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
    public $plugin_url;

    /**
     * Slug of the plugin screen.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = array('program', 'flat', "toplevel_page_parse_xml");

    /**
     * Initialize the plugin by loading admin scripts & styles and adding a
     * settings page and menu.
     *
     * @since     1.0.0
     */
    private function __construct() {

        $this->plugin_url = plugin_dir_url(__FILE__);

        $plugin = EstateProgram::get_instance();
        $this->plugin_slug = $plugin->get_plugin_slug();

        add_action('admin_init', array(&$this, 'admin_init'));


        // Load admin style sheet and JavaScript.
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));


        add_action('load-post.php', array(&$this, 'meta_boxes_setup'));
        add_action('load-post-new.php', array(&$this, 'meta_boxes_setup'));

        add_action('save_post', array(&$this, 'save'));

        add_action('edit_user_profile', array($this, 'profile_boxes'));
//        add_action('edit_user_profile_update', array($this, 'update_profile'));
        // Add the options page and menu item.
        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
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
        add_filter('manage_flat_posts_columns', array($this, 'column_head'));
        add_action('manage_flat_posts_custom_column', array($this, 'column_content'), 10, 2);
        add_filter('manage_edit-flat_sortable_columns', array($this, 'my_movie_sortable_columns'));
        add_filter('request', array($this, 'my_sort_movies'));
    }

    function column_head($defaults) {
        $defaults['ref_no'] = __('Ref. no.', $this->plugin_slug);
        return $defaults;
    }

    function column_content($column_name, $post_id) {

        global $wpdb;

        switch ($column_name) {
            case 'ref_no':
                $sql = $wpdb->prepare("
                    SELECT 
                        meta_value
                    FROM 
                        wp_postmeta
                    WHERE 
                        meta_key = 'unique_identificator'
                    AND    
                        post_id = %d", $post_id);

                $ref_no = $wpdb->get_var($sql);
                echo $ref_no;
                break;
            default:
                break;
        }
    }

    /* Sorts the movies. */

    function my_sort_movies($vars) {

        /* Check if we're viewing the 'movie' post type. */
        if (isset($vars['post_type']) && 'flat' == $vars['post_type']) {

            /* Check if 'orderby' is set to 'duration'. */
            if (isset($vars['orderby']) && 'unique_identificator' == $vars['orderby']) {

                /* Merge the query vars with our custom variables. */
                $vars = array_merge(
                        $vars, array(
                    'meta_key' => 'unique_identificator',
                    'orderby' => 'meta_value'
                        )
                );
            }
            if (isset($vars['s'])) {
                $vars = array_merge(
                        $vars, array(
                    'meta_query' => array(
                        array(
                            'key' => 'unique_identificator',
                            'value' => $vars['s'],
                            'compare' => 'LIKE'
                        )
                    )
                        )
                );
            }
        }
        return $vars;
    }

    function my_movie_sortable_columns($columns) {
        $columns['ref_no'] = 'unique_identificator';
        return $columns;
    }

    public function parse_xml() {
        include 'views/parse_xml.php';
    }

    public function admin_init() {
        if (current_user_can('delete_posts')) {
            add_action('delete_post', array(&$this, 'clean_post_data'), 10, 0);
        }
    }

    /**
     *
     */
    public function profile_boxes($user) {
        include_once( 'views/user_profile.php' );
        wp_nonce_field('update_custom_profile', 'update_custom_profile');
    }

    /**
     *
     */
    /*
      public function update_profile($user_id) {

      if (isset($_POST['user_fields_profile']) && wp_verify_nonce($_POST['user_fields_profile'], __FILE__)) {

      $keys = array(
      'company',
      'phone',
      'address',
      'city',
      'country',
      'title'
      );

      foreach ($keys as $key) {
      update_user_meta($user_id, $key, $_POST[$key]);
      }
      }
      } */

    /**
     *
     * @global type $post
     */
    public function clean_post_data() {

        global $post_id;
        global $wpdb;

        $post_type = $_GET['post_type'];

        if (!empty($post_type)) {
            switch ($post_type) {
                case 'flat':
                    $sql = "DELETE FROM apartment2program WHERE apartment_id = " . (int) $post_id;
                    $wpdb->query($sql);

                    $sql = "DELETE FROM images2post WHERE apartment_id = " . (int) $post_id;
                    $wpdb->query($sql);
                    break;
                case 'program':
                    $sql = "DELETE FROM apartment2program WHERE program_id = " . (int) $post_id;
                    $wpdb->query($sql);
                    break;
            }
        }
    }

                
    public function save() {

        global $post;
        global $wpdb;

        if (isset($_POST['program_post_nonce']) && wp_verify_nonce($_POST['program_post_nonce'], __FILE__)) {
          
            $meta_keys = array(
                '_program_video',
                '_program_street',
                '_program_region',
                '_program_city',
                '_program_house_number',
                '_program_postcode',
                '_program_apartments',
                '_program_price_from',
                '_program_price_to',
                '_program_surface_to',
                '_program_surface_from',
                '_program_latitude',
                '_program_longitude',
                '_program_hightlight',
                '_program_commission',
                'podcast_file',
                'podcast_filefr',
                'podcast_filede'
            );
                
            $this->process_save($post->ID, $meta_keys);
        }

        if (isset($_POST['flat_post_nonce']) && wp_verify_nonce($_POST['flat_post_nonce'], __FILE__)) {
            
            $meta_keys = array(
                '_flat_price',
                '_flat_number_of_room',
                
            );

            $this->process_save($post->ID, $meta_keys);

            //
            if (!empty($_POST['flat2program'])) {
                $sql = "
                    REPLACE INTO
                        apartment2program (apartment_id, program_id)
                    VALUES (
                        '" . (int) $post->ID . "',
                        '" . (int) $_POST['flat2program'] . "'
                    )";
                $wpdb->query($sql);
            } else {
                $sql = "
                    DELETE FROM
                        apartment2program
                    WHERE
                        apartment_id = " . (int) $post->ID;

                $wpdb->query($sql);
            }
        }
    }

    /**
     *
     * @param type $post_id
     * @param type $meta_keys
     */
    protected function process_save($post_id, $meta_keys) {

        $langs = qtrans_getSortedLanguages();

        foreach ($meta_keys as $key) {

            // kouknu jestli existují jazykové verze
            $mam = false;

            $content = '';
            foreach ($langs as $lang) {
                $lang_key = $key . '_' . $lang;
                if (isset($_POST[$lang_key])) {
                    $mam = true;

                    if (!empty($_POST[$lang_key])) {
                        $content .= '<!--:' . $lang . '-->' . $_POST[$lang_key] . '<!--:-->';
                    }
                }
            }

            if ($mam) {
                if (empty($content)) {
                    delete_post_meta($post->ID, $key);
                } else {
                    update_post_meta($post_id, $key, $content);
                }
                continue;
            }

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
                

        add_meta_box(
                'program_properties', __('Program properties', $this->plugin_slug), array($this, 'program_properties'), 'program'
        );

        add_meta_box(
                'flat_properties', __('Flat properties', $this->plugin_slug), array($this, 'flat_properties'), 'flat'
        );

        add_meta_box(
                'flat2program', __('Assign to program', $this->plugin_slug), array($this, 'flat2program'), 'flat', 'side'
        );

        add_meta_box(
                'program_hightlight', __('Program hightlight', $this->plugin_slug), array($this, 'program_hightlight'), 'program'
        );
        
        
         add_meta_box(
                'swp_file_upload', __('File Upload', $this->plugin_slug), array($this, 'swp_file_upload'), 'program'
        );
                
    }

    public function flat2program() {

        global $post;
        global $wpdb;

        $sql = "
            SELECT
                ID
            FROM
                wp_posts
            WHERE
                post_type='program'
            AND
                post_status IN ('publish', 'future', 'pending', 'private')";

        $programs = $wpdb->get_results($sql);

        $sql = "
            SELECT
                program_id
            FROM
                apartment2program
            WHERE
                apartment_id = '" . (int) $post->ID . "'
            ";

        $current_program_id = $wpdb->get_var($sql);

        include_once( 'views/flat2program.php' );
    }

    public function program_properties() {
        global $post;
        include_once( 'views/program_properties.php' ); 
        wp_nonce_field(__FILE__, 'program_post_nonce');
    }

    public function flat_properties() {
        global $post;
        global $wpdb;
        include_once( 'views/flat_properties.php' );
        wp_nonce_field(__FILE__, 'flat_post_nonce');
    }

    public function program_hightlight() {
        global $post;
        include_once( 'views/program_hightlight.php' );
    }
    
    public function swp_file_upload() {
        global $post;
        include_once( 'views/swp_file_upload.php' );
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
        if (in_array($screen->id, $this->plugin_screen_hook_suffix)) {
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

        if (in_array($screen->id, $this->plugin_screen_hook_suffix)) {
            wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), EstateProgram::VERSION);
        }
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {

        add_menu_page('Parse XML', 'Parse XML', 'manage_options', 'parse_xml', array(&$this, 'parse_xml'));

        //add_menu_page('Program', 'Program', 'manage_options', 'program_overview', array(&$this, 'program_overviw'));
        //add_submenu_page('edit.php?post_type=flat', __('Contribution Amount', 'campaign'), __('Contribution Amount', 'campaign'), 'manage_options', 'parse_xml', array(&$this, 'index'));


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
        /*
          $this->plugin_screen_hook_suffix = add_options_page(
          __('Page Title', $this->plugin_slug), __('Menu Text', $this->plugin_slug), 'manage_options', $this->plugin_slug, array($this, 'display_plugin_admin_page')
          ); */
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
