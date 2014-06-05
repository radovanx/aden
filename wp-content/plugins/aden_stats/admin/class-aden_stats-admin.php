<?php

/**
 * Plugin Name.
 *
 * @package   aden_stats_Admin
 * @author    w4a <>
 * @license   GPL-2.0+
 * @link
 * @copyright 2014 w4a
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-aden_stats.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package aden_stats_Admin
 * @author  Your Name <email@example.com>
 */
class aden_stats_Admin {

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;
    public $pages = array(
        "toplevel_page_aden_stat",
        "admin_page_stat_user_detail",
        "admin_page_stat_user_detail_recommendation",
        "admin_page_stat_user_detail_download",
        "admin_page_recommendation_stat_by_product",
        "admin_page_product_detail_download",
        "admin_page_product_detail_recommendation",
        "admin_page_stat_by_product"
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
         * - Rename "aden_stats" to the name of your initial plugin class
         *
         */
        $plugin = aden_stats::get_instance();
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
     * - Rename "aden_stats" to the name your plugin
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
        wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/admin.css', __FILE__), array(), aden_stats::VERSION);
        //wp_enqueue_style($this->plugin_slug . '-admin-', plugins_url('assets/css/admin.css', __FILE__), array(), aden_stats::VERSION);
    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @TODO:
     *
     * - Rename "aden_stats" to the name your plugin
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
        wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), aden_stats::VERSION);
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

        add_menu_page('Stats', 'Stats', 'manage_options', 'aden_stat', array(&$this, 'by_user'));

        add_submenu_page('', 'Stat user detail download', 'Stat user detail download', 'manage_options', 'stat_user_detail_download', array(&$this, 'user_detail_download'));
        add_submenu_page('', 'Stat user detail recommendation', 'Stat user detail recommendation', 'manage_options', 'stat_user_detail_recommendation', array(&$this, 'user_detail_recommendation'));

        add_submenu_page('', 'Stat by product', 'Stat by product', 'manage_options', 'stat_by_product', array(&$this, 'by_product'));

        add_submenu_page('', 'Stat product recommendation', 'Stat product recommendation', 'manage_options', 'product_detail_recommendation', array(&$this, 'product_detail_recommendation'));
        add_submenu_page('', 'Stat product download', 'Stat product download', 'manage_options', 'product_detail_download', array(&$this, 'product_detail_download'));
    }

    public function product_detail_download() {
        global $wpdb;

        $ref_no = $_GET['product_id'];

        $sql = "
            SELECT
                *,
                DATE_FORMAT(record_date, '%e. %c. %Y %H:%i') as fdate
            FROM
                stat
            WHERE
                ref_no = '" . esc_sql($ref_no) . "'
            AND
                type = 2
            ORDER BY
                stat_id DESC                
        ";

        $lang = qtrans_getLanguage();
        
        $results = $wpdb->get_results($sql);
        
        $product_id = $wpdb->get_var("SELECT product_id FROM stat WHERE ref_no = '" . esc_sql($ref_no) . "' ORDER BY stat_id DESC  LIMIT 1");
        
        $props = get_post_meta($product_id, 'flat_props_' . $lang, true);
        
        include 'views/product_detail_download.php';
    }

    public function product_detail_recommendation() {
        global $wpdb;

        $ref_no = $_GET['product_id'];

        $sql = "
        SELECT
            *,
            DATE_FORMAT(record_date, '%e. %c. %Y %H:%i') as fdate
        FROM
            stat
        WHERE
            ref_no = '" . esc_sql($ref_no) . "'
        AND
            type = 1
        ORDER BY
            stat_id DESC
        ";

        $results = $wpdb->get_results($sql);
        
        $product_id = $wpdb->get_var("SELECT product_id FROM stat WHERE ref_no = '" . esc_sql($ref_no) . "' ORDER BY stat_id DESC  LIMIT 1");

        $lang = qtrans_getLanguage();
        $props = get_post_meta($product_id, 'flat_props_' . $lang, true);

        include 'views/product_detail_recommendation.php';
    }

    public function by_product() {
        global $wpdb;

        $lang = qtrans_getLanguage();

        $sql = "
            SELECT
                SUM(s.recommend) AS emails,
                SUM(s.download) AS download,
                s.product_id,
                s.program_id,
                l.title,
                s.ref_no
            FROM
                stat AS s

            LEFT JOIN
                stat_lang AS l
            ON
                l.product_id = s.product_id AND l.lang = '" . esc_sql($lang) . "'
            GROUP BY
                s.ref_no
            ";
        
        if (!empty($_GET['orderby']) && !empty($_GET['order'])) {
            $sql .= "
                    ORDER BY 
                        " . esc_sql($_GET['orderby']) . " " . esc_sql($_GET['order'])
                ;
        }        

        $results = $wpdb->get_results($sql);

        include 'views/by_product.php';
    }

    public function user_detail_download() {
        $user_id = (int) $_GET['user_id'];
        $user_info = get_userdata($user_id);

        $lang = qtrans_getLanguage();

        global $wpdb;
        $sql = "
            SELECT
                s.product_id,
                s.stat_id,
                s.ref_no,
                l.title,
                s.user_id,
                DATE_FORMAT(s.record_date, '%e. %c. %Y %H:%i') as fdate
            FROM
                stat AS s
            LEFT JOIN
                stat_lang AS l
            ON
                l.product_id = s.product_id AND l.lang = '" . esc_sql($lang) . "'
            WHERE
                s.type = 2
            AND
                s.user_id = " . (int) $user_id . "
            ORDER BY
                s.record_date
            DESC";

        $results = $wpdb->get_results($sql);
        include 'views/user_detail_download.php';
    }

    public function user_detail_recommendation() {

        $user_id = (int) $_GET['user_id'];
        $user_info = get_userdata($user_id);

        global $wpdb;
        $lang = qtrans_getLanguage();

        $sql = "
            SELECT
                s.product_id,
                s.stat_id,
                s.receiver,
                s.ref_no,
                l.title,
                s.user_id,
                DATE_FORMAT(s.record_date, '%e. %c. %Y %H:%i') as fdate
            FROM
                stat AS s
            LEFT JOIN
                stat_lang AS l
            ON
                l.product_id = s.product_id AND l.lang = '" . esc_sql($lang) . "'
            WHERE
                s.type = 1
            AND
                s.user_id = " . (int) $user_id . "
            ORDER BY
                s.record_date
            DESC";

        $results = $wpdb->get_results($sql);
        include 'views/user_detail_recommendation.php';
    }

    public function user_detail() {
        $user_id = (int) $_GET['user_id'];

        $user_info = get_userdata($user_id);

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
        include 'views/user_detail.php';
    }
    
    public function order_link($page, $order_by){
        $return = '/wp-admin/admin.php?page=' . $page . '&orderby=' . $order_by . '&order=';
        $return .= !empty($_GET['order']) && 'desc' == $_GET['order'] && $order_by == $_GET['orderby'] ? 'asc' : 'desc';
        return esc_attr($return);
    }
    
    public function order_class($order_by){
        return !empty($_GET['order']) && $order_by == $_GET['orderby'] ? esc_attr($_GET['order']) : 'asc';
    }

    public function by_user() {
        global $wpdb;

        $sql = "
            SELECT
                SUM(s.recommend) AS emails,
                SUM(s.download) AS download,
                s.user_id,
                s.product_id,
                s.program_id
            FROM
                stat AS s
            LEFT JOIN
                wp_users AS u
            ON
                u.ID = s.user_id
            LEFT JOIN
                wp_usermeta AS um
            ON
                um.user_id = u.ID AND um.meta_key = 'first_name'
            LEFT JOIN
                wp_posts AS p
            ON
                p.ID = s.product_id AND p.post_type = 'flat'
            GROUP BY
                s.user_id             
            ";


        if (!empty($_GET['orderby']) && !empty($_GET['order'])) {
            $sql .= "
                    ORDER BY 
                        " . esc_sql($_GET['orderby']) . " " . esc_sql($_GET['order'])
                ;
        }

        $results = $wpdb->get_results($sql);

        include 'views/by_user.php';
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
