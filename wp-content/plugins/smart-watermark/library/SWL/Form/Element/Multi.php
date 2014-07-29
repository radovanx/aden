<?php
/**
 * <kbd>SWL_Form_Element_Multi</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Multi
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ .'/../Element.php';


/**
 * Multi element
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Multi
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
abstract class SWL_Form_Element_Multi extends SWL_Form_Element {
    
    protected $choices = array();  
    
    protected $elements = array();
    
    public function __construct($type, $name, $choices, $value = '', $label = '', $attributes = array(), $options = array()) {   
        if (!is_array($value)) $value = array($value);
        parent::__construct($type, $name, $value, $label, $attributes, $settings);
        $this->choices = $choices;
        $this->createElements();
   }
    
    abstract protected function createElements();
    
}