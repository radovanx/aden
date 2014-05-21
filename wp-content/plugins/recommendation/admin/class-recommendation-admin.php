<?php

/**
 * Plugin Name.
 *
 * @package   Recommendation_Admin
 * @author    w4a. <>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2014 w4a.
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-recommendation.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Recommendation_Admin
 * @author  Your Name <email@example.com>
 */
class Recommendation_Admin {

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    
    public $pages = array(          
            'toplevel_page_recommendation_stat',
            'admin_page_recommentation_user_detail',
            "admin_page_recommendation_stat_by_product"
    );
    
    /**
     * Slug of the plugin screen.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = null;

    /**
     * Initialize the plugin by loading admin scripts & styles and adding a
     * settings page and menu.
     *
     * @since     1.0.0
     */
    private function __construct() {

        /*
         * @TODO :
         *
         * - Uncomment following lines if the admin class should only be available for super admins
         */
        /* if( ! is_super_admin() ) {
          return;
          } */

        /*
         * Call $plugin_slug from public plugin class.
         *
         * @TODO:
         *
         * - Rename "Recommendation" to the name of your initial plugin class
         *
         */
        $plugin = Recommendation::get_instance();
        $this->plugin_slug = $plugin->get_plugin_slug();

        // Load admin style sheet and JavaScript.
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));

        // Add the options page and menu item.
        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));

        // Add an action link pointing to the options page.
        $plugin_basename = plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_slug . '.php');
        add_filter('plugin_action_links_' . $plugin_basename, array($this, 'add_action_links'));

        /*
         * Define custom functionality.
         *
         * Read more about actions and filters:
         * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
         */
        add_action('@TODO', array($this, 'action_method_name'));
        add_filter('@TODO', array($this, 'filter_method_name'));
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        /*
         * @TODO :
         *
         * - Uncomment following lines if the admin class should only be available for super admins
         */
        /* if( ! is_super_admin() ) {
          return;
          } */

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Register and enqueue admin-specific style sheet.
     *
     * @TODO:
     *
     * - Rename "Recommendation" to the name your plugin
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_styles() {

        /*
          if (!isset($this->plugin_screen_hook_suffix)) {
          return;
          } */
        $screen = get_current_screen();



        if (!in_array($screen->id, $this->pages)) {
            return;
        }

        wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/admin.css', __FILE__), array(), Recommendation::VERSION);
    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @TODO:
     *
     * - Rename "Recommendation" to the name your plugin
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_scripts() {

        /*
          if (!isset($this->plugin_screen_hook_suffix)) {
          return;
          } */

        $screen = get_current_screen();

        if (!in_array($screen->id, $this->pages)) {
            return;
        }


        wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), Recommendation::VERSION);
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {

        add_menu_page('Recommendation stats', 'Recommendation stats', 'manage_options', 'recommendation_stat', array(&$this, 'by_user'));
        add_submenu_page('', 'Recommendation user detail', 'Recommendation user detail', 'manage_options', 'recommentation_user_detail', array(&$this, 'user_detail'));

        add_submenu_page('', 'Recommendation stats by product', 'Recommendation stats by product', 'manage_options', 'recommendation_stat_by_product', array(&$this, 'by_product'));
        add_submenu_page('', 'Recommendation product detail', 'Recommendation product detail', 'manage_options', 'recommentation_product_detail', array(&$this, 'product_detail'));
        
        
        $this->plugin_screen_hook_suffix = add_options_page(
                __('Page Title', $this->plugin_slug), __('Menu Text', $this->plugin_slug), 'manage_options', $this->plugin_slug, array($this, 'display_plugin_admin_page')
        );
    }

    
    public function product_detail(){
        
        $product_id = $_GET['product_id'];
        
        global $wpdb;
        
        $sql = "
            SELECT
                product_id,
                product,
                count(recommendation_id) as emails
            FROM
                recommendation
            GROUP
                BY product_id
        ";
        
        $results = $wpdb->get_results($sql);
        
        include 'views/product_detail.php';        
        
    }
    
    public function by_product(){
        global $wpdb;
        
        $sql = "
            SELECT
                product_id,
                product,
                count(recommendation_id) as emails
            FROM
                recommendation
            GROUP
                BY product_id
        ";
        
        $results = $wpdb->get_results($sql);
        
        include 'views/by_product.php';
    }
    
    public function user_detail(){
        $user_id = $_GET['user_id'];
        
        global $wpdb;
        
        $sql = "            
            SELECT
                *
            FROM
                recommendation
            WHERE
                user_id = '" . (int) $user_id . "'
            ";        
        $results = $wpdb->get_results($sql);
        
        $user_info = get_userdata((int) $user_id);
        
        include 'views/user_detail.php';
    }
    
    public function by_user(){
        global $wpdb;
        
        $sql = "
            SELECT
                count(recommendation_id) AS emails,
                r.user_id
            FROM
                recommendation AS r
            LEFT JOIN
                wp_users AS u
            ON
                u.ID = r.user_id
            GROUP BY 
                r.user_id
            ";
        
        $results = $wpdb->get_results($sql);        
        
        include 'views/by_user.php';
    }

    public function recommendation_stat() {
        
        global $wpdb;
        
        $lang = qtrans_getLanguage();

        $sql = "
            SELECT
                r.user_id,
                DATE_FORMAT(record_date, '%e. %c. %Y %H:%i') as fdate,
                mp.meta_value AS props
            FROM 
                recommendation AS r 
            LEFT JOIN
                wp_postmeta AS pm
            ON
                pm.post_id = r.product_id AND meta_key = 'flat_props_" . esc_sql($lang) . "                 
            ORDER BY 	
                record_date
            DESC";

        $results = $wpdb->get_results($sql);        
        
        include 'views/recommendation_stat.php';
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_admin_page() {
        include_once( 'views/admin.php' );
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */
    public function add_action_links($links) {

        return array_merge(
                array(
            'settings' => '<a href="' . admin_url('options-general.php?page=' . $this->plugin_slug) . '">' . __('Settings', $this->plugin_slug) . '</a>'
                ), $links
        );
    }

    /**
     * NOTE:     Actions are points in the execution of a page or process
     *           lifecycle that WordPress fires.
     *
     *           Actions:    http://codex.wordpress.org/Plugin_API#Actions
     *           Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
     *
     * @since    1.0.0
     */
    public function action_method_name() {
        // @TODO: Define your action hook callback here
    }

    /**
     * NOTE:     Filters are points of execution in which WordPress modifies data
     *           before saving it or sending it to the browser.
     *
     *           Filters: http://codex.wordpress.org/Plugin_API#Filters
     *           Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
     *
     * @since    1.0.0
     */
    public function filter_method_name() {
        // @TODO: Define your filter hook callback here
    }

}
