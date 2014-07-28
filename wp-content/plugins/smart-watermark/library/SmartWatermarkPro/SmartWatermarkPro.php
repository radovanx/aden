<?php

require_once 'SWL/View/Element/Form/RadioMulti.php';

require_once 'SmartWatermark/SmartWatermark.php';
require_once 'SmartWatermark/View/Renderer/Form/Position.php';

require_once 'SmartWatermark/Page/Admin/Tabs.php';

require_once 'SmartWatermarkPro/Page/Admin/Restore.php';
require_once 'SmartWatermarkPro/View/Element/Metabox/Media.php';


class SmartWatermarkPro extends SmartWatermark {
    
    protected $version = '3.0.1';
    
    protected $name = 'Smart Watermark';  
    
    public function registerAdminActions() {
        parent::registerAdminActions();
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'beforeSave'), 'smartwatermark_before_save'));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action_Ajax(array($this, 'ajaxRestore'), 'smartwatermark_restore'));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'addMetaboxes'), 'add_meta_boxes'));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'savaAttachment'), 'edit_attachment'));
    }
    
    public function registerFilters() {
        parent::registerFilters();
        SWL_Filter_Manager::getInstance()->addFilter(new SWL_Filter(array($this, 'getImagePath'), 'smartwatermark_image_path'));
        SWL_Filter_Manager::getInstance()->addFilter(new SWL_Filter(array($this, 'getImageWatermarkPosition'), 'smartwatermark_position', 10, 2));
        SWL_Filter_Manager::getInstance()->addFilter(new SWL_Filter(array($this, 'getImageWatermarkOffsetLeft'), 'smartwatermark_offset_left', 10, 2));
        SWL_Filter_Manager::getInstance()->addFilter(new SWL_Filter(array($this, 'getImageWatermarkOffsetTop'), 'smartwatermark_offset_top', 10, 2));
        SWL_Filter_Manager::getInstance()->addFilter(new SWL_Filter(array($this, 'settingsForm'), 'smartwatermark_settings_form'));
    }
    
    public function settingsForm($form) {
        $formats = array(
            array('value' => 'jpg', 'label' => 'JPG'),
            array('value' => 'jpeg', 'label' => 'JPEG'),
            array('value' => 'gif', 'label' => 'GIF'),
            array('value' => 'png', 'label' => 'PNG'),
        );
        $form->addElement(new SWL_View_Element_Form_CheckboxMulti('smartwatermark_image_formats', array(), $formats, array('label' => 'Allowed Formats')));
        return $form;
    }
    
    public function validateImage($attachmentId) {
        $extensions = get_option('smartwatermark_image_formats', array('jpg', 'jpeg', 'gif', 'png'));
        $fileExt = pathinfo(get_attached_file($attachmentId), PATHINFO_EXTENSION);
        if (!in_array($fileExt, $extensions)) return false;
        return parent::validateImage($attachmentId);
    }    
    
    public function addMetaboxes() {
        $mediaMetabox = new SmartWatermarkPro_View_Element_Metabox_Media();
        $mediaMetabox->init();
    }
    
    public function getImageWatermarkPosition($position, $attachmentId) {
        $watermarkPosition = get_post_meta($attachmentId, 'smartwatermark_position', true);
        if ($watermarkPosition!='') $position = $watermarkPosition;
        return $position;
    }
    
    public function getImageWatermarkOffsetLeft($offset, $attachmentId) {
        $watermarkOffset = get_post_meta($attachmentId, 'smartwatermark_offset_left', true);
        if ($watermarkOffset!='') $offset = $watermarkOffset;
        return $offset;
    } 
    
    public function getImageWatermarkOffsetTop($offset, $attachmentId) {
        $watermarkOffset = get_post_meta($attachmentId, 'smartwatermark_offset_top', true);
        if ($watermarkOffset!='') $offset = $watermarkOffset;
        return $offset;
    }     
    
    public function savaAttachment($postId) {
        if (!isset( $_POST['smartwatermark_media_metabox_nonce'])) return $postId;
        $nonce = $_POST['smartwatermark_media_metabox_nonce'];
	if (!wp_verify_nonce($nonce, 'smartwatermark_media_metabox_nonce')) return $postId;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $postId;
	if (!current_user_can('upload_files', $postId)) return $postId;
        $addWatermark = $_POST['smartwatermark_add_watermark'];
        delete_post_meta($postId, 'smartwatermark_add_watermark');
        add_post_meta($postId, 'smartwatermark_add_watermark', sanitize_text_field($addWatermark), true);
        delete_post_meta($postId, 'smartwatermark_position');
        add_post_meta($postId, 'smartwatermark_position', sanitize_text_field($_POST['smartwatermark_position']), true);    
        delete_post_meta($postId, 'smartwatermark_offset_top');
        add_post_meta($postId, 'smartwatermark_offset_top', sanitize_text_field($_POST['smartwatermark_offset_top']), true);   
        delete_post_meta($postId, 'smartwatermark_offset_left');
        add_post_meta($postId, 'smartwatermark_offset_left', sanitize_text_field($_POST['smartwatermark_offset_left']), true); 
        if (isset($_POST['smartwatermark_restore'])) {
            $this->restore($postId);
        } elseif ($addWatermark) { //rebuild watermarks
            $this->addWatermark(wp_get_attachment_metadata($postId), $postId);
        }    
    }
    
    /**
     * Add plugin settings page link to admin navigation
     */
    public function createMenu() {        
        $settingsPage = new SmartWatermark_Page_Admin_Tabs('Smart Watermark', 'smart-watermark', 'settings');
        $settingsPage->addTab(new SmartWatermark_Page_Admin_Settings(), 'settings');
        $settingsPage->addTab(new SmartWatermark_Page_Admin_Bulk(), 'bulk');
        $settingsPage->addTab(new SmartWatermarkPro_Page_Admin_Restore(), 'restore');
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
    
    protected function restore($attachmentId) {
        $metadata = wp_get_attachment_metadata($attachmentId);
        $uploadDir = dirname(get_attached_file($attachmentId));
        foreach ($metadata['sizes'] as $size => $image) {
            $imagePath = $uploadDir.'/'.$image['file'];
            $originalPath = $imagePath.'_swbckp';  
            if (file_exists($originalPath)) {
                @copy($originalPath, $imagePath);
                @unlink($originalPath);
            }
        }  
        //procced original
        $imagePath = get_attached_file($attachmentId);
        $originalPath = $imagePath.'_swbckp'; 
        if (file_exists($originalPath)) {
            @copy($originalPath, $imagePath);
            @unlink($originalPath);
        }         
    }
    
    /**
     * Restore originals (via ajax)
     */
    public function ajaxRestore() {
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
            $this->restore($attachment->ID);           
        }
        exit;
    }    
    
    /**
     * Backup image before add watermark
     * 
     * @param string $imagePath Path to image
     */
    public function beforeSave($imagePath) {
        $bckpPath = $imagePath.'_swbckp';
        if (!file_exists($bckpPath)) @copy($imagePath, $bckpPath);
    }
    
    /**
     * Get path to original image
     * 
     * @param string $imagePathPath to image
     * @return string
     */
    public function getImagePath($imagePath) {
        $bckpPath = $imagePath.'_swbckp';
        if (file_exists($bckpPath)) return $bckpPath;
        return $imagePath;
    }

}