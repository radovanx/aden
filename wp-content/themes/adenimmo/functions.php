<?php

/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 * 
 */

// theme setup
function theme_setup() {
    load_theme_textdomain( 'aden', get_template_directory() . '/languages' );
    
    add_theme_support( 'post-thumbnails' );
    //set_post_thumbnail_size( 672, 372, true );  
    
    register_nav_menus();    
}

add_action( 'after_setup_theme', 'theme_setup' );

// enqueue styles
if (!function_exists("theme_styles")) {

    function theme_styles() {
        // This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
        wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap');

        // For child themes
        wp_register_style('theme-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all');
        wp_enqueue_style('theme-style');

        //<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    }

}
add_action('wp_enqueue_scripts', 'theme_styles');

// enqueue javascript
if (!function_exists("theme_js")) {

    function theme_js() {

	//<script type="text/javascript" src="js/jquery.min.js"></script>
	//<script type="text/javascript" src="js/bootstrap.min.js"></script>
	//<script type="text/javascript" src="js/scripts.js"></script>        
        
        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.2');
        wp_register_script('theme-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.2');
        //wp_register_script('modernizr', get_template_directory_uri() . '/library/js/modernizr.full.min.js', array('jquery'), '1.2');
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap');
        wp_enqueue_script('theme-script');
        //wp_enqueue_script('modernizr');

        //wp_register_script('custom-script', get_template_directory_uri() . '/jsfacebook.js', array('jquery'), '1.0');
    }

}
add_action('wp_enqueue_scripts', 'theme_js');

//////////////////////////////////

// Menu output mods
    class Bootstrap_walker extends Walker_Nav_Menu {

        function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0) {

            global $wp_query;
            $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

            $class_names = $value = '';

            // If the item has children, add the dropdown class for bootstrap
            if ($args->has_children) {
                $class_names = "dropdown ";
            }

            $classes = empty($object->classes) ? array() : (array) $object->classes;

            $class_names .= join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $object));
            $class_names = ' class="' . esc_attr($class_names) . '"';

            $output .= $indent . '<li id="menu-item-' . $object->ID . '"' . $value . $class_names . '>';

            $attributes = !empty($object->attr_title) ? ' title="' . esc_attr($object->attr_title) . '"' : '';
            $attributes .=!empty($object->target) ? ' target="' . esc_attr($object->target) . '"' : '';
            $attributes .=!empty($object->xfn) ? ' rel="' . esc_attr($object->xfn) . '"' : '';
            $attributes .=!empty($object->url) ? ' href="' . esc_attr($object->url) . '"' : '';

            // if the item has children add these two attributes to the anchor tag
            // if ( $args->has_children ) {
            // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
            // }

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $object->title, $object->ID);
            $item_output .= $args->link_after;

            // if the item has children add the caret just before closing the anchor tag
            if ($args->has_children) {
                $item_output .= '<b class="caret"></b></a>';
            } else {
                $item_output .= '</a>';
            }

            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $object, $depth, $args);
        }

// end start_el function

        function start_lvl(&$output, $depth = 0, $args = Array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }

        function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
            $id_field = $this->db_fields['id'];
            if (is_object($args[0])) {
                $args[0]->has_children = !empty($children_elements[$element->$id_field]);
            }
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

    }
