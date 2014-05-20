<?php

/**
 * Plugin Name.
 *
 * @package   pdfgenerator
 * @author    Radomir Bednar <radomir@web-4-all.cz>
 * @license   GPL-2.0+
 * @link
 * @copyright 2014 Radomir Bednar
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-pdfgenerator-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package pdfgenerator
 * @author  Your Name <email@example.com>
 */
class pdfgenerator {

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    const VERSION = '1.0.0';

    /**
     * @TODO - Rename "pdfgenerator" to the name your your plugin
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
    public $plugin_slug = 'pdfgenerator';

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.0.0
     */
    private function __construct() {

        // Load plugin text domain
        add_action('init', array($this, 'load_plugin_textdomain'));

        // Activate plugin when new blog is added
        add_action('wpmu_new_blog', array($this, 'activate_new_site'));

        // Load public-facing style sheet and JavaScript.
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

        /* Define custom functionality.
         * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
         */
        add_action('@TODO', array($this, 'action_method_name'));
        add_filter('@TODO', array($this, 'filter_method_name'));

        //add_action('init', array(&$this, 'endpoints'));

        add_action('parse_request', array(&$this, 'parse_request'));
        add_action('init', array(&$this, 'do_rewrite'));
        add_filter('query_vars', array(&$this, 'query_vars'));

        //
        add_action('wp_ajax_recommend_product', array(&$this, 'recommend_product'));
        add_action('wp_ajax_nopriv_recommend_product', array(&$this, 'recommend_product'));
    }

    public function query_vars($public_query_vars) {
        $public_query_vars[] = 'action';
        $public_query_vars[] = 'product_id';
        $public_query_vars[] = 'product_type';
        return $public_query_vars;
    }

    function do_rewrite() {
        add_rewrite_rule("generate-pdf/([^/]+)/([^/]+)/?$", 'index.php?action=generate-pdf&product_type=$matches[1]&product_id=$matches[2]', 'top');
        add_rewrite_rule("generate-pdf/([^/]+)/([^/]+)/?$", 'index.php?action=generate-pdf&product_type=$matches[1]&product_id=$matches[2]', 'top');
        add_rewrite_rule("reservation-document/([^/]+)/?$", 'index.php?action=reservation-pdf&product_id=$matches[1]', 'top');
    }

    public function parse_request(&$wp) {

        $q = $wp->query_vars;
        $lang = qtrans_getLanguage();

        // rezervacni form
        if (isset($q['action']) && 'reservation-pdf' == $q['action']) {
            if (!empty($q['product_id'])) {

                $product = get_post($q['product_id']);
                $props = get_post_meta($product->ID, 'flat_props_' . $lang, true);

                require_once(plugin_dir_path(__FILE__) . '..' . DIRECTORY_SEPARATOR . 'lib/MPDF57/mpdf.php');

                $mpdf = new mPDF();

                $header_file = plugin_dir_path(__FILE__) . 'pdf' . DIRECTORY_SEPARATOR . 'header.php';
                ob_start();
                include $header_file;
                $header = ob_get_contents();
                ob_end_clean();

                $mpdf->SetHTMLHeader($header);

                $mpdf->SetImportUse();

                $dir = plugin_dir_path(__FILE__);

                $pdf_file = $dir . 'pdf' . DIRECTORY_SEPARATOR . 'reservation-' . $lang . '.pdf';

                $pagecount = $mpdf->SetSourceFile($pdf_file);

                for ($i = 1; $i <= $pagecount; $i++) {
                    $mpdf->AddPage();
                    $tpl = $mpdf->ImportPage($i);
                    $mpdf->SetHTMLHeader('');
                    $mpdf->UseTemplate($tpl, '', '', 210, 297);
                }

                if (empty($props['verwaltung_techn|objektnr_extern'])) {
                    $filename = 'reservation-' . get_the_title($product_id);
                } else {
                    $filename = 'reservation-' . $props['verwaltung_techn|objektnr_extern'];
                }

                $mpdf->Output($filename, 'D');
            }
        }

        // pdf prezentace produktu
        if (isset($q['action']) && 'generate-pdf' == $q['action']) {

            /*
              $mpdf = new mPDF(
              '', //mode
              'A4', // format
              '', // font size
              '', // default font
              '', // margin left
              '', // margin right
              '', // margin top
              '', // margin bottom
              '', // margin header
              '' // margin footer
              ); */

            if (isset($q['product_type'])) {
                switch ($q['product_type']) {
                    case 'product':

                        if (isset($q['product_id'])) {
                            $product = get_post($q['product_id']);

                            $props = get_post_meta($product->ID, 'flat_props_' . $lang, true);

                            $mpdf = $this->create_html2pdf($product, $props);

                            if (empty($props['verwaltung_techn|objektnr_extern'])) {
                                $filename = get_the_title($product_id);
                            } else {
                                $filename = $props['verwaltung_techn|objektnr_extern'];
                            }

                            $mpdf->Output($filename, 'D');
                        }

                        if (isset($q['product-id'])) {
                            
                        }
                        break;
                    case '':
                        break;
                }
            }

            if (isset($q['program-id'])) {
                
            }

            //$mpdf->Output($filename, 'D');
            //$mpdf->Output('filename.pdf', 'F');
            exit;
        }
    }

