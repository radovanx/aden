<?php
/**
 * <kbd>SmartWatermark_View_Renderer_Form_Position</kbd> class file
 *
 * PHP version 5
 *
 * @category    SmartWatermark_View_Renderer_Form
 * @package     SmartWatermark_View_Renderer_Form_Position
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer/Form/RadioMulti.php';

/**
 * RadioMulti field renderer
 *
 * @category    SmartWatermark_View_Renderer_Form
 * @package     SmartWatermark_View_Renderer_Form_Position
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SmartWatermark_View_Renderer_Form_Position extends SWL_View_Renderer_Form_RadioMulti {
    
    public function renderElement() {
        $html = '<table border="1">
            <tr>
                <td><input type="radio" name="'.$this->element->getName().'" value="top-left" '.(in_array('top-left', $this->element->getValue())?'checked':'').' /></td>
                <td><input type="radio" name="'.$this->element->getName().'" value="top-middle" '.(in_array('top-middle', $this->element->getValue())?'checked':'').' /></td>
                <td><input type="radio" name="'.$this->element->getName().'" value="top-right" '.(in_array('top-right', $this->element->getValue())?'checked':'').' /></td>
            </tr>   
            <tr>
                <td><input type="radio" name="'.$this->element->getName().'" value="middle-left" '.(in_array('middle-left', $this->element->getValue())?'checked':'').' /></td>
                <td><input type="radio" name="'.$this->element->getName().'" value="middle-middle" '.(in_array('middle-middle', $this->element->getValue())?'checked':'').' /></td>
                <td><input type="radio" name="'.$this->element->getName().'" value="middle-right" '.(in_array('iddle-right', $this->element->getValue())?'checked':'').' /></td>
            </tr> 
            <tr>
                <td><input type="radio" name="'.$this->element->getName().'" value="bottom-left" '.(in_array('bottom-left', $this->element->getValue())?'checked':'').' /></td>
                <td><input type="radio" name="'.$this->element->getName().'" value="bottom-middle" '.(in_array('bottom-middle', $this->element->getValue())?'checked':'').' /></td>
                <td><input type="radio" name="'.$this->element->getName().'" value="bottom-right" '.(in_array('bottom-right', $this->element->getValue())?'checked':'').' /></td>
            </tr>             
        </table>';
        return $html;
    } 
    
}