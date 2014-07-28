<?php

require_once 'SWL/Page/Admin/Settings.php';
require_once 'SWL/View/Element/Form.php';
require_once 'SWL/View/Element/Metabox.php';
require_once 'SWL/View/Element/Form/Text.php';
require_once 'SWL/View/Element/Form/Boolean.php';
require_once 'SWL/View/Element/Form/Select.php';
require_once 'SWL/View/Element/Form/CheckboxMulti.php';
require_once 'SWL/View/Element/Form/RadioMulti.php';
require_once 'SWL/View/Element/Form/Submit.php';
require_once 'SWL/View/Element/Form/Image.php';
require_once 'SWL/View/Decorator/Tag.php';
require_once 'SmartWatermark/View/Renderer/Form/Position.php';

class SmartWatermark_Page_Admin_Settings extends SWL_Page_Admin_Settings {
    
    public function __construct() {
        parent::__construct('General Settings', array('hide_title' => true));
    }  
    
    public function initAssets() {
        parent::initAssets();
        $this->addScript(array('name' => 'media-upload'));
        $this->addScript(array('name' => 'thickbox'));
        $this->addStyle(array('name' => 'thickbox'));
    }    
    
    protected function buildForm() {
        parent::buildForm();   
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
        $position = new SWL_View_Element_Form_RadioMulti('smartwatermark_position', array('bottom-right'), $options, array('label' => 'Watermark Position'));
        $position->setRenderer(new SmartWatermark_View_Renderer_Form_Position($position));
        $this->form->addElement($position);
        $this->form->addElementsDecorator(new SWL_View_Decorator_Tag('div', array('class' => 'input')));
        $this->form->addElement(new SWL_View_Element_Form_Text('smartwatermark_offset_top', '0', array('label' => 'Watermark Offset Top, px')));
        $this->form->addElement(new SWL_View_Element_Form_Text('smartwatermark_offset_left', '0', array('label' => 'Watermark Offset Left, px')));
        $this->form->addElement(new SWL_View_Element_Form_Text('smartwatermark_image_min_width', '300', array('label' => 'Min Image Width, px')));
        $this->form->addElement(new SWL_View_Element_Form_Text('smartwatermark_image_min_height', '300', array('label' => 'Min Image Height, px')));
        $sizes = array_merge(array('original'), get_intermediate_image_sizes());
        $options = array();
        foreach ($sizes as $size) $options[] = array('value' => $size, 'label' => $size);
        $this->form->addElement(new SWL_View_Element_Form_CheckboxMulti('smartwatermark_images', array(), $options, array('label' => 'Add Watermark To')));
        $this->form = apply_filters('smartwatermark_settings_form', $this->form);        
        $this->form->addElement(new SWL_View_Element_Form_Image('smartwatermark_watermark', '', array('label' => 'Watermark Image')));
        $this->form->addElement(new SWL_View_Element_Form_Submit('save', 'Save', array('class' => 'button button-primary')));
    }  
    
    protected function processForm() {
        global $smartWatermark;
        parent::processForm();
        if ($this->isPageFormSubmit()) {
            $originalPath = plugin_dir_path(SMARTWATERMARK_PATH.'/dummy').'assets/default/images/original.jpg';
            $watermarkPath = plugin_dir_path(SMARTWATERMARK_PATH.'/dummy').'assets/default/images/watermark.jpg';
            @copy($originalPath, $watermarkPath);
            $smartWatermark->proceed($watermarkPath);
        }         
    }    
    
    public function render($print = true) {
    ?>    
        <div class="wrap swl-page swl-settings-page">
            <?php if (!isset($this->options['hide_title'])): ?>
            <?php screen_icon(); ?>
            <h2><?php echo $this->title; ?></h2>
            <?php endif; ?> 
            <table>
                <tr valign="top">
                    <td style="min-width:300px;">
                    <?php SWL_Alert_Manager::getInstance()->display(); ?>    
                    <?php $this->form->render(); ?>
                    </td>  
                    <td>
                        <h3>Watermark Example</h3>
                        <img src="<?php echo plugins_url('assets/default/images/watermark.jpg?'.time(), SMARTWATERMARK_PATH.'/dummy'); ?>" alt="">
                    </td>    
                </tr>
             </table> 
        </div>
    <?php     
    }     

} 
