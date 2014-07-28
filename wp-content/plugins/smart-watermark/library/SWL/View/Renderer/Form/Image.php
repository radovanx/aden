<?php
/**
 * <kbd>SWL_View_Renderer_Form_Image</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Image
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer/Form/Element.php';

/**
 * Image renderer
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Image
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Renderer_Form_Image extends SWL_View_Renderer_Form_Element {
    
    public function renderElement() {
        $html = '';
        $attributes = $this->element->getAttributes();
        $html .= '<input type="text" id="'.esc_attr($this->element->getName()).'" name="'.esc_attr($this->element->getName()).'" value="'.esc_attr($this->element->getValue()).'" />';  
        $html .= '<input id="upload_'.esc_attr($this->element->getName()).'" type="button" class="button" value="Upload" />';
        $html .= '<br /><br />';
        $html .= '<div id="preview_'.esc_attr($this->element->getName()).'">';
        if ($this->element->getValue()!='') {
            $html .= '<img src="'.esc_attr($this->element->getValue()).'" />'; 
        }                    
        $html .= '</div>'; 
        $html .= '<script type="text/javascript">
                    jQuery(document).ready(function($) {  
                        $("#upload_'.esc_attr($this->element->getName()).'").click(function() {  
                            tb_show("Upload a watermark", "media-upload.php?referer=smart_watermark_referer&type=image&TB_iframe=true&post_id=0", false);  
                            return false;  
                        });
                        window.send_to_editor = function(html) {  
                            var image_url = $("img", html).attr("src");  
                            $("#'.esc_attr($this->element->getName()).'").val(image_url);  
                            $("#preview_'.esc_attr($this->element->getName()).'").html("<img src=\'"+image_url+"\' alt=\'\' />");  
                            tb_remove();  
                        }    
                      });
                    </script>';
        return $html;
    }
    
}