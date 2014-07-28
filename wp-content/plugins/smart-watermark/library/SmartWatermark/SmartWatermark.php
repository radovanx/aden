<?php

require_once 'SWL/Plugin/Plugin.php';
require_once 'SWL/Action/Action.php';
require_once 'SWL/Filter/Filter.php';
require_once 'SWL/Action/Ajax.php';
require_once 'SWL/Menu/Admin/Menu.php';
require_once 'SWL/Page/Admin/Tabs.php';
require_once 'SWL/View/Element/Form/CheckboxMulti.php';

require_once 'SmartWatermark/Page/Admin/Settings.php';
require_once 'SmartWatermark/Page/Admin/Bulk.php';
require_once 'SmartWatermark/ImageEditor.php';

class SmartWatermark extends SWL_Plugin {
    
    protected $_errors = array();
    
    protected $version = '2.0.5';
    
    protected $name = 'Smart Watermark';   
    
    
    /*public function __construct() {
        if (is_admin()) {
            add_action('admin_enqueue_scripts', array($this, 'options_enqueue_scripts')); 
            add_action('admin_notices', array($this, 'admin_notices'));
        }   
        add_filter('wp_update_attachment_metadata', array($this, 'add_watermark'), 10, 2);
        
    } */
    
    public function registerFilters() {
        SWL_Filter_Manager::getInstance()->addFilter(new SWL_Filter(array($this, 'addWatermark'), 'wp_update_attachment_metadata', 10, 2));
    }
    