    public function create_html2pdf($product, $props) {

        require_once(plugin_dir_path(__FILE__) . '..' . DIRECTORY_SEPARATOR . 'lib/MPDF57/mpdf.php');

        $mpdf = new mPDF();

        ob_start();
        require_once plugin_dir_path(__FILE__) . "pdf/apartment.php";
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        return $mpdf;
    }

    static function apartment($apartment_id, $lang) {

        global $wpdb;

        $apartment = get_post($apartment_id);
        $apartment_props = get_post_meta($apartment_id, 'flat_props_' . $lang, true);

        $path = plugin_dir_path(__FILE__);
    }

    function recommend_product() {

        if (empty($_POST['id'])) {
            header("HTTP/1.0 404 Not Found");
            _e('Error: could not find presentatiion', $this->plugin_slug);
            die();
        }

        $id = $_POST['id'];

        $product = get_post($id);

        if (empty($product)) {
            header("HTTP/1.0 404 Not Found");
            _e('Error: could not find presentatiion', $this->plugin_slug);
            die();
        }

        if (empty($_POST['receiver_email'])) {
            header("HTTP/1.0 404 Not Found");
            _e('Please, enter an email address', $this->plugin_slug);
            die();
        } else if (!filter_var($_POST['receiver_email'], FILTER_VALIDATE_EMAIL)) {
            header("HTTP/1.0 404 Not Found");
            _e('Please enter a valid email address', $this->plugin_slug);
            die();
        }

        $to = $_POST['receiver_email'];

        if (empty($_POST['receiver_message'])) {
            header("HTTP/1.0 404 Not Found");
            _e('Please enter a message', $this->plugin_slug);
            die();
        }

        $message = strip_tags($_POST['receiver_message']);
        $message = str_replace("\n", "\r\n", $message);

        $lang = qtrans_getLanguage();
        $props = get_post_meta($product->ID, 'flat_props_' . $lang, true);

        $mpdf = $this->create_html2pdf($product, $props);

        $presentation_string = $mpdf->Output('', 'S');
        $attachment = chunk_split(base64_encode($presentation_string));

        //$user_data = get_userdata(get_current_user_id());
        //$mailto = $user_data->user_email;
        //$mailto = 'root@localhost';

        global $current_user;
        get_currentuserinfo();

        $from_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
        $from_mail = $current_user->user_email;
        $reply_to = $current_user->user_email;

        if (!empty($props['freitexte|objekttitel'])) {
            $subject = $props['freitexte|objekttitel'];
        } else {
            $subject = get_the_title($product->ID);
        }

        if (empty($props['verwaltung_techn|objektnr_extern'])) {
            $filename = $subject;
        } else {
            $filename = $props['verwaltung_techn|objektnr_extern'];
        }

        $filename = $filename . '.pdf';

        // $message = esc_attr($message);
// a random hash will be necessary to send mixed content
        $separator = md5(time());
// carriage return type (we use a PHP end of line constant)
        $eol = PHP_EOL;
// main header
        $headers = "From: " . $from_name . " <" . $from_mail . "> " . $eol;
        $headers .= "Reply-To: $replyto\r\n";

        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";
// no more headers after this, we start the body! //
        $body = "" . $separator . $eol;
        $body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
// message
        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: text/plain; charset=utf-8" . $eol;
        $body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
        $body .= $message . $eol;
// attachment
        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment" . $eol . $eol;
        $body .= $attachment . $eol;
        $body .= "--" . $separator . "--";
// send message
        if (false === mail($to, $subject, $body, $headers)) {
            header("HTTP/1.0 404 Not Found");
            _e('Email could not be sent, please contact administrator of this server.', $this->plugin_slug);
            die();
        }

        // ulozim zaznam

        global $wpdb;

        $sql = "
            INSERT INTO
                recommendation (user_id, receiver, when_sent, product_id, product)
            VALUES (
                '" . get_current_user_id() . "',
                '" . esc_sql($to) . "',
                NOW(),
                '" . $product->ID . "',
                '" . esc_sql(serialize($props)) . "'
            );
        ";

        $wpdb->query($sql);

        exit;
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

        $domain = $this->plugin_slug;
        $locale = apply_filters('plugin_locale', get_locale(), $domain);

        load_textdomain($domain, trailingslashit(WP_LANG_DIR) . $domain . '/' . $domain . '-' . $locale . '.mo');
    }

    /**
     * Register and enqueue public-facing style sheet.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_slug . '-plugin-styles', plugins_url('assets/css/public.css', __FILE__), array(), self::VERSION);
    }

    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_slug . '-plugin-script', plugins_url('assets/js/public.js', __FILE__), array('jquery'), self::VERSION);
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

}
