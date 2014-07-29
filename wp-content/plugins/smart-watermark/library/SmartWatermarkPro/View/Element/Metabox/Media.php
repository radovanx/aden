<?php

require_once 'SWL/View/Element/Metabox.php';
require_once 'SWL/View/Decorator/Tag.php';
require_once 'SWL/View/Element/Form/Boolean.php';
require_once 'SWL/View/Element/Form/Element.php';
require_once 'SWL/View/Element/Form/Text.php';

class SmartWatermarkPro_View_Element_Metabox_Media extends SWL_View_Element_Metabox {
    
    public function __construct() {
        parent::__construct('smartwatermark_media', 'Smart Watermark', array('type' => 'attachment', 'context' => 'side'));
    }
    
    public function buildMetabox($post) {
        $this->addElementsDecorator(new SWL_View_Decorator_Tag('div', array('style' => 'padding-top:5px;')));
        $addWatermark = get_post_meta($post->ID, 'smartwatermark_add_watermark', true);
        if ($addWatermark=='') $addWatermark = true;
        $this->addElement(new SWL_View_Element_Form_Boolean('smartwatermark_add_watermark', array('label' => 'Add watermark', 'checked' => $addWatermark)));
        $this->addElement(new SWL_View_Element_Form_Element('hidden', 'smartwatermark_media_metabox_nonce', wp_create_nonce('smartwatermark_media_metabox_nonce')));
        $options = array(
            array('value' => 'top-left', 'label' => ''),
            array('value' => 'top-middle', 'label' => ''),
            array('value' => 'top-right', 'label' => ''),
            array('value' => 'middle-left', 'label' => ''),
            array('value' => 'middle-middle', 'label' => ''),
            array('value' => 'middle-right', 'label' => ''),
            array('value' => 'bottom-left', 'label' => ''),
            array('value' => 'bottom-middle', 'label' => ''),
            array('value' => 'bottom-right', 'label' => ''),
        );
        $position = get_post_meta($post->ID, 'smartwatermark_position', true);
        if ($position=='') $position = get_option('smartwatermark_position', 'bottom-right');        
        $position = new SWL_View_Element_Form_RadioMulti('smartwatermark_position', array($position), $options, array('label' => 'Watermark Position'));
        $position->setRenderer(new SmartWatermark_View_Renderer_Form_Position($position));  
        $this->addElement($position);     
        $offsetTop = get_post_meta($post->ID, 'smartwatermark_offset_top', true);
        if ($offsetTop=='') $offsetTop = get_option('smartwatermark_offset_top', 0);  
        $offsetLeft = get_post_meta($post->ID, 'smartwatermark_offset_left', true);
        if ($offsetLeft=='') $offsetLeft = get_option('smartwatermark_offset_left', 0);         
        $this->addElement(new SWL_View_Element_Form_Text('smartwatermark_offset_top', $offsetTop, array('label' => 'Watermark Offset Top, px')));
        $this->addElement(new SWL_View_Element_Form_Text('smartwatermark_offset_left', $offsetLeft, array('label' => 'Watermark Offset Left, px')));        
        $restore = new SWL_View_Element_Form_Element('submit', 'smartwatermark_restore', 'Restore original', array('class' => 'button-primary button-large'));
        $restore->addDecorator(new SWL_View_Decorator_Tag('p'));
        $this->addElement($restore);    
        
    }
    
}