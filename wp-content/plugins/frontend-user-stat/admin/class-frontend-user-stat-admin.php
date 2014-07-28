<?php

/**
 * Plugin Name.
 *
 * @package   Frontend_user_stat_Admin
 * @author    W4a <>
 * @license   GPL-2.0+
 * @link
 * @copyright 2014 W4a
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-frontend-user-stat.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Frontend_user_stat_Admin
 * @author  Your Name <email@example.com>
 */
class Frontend_user_stat_Admin {

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Slug of the plugin screen.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = null;
    public $pages = array(
        "toplevel_page_user_stat",
    );

    public $url;
    
    /**
     * Initialize the plugin by loading admin scripts & styles and adding a
     * settings page and menu.
     *
     * @since     1.0.0
     */
    private function __construct() {
        
        
        if(!isset($_SESSION)){
            session_start();
        }
        
        $this->url = plugins_url( '' , __FILE__ );

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
         * - Rename "Frontend_user_stat" to the name of your initial plugin class
         *
         */
        $plugin = Frontend_user_stat::get_instance();
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
        //add_action( '@TODO', array( $this, 'action_method_name' ) );
        //add_filter( '@TODO', array( $this, 'filter_method_name' ) );
    }

    public function user_stat() {
        
        $path = plugin_dir_path( __FILE__ ) . 'includes/google-api-php-client-master/src';
        set_include_path($path);
        
        require_once 'includes/google-api-php-client-master/src/Google/Service/Resource.php';
        require_once 'includes/google-api-php-client-master/src/Google/Service.php';
        require_once 'includes/google-api-php-client-master/src/Google/Utils.php';
        require_once 'includes/google-api-php-client-master/src/Google/Http/Request.php';
        
        include_once 'includes/google-api-php-client-master/src/Google/Service/Urlshortener.php';
        
                
        require_once 'includes/google-api-php-client-master/src/Google/Auth/Abstract.php';
        require_once 'includes/google-api-php-client-master/src/Google/Auth/OAuth2.php';
        require_once 'includes/google-api-php-client-master/src/Google/Auth/AssertionCredentials.php';        
        require_once "includes/google-api-php-client-master/src/Google/Client.php";
        require_once "includes/google-api-php-client-master/src/Google/Service.php";
        
        
        include 'views/user_stat.php';
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
     * - Rename "Frontend_user_stat" to the name your plugin
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_styles() {

        $screen = get_current_screen();

        if (!in_array($screen->id, $this->pages)) {
            return;
        }

        wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/admin.css', __FILE__), array(), Frontend_user_stat::VERSION);
    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @TODO:
     *
     * - Rename "Frontend_user_stat" to the name your plugin
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_scripts() {

        $screen = get_current_screen();

        if (!in_array($screen->id, $this->pages)) {
            return;
        }

        wp_enqueue_script($this->plugin_slug . '-google-jsapi', 'https://www.google.com/jsapi', false, Frontend_user_stat::VERSION);
        wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), Frontend_user_stat::VERSION);
        
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         * @TODO:
         *
         * - Change 'Page Title' to the title of your plugin admin page
         * - Change 'Menu Text' to the text for menu item for the plugin settings page
         * - Change 'manage_options' to the capability you see fit
         *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
         */
        $this->plugin_screen_hook_suffix = add_options_page(
                __('Page Title', $this->plugin_slug), __('Menu Text', $this->plugin_slug), 'manage_options', $this->plugin_slug, array($this, 'display_plugin_admin_page')
        );

        add_menu_page('User stats', 'User stats', 'manage_options', 'user_stat', array(&$this, 'user_stat'));
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
