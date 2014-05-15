<?php

$time = microtime(true); // time in Microseconds


require( ABSPATH . 'wp-load.php' );

require_once(ABSPATH . "wp-admin/includes/image.php");
require_once(ABSPATH . "wp-admin/includes/file.php");
require_once(ABSPATH . "wp-admin/includes/media.php");
require_once(ABSPATH . "wp-admin/includes/image.php");

class SourceParser {

    /**
     *
     * @param type $node
     * @param string $prefix
     * @return type
     */
    function parse_nodes($node, $prefix = '') {

        //var_dump($node);
        // nechci obrazky
        if ($node->getName() == 'anhaenge') {
            return;
        }

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

            $children = SourceParser::parse_nodes($child, $child->getName());

            $return = array_merge($return, (array) $children);
        }

        return $return;
    }

    /**
     *
     */
    function grab_it($file, $lang, $source_path) {

        $realpath = realpath($file);

        $xml = simplexml_load_file($realpath);

        $wp_lang = EstateProgram::$langs[$lang];

        global $wpdb;

        $result = $xml->xpath('/openimmo/anbieter');

        foreach ($result as $anbieter) {

            $anbieternr = (string) $anbieter->anbieternr;
            $firma = (string) $anbieter->firma;
            $openimmo_anid = (string) $anbieter->openimmo_anid;

            $unique_identificator_node = $anbieter->xpath('immobilie/verwaltung_techn/objektnr_extern');

            $unique_identificator = (string) $unique_identificator_node[0];

            //var_dump($unique_identificator); exit;
            // 
            //$cityNode = $anbieter->xpath('immobilie/geo/ort');
            //$city = (string) $cityNode[0];

            $streetNode = $anbieter->xpath('immobilie/geo/strasse');
            $street = (string) $streetNode[0];

            //$regionNode = $anbieter->xpath('immobilie/geo/regionaler_zusatz');
            //$region = (string) $regionNode[0];

            $houseNumberNode = $anbieter->xpath('immobilie/geo/hausnummer');
            $houseNumber = (string) $houseNumberNode[0];

            $ret = SourceParser::parse_nodes($anbieter);


            // zjistim jestli existuje apartment na stejne adrese            
            $sql = "
            SELECT
                p.ID
            FROM
                wp_posts AS p
            JOIN
                wp_postmeta AS pm                
            ON
                pm.post_id = p.ID
            WHERE
                pm.meta_key = 'unique_identificator'
            AND
                pm.meta_value = '" . esc_sql(trim($unique_identificator)) . "'
            AND
                p.post_type = 'flat'
            ";

            $apartment_id = $wpdb->get_var($sql);

            //
            $post_information = array(
                //'post_title' => $ret['freitexte|objekttitel'],
                'post_content' => '',
                'post_type' => 'flat',
                'post_status' => 'publish',
            );


            if (!empty($apartment_id)) {

                $post_title = $wpdb->get_var("SELECT post_title FROM wp_posts WHERE ID = " . (int) $apartment_id);
                $pattern = "~<!--:$wp_lang-->(.*)<!--:-->~U";
                $post_title = preg_replace($pattern, '', $post_title);

                if (false != trim($ret['freitexte|objekttitel'])) {
                    $post_information['post_title'] = $post_title . '<!--:' . $wp_lang . '-->' . $ret['freitexte|objekttitel'] . '<!--:-->';
                }
                $post_information['ID'] = $apartment_id;

                wp_insert_post($post_information);
            } else {
                $apartment_id = wp_insert_post($post_information);

                if (!empty($ret['freitexte|objekttitel'])) {
                    $post_information['post_title'] = '<!--:' . $wp_lang . '-->' . $ret['freitexte|objekttitel'] . '<!--:-->';
                } else {
                    $post_information['post_title'] = '';
                }
            }

            update_post_meta((int) $apartment_id, 'unique_identificator', $unique_identificator);
            //update_post_meta((int) $apartment_id, 'apartment_street', $street);
            //update_post_meta((int) $apartment_id, 'apartment_house_number', $houseNumber);

            $props = array();
            $excl = array('anhaenge', 'anhang');

            // nasázím vlastnosti bytu
            foreach ($ret as $key => $val) {

                $split = explode('|', $key);

                if ((false == (rtrim($val)) && count($split) > 1) || in_array($split[0], $excl)) {
                    continue;
                }

                if ('geo|ort' == $key) {
                    $sql = "REPLACE INTO
                            city (lang, city)
                         VALUES(
                            '" . $wp_lang . "',
                            '" . $val . "')";

                    $wpdb->query($sql);

                    $last_city_id = $wpdb->insert_id;
                }

                if ('geo|regionaler_zusatz' == $key) {
                    $region = $val;
                }

                $props[$key] = rtrim($val);
                //update_post_metalang($apartment_id, $wp_lang, $key, $val);
            }


            if (!empty($last_city_id) && !empty($region)) {
                $sql = "REPLACE INTO
                            region (lang, region, id_city)
                         VALUES(
                            '" . $wp_lang . "',
                            '" . $region . "',
                            " . $last_city_id . ")";

                $wpdb->query($sql);
            }



            // zjistim jestli existuje program na stejne adrese
            $sql = "
          SELECT
            p.ID,
            p.post_title
          FROM
             " . $wpdb->prefix . "postmeta as pm2
          JOIN
            " . $wpdb->prefix . "postmeta as pm4
          ON
            pm2.post_id = pm4.post_id
          JOIN
            " . $wpdb->prefix . "posts as p
          ON
            p.ID = pm2.post_id
          WHERE
            pm2.meta_key = '_program_street'
          AND
            pm4.meta_key = '_program_house_number'
          AND
            pm2.meta_value = '" . esc_sql(rtrim($street)) . "'
          AND
            pm4.meta_value = '" . esc_sql(rtrim($houseNumber)) . "'
          AND
            p.post_type = 'program'
          ";


            $program_id = $wpdb->get_var($sql);

            //
            if (!empty($program_id)) {
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

            // zgrabovani obrazků
            $images = $anbieter->xpath('immobilie/anhaenge/anhang');

            $set_apartment_thumb = true;

            //$props['dropbox'] = array();
            //$props['youtube'] = array();

            foreach ($images as $image) {
                $file = $image->xpath('daten/pfad');
                $image_title = (string) $image->anhangtitel;
                $image_file = (string) $file[0];

                //$image_path = ABSPATH . 'ftp' . '/' . $lang . '/' . $image_file;

                if (false !== strpos($image_file, 'http')) {
                    if (false !== strpos($image_file, 'dropbox')) {

                        if (false !== strpos($image_title, 'flat')) {
                            $props['dropbox|flat'] = $image_file;
                            continue;
                        }

                        if (false !== strpos($image_title, 'building')) {
                            $props['dropbox|building'] = $image_file;
                            continue;
                        }
                    }

                    if (false !== strpos($image_file, 'youtu')) {
                        $props['youtube'] = $image_file;
                        continue;
                    }
                }

                //$image_path = ABSPATH . 'ftp' . '/' . $lang . '/' . $image_file;
                $image_path = $source_path . DIRECTORY_SEPARATOR . $image_file;

                if (is_file($image_path)) {

                    $finfo = pathinfo($image_path);
                    $wp_upload_dir = wp_upload_dir();

                    $new_path = $wp_upload_dir['path'] . '/' . $image_file;

                    if (copy($image_path, $new_path)) {

                        //chmod($new_path, 0775);

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


                        if ($set_apartment_thumb && !has_post_thumbnail($apartment_id)) {
                            set_post_thumbnail($apartment_id, $attach_id);
                        } else {
                            $set_apartment_thumb = false;
                        }
                    }
                }
            }

            update_post_meta($apartment_id, 'flat_props_' . $wp_lang, $props);
        }
    }

    public static function all() {
        $err = array();

// start programu
        global $wpdb;

        $langs = EstateProgram::$langs;



        foreach ($langs as $key => $val) {

            $source_dir = ABSPATH . $key . '/';

            if (!is_dir($source_dir)) {
                throw new Exception('Zdrojový adresář ' . $source_dir . ' neexistuje');
            }

            // var_dump($source_dir);

            if ($handle = opendir($source_dir)) {

                while (false !== ($entry = readdir($handle))) {

                    $file = $source_dir . DIRECTORY_SEPARATOR . $entry;
                    $temp_dir = $source_dir . DIRECTORY_SEPARATOR . 'temp';

                    SourceParser::read_zip($file, $key, $temp_dir);
                }
            } else {
                throw new Exception('Nepodařilo se otevřít zdrojový adresář ' . $source_dir . ' neexistuje');
            }
        }
    }

    /**
     * 
     * @param type $fil
     * @param type $dir
     * @param type $temp
     * @return type
     * @throws Exception
     */
    public static function read_zip($file, $dir, $temp_dir) {

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if ('zip' != strtolower($ext)) {
            return;
        }

        // var_dump($file);

        $zip = new ZipArchive;
        $res = $zip->open($file);

        //var_dump($file);
        // extrahovani zipu do tempu
        if (true == $res) {
            //$image_path = ABSPATH . 'ftp' . '/' . $lang . '/' . $image_file;
            /*
            if (!is_dir($temp_dir)) {
                if (!mkdir($temp_dir, 0775)) {
                    throw new Exception('unable create temp dir');
                }
            }*/

            $zip->extractTo($temp_dir);
            $zip->close();

            $in_temp = array();

            // projdu unzipovany xml
            if ($temp_handle = opendir($temp_dir)) {
                while (false !== ($entry = readdir($temp_handle))) {

                    $temp_file = $temp_dir . DIRECTORY_SEPARATOR . $entry;

                    //chmod($temp_file, 0775);

                    $temp_file_ext = strtolower(pathinfo($temp_file, PATHINFO_EXTENSION));

                    if (is_file($temp_file)) {
                        $in_temp[] = $temp_file;
                    }

                    if ('xml' == $temp_file_ext) {
                        SourceParser::grab_it($temp_file, $dir, $temp_dir);
                    }
                }

                //promažu temp
                foreach ($in_temp as $temp_file) {
                    unlink($temp_file);
                }

                // přesunu zdrovy zip do archivu
                $archiv_dir = $source_dir . DIRECTORY_SEPARATOR . 'archiv';

                /*
                if (!is_dir($archiv_dir)) {
                    if (!mkdir($archiv_dir, 0775)) {
                        throw new Exception('unable create archiv dir');
                    }
                }*/

                rename($file, $archiv_dir . DIRECTORY_SEPARATOR . basename($file));
            }


            /*
              if ($temp_handle2 = opendir($temp_dir)) {
              while (false !== ($entry = readdir($temp_handle2))) {
              $temp_file = $temp_dir . DIRECTORY_SEPARATOR . $entry;
              }
              } */
        } else {
            $err[] = esc_attr('Zip: resource failed - ' . $file);
        }
    }

}