    public function registerAdminActions() {
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'mediaUploadSetup'), 'admin_init'));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'createMenu'), 'admin_menu'));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action_Ajax(array($this, 'ajaxProceed'), 'smart_watermark_proceed'));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action_Ajax(array($this, 'ajaxStat'), 'smart_watermark_stat'));
    }
    
    public function admin_notices() {
        if (count($this->_errors)) {
            foreach ($this->_errors as $error) {
                echo '<div id="message" class="error"><p>' . $error->get_error_message() . '</p></div>';
            }
        }
    }
    
    public function addError(WP_Error $error) {
        $this->_errors[] = $error;
    }
    
    /**
     * Bulk watermarking (via ajax)
     */
    public function ajaxProceed() {
        $offset = $_POST['offset'];
        $limit = $_POST['limit'];
        $args = array(
                        'post_type' => 'attachment', 
                        'posts_per_page' => $limit, 
                        'offset'        => $offset,
                        'post_status' => null, 
                        'post_parent' => null ); 
        $attachments = get_posts($args);   
        foreach ($attachments as $attachment) {
            $this->addWatermark(wp_get_attachment_metadata($attachment->ID), $attachment->ID);
        }
        exit;
    }
    
    /**
     * Media counter (via ajax)
     */
    public function ajaxStat() {
        $stat = 0;
        foreach (wp_count_attachments() as $info) $stat += $info; //TO DO: load only images mime type
        echo $stat;
        exit;
    }    
    
    public function validateImage($attachmentId) {
        return true;
    }
    
    /**
     * Add watermark to attachment (included all attachment sizes). Metadata not changed.
     * 
     * @param array $metadata Attachment metadata. Used for compatibility with wp_update_attachment_metadata filter
     * @param int $attachmentId Atachment identificator
     * @return array Attachment metadata 
     */
    public function addWatermark($metadata, $attachmentId) {
        if ($this->validateImage($attachmentId)) {
            if (strpos(wp_get_referer(), 'smart_watermark_referer')!==false) return $metadata;
            $uploadDir = dirname(get_attached_file($attachmentId));
            foreach ($metadata['sizes'] as $size => $image) {
                if (in_array($size, get_option('smartwatermark_images', array()))) {
                    $path = $uploadDir.'/'.$image['file'];
                    $this->proceed($path, $attachmentId);
                }
            }
            if (in_array('original', get_option('smartwatermark_images', array()))) {
                $this->proceed(get_attached_file($attachmentId), $attachmentId);
            }
        }
        return $metadata;
    }

    /**
     * Add watermark to image
     * 
     * @param string $imagePath Path to image
     * @return boolean
     */
    public function proceed($imagePath, $attachmentId = '') {
        if (get_option('smartwatermark_watermark', '')=='') return false;
        $imagePathFiltered = apply_filters('smartwatermark_image_path', $imagePath);
        $image = new WP_Image_Editor_GD_Watermark($imagePathFiltered);
        $result = $image->load();
        if (is_wp_error($result))  {
            $this->addError($result);
            return false;
        }    
        $imageSize = $image->get_size();
        $watermarkPath = apply_filters('smartwatermark_watermark_path', get_option('smartwatermark_watermark', ''));
        $watermark = new WP_Image_Editor_GD_Watermark($watermarkPath);
        $result = $watermark->load();
        if (is_wp_error($result)) {
            $this->addError($result);
            return false;
        }
        $watermarkSize = $watermark->get_size();
        //get watermark position
        if ($imageSize['width']<=$watermarkSize['width'] || 
            $imageSize['height']<=$watermarkSize['height']) return false;
        if ($imageSize['width'] < get_option('smartwatermark_image_min_width', 300) || 
            $imageSize['height'] < get_option('smartwatermark_image_min_height', 300)) return false;
        $watermarkPosition = $this->getWatermarkPosition($attachmentId, $imageSize['width'], $imageSize['height'], $watermarkSize['width'], $watermarkSize['height']);
        $result = $image->merge($watermark, $watermarkPosition);
        if ($result) {
            do_action('smartwatermark_before_save', $imagePath);
            return $image->save($imagePath);
        }    
        return false;
    }
    
    /**
     * Calculate watermark position 
     * 
     * @param int $imageWidth
     * @param int $imageHeight
     * @param int $watermarkWidth
     * @param int $watermarkHeight
     * @return array
     */
    protected function getWatermarkPosition($attachmentId, $imageWidth, $imageHeight, $watermarkWidth, $watermarkHeight) {
        $x = 0;
        $y = 0;
        $position = apply_filters('smartwatermark_position', get_option('smartwatermark_position', 'bottom-right'), $attachmentId);
        switch ($position) {
            case 'top-left':
                $x = 0;
                $y = 0;
                break;
            case 'top-middle':
                $x = ceil($imageWidth/2-$watermarkWidth/2);
                $y = 0;
                break;
            case 'top-right':
                $x = $imageWidth-$watermarkWidth;
                $y = 0;
                break; 
            case 'middle-left':
                $x = 0;
                $y = ceil($imageHeight/2-$watermarkHeight/2);
                break;
            case 'middle-middle':
                $x = ceil($imageWidth/2-$watermarkWidth/2);
                $y = ceil($imageHeight/2-$watermarkHeight/2);
                break;
            case 'middle-right':
                $x = $imageWidth-$watermarkWidth;
                $y = ceil($imageHeight/2-$watermarkHeight/2);
                break; 
            
            case 'bottom-left':
                $x = 0;
                $y = $imageHeight-$watermarkHeight;
                break;
            case 'bottom-middle':
                $x = ceil($imageWidth/2-$watermarkWidth/2);
                $y = $imageHeight-$watermarkHeight;
                break;
            case 'bottom-right':
                $x = $imageWidth-$watermarkWidth;
                $y = $imageHeight-$watermarkHeight;
                break;            
        }
        $offsetLeft = apply_filters('smartwatermark_offset_left', get_option('smartwatermark_offset_left', 0), $attachmentId);
        $offsetTop = apply_filters('smartwatermark_offset_top', get_option('smartwatermark_offset_top', 0), $attachmentId);
        $x += $offsetLeft;
        $y += $offsetTop;
        return array('x' => $x, 'y' => $y);
    }
    
    /**
     * Replace button text to "Add Watermark" in media insertion window
     * 
     * @global type $pagenow
     */
    public function mediaUploadSetup() {  
        global $pagenow;  
        if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {  
            // Now we'll replace the 'Insert into Post Button' inside Thickbox  
            SWL_Filter_Manager::getInstance()->addFilter(new SWL_Filter(array($this, 'replaceThickboxText'), 'gettext', 1, 3));
        } 
    }
 
    public function replaceThickboxText($translatedText, $text, $domain) { 
        if ('Insert into Post' == $text) { 
            $referer = strpos(wp_get_referer(), 'smart_watermark_referer'); 
            if ($referer != '') return 'Add Watermark';  
        }  
        return $translatedText;  
    }     
    
    /**
     * Add plugin settings page link to admin navigation
     */
    public function createMenu() {        
        $settingsPage = new SWL_Page_Admin_Tabs('Smart Watermark', 'smart-watermark', 'settings');
        $settingsPage->addTab(new SmartWatermark_Page_Admin_Settings(), 'settings');
        $settingsPage->addTab(new SmartWatermark_Page_Admin_Bulk(), 'bulk');
        $menu = array(
            array(
                'title' => 'Smart Watermark',
                'slug' => 'smart-watermark',
                'parent' => 'options-general.php',
                'renderer' => $settingsPage,
            )
        );
        $menu = new SWL_Menu_Admin($menu);
        $menu->init();        
    } 
    
    protected function install() {
        parent::install();
        $this->migrateTo200();
    }   
    
    protected function migrateTo200() {
        add_option('smartwatermark_position', get_option('position', 'bottom-right'));
        add_option('smartwatermark_offset_top', get_option('offset_top', 0));
        add_option('smartwatermark_offset_left', get_option('offset_left', 0));
        add_option('smartwatermark_image_min_width', get_option('image_min_width', 300));
        add_option('smartwatermark_image_min_height', get_option('image_min_height', 300));
        add_option('smartwatermark_images', get_option('images', array()));
        add_option('smartwatermark_watermark', get_option('watermark', ''));
        delete_option('position');
        delete_option('offset_top');
        delete_option('offset_left');
        delete_option('image_min_width');
        delete_option('image_min_height');
        delete_option('images');
        delete_option('watermark');
    }

}