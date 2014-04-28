<?php

/**
 * Plugin Name.
 *
 * @package   EstateProgram_Admin
 * @author    a. <>
 * @license   GPL-2.0+
 * @link
 * @copyright 2014 a.
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-estateprogram.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package EstateProgram_Admin
 * @author  Your Name <email@example.com>
 */
class EstateProgram_Admin {

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
    protected $plugin_screen_hook_suffix = 'program';

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
         * - Rename "EstateProgram" to the name of your initial plugin class
         *
         */



        $plugin = EstateProgram::get_instance();
        $this->plugin_slug = $plugin->get_plugin_slug();

        // Load admin style sheet and JavaScript.
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));


        add_action('load-post.php', array(&$this, 'meta_boxes_setup'));
        add_action('load-post-new.php', array(&$this, 'meta_boxes_setup'));

        add_action('save_post', array($this, 'save'));

        // Add the options page and menu item.
        //add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
        //add_action('admin_menu', array(&$this, 'register_menu_page'));
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

    public function save() {

        global $post;

        if (isset($_POST['program_post_nonce']) && wp_verify_nonce($_POST['program_post_nonce'], __FILE__)) {
            $meta_keys = array(
                '_program_city',
                '_program_district',
                '_program_range_from',
                '_program_range_to'
            );
            
            $this->process_save($post->ID, $meta_keys);
        }
        
        if (isset($_POST['flat_post_nonce']) && wp_verify_nonce($_POST['flat_post_nonce'], __FILE__)) {
            $meta_keys = array(
                '_flat_price',
                '_flat_number_of_room',
                '_flat_surface_from',
                '_flat_surface_to',
                '_flat_elevator'
            );
            
            $this->process_save($post->ID, $meta_keys);
        }        
    }

    protected function process_save($post_id, $meta_keys) {

        foreach ($meta_keys as $key) {
            if (isset($_POST[$key]) && ('' != $_POST[$key])) {
                update_post_meta($post_id, $key, $_POST[$key]);
            } else {
                delete_post_meta($post_id, $key);
            }
        }
    }

    /**
     *
     */
    public function meta_boxes_setup() {
        add_action('add_meta_boxes', array($this, 'custom_boxes'));
    }

    /**
     *
     */
    public function custom_boxes() {
        /* add_meta_box(
          'campaigne_logo', __('Charity', $this->plugin_slug), array($this, 'campaign_logo_box'), 'campaign_item', 'side'
          ); */

        add_meta_box(
                'program_properties', __('Program properties', $this->plugin_slug), array($this, 'program_properties'), 'program'
        );

        add_meta_box(
                'flat_properties', __('Flat properties', $this->plugin_slug), array($this, 'flat_properties'), 'flat'
        );
    }

    public function program_properties() {
        global $post;
        include_once( 'views/program_properties.php' );
        wp_nonce_field(__FILE__, 'program_post_nonce');
    }

    public function flat_properties() {
        global $post;
        include_once( 'views/flat_properties.php' );
        wp_nonce_field(__FILE__, 'flat_post_nonce');
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
     * - Rename "EstateProgram" to the name your plugin
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_styles() {

        if (!isset($this->plugin_screen_hook_suffix)) {
            //return;
        }

        $screen = get_current_screen();
        if ($this->plugin_screen_hook_suffix == $screen->id) {
            wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/admin.css', __FILE__), array(), EstateProgram::VERSION);
        }
    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @TODO:
     *
     * - Rename "EstateProgram" to the name your plugin
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_scripts() {

        $screen = get_current_screen();

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();

        if ($this->plugin_screen_hook_suffix == $screen->id) {
            wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), EstateProgram::VERSION);
        }
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {

        add_menu_page('Program', 'Program', 'manage_options', 'program_overview', array(&$this, 'program_overview'));


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
