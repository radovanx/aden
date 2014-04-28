<?php

class Flat {

    public function __construct() {
        add_action('init', array(&$this, 'register_custom_post'));        
    }

    static function register_custom_post() {

        $args = array(
            'labels' => array(
                'name' => __('Flats', 'w4a-program'),
                'singular_name' => __('Flat', 'w4a-program'),
                'add_new' => __('Create flat', 'w4a-program'),
                'add_new_item' => __('New flat', 'w4a-program'),
                'edit_item' => __('Edit flat', 'w4a-program'),
                'new_item' => __('Create flat', 'w4a-program'),
                'all_items' => __('All flat', 'w4a-program'),
                'view_item' => __('View flat', 'w4a-program'),
                'search_items' => __('Find flat', 'w4a-program'),
                'parent_item_colon' => '',
                'menu_name' => __('Flats', 'w4a-program')
            ),
            'public' => true,
            'supports' => array(
                'thumbnail',
                'title',
                'editor',
                'excerpt',
                'author'
            ),
            'rewrite' => array(
                //'slug' => __('divka', 'w4a-program'),
                //'slug' => '%category_club%/girlsss',
                //'with_front' => false,
                'slug' => 'flat',
            ),
            'show_in_menu' => 'program_overview'
        );

        register_post_type('flat', $args);
    }

}

$flat = new Flat();
