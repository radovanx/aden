<?php

/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Recommendation
 * @author    w4a. <>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2014 w4a.
 *
 * @wordpress-plugin
 * Plugin Name:       Recommendation
 * Plugin URI:       
 * Description:       Recommendation statistic
 * Version:           1.0.0
 * Author:       w4a.
 * Author URI:       
 * Text Domain:       recommendation
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

/*
 * @TODO:
 *
 * - replace `class-recommendation.php` with the name of the plugin's class file
 *
 */
require_once( plugin_dir_path(__FILE__) . 'public/class-recommendation.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace Recommendation with the name of the class defined in
 *   `class-recommendation.php`
 */
register_activation_hook(__FILE__, array('Recommendation', 'activate'));
register_deactivation_hook(__FILE__, array('Recommendation', 'deactivate'));

/*
 * @TODO:
 *
 * - replace Recommendation with the name of the class defined in
 *   `class-recommendation.php`
 */
add_action('plugins_loaded', array('Recommendation', 'get_instance'));

/* ----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 * ---------------------------------------------------------------------------- */

/*
 * @TODO:
 *
 * - replace `class-recommendation-admin.php` with the name of the plugin's admin file
 * - replace Recommendation_Admin with the name of the class defined in
 *   `class-recommendation-admin.php`
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

    require_once( plugin_dir_path(__FILE__) . 'admin/class-recommendation-admin.php' );
    add_action('plugins_loaded', array('Recommendation_Admin', 'get_instance'));
}
