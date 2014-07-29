<?php
/**
 * <kbd>SWL_Form_Element_Submit</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Submit
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ .'/../Element.php';
require_once __DIR__ .'/Renderer/Submit.php';

/**
 * Textarea element
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Submit
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Submit extends SWL_Form_Element {
    
    public function __construct($label = '', $attributes = array(), $options = array()) {    
        parent::__construct('submit', '', '', $label, $attributes, $options);
        $options['renderer']['renderLabel'] = false;
        $this->setRenderer(new SWL_Form_Element_Renderer_Submit($this, isset($options['renderer'])?$options['renderer']:array()));
    }
    
}

