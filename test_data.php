<?php

define('WP_USE_THEMES', FALSE);
require( 'wp-load.php' );

require_once(ABSPATH . "wp-admin/includes/image.php");
require_once(ABSPATH . "wp-admin/includes/file.php");
require_once(ABSPATH . "wp-admin/includes/media.php");
require_once(ABSPATH . "wp-admin/includes/image.php");


global $wpdb;

$vzor_id = 4596;

$original = get_post($vzor_id);
$program_id = 4220;

$city = 'New York';
$region = 'Staten Island';


for ($i = 0; $i < 5; $i++) {

    $new_flat_number = rand(100, 100000);

    $post_information = array(
        'post_title' => 'Test apartment - ' . $new_flat_number,
        'post_content' => '',
        'post_type' => 'flat',
        'post_status' => 'publish',
    );

    $new_flat_id = wp_insert_post($post_information);

    $sql = "
          REPLACE INTO
            apartment2program (apartment_id, program_id)
          VALUES(
            '" . (int) $new_flat_id . "',
            '" . $program_id . "'
          )";

    $wpdb->query($sql);



    $sql = "SELECT * FROM wp_postmeta WHERE post_id = '" . (int) $vzor_id . "'";

    $metas = $wpdb->get_results($sql);

    foreach ($metas as $meta) {

        switch ($meta->meta_key) {
            case "anbieternr":
                update_post_meta($new_flat_id, $meta->meta_key, $new_flat_number);
                break;
            case "flat_props_fr":

                $props = unserialize($meta->meta_value);

                $props['geo|ort'] = $city;
                $props['geo|regionaler_zusatz'] = $region;

                $props['anbieternr'] = $new_flat_number;
                $props['flaechen|wohnflaeche'] = rand(40, 700);
                $props['flaechen|anzahl_zimmer'] = rand(1, 12);
                $props['preise|kaufpreis'] = rand(140000, 780000);
                $props['preise|kaufpreis_pro_qm'] = $props['preise|kaufpreis'] / $props['flaechen|wohnflaeche'];

                update_post_meta($new_flat_id, $meta->meta_key, $props);
                break;
            case "flat_props_en":

                $props = unserialize($meta->meta_value);

                $props['geo|ort'] = $city;
                $props['geo|regionaler_zusatz'] = $region;

                $props['anbieternr'] = $new_flat_number;
                $props['flaechen|wohnflaeche'] = rand(40, 700);
                $props['flaechen|anzahl_zimmer'] = rand(1, 12);
                $props['preise|kaufpreis'] = rand(140000, 780000);
                $props['preise|kaufpreis_pro_qm'] = $props['preise|kaufpreis'] / $props['flaechen|wohnflaeche'];


                update_post_meta($new_flat_id, $meta->meta_key, $props);
                break;
            default:
                update_post_meta($new_flat_id, $meta->meta_key, $meta->meta_value);
                break;
        }

        wp_set_object_terms($new_flat_id, null, 'location');

        if (!empty($city)) {

            $flat_location_terms = array();

            $city_term = term_exists($city, 'location');

            // uložim město
            if (empty($city_term)) {
                $city_term = wp_insert_term($city, 'location');
            }

            $city_term_id = $city_term['term_id'];
            // spraruju mesto s bytem
            wp_set_post_terms($new_flat_id, $city_term_id, 'location', true);

            // ulozim region
            if (!empty($region) && !empty($city_term_id)) {

                $region_term = term_exists($region, 'location');

                if (empty($region_term)) {
                    $region_term = wp_insert_term($region, 'location', array(
                        'parent' => $city_term_id
                    ));
                }
                // spraruju region s bytem
                wp_set_post_terms($new_flat_id, $region_term['term_id'], 'location', true);
            }
        }
    }
}