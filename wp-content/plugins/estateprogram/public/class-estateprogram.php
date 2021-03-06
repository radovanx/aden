<?php

/**
 * Plugin Name.
 *
 * @package   EstateProgram
 * @author    a. <>
 * @license   GPL-2.0+
 * @link
 * @copyright 2014 a.
 */
/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-estateprogram-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package EstateProgram
 * @author  Your Name <email@example.com>
 */
require 'class-sourceimport.php';

/**
 *
 */
EstateProgram::$tags_apartment = array(
    'geo',
    'objektkategorie',
    'kontaktperson',
    'preise',
    'flaechen',
    'ausstattung',
    'freitexte',
    'zustand_angaben',
    'bewertung',
    'infrastruktur',
);

EstateProgram::$tags_program = array(
    'geo',
    'zustand_angaben',
    'bewertung',
    'infrastruktur',
);

EstateProgram::$langs = array(
    'fre' => 'fr',
    'eng' => 'en',
    'ger' => 'de'
);

EstateProgram::$rental_status = array(
    'fre' => 'fr',
    'eng' => 'en',
    'ger' => 'de'
);

EstateProgram::$apartment_type = array(
    'ETAGE' => __("appart d’etage", 'estateprogram'),
    'DACHGESCHOSS' => __("Combles", 'estateprogram'),
    'ERDGESCHOSS' => __("Rez de chaussée", 'estateprogram'),
    'MAISONETTE' => __("duplex", 'estateprogram')
);

class EstateProgram {

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    const VERSION = '1.0.0';

    /**
     * @TODO - Rename "estateprogram" to the name your your plugin
     *
     * Unique identifier for your plugin.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * plugin file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    public $plugin_slug = 'estateprogram';

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;
    static $tags_apartment;
    static $tags_program;
    static $langs;
    static $rental_status;
    public static $cron_url;
    public static $apartment_type;

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.0.0
     */
    private function __construct() {



        EstateProgram::$cron_url = plugins_url('/cron/script.php', __FILE__);

        // Load plugin text domain
        add_action('init', array($this, 'load_plugin_textdomain'));

        // Activate plugin when new blog is added
        add_action('wpmu_new_blog', array($this, 'activate_new_site'));

        // Load public-facing style sheet and JavaScript.
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

        //add_action('init', array(&$this, 'register_custom_post'));
        //add_action('init', array(&$this, 'create_taxonomies'));

        add_action('init', array(&$this, 'init'));

        add_action('edit_user_profile_update', array($this, 'update_profile'));
        add_action('personal_options_update', array($this, 'update_profile'));

        /* Define custom functionality.
         * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
         */
        add_action('@TODO', array($this, 'action_method_name'));
        add_filter('@TODO', array($this, 'filter_method_name'));

        add_filter('authenticate', array(&$this, 'check_login'), 100, 3);

        $ajaxModule = new EstateProgramAjax();

        //add_action('init', array(&$this, 'rewrite'));
        add_action('parse_request', array(&$this, 'parse_request'));
        add_action('init', array(&$this, 'do_rewrite'));
        add_filter('query_vars', array(&$this, 'query_vars'));


        add_action('type_of_accommodation_add_form', 'qtrans_modifyTermFormFor');
        add_action('type_of_accommodation_edit_form', 'qtrans_modifyTermFormFor');
    }

    public function query_vars($public_query_vars) {
        $public_query_vars[] = 'action';
        $public_query_vars[] = 'source-file';
        //$public_query_vars[] = 'product-id';
        //$public_query_vars[] = 'program-id';
        return $public_query_vars;
    }

    function do_rewrite() {
        //add_rewrite_rule("download-product-data/([^/]+)/?$", 'index.php?action=generate-pdf&product-id=$matches[1]', 'top');
        add_rewrite_rule("grab-source-xml/([^/]+)/?$", 'index.php?action=grab-source-xml&source-file=$matches[1]', 'top');
    }

    public function parse_request(&$wp) {

        $q = $wp->query_vars;

        if (isset($q['action']) && 'grab-source-xml' == $q['action']) {

            //require_once 'class-sourceimport.php';

            $file = $q['source-file'];

            if ('all' == $file) {
                //$time_start = microtime(true);
                SourceImport::run();
                //$time_end = microtime(true);
                //$time = $time_end - $time_start;
                //echo "running in $time seconds\n";
            }

            exit;
        }
    }

    /**
     * kouknu jestli datum registrace je mensi 15 dní
     *
     * @param type $user
     * @param type $username
     * @param type $password
     * @return null
     */
    function check_login($user, $username, $password) {
        // this filter is called on the log in page
        // make sure we have a username before we move forward
        //if (!empty($username)) {

        if ($user instanceof WP_User && user_can($user, 'freeze')) {
            $user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: We are really sorry. Your account has been frozen. If you like to use our service, please contact us.', $plugin_slug));
            return $user;
        }

        /*
          if ($user instanceof WP_User && user_can($user, 'only_demo')) {

          $user_data = $user->data;

          $register_date = DateTime::createFromFormat('Y-m-d H:i:s', $user_data->user_registered);

          $valid_to = clone $register_date;
          $valid_to->modify("+15 day");

          $now = new DateTime();

          if ($now > $valid_to) {
          $user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: We are really sorry, your account has not been approved.', $plugin_slug));
          } else {
          return $user;
          }
          } */

        if ($user instanceof WP_User) {
            global $wpdb;
            $sql = $wpdb->prepare("REPLACE INTO last_login (user_id, login_date) VALUES(%d, NOW())", $user->ID);
            $wpdb->query($sql);
        }

        return $user;
    }

    /**
     *
     */
    public function update_profile($user_id) {

        if (isset($_POST['update_custom_profile']) && wp_verify_nonce($_POST['update_custom_profile'], 'update_custom_profile')) {

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

            //foreach ($_FILES as $file => $array) {
            $newupload = insert_attachment('user_logo', $user_id);
            //}
            //insert_attachment('', $post_id, $setthumb = 'true')

            try {
                //upload_logo($user_id, 'user_logo');
            } catch (Exception $e) {
                
            }
        }
    }

    public function init() {
        $this->register_custom_post();
        $this->create_taxonomies();

        /*
          register_post_status('deleted', array(
          'label' => _x('Deleted', 'estateprogram'),
          'public' => false,
          'exclude_from_search' => true,
          'show_in_admin_all_list' => true,
          'show_in_admin_status_list' => true,
          'label_count' => _n_noop('Deleted <span class="count">(%s)</span>', 'Deleted <span class="count">(%s)</span>'),
          )); */
    }

    /**
     *
     */
    public function register_custom_post() {

        $args = array(
            'labels' => array(
                'name' => __('Program', $this->plugin_slug),
                'singular_name' => __('Program', $this->plugin_slug),
                'add_new' => __('Create program', $this->plugin_slug),
                'add_new_item' => __('New program', $this->plugin_slug),
                'edit_item' => __('Edit program', $this->plugin_slug),
                'new_item' => __('Create program', $this->plugin_slug),
                'all_items' => __('All programs', $this->plugin_slug),
                'view_item' => __('View program', $this->plugin_slug),
                'search_items' => __('Find program', $this->plugin_slug),
                'parent_item_colon' => '',
                'menu_name' => __('Programs', $this->plugin_slug)
            ),
            'public' => true,
            'supports' => array(
                'thumbnail',
                'title',
                'editor',
                'excerpt',
                'author'
            ),
            'menu_position' => 7,
            'rewrite' => array(
                'slug' => 'program',
            ),
                //'show_in_menu' => 'Program'
        );

        register_post_type('program', $args);


        $args = array(
            'labels' => array(
                'name' => __('Products', $this->plugin_slug),
                'singular_name' => __('Product', $this->plugin_slug),
                'add_new' => __('Create product', $this->plugin_slug),
                'add_new_item' => __('New product', $this->plugin_slug),
                'edit_item' => __('Edit product', $this->plugin_slug),
                'new_item' => __('Create product', $this->plugin_slug),
                'all_items' => __('All products', $this->plugin_slug),
                'view_item' => __('View product', $this->plugin_slug),
                'search_items' => __('Find product', $this->plugin_slug),
                'parent_item_colon' => '',
                'menu_name' => __('Products', $this->plugin_slug)
            ),
            'public' => true,
            'supports' => array(
                'thumbnail',
                'title',
                'editor',
                'excerpt',
                'author'
            ),
            'menu_position' => 8,
            'rewrite' => array(
                'slug' => 'product',
            ),
                //'show_in_menu' => 'program_overview'
        );

        register_post_type('flat', $args);
    }

    /**
     *
     */
    public function create_taxonomies() {


        ############################################################
        # program
        $args = array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('Type of property', $this->plugin_slug),
                'menu_name' => __('Type of property', $this->plugin_slug)
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'type-of-property'),
                //'show_in_menu' => 'program_overview'
        );

        register_taxonomy('type_of_accommodation', array('program'), $args);

        ############################################################
        # Show
        $args = array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('Show', $this->plugin_slug),
                'menu_name' => __('Show', $this->plugin_slug)
            ),
            'public' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            //'query_var' => true,
            'rewrite' => array('slug' => 'show'),
                //'show_in_menu' => 'program_overview'
        );

        register_taxonomy('show', array('program'), $args);

        ###################################################
        # Show
        $args = array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('Location', $this->plugin_slug),
                'menu_name' => __('Location', $this->plugin_slug)
            ),
            'public' => false,
            'show_ui' => false,
            'show_admin_column' => false,
                //'query_var' => true,
                //'rewrite' => array('slug' => 'location'),
                //'show_in_menu' => 'program_overview'
        );

        register_taxonomy('location', array('flat'), $args);

        /*
          $args = array(
          'hierarchical' => true,
          'labels' => array(
          'name' => _x('Parking', $this->plugin_slug),

          'singular_name' => _x('City', 'taxonomy singular name'),
          'search_items' => __('Find city'),
          'all_items' => __('All cities'),
          'parent_item' => __('Parent city'),
          'parent_item_colon' => __('Parent city'),
          'edit_item' => __('Edit city'),
          'update_item' => __('Update city'),
          'add_new_item' => __('Create city'),
          'new_item_name' => __('New city'),
          'menu_name' => __('Parking', $this->plugin_slug)
          ),
          'show_ui' => true,
          'show_admin_column' => true,
          'query_var' => true,
          'rewrite' => array('slug' => 'parking'),
          //'show_in_menu' => 'program_overview'
          );

          register_taxonomy('parking', array('program'), $args);
         */

        ############################################################
        # flat



        /*
          $args = array(
          'hierarchical' => true,
          'labels' => array(
          'name' => __('Structure', $this->plugin_slug),
          'menu_name' => __('Structure', $this->plugin_slug)
          ),
          'show_ui' => true,
          'show_admin_column' => true,
          'query_var' => true,
          'rewrite' => array('slug' => 'structure'),
          //'show_in_menu' => 'program_overview'
          );

          register_taxonomy('structure', array('flat'), $args); */
    }

    /**
     * Return the plugin slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_plugin_slug() {
        return $this->plugin_slug;
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fired when the plugin is activated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses
     *                                       "Network Activate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       activated on an individual blog.
     */
    public static function activate($network_wide) {

        // nechci pending roli
        remove_role('pending');



        $result = add_role(
                'waiting_for_approval', __('Waiting for approval'), array(
                //'read' => true, // true allows this capability
                //'edit_posts' => true,
                //'delete_posts' => false, // Use false to explicitly deny
                )
        );

        $result = add_role(
                'frozen', __('Frozen'), array(
                //'read' => true, // true allows this capability
                //'edit_posts' => true,
                //'delete_posts' => false, // Use false to explicitly deny
                )
        );

        $frozen_role = get_role('frozen');
        $frozen_role->add_cap('freeze');

        $role_names = array(
            'administrator',
            'editor',
            'author',
            'contributor',
            'subscriber',
            'waiting_for_approval',
                //'pending'
        );


        foreach ($role_names as $role_name) {
            $role = get_role($role_name);
            $role->add_cap('see_detail');
        }

        $waiting_for_approval_role = get_role('waiting_for_approval');
        $waiting_for_approval_role->add_cap('only_demo');

        //
        $role_names = array(
            'administrator',
            'editor',
            'author',
            'contributor',
            'subscriber',
        );


        foreach ($role_names as $role_name) {
            $role = get_role($role_name);
            $role->add_cap('see_contact');
        }

        if (function_exists('is_multisite') && is_multisite()) {

            if ($network_wide) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ($blog_ids as $blog_id) {

                    switch_to_blog($blog_id);
                    self::single_activate();
                }

                restore_current_blog();
            } else {
                self::single_activate();
            }
        } else {
            self::single_activate();
        }
    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses
     *                                       "Network Deactivate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       deactivated on an individual blog.
     */
    public static function deactivate($network_wide) {

        if (function_exists('is_multisite') && is_multisite()) {

            if ($network_wide) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ($blog_ids as $blog_id) {

                    switch_to_blog($blog_id);
                    self::single_deactivate();
                }

                restore_current_blog();
            } else {
                self::single_deactivate();
            }
        } else {
            self::single_deactivate();
        }
    }

    /**
     * Fired when a new site is activated with a WPMU environment.
     *
     * @since    1.0.0
     *
     * @param    int    $blog_id    ID of the new blog.
     */
    public function activate_new_site($blog_id) {

        if (1 !== did_action('wpmu_new_blog')) {
            return;
        }

        switch_to_blog($blog_id);
        self::single_activate();
        restore_current_blog();
    }

    /**
     * Get all blog ids of blogs in the current network that are:
     * - not archived
     * - not spam
     * - not deleted
     *
     * @since    1.0.0
     *
     * @return   array|false    The blog ids, false if no matches.
     */
    private static function get_blog_ids() {

        global $wpdb;

        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

        return $wpdb->get_col($sql);
    }

    /**
     * Fired for each blog when the plugin is activated.
     *
     * @since    1.0.0
     */
    private static function single_activate() {
        // @TODO: Define activation functionality here
    }

    /**
     * Fired for each blog when the plugin is deactivated.
     *
     * @since    1.0.0
     */
    private static function single_deactivate() {
        // @TODO: Define deactivation functionality here
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {


        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            // I'm AJAX!

            $referer = $_SERVER['HTTP_REFERER'];

            global $q_config;
            $langs = qtrans_getSortedLanguages();

            $wanted_lang = '';

            foreach ($langs as $lang) {
                if (false !== strpos($referer, "/$lang/")) {
                    $wanted_lang = $lang;
                }
            }

            if (!empty($wanted_lang)) {
                $q_config['language'] = $wanted_lang;
            }


            $locale = apply_filters('plugin_locale', get_locale(), $domain);
        } else {

            $locale = apply_filters('plugin_locale', get_locale(), $domain);
        }

        $domain = $this->plugin_slug;
        load_textdomain($domain, trailingslashit(WP_LANG_DIR) . $domain . '/' . $domain . '-' . $locale . '.mo');
    }

    /**
     * Register and enqueue public-facing style sheet.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        //wp_enqueue_style($this->plugin_slug . '-plugin-styles', plugins_url('assets/css/public.css', __FILE__), array(), self::VERSION);
    }

    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        //$t = __('Added to favorites', 'wpbootstrap');

        wp_enqueue_script($this->plugin_slug . '-plugin-script', plugins_url('assets/js/public.js', __FILE__), array('jquery'), self::VERSION);
        wp_localize_script($this->plugin_slug . '-plugin-script', $this->plugin_slug, array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'added' => __('Added to favorites', 'wpbootstrap'),
            'removed' => __('Add to favorite', 'wpbootstrap'),
        ));
    }

    /**
     * NOTE:  Actions are points in the execution of a page or process
     *        lifecycle that WordPress fires.
     *
     *        Actions:    http://codex.wordpress.org/Plugin_API#Actions
     *        Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
     *
     * @since    1.0.0
     */
    public function action_method_name() {
        // @TODO: Define your action hook callback here
    }

    /**
     * NOTE:  Filters are points of execution in which WordPress modifies data
     *        before saving it or sending it to the browser.
     *
     *        Filters: http://codex.wordpress.org/Plugin_API#Filters
     *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
     *
     * @since    1.0.0
     */
    public function filter_method_name() {
        // @TODO: Define your filter hook callback here
    }

    /**
     *
     * @global type $wpdb
     * @param type $program_id
     * @return type
     */
    static function get_flats_by_program($program_id) {

        global $wpdb;

        $sql = "
            SELECT
                flat.*
            FROM
                wp_posts AS flat
            JOIN
                apartment2program a2p
            ON
                a2p.apartment_id = flat.ID
            WHERE
                a2p.program_id = '" . esc_sql($program_id) . "'

        ";

        return $wpdb->get_results($sql);
    }

    static function get_flat_props_by_program($program_id, $langugage, $limit, $offset) {

        global $wpdb;

        $sql = "
            SELECT
                pl.meta_key,
                pl.meta_value,
                flat.ID,
                flat.post_title
            FROM
                postmeta_lang AS pl
            JOIN
                wp_posts AS flat
            ON
                flat.ID = pl.post_id
            JOIN
                apartment2program AS a2p
            ON
                a2p.apartment_id = pl.post_id
            WHERE
                pl.lang = '" . esc_sql($langugage) . "'
            AND
                a2p.program_id = '" . (int) $program_id . "'
            ORDER BY
                flat.ID DESC
        ";

        if (!empty($limit)) {
            $sql .= " LIMIT '" . (int) $limit . "'";

            if (!empty($offset)) {
                $sql .= ", " . (int) $offset;
            }
        }

        return $wpdb->get_results($sql);
    }

    static function get_flats_props_by_program($program_id, $lang, $exclude_apartment_id = null) {

        global $wpdb;
        $sql = "
            SELECT
                p.ID,
                m.meta_value as prop,
                IFNULL(up.flat_id, 0) as is_favorite,
                p.post_name as slug
            FROM
                wp_posts AS p
            JOIN
                wp_postmeta as m
            ON
                m.post_id = p.ID
            JOIN
                apartment2program AS a2p
            ON
                a2p.apartment_id = p.ID
            LEFT JOIN
                user_preference	AS up
            ON
                up.flat_id = p.ID AND up.user_id = " . (int) get_current_user_id() . "
            LEFT JOIN
                wp_users AS u
            ON
                up.user_id = u.ID
            WHERE
                m.meta_key = 'flat_props_" . esc_sql($lang) . "'
            AND
                a2p.program_id = '" . (int) $program_id . "'
            AND
                p.post_type = 'flat'
            AND
                p.post_status = 'publish'
        ";

        if (!is_null($exclude_apartment_id)) {
            $sql .= "
                AND
                    p.ID != '" . $exclude_apartment_id . "'
            ";
        }

        $result = $wpdb->get_results($sql);

        if (empty($result)) {

            $sql = "
            SELECT
                p.ID,
                m.meta_value as prop,
                IFNULL(up.flat_id, 0) as is_favorite,
                p.post_name as slug
            FROM
                wp_posts AS p
            JOIN
                wp_postmeta as m
            ON
                m.post_id = p.ID
            JOIN
                apartment2program AS a2p
            ON
                a2p.apartment_id = p.ID
            LEFT JOIN
                user_preference	AS up
            ON
                up.flat_id = p.ID AND up.user_id = " . (int) get_current_user_id() . "
            LEFT JOIN
                wp_users AS u
            ON
                up.user_id = u.ID
            WHERE
                m.meta_key = 'flat_props_en'
            AND
                a2p.program_id = '" . (int) $program_id . "'
            AND
                p.post_type = 'flat'
            AND
                p.post_status = 'publish'
        ";

            if (!is_null($exclude_apartment_id)) {
                $sql .= "
                AND
                    p.ID != '" . $exclude_apartment_id . "'
            ";
            }

            $result = $wpdb->get_results($sql);
        }

        return $result;
    }

    /**
     *
     */
    public static function get_all_flats($lang, $limit = null, $offset = null) {
        global $wpdb;

        $sql = "SELECT
                p.ID,
                m.meta_value as prop,
                IFNULL(up.flat_id, 0) as is_favorite,
                p.post_name as slug,
                a2p.program_id as program_id
            FROM
                wp_posts AS p
            JOIN
                wp_postmeta as m
            ON
                m.post_id = p.ID
            LEFT JOIN
                apartment2program AS a2p
            ON
              a2p.apartment_id = p.ID
            LEFT JOIN
              wp_posts AS program
            ON
              a2p.program_id = program.ID
            LEFT JOIN
                user_preference	AS up
            ON
                up.flat_id = p.ID AND up.user_id = " . (int) get_current_user_id() . "
            LEFT JOIN
                wp_users AS u
            ON
                up.user_id = u.ID
            WHERE
                m.meta_key = 'flat_props_" . esc_sql($lang) . "'
            AND
                p.post_type = 'flat'
            AND
                p.post_status = 'publish'
            GROUP BY
                p.ID";

        if (!is_null($limit)) {
            $sql .= " LIMIT " . (int) $limit;

            if (!is_null($offset)) {
                $sql .= ", " . (int) $offset;
            }
        }

        $result = $wpdb->get_results($sql);

        if (empty($result)) {
            $sql = "SELECT
                p.ID,
                m.meta_value as prop,
                IFNULL(up.flat_id, 0) as is_favorite,
                p.post_name as slug,
                a2p.program_id as program_id
            FROM
                wp_posts AS p
            JOIN
                wp_postmeta as m
            ON
                m.post_id = p.ID
            LEFT JOIN
                apartment2program AS a2p
            ON
              a2p.apartment_id = p.ID
            LEFT JOIN
              wp_posts AS program
            ON
              a2p.program_id = program.ID
            LEFT JOIN
                user_preference	AS up
            ON
                up.flat_id = p.ID AND up.user_id = " . (int) get_current_user_id() . "
            LEFT JOIN
                wp_users AS u
            ON
                up.user_id = u.ID
            WHERE
                m.meta_key = 'flat_props_en'
            AND
                p.post_type = 'flat'
            AND
                p.post_status = 'publish'
            GROUP BY
                p.ID";

            if (!is_null($limit)) {
                $sql .= " LIMIT " . (int) $limit;

                if (!is_null($offset)) {
                    $sql .= ", " . (int) $offset;
                }
            }

            $result = $wpdb->get_results($sql);
        }

        return $result;
    }

    /**
     *
     * @global type $wpdb
     * @param type $flat_id
     */
    static public function is_user_favorite($flat_id) {

        global $wpdb;

        $sql = "
            SELECT
                flat_id
            FROM
                user_preference
            WHERE
                flat_id = '" . (int) $flat_id . "'
            AND
                user_id = '" . (int) get_current_user_id() . "'
        ";

        return (bool) $wpdb->get_var($sql);
    }

    /**
     *
     */
    static public function user_preferences($lang, $limit = null, $offset = null) {

        global $wpdb;

        $sql = "SELECT
                p.ID,
                m.meta_value as prop,
                up.flat_id as is_favorite,
                p.post_name as slug,
                a2p.program_id as program_id
            FROM
                wp_posts AS p
            JOIN
                wp_postmeta as m
            ON
                m.post_id = p.ID
            LEFT JOIN
                apartment2program AS a2p
            ON
              a2p.apartment_id = p.ID
            LEFT JOIN
              wp_posts AS program
            ON
              a2p.program_id = program.ID
            JOIN
                user_preference	AS up
            ON
                up.flat_id = p.ID AND up.user_id = " . (int) get_current_user_id() . "
            JOIN
                wp_users AS u
            ON
                up.user_id = u.ID
            WHERE
                m.meta_key = 'flat_props_" . esc_sql($lang) . "'
            AND
                p.post_type = 'flat'
            AND
                p.post_status = 'publish'
            GROUP BY
                p.ID";

        if (!is_null($limit)) {
            $sql .= " LIMIT " . (int) $limit;

            if (!is_null($offset)) {
                $sql .= ", " . $offset;
            }
        }

        $result = $wpdb->get_results($sql);


        if (empty($result)) {

            $sql = "SELECT
                p.ID,
                m.meta_value as prop,
                up.flat_id as is_favorite,
                p.post_name as slug,
                a2p.program_id as program_id
            FROM
                wp_posts AS p
            JOIN
                wp_postmeta as m
            ON
                m.post_id = p.ID
            JOIN
                apartment2program AS a2p
            ON
              a2p.apartment_id = p.ID
            JOIN
              wp_posts AS program
            ON
              a2p.program_id = program.ID
            JOIN
                user_preference	AS up
            ON
                up.flat_id = p.ID AND up.user_id = " . (int) get_current_user_id() . "
            JOIN
                wp_users AS u
            ON
                up.user_id = u.ID
            WHERE
                m.meta_key = 'flat_props_en'
            AND
                p.post_type = 'flat'
            AND
                p.post_status = 'publish'
            GROUP BY
                p.ID";

            if (!is_null($limit)) {
                $sql .= " LIMIT " . (int) $limit;

                if (!is_null($offset)) {
                    $sql .= ", " . $offset;
                }
            }

            $result = $wpdb->get_results($sql);
        }

        return $result;
    }

    /**
     *
     * @global type $wpdb
     * @param type $lang
     * @return type
     */
    public static function cities($lang) {

        global $wpdb;

        $sql = "
            SELECT
                city
            FROM
                city
            WHERE
                lang = '" . esc_sql($lang) . "'
            ";

        return $wpdb->get_col($sql);
    }

    /*
      static public function heatingSystem($props) {
      $arr = array();

      if (isset($props['ausstattung|heizungsart|ZENTRAL']) && 1 == $props['ausstattung|heizungsart|ZENTRAL']) {
      $arr[] = __('chauffage par le sol', 'estateprogram');
      }

      if (isset($props['ausstattung|heizungsart|FUSSBODEN']) && 1 == $props['ausstattung|heizungsart|FUSSBODEN']) {
      $arr[] = __('chauffage central', 'estateprogram');
      }

      if (isset($props['ausstattung|heizungsart|ETAGE']) && 1 == $props['ausstattung|heizungsart|ETAGE']) {
      $arr[] = __('chauffage individuel', 'estateprogram');
      }

      return implode(', ', $arr);
      } */

    static function flat_program_id($apartment_id) {

        global $wpdb;

        $sql = "SELECT program_id FROM apartment2program WHERE apartment_id = " . (int) $apartment_id;

        return $wpdb->get_var($sql);
    }

}
