<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   aden_stats
 * @author    w4a <>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2014 w4a
 *
 * @wordpress-plugin
 * Plugin Name:       aden_stats
 * Plugin URI:       
 * Description:       stats
 * Version:           1.0.0
 * Author:       w4a
 * Author URI:       
 * Text Domain:       aden_stats
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-aden_stats.php` with the name of the plugin's class file
 *
 */
require_once( plugin_dir_path( __FILE__ ) . 'public/class-aden_stats.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace aden_stats with the name of the class defined in
 *   `class-aden_stats.php`
 */
register_activation_hook( __FILE__, array( 'aden_stats', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'aden_stats', 'deactivate' ) );

/*
 * @TODO:
 *
 * - replace aden_stats with the name of the class defined in
 *   `class-aden_stats.php`
 */
add_action( 'plugins_loaded', array( 'aden_stats', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-aden_stats-admin.php` with the name of the plugin's admin file
 * - replace aden_stats_Admin with the name of the class defined in
 *   `class-aden_stats-admin.php`
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
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-aden_stats-admin.php' );
	add_action( 'plugins_loaded', array( 'aden_stats_Admin', 'get_instance' ) );

}
