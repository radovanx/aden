<?php

define('WP_USE_THEMES', FALSE);
require( 'wp-load.php' );

require_once(ABSPATH . "wp-admin/includes/image.php");
require_once(ABSPATH . "wp-admin/includes/file.php");
require_once(ABSPATH . "wp-admin/includes/media.php");
require_once(ABSPATH . "wp-admin/includes/image.php");


global $wpdb;

$vzor_id = 1774;

$original = get_post($vzor_id);


for ($i = 0; $i < 10; $i++) {

    $new_flat_number = rand(100, 100000);
    
    $post_information = array(
        'post_title' => 'Test apartment - ' . $new_flat_number,
        'post_content' => '',
        'post_type' => 'flat',
        'post_status' => 'publish',
    );

    $new_flat_id = wp_insert_post($post_information);


    $sql = "SELECT * FROM wp_postmeta WHERE post_id = '" . (int) $vzor_id . "'";

    $metas = $wpdb->get_results($sql);
    
    foreach($metas as $meta){
        
        switch($meta->meta_key){
            case "anbieternr":
                update_post_meta($new_flat_id, $meta->meta_key, $new_flat_number);
                break;
            case "flat_props_fr":
                
                $props = unserialize($meta->meta_value);
                
                $props['anbieternr'] = $new_flat_number;
                $props['flaechen|wohnflaeche'] = rand(40, 700);
                $props['flaechen|anzahl_zimmer'] = rand(1, 12);
                $props['preise|kaufpreis'] = rand(140000, 780000);
                $props['preise|kaufpreis_pro_qm'] = $props['preise|kaufpreis'] / $props['flaechen|wohnflaeche'];                
                
                update_post_meta($new_flat_id, $meta->meta_key, $props);
                break;
            case "flat_props_en":
                
                $props = unserialize($meta->meta_value);
                
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
        
    }
    
}
$x = 1;
$y = $x;

