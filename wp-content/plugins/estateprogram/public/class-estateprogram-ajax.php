<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EstateProgramAjax {

    protected $plugin_slug = 'estateprogram';
    public static $log_file;
    protected $fp;

    public function __construct() {
        add_action('wp_ajax_add_to_preference', array(&$this, 'add_to_preference'));
        add_action('wp_ajax_nopriv_add_to_preference', array(&$this, 'add_to_preference'));
        add_action('wp_ajax_get_district', array(&$this, 'get_district'));
        add_action('wp_ajax_nopriv_get_district', array(&$this, 'get_district'));

        add_action('wp_ajax_backend_parse_xml', array(&$this, 'backend_parse_xml'));
        //add_action('wp_ajax_nopriv_backend_parse_xml', array(&$this, 'backend_parse_xml'));
    }

    /**
     * 
     */
    public function backend_parse_xml() {

        require 'class-sourceimport.php';

        //ignore_user_abort(true);


        $dir = trim($_POST['dir']);
        $filename = trim($_POST['file']);


        //$str = 'Processing POST| dir:' . $dir . ' | filename: ' . $filename . "\n";        
        //file_put_contents(EstateProgramAjax::$log_file, $str, FILE_APPEND);


        EstateProgramAjax::$log_file = ABSPATH . $dir . DIRECTORY_SEPARATOR . 'import_log';


        $lockfile = ABSPATH . 'lock' . DIRECTORY_SEPARATOR . basename($filename);



        $now = time();

        if (!file_exists($lockfile)) {
            file_put_contents($lockfile, $now);
        } else {

            $lats_time = file_get_contents($lockfile);
            
            

            if ($now - (int) $lats_time < 30) {
                $str = "****************************************\n";
                $str .= $filename . "|Double process\n";
                file_put_contents(EstateProgramAjax::$log_file, $strs, FILE_APPEND);
                
                //header("HTTP/1.0 404 Not Found");
                //echo 'only one instance at one time can run';
                
                echo 'double';
                exit;
            }
        }


        // zamknu soubor

        /*
          $file = ABSPATH . 'lock.txt';


          $this->fp = fopen($file, "w"); // open it for WRITING ("w")

          if (flock($this->fp, LOCK_EX)) {

          $x = 1;
          $y = 2;

          } else {
          header("HTTP/1.0 404 Not Found");
          echo 'already running';
          exit;
          } */






        $date = date("d. m. Y H:i:s");

        $strs = "------------------------------------------------------------------------------\n";
        $strs .= 'begin|' . $date . '|Processing POST| dir:' . $dir . ' | filename: ' . $filename . "\n";

        $strs .= "======================================================================\n";
        $strs .= print_r($_POST, true) . "\n";
        $strs .= "======================================================================\n";

        file_put_contents(EstateProgramAjax::$log_file, $strs, FILE_APPEND);

        $start_time = time();

        $str = esc_attr($filename);


        try {
            $sc = new SourceImport();
            $sc->processBackendParseXml($filename, $dir);
            $str .= '|ok';
            echo 'ok';
        } Catch (Exception $e) {
            header("HTTP/1.0 404 Not Found");
            echo $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine();
        }

        //flock($this->fp, LOCK_UN);
        //echo 'hello';
        //fclose($this->fp);    

        unlink($lockfile);


        $end_time = time();

        $d = $end_time - $start_time;

        $str .= '|' . $d;

        $date = date("d. m. Y H:i:s");

        $str .= "\nend|" . $date . "\n";

        file_put_contents(EstateProgramAjax::$log_file, $str, FILE_APPEND);

        die();
    }

    //GET !
    public function get_district() {
        $parent_id = $_GET['id'];
        $args = array(
            'taxonomy' => 'location',
            'hide_empty' => true,
            'parent' => $parent_id
        );
        $regions = get_categories($args);
        $term = get_term($parent_id, 'location');
        // Name 
        $city = $term->name;
        ?>
        <div id="district-wrap-<?php echo (int) $parent_id ?>"> 
            <strong><?php echo $city; ?></strong></br>  
            <?php
            foreach ($regions as $key => $value):
                ?> 
                <label class="checkbox-inline">
                    <input type="checkbox" id="district-<?php echo $value->term_id ?>" class="district-checkbox" value="<?php _e($value->name) ?>"><?php _e($value->name) ?>
                </label>
                <?php
            endforeach;
            ?>
        </div>
        <?php
        exit;
    }

    /**
     *
     * @global type $wpdb
     */
    public function add_to_preference() {

        if (!is_user_logged_in()) {
            header("HTTP/1.0 404 Not Found");
            _e('Error', $this->plugin_slug);
            die();
        }

        global $wpdb;

        $flat_id = $_POST['flat_id'];
        $user_id = get_current_user_id();

        $sql = "
SELECT
flat_id
FROM
user_preference
WHERE
flat_id = '" . (int) $flat_id . "'
AND
user_id = '" . (int) $user_id . "'
";

        $exists = $wpdb->get_var($sql);

        if ($exists) {
// current preference - remove preference

            $operation = 0;

            $sql = "
DELETE FROM
user_preference
WHERE
flat_id = '" . (int) $flat_id . "'
AND
user_id = '" . (int) $user_id . "'
";

            if (false === $wpdb->query($sql)) {
                header("HTTP/1.0 404 Not Found");
                _e('Error update preference', $this->plugin_slug);
                die();
            }
        } else {
// current preference - add preference

            $operation = 1;

            $sql = "
REPLACE INTO
user_preference (flat_id, user_id, date_add)
VALUES(
'" . (int) $flat_id . "',
'" . (int) $user_id . "',
NOW()
)";
            if (false === $wpdb->query($sql)) {
                header("HTTP/1.0 404 Not Found");
                _e('Saving preference failed', $this->plugin_slug);
                die();
            }
        }
// update history
        $sql = "
INSERT INTO
user_preference_history (user_id, flat_id, date_change, operation)
VALUES(
'" . (int) $user_id . "',
'" . (int) $flat_id . "',
NOW(),
'" . $operation . "'
)";
        $wpdb->query($sql);
        echo $operation;
        exit;
    }

}

?>