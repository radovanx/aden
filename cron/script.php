<?php

$time = microtime(true); // time in Microseconds

define('WP_USE_THEMES', FALSE);
require( '../wp-load.php' );

/**
 *
 * @param type $node
 * @param string $prefix
 * @return type
 */
function parse_nodes($node, $prefix = '') {

    $return = array();

    if (!empty($prefix)) {
        $prefix .= '|';
    }

    foreach ($node->children() as $child) {

        $attr = $child->attributes();

        foreach ($attr as $att) {
            $return[$prefix . $child->getName() . '|' . $att->getName()] = (string) $att;
        }

        $string = (string) $child;
        $return[$prefix . $child->getName()] = $string;

        $children = parse_nodes($child, $child->getName());

        $return = array_merge($return, $children);
    }

    return $return;
}

/**
 *
 */
function grab_it($xml, $lang) {

    $processed_program = array();

    global $wpdb;

    $exclude_tag = array(
        'anhaenge'
    );

    //
    $uebertragung = $xml->xpath('/openimmo/uebertragung');

    $result = $xml->xpath('/openimmo/anbieter');

    $immobilie = $xml->xpath('/openimmo/anbieter/immobilie');

    // ulozim si hlavni vlastnosti bytu / programu
    foreach ($immobilie as $val) {
        foreach ($val->children() as $tag) {
            $name = (string) $tag->getName();
            $sql = "SELECT p2m FROM tag2meta_key WHERE tag = '" . $name . "' AND meta_key = '" . $name . "' AND deep = 1";
            $exists = $wpdb->get_var($sql);
            if (empty($exists)) {
                $sql = "INSERT INTO
                                tag2meta_key (tag, meta_key, deep)
                            VALUES (
                                '" . esc_sql($name) . "',
                                '" . esc_sql($name) . "',
                                1
                            )";
                $wpdb->query($sql);
            }
        }
    }

    $sql = "SELECT * FROM tag2meta_key WHERE deep = 1";
    $parent_res = $wpdb->get_results($sql);

    $parents = array();
    foreach ($parent_res as $r) {
        $parents[$r->tag] = $r->p2m;
    }

    foreach ($result as $anbieter) {

        $anbieternr = (string) $anbieter->anbieternr;
        $firma = (string) $anbieter->firma;
        $openimmo_anid = (string) $anbieter->openimmo_anid;

        $ret = parse_nodes($anbieter->immobilie);

        $deeps = array();
        foreach ($ret as $key => $val) {

            $split = explode('|', $key);
            $deep = count($split);
            $deeps[$key] = $deep;

            if (1 == $deep || in_array($split[0], $exclude_tag)) {
                // its parent element
                continue;
            }

            //vytvorim mapu tagu z xml na meta_key v tabulce wp_post_meta
            $sql = "SELECT p2m FROM tag2meta_key WHERE meta_key = '" . esc_sql($key) . "'";
            $exists = $wpdb->get_var($sql);

            if (empty($exists)) {

                $parent_id = $parents[$split[0]];

                $sql = "
                        INSERT INTO
                            tag2meta_key (tag, meta_key, deep, parent)
                        VALUES (
                            '" . esc_sql($split[0]) . "',
                            '" . esc_sql($key) . "',
                            '" . $deep . "',
                            '" . $parent_id . "'
                        )";

                $wpdb->query($sql);
            }
        }


        $sql = "
            SELECT
                post_id
            FROM
                " . $wpdb->prefix . "postmeta
            JOIN
                " . $wpdb->prefix . "posts
            WHERE
                meta_key = 'anbieternr'
            AND
                meta_value = '" . esc_sql($anbieternr) . "'";

        $apartment_id = $wpdb->get_var($sql);

        //
        if (empty($apartment_id)) {

            $post_information = array(
                'post_title' => $ret['freitexte|objekttitel'],
                'post_content' => '',
                'post_type' => 'flat',
                'post_status' => 'publish',
            );

            $apartment_id = wp_insert_post($post_information);
        }

        update_post_meta((int) $apartment_id, 'anbieternr', $anbieternr);

        // nasázím vlastnosti bytu
        foreach ($ret as $key => $val) {

            $split = explode('|', $key);

            if (1 == $deeps[$key] || !in_array($split[0], EstateProgram::$tags_apartment)) {
                continue;
            }
            update_post_meta((int) $apartment_id, $key, $val);
        }

        // zjistim jestli existuje program na stejne adrese
        $address_nodes = $anbieter->xpath('immobilie/geo');
        $address = parse_nodes($address_nodes[0]);

        $sql = "
                SELECT
                    p.ID
                FROM
                    " . $wpdb->prefix . "postmeta as pm1
                JOIN
                    " . $wpdb->prefix . "postmeta as pm2
                ON
                    pm1.post_id = pm2.post_id
                JOIN
                    " . $wpdb->prefix . "posts as p
                ON
                    p.ID = pm1.post_id
                WHERE
                    pm1.meta_key = 'geo|geokoordinaten|breitengrad'
                AND
                    pm2.meta_key = 'geo|geokoordinaten|laengengrad'
                AND
                    pm1.meta_value = '" . esc_sql($address['geokoordinaten|breitengrad']) . "'
                AND
                    pm2.meta_value = '" . esc_sql($address['geokoordinaten|laengengrad']) . "'
                AND
                    p.post_type = 'program'

            ";

        $program_id = $wpdb->get_var($sql);

        // pokud jeste neni vytvoren program teto adrese
        if (!in_array($program_id, $processed_program)) {

            if (empty($program_id)) {
                $post_information = array(
                    'post_title' => $ret['freitexte|objekttitel'],
                    'post_content' => '',
                    'post_type' => 'program',
                    'post_status' => 'publish',
                );

                $program_id = wp_insert_post($post_information);
            }

            //
            foreach ($ret as $key => $val) {

                $split = explode('|', $key);

                if (1 == $deeps[$key] || !in_array($split[0], EstateProgram::$tags_program)) {
                    continue;
                }
                update_post_meta((int) $program_id, $key, $val);
            }

            array_push($processed_program, $program_id);
        }

        // ulozim vztah mezi programem a bytem
        $sql = "
            REPLACE INTO
                apartment2program (apartment_id, program_id)
            VALUES(
                '" . (int) $apartment_id . "',
                '" . (int) $program_id . "'
            )
            ";
        
        $wpdb->query($sql);
    }
}

global $wpdb;

$langs = array(
    'fr' => 'fr',
    'en' => 'eng',
);

foreach ($langs as $key => $val) {

    $source_dir = ABSPATH . 'ftp' . DIRECTORY_SEPARATOR . $val;

    if (!is_dir($source_dir)) {
        throw new Exception('Zdrojový adresář ' . $source_dir . ' neexistuje');
    }

    if ($handle = opendir($source_dir)) {
        while (false !== ($entry = readdir($handle))) {

            $file = $source_dir . DIRECTORY_SEPARATOR . $entry;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if ('xml' == $ext) {
                if (file_exists($file)) {
                    $xml = simplexml_load_file($file);
                    grab_it($xml, $lang);
                    //
                } else {
                    throw new Exception('Nepodařilo se otevřít soubor ' . $file);
                }
            }
        }
    } else {
        throw new Exception('Nepodařilo se otevřít zdrojový adresář ' . $source_dir . ' neexistuje');
    }
}


echo (microtime(true) - $time) . ' elapsed';
