<?php
/**
 * <kbd>SWL_View_Element_Form_Radio</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Radio
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Form/Element.php';
require_once 'SWL/View/Renderer/Form/Radio.php';

/**
 * Radio element
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Radio
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form_Radio extends SWL_View_Element_Form_Element {
    
    protected $checked = false;
    
    public function __construct($name, $value, $attributes = array(), $options = array()) {    
        if (isset($attributes['checked'])) $attributes['checked'] = true;
        parent::__construct('radio', $name, $value, $attributes, $options);
        $this->setRenderer(new SWL_View_Renderer_Form_Radio($this));
    }
    
    public function isChecked() {
        return $this->attributes['checked'];
    }
    
    public function checked($flag) {
        $this->attributes['checked'] = $flag;
    }
    
    public function setValue($value) {
        if ($this->value==$value) $this->checked(true);
        else $this->checked(false);
    }
    
}

