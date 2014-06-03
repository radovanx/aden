<?php

/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   EstateProgram
 * @author    a. <>
 * @license   GPL-2.0+
 * @link
 * @copyright 2014 a.
 *
 * @wordpress-plugin
 * Plugin Name:       EstateProgram
 * Plugin URI:
 * Description:       Program manamegent
 * Version:           1.0.0
 * Author:       a.
 * Author URI:
 * Text Domain:       estateprogram
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/* ----------------------------------------------------------------------------*
 * Public-Facing Functionality
 * ---------------------------------------------------------------------------- */



add_image_size('pdf_logo', 260, 80, false);
add_image_size('pdf_thumb', 324, 238, false);


/*
 * @TODO:
 *
 * - replace `class-estateprogram.php` with the name of the plugin's class file
 *
 */
require_once( plugin_dir_path(__FILE__) . 'public/class-estateprogram.php' );
require_once( plugin_dir_path(__FILE__) . 'public/class-estateprogram-ajax.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace EstateProgram with the name of the class defined in
 *   `class-estateprogram.php`
 */
register_activation_hook(__FILE__, array('EstateProgram', 'activate'));
register_deactivation_hook(__FILE__, array('EstateProgram', 'deactivate'));

/*
 * @TODO:
 *
 * - replace EstateProgram with the name of the class defined in
 *   `class-estateprogram.php`
 */
add_action('plugins_loaded', array('EstateProgram', 'get_instance'));

/* ----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 * ---------------------------------------------------------------------------- */

/*
 * @TODO:
 *
 * - replace `class-estateprogram-admin.php` with the name of the plugin's admin file
 * - replace EstateProgram_Admin with the name of the class defined in
 *   `class-estateprogram-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX )) {

    //require_once( plugin_dir_path(__FILE__) . 'public/class-sourceparser.php' );

    require_once( plugin_dir_path(__FILE__) . 'admin/class-estateprogram-admin.php' );
    add_action('plugins_loaded', array('EstateProgram_Admin', 'get_instance'));
}







