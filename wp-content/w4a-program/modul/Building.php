<?php

class Building {

    public function __construct() {
        add_action('init', array(&$this, 'register_custom_post'));
        add_action('init', array(&$this, 'create_taxonomies'));
    }

    /**
     * 
     */
    function create_taxonomies() {

        // služby dívky
        $args = array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('Cities', 'taxonomy general name'),
                'singular_name' => _x('City', 'taxonomy singular name'),
                'search_items' => __('Find city'),
                'all_items' => __('All cities'),
                'parent_item' => __('Parent city'),
                'parent_item_colon' => __('Parent city'),
                'edit_item' => __('Edit city'),
                'update_item' => __('Update city'),
                'add_new_item' => __('Create city'),
                'new_item_name' => __('New city'),
                'menu_name' => __('Cities')
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'city'),
            //'show_in_menu' => 'program_overview'
        );

        register_taxonomy('city', array('building'), $args);
    }

    /**
     *
     */
    static function register_custom_post() {

        $args = array(
            'labels' => array(
                'name' => __('Buildings', 'w4a-program'),
                'singular_name' => __('Building', 'w4a-program'),
                'add_new' => __('Create building', 'w4a-program'),
                'add_new_item' => __('New building', 'w4a-program'),
                'edit_item' => __('Edit building', 'w4a-program'),
                'new_item' => __('Create building', 'w4a-program'),
                'all_items' => __('All buildings', 'w4a-program'),
                'view_item' => __('View building', 'w4a-program'),
                'search_items' => __('Find building', 'w4a-program'),
                'parent_item_colon' => '',
                'menu_name' => __('Buildings', 'w4a-program')
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
                'slug' => 'girl',
            ),
            //'show_in_menu' => 'edit.php?post_type=banner',
            'show_in_menu' => 'program_overview'
        );

        register_post_type('building', $args);
    }

}

$building = new Building();
