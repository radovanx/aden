<?php
/**
 * <kbd>SWL_View_Element_Form_CheckboxMulti</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_CheckboxMulti
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Form/Element.php';
require_once 'SWL/View/Renderer/Form/CheckboxMulti.php';

/**
 * Checkbox element
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_CheckboxMulti
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form_CheckboxMulti extends SWL_View_Element_Form_Element {
    
    protected $options = array(); 
    
    public function __construct($name, $value = array(), $options = array(), $attributes = array(), $settings = array()) {    
        $this->options = $options;
        parent::__construct('checkboxmulti', $name, $value, $attributes, $settings);
        $this->setRenderer(new SWL_View_Renderer_Form_CheckboxMulti($this));
    }
    
    public function getOptions() {
        return $this->options;
    }

}

