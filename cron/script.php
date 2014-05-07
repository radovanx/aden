<?php

$time = microtime(true); // time in Microseconds

define('WP_USE_THEMES', FALSE);
require( '../wp-load.php' );

require_once(ABSPATH . "wp-admin/includes/image.php");
require_once(ABSPATH . "wp-admin/includes/file.php");
require_once(ABSPATH . "wp-admin/includes/media.php");
require_once(ABSPATH . "wp-admin/includes/image.php");

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

/*
  function wrap_lang($string, $lang) {
  if (is_string($lang)) {
  $string .= "[:$lang]" . $string;
  }

  return $string;
  }

  function has_lang($string, $lang){
  return false !== strpos("[:$lang]", $string);
  }
  function update_lang_part($string, $lang){

  } */

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
        $post_information = array(
            'post_title' => $ret['freitexte|objekttitel'],
            'post_content' => '',
            'post_type' => 'flat',
            'post_status' => 'publish',
        );

        if (!empty($apartment_id)) {
            $post_information['ID'] = $apartment_id;
        }

        $apartment_id = wp_insert_post($post_information);


        update_post_meta((int) $apartment_id, 'anbieternr', $anbieternr);

        // nasázím vlastnosti bytu
        foreach ($ret as $key => $val) {

            $split = explode('|', $key);

            if (1 == $deeps[$key] || !in_array($split[0], EstateProgram::$tags_apartment)) {
                continue;
            }
            //update_post_meta((int) $apartment_id, $key, $val);
            //update_post_metalang($apartment_id, $lang, $key, $val);

            $wp_lang = EstateProgram::$langs[$lang];
            update_post_metalang($apartment_id, $wp_lang, $key, $val);
        }

        // zjistim jestli existuje program na stejne adrese
        $cityNode = $anbieter->xpath('immobilie/geo/ort');
        $city = (string) $cityNode[0];

        $streetNode = $anbieter->xpath('immobilie/geo/strasse');
        $street = (string) $streetNode[0];

        $regionNode = $anbieter->xpath('immobilie/geo/regionaler_zusatz');
        $region = (string) $regionNode[0];

        $houseNumberNode = $anbieter->xpath('immobilie/geo/hausnummer');
        $houseNumber = (string) $houseNumberNode[0];

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
            " . $wpdb->prefix . "postmeta as pm3
          ON
            pm1.post_id = pm3.post_id
          JOIN
            " . $wpdb->prefix . "postmeta as pm4
          ON
            pm1.post_id = pm4.post_id
          JOIN
            " . $wpdb->prefix . "posts as p
          ON
            p.ID = pm1.post_id
          WHERE
            pm1.meta_key = '_program_city'
          AND
            pm2.meta_key = '_program_street'
          AND
            pm3.meta_key = '_program_district'
          AND
            pm4.meta_key = '_house_number'
          AND
            pm1.meta_value = '" . esc_sql($city) . "'
          AND
            pm2.meta_value = '" . esc_sql($street) . "'
          AND
            pm3.meta_value = '" . esc_sql($region) . "'
          AND
            pm4.meta_value = '" . esc_sql($houseNumber) . "'
          AND
            p.post_type = 'program'
          ";
        

        $program_id = $wpdb->get_var($sql);
        
        //
        if(!empty($program_id)){
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

        /*
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
         */

        // zgrabovani obrazků
        $images = $anbieter->xpath('immobilie/anhaenge/anhang');

        $set_program_thumb = true;

        foreach ($images as $image) {
            $file = $image->xpath('daten/pfad');
            $image_title = (string) $image->anhangtitel;
            $image_file = (string) $file[0];

            $image_path = ABSPATH . 'ftp' . '/' . $lang . '/' . $image_file;

            if (is_file($image_path)) {

                $finfo = pathinfo($image_path);
                $wp_upload_dir = wp_upload_dir();

                $new_path = $wp_upload_dir['path'] . '/' . $image_file;

                if (copy($image_path, $new_path)) {

                    $basename = basename($new_path);

                    // Check the type of tile. We'll use this as the 'post_mime_type'.
                    $filetype = wp_check_filetype(basename($new_path), null);

                    $attachment = array(
                        'guid' => $wp_upload_dir['url'] . '/' . $basename,
                        'post_mime_type' => $filetype['type'],
                        'post_title' => $image_title,
                        'post_content' => '',
                        'post_status' => 'inherit',
                        'post_excerpt' => $image_title,
                    );


                    // ma uz byt obrazek se stejnym nazvem
                    $attach_id = $wpdb->get_var("
                                            SELECT
                                                ID
                                            FROM
                                                " . $wpdb->prefix . "posts AS p
                                            JOIN
                                                " . $wpdb->prefix . "postmeta AS pm
                                            ON
                                                pm.post_id = p.ID AND pm.meta_key = '_original_image_name'
                                            WHERE
                                                post_parent = " . (int) $apartment_id . "
                                            AND
                                                pm.meta_value = '" . $basename . "'");

                    if (empty($attach_id)) {
                        // Insert the attachment.
                        $attach_id = wp_insert_attachment($attachment, $new_path, $apartment_id);
                    } else {
                        $attachment['ID'] = $attach_id;
                        wp_update_post($attachment);
                    }

                    // Generate the metadata for the attachment, and update the database record.
                    $attach_data = wp_generate_attachment_metadata($attach_id, $new_path);
                    wp_update_attachment_metadata($attach_id, $attach_data);

                    update_post_meta($attach_id, '_wp_attachment_image_alt', $basename);
                    update_post_meta($attach_id, '_original_image_name', $basename);

                    /*
                      if($set_program_thumb && !has_post_thumbnail($program_id)){
                      set_post_thumbnail($program_id, $attach_id);
                      } else {
                      $set_program_thumb = false;
                      } */
                }
            }
        }
    }
}

global $wpdb;

$langs = EstateProgram::$langs;

foreach ($langs as $key => $val) {

    $source_dir = ABSPATH . 'ftp' . DIRECTORY_SEPARATOR . $key;

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
                    grab_it($xml, $key);
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
