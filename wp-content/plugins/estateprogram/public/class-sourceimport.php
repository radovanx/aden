<?php

class SourceImport {

    protected $file;
    protected $fp;

    public function __construct() {
        
    }

    public function __destruct() {
        
    }

    /**
     *
     * @throws Exception
     */
    public static function run() {

        require ( ABSPATH . 'wp-admin/includes/image.php' );

        foreach (EstateProgram::$langs as $lang_dir => $lang) {

            $source_dir = ABSPATH . $lang_dir;
            $temp_dir = ABSPATH . $lang_dir . DIRECTORY_SEPARATOR . 'temp';
            $archiv_dir = ABSPATH . $lang_dir . DIRECTORY_SEPARATOR . 'archiv';

            if (!is_dir($source_dir)) {
                throw new Exception('Could not find source dir');
            }

            if (!is_dir($temp_dir)) {
                if (mkdir($temp_dir, 0775)) {
                    throw new Exception('Could not create temp dir ');
                }
            }

            if (!is_dir($archiv_dir)) {
                if (mkdir($archiv_dir, 0775)) {
                    throw new Exception('Could not create archiv dir ');
                }
            }

            // projdu zipy
            foreach (glob($source_dir . "/*.zip") as $zip_file) {
                $temp_dir = SourceImport::extract_zip($zip_file, $temp_dir, $archiv_dir);
                SourceImport::process_temp_files($temp_dir, $lang);

                // delete temp files
                array_map('unlink', glob($temp_dir . "/*"));

                // presunout zip do archivu
                $target = $archiv_dir . DIRECTORY_SEPARATOR . basename($zip_file);
                rename($zip_file, $target);
            }
        }
    }

    /**
     * called from backoffice ajaxem
     *
     * @param string $zip_file
     * @param type $lang_dir
     * @throws Exception
     */
    public function processBackendParseXml($zip_file, $lang_dir) {


        //$str = 'call processBackendParseXml: zip_file: ' . $zip_file . ' | lang_dir: ' . $lang_dir . "\n";
        //file_put_contents(EstateProgramAjax::$log_file, $str, FILE_APPEND);
        //sleep(10);

        $lang = EstateProgram::$langs[$lang_dir];

        $source_dir = ABSPATH . $lang_dir;
        $temp_dir = ABSPATH . $lang_dir . DIRECTORY_SEPARATOR . 'temp';
        $archiv_dir = ABSPATH . $lang_dir . DIRECTORY_SEPARATOR . 'archiv';

        if (!is_dir($temp_dir)) {
            if (mkdir($temp_dir, 0775)) {
                throw new Exception('Could not create temp dir ');
            }
        }

        if (!is_dir($archiv_dir)) {
            if (mkdir($archiv_dir, 0775)) {
                throw new Exception('Could not create archiv dir ');
            }
        }

        $zip_file = $source_dir . DIRECTORY_SEPARATOR . $zip_file;

        if (file_exists($zip_file)) {

            SourceImport::extract_zip($zip_file, $temp_dir, $archiv_dir);
            SourceImport::process_temp_files($temp_dir, $lang);

            // delete temp files
            array_map('unlink', glob($temp_dir . "/*"));

            // presunout zip do archivu
            $target = $archiv_dir . DIRECTORY_SEPARATOR . basename($zip_file);


            if (file_exists($zip_file)) {
                rename($zip_file, $target);
            }
        }
    }

    /**
     *
     * @param type $node
     * @param string $prefix
     * @return type
     */
    public static function parse_nodes($node, $prefix = '') {

        //return array();
        //echo "1\n";

        if ($node->getName() == 'anhaenge') {
            return;
        }
        
        if('immobilie' == $prefix){
            $prefix = '';
        }

        if (!empty($prefix)) {
            $prefix .= '|';
        }

        $return = array();

        if (0 != count($node->children())) {
            foreach ($node->children() as $child) {

                $attr = $child->attributes();

                foreach ($attr as $att) {
                    $return[$prefix . $child->getName() . '|' . $att->getName()] = (string) $att;
                }

                $string = (string) $child;

                //echo $string . "\n";

                $return[$prefix . $child->getName()] = $string;

                $children = SourceImport::parse_nodes($child, $prefix . $child->getName());

                $return = array_merge($return, (array) $children);
            }
        }

        //print_r($return);

        return $return;
    }

    /**
     *
     * @global type $wpdb
     * @param type $xml_file
     * @param type $temp_dir
     * @param type $lang
     */
    public static function parse_xml($xml_file, $temp_dir, $lang) {
        global $wpdb;

        //EstateProgramAjax::$log_file = ABSPATH . $dir . DIRECTORY_SEPARATOR . 'import_log';
        //$str = 'call parse_xml: xml_file: ' . $xml_file . ' | temp_dir: ' . $temp_dir . ' | lang: ' . $lang . "\n";
        //file_put_contents(EstateProgramAjax::$log_file, $str, FILE_APPEND);


        $xml = simplexml_load_file($xml_file);

        $result = $xml->xpath('/openimmo/anbieter');

        if (false == $result) {
            throw new Exception('Could not load xml file');
        }


        $node = $xml->xpath('/openimmo/uebertragung');
        $uebertragung = $node[0];

        //
        $action = (string) $uebertragung->attributes()->modus;

        // id inzeratu
        $unique_identificator_node = $xml->xpath('/openimmo/anbieter/immobilie/verwaltung_techn/objektnr_extern');
        $unique_identificator = (string) $unique_identificator_node[0];

        //$str = "uid:" . $unique_identificator . "\n";
        //file_put_contents(EstateProgramAjax::$log_file, $str, FILE_APPEND);
        //var_dump($unique_identificator);
        // zjistim zdali tento byt je již importován
        $sql = "
            SELECT p.ID FROM wp_posts AS p
            JOIN wp_postmeta AS pm ON pm.post_id = p.ID
            WHERE pm.meta_key = 'unique_identificator'
            AND pm.meta_value = '" . esc_sql(trim($unique_identificator)) . "'
            AND p.post_type = 'flat'";

        $apartment_id = $wpdb->get_var($sql);

        if ('DELETE' == $action) {
            if (!empty($apartment_id)) {
                wp_trash_post($apartment_id);
            }
        } else {


            foreach ($result as $anbieter) {

                $streetNode = $anbieter->xpath('immobilie/geo/strasse');
                $street = (string) $streetNode[0];

                $houseNumberNode = $anbieter->xpath('immobilie/geo/hausnummer');
                $houseNumber = (string) $houseNumberNode[0];

                $ret = SourceImport::parse_nodes($anbieter);
                //
                $post_information = array(
                    'post_content' => '',
                    'post_type' => 'flat',
                    'post_status' => 'publish',
                );

                if (!empty($apartment_id)) {

                    $post_title = $wpdb->get_var("SELECT post_title FROM wp_posts WHERE ID = " . (int) $apartment_id);
                    $pattern = "~<!--:$lang-->(.*)<!--:-->~U";
                    $post_title = preg_replace($pattern, '', $post_title);

                    if (!empty($ret['freitexte|objekttitel'])) {
                        $post_information['post_title'] = $post_title . '<!--:' . $lang . '-->' . $ret['freitexte|objekttitel'] . '<!--:-->';
                    } else {
                        $post_information['post_title'] = $unique_identificator;
                    }
                    $post_information['ID'] = $apartment_id;

                    wp_insert_post($post_information);
                } else {

                    if (!empty($ret['freitexte|objekttitel'])) {
                        $post_information['post_title'] = '<!--:' . $lang . '-->' . $ret['freitexte|objekttitel'] . '<!--:-->';
                    } else {
                        $post_information['post_title'] = '';
                    }
                    
                    if(empty($post_information['post_title'])){
                        $post_information['post_title'] = $unique_identificator;
                    }

                    $apartment_id = wp_insert_post($post_information);
                    // vložim unikátní identifikátor inzerátu bytu
                    add_post_meta((int) $apartment_id, 'unique_identificator', $unique_identificator);
                }

                $props = array();
                // nasázím vlastnosti bytu
                foreach ($ret as $key => $val) {

                    $split = explode('|', $key);

                    /*
                    if ((false == (rtrim($val)) && count($split) > 1)) {
                        continue;
                    }*/
                    // podržim si město
                    if ('geo|ort' == $key) {
                        $city = $val;
                    }
                    // podržim region
                    if ('geo|regionaler_zusatz' == $key) {
                        $region = $val;
                    }
                    // pole s vlastnostrmi bytu
                    $props[$key] = rtrim($val);
                }
                //
                wp_set_object_terms($apartment_id, null, 'location');

                if (!empty($city)) {

                    $flat_location_terms = array();

                    $city_term = term_exists($city, 'location');
                    // uložim město
                    if (empty($city_term)) {
                        $city_term = wp_insert_term($city, 'location');
                    }

                    $city_term_id = $city_term['term_id'];
                    // spraruju mesto s bytem
                    wp_set_post_terms($apartment_id, $city_term_id, 'location', true);

                    // ulozim region
                    if (!empty($region) && !empty($city_term_id)) {

                        $region_term = term_exists($region, 'location');

                        if (empty($region_term)) {
                            $region_term = wp_insert_term($region, 'location', array(
                                'parent' => $city_term_id
                            ));
                        }
                        // spraruju region s bytem
                        wp_set_post_terms($apartment_id, $region_term['term_id'], 'location', true);
                    }
                }

                // zjistim jestli existuje program na stejne adrese
                $sql = $wpdb->prepare("
                    SELECT p.ID, p.post_title FROM " . $wpdb->prefix . "postmeta as pm2
                    JOIN " . $wpdb->prefix . "postmeta as pm4 ON pm2.post_id = pm4.post_id
                    JOIN " . $wpdb->prefix . "posts as p ON p.ID = pm2.post_id
                    WHERE pm2.meta_key = '_program_street'
                    AND pm4.meta_key = '_program_house_number'
                    AND pm2.meta_value = %s
                    AND pm4.meta_value = %s
                    AND p.post_type = 'program'
                ", $street, $houseNumber);

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
                } else {
                    
                }

                // zgrabovani obrazků
                $images = $anbieter->xpath('immobilie/anhaenge/anhang');

                //$set_apartment_thumb = true;
                //$has_apartment_thumbnail = has_post_thumbnail($apartment_id);
                //$images = array_reverse($images);

                $thumb_id = false;
                $wp_upload_dir = wp_upload_dir();
                //
                foreach ($images as $image) {

                    $gruppe = (string) $image->attributes()->gruppe;

                    $file = $image->xpath('daten/pfad');
                    $image_title = (string) $image->anhangtitel;
                    $image_file = (string) $file[0];

                    $image_title = trim($image_title);
                    $image_file = trim($image_file);

                    //$str = "processing image:" . esc_attr($image_file) . '| Image title: ' . $image_title . "\n";
                    //file_put_contents(EstateProgramAjax::$log_file, $str, FILE_APPEND);
                    //if (false !== strpos($image_file, 'http')) {

                    if ('LINKS' == $gruppe) {

                        if (false !== strpos($image_title, 'flat')) {
                            $props['dropbox|flat'] = $image_file;
                            //continue;
                        }

                        if (false !== strpos($image_title, 'building')) {
                            $props['dropbox|building'] = $image_file;
                            //continue;
                        }

                        /*
                          if (false !== strpos($image_file, 'dropbox')) {

                          if (false !== strpos($image_title, 'flat')) {
                          $props['dropbox|flat'] = $image_file;
                          //continue;
                          }

                          if (false !== strpos($image_title, 'building')) {
                          $props['dropbox|building'] = $image_file;
                          //continue;
                          }
                          }

                          if (false !== strpos($image_file, 'youtu')) {
                          $props['youtube'] = $image_file;
                          //continue;
                          }
                         */
                    } else if('FILMLINK' == $gruppe) {
                        
                        if(empty($props['youtube'])){
                            $props['youtube'] = array();
                        }
                        
                        $props['youtube'][] = $image_file;
                        //$props['youtube'] = $image_file;
                    } else {

                        $image_path = $temp_dir . DIRECTORY_SEPARATOR . $image_file;

                        // ma uz byt obrazek se stejnym nazvem
                        $sql = $wpdb->prepare("SELECT attach_id FROM images2post WHERE apartment_id = %d AND filename = %s", $apartment_id, $image_file);
                        $existing_attach_id = $wpdb->get_var($sql);

                        //$str = "image:" . esc_attr($image_file) . '|sql:' . $sql . '|id:' . $existing_attach_id . "\n";
                        //file_put_contents(EstateProgramAjax::$log_file, $str, FILE_APPEND);

                        if (!empty($existing_attach_id)) {

                            $existing_image_title = $wpdb->get_var($wpdb->prepare("SELECT post_title FROM wp_posts WHERE ID = %d", $existing_attach_id));
                            $pattern = "~<!--:$lang-->(.*)<!--:-->~U";
                            $existing_image_title = preg_replace($pattern, '', $existing_image_title);

                            $attachment = array(
                                'post_title' => $existing_image_title . '<!--:' . $lang . '-->' . $image_title . '<!--:-->',
                                'post_excerpt' => $image_title,
                            );

                            $attachment['ID'] = $existing_attach_id;
                            wp_update_post($attachment);
                            
                            set_post_thumbnail($apartment_id, $existing_attach_id);
                            
                        } else {

                            if (file_exists($image_path)) {
                                $finfo = pathinfo($image_path);
                                $new_path = $wp_upload_dir['path'] . '/' . $image_file;
                                if (copy($image_path, $new_path)) {
                                    $basename = basename($new_path);
                                    // Check the type of tile. We'll use this as the 'post_mime_type'.
                                    $filetype = wp_check_filetype(basename($new_path), null);
                                    //
                                    $attachment = array(
                                        'guid' => $wp_upload_dir['url'] . '/' . $basename,
                                        'post_mime_type' => $filetype['type'],
                                        'post_title' => '<!--:' . $lang . '-->' . $image_title . '<!--:-->',
                                        'post_content' => '',
                                        'post_status' => 'inherit',
                                        'post_excerpt' => $image_title,
                                    );

                                    // Insert the attachment.
                                    $attach_id = wp_insert_attachment($attachment, $new_path, $apartment_id);
                                    // Generate the metadata for the attachment, and update the database record.
                                    $attach_data = wp_generate_attachment_metadata($attach_id, $new_path);
                                    wp_update_attachment_metadata($attach_id, $attach_data);

                                    //update_post_meta($attach_id, '_wp_attachment_image_alt', $image_title);
                                    //update_post_meta($attach_id, '_original_image_name', $basename);
                                    $sql = "
                                            INSERT INTO images2post (apartment_id, filename, attach_id) VALUES (
                                                " . (int) $apartment_id . ",
                                                '" . esc_sql($image_file) . "',
                                                " . (int) $attach_id . "    
                                                )
                                    ";

                                    $wpdb->query($sql);

                                    if ('TITELBILD' == $gruppe) {
                                        set_post_thumbnail($apartment_id, $thumb_id);
                                    }
                                }
                            }
                        }
                        //
                    }
                }

                update_post_meta($apartment_id, 'flat_props_' . $lang, $props);
            }
        }
    }

    /**
     *
     * @param type $temp_dir
     * @throws Exception
     */
    public static function process_temp_files($temp_dir, $lang) {

        //$str = 'call process_temp_files: temp_dir: ' . $temp_dir . ' | lang: ' . $dir . "\n";
        //file_put_contents(EstateProgramAjax::$log_file, $str, FILE_APPEND);

        $xml_found = false;

        foreach (glob($temp_dir . "/*.xml") as $file) {
            $xml_found = true;
            SourceImport::parse_xml($file, $temp_dir, $lang);
            break;
        }

        if (!$xml_found) {
            throw new Exception('Could not find xml file in temp dir');
        }
    }

    /**
     *
     * @param type $path_to_zip
     * @param type $temp_dir
     * @param type $archiv_dir
     */
    public static function extract_zip($zip_file, $temp_dir, $archiv_dir) {

        // extract zip file to temp
        $zip = new ZipArchive;
        $res = $zip->open($zip_file);

        if (true == $res) {
            if ($zip->extractTo($temp_dir)) {
                $zip->close();
            } else {
                throw new Exception('Extract zip file to temp dir failed. temp dir ' . $temp_dir);
            }
        } else {
            throw new Exception('Cannot open zip file');
        }



        return $temp_dir;
    }

}

?>