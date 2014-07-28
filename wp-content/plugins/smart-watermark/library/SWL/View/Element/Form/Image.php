<?php
/**
 * <kbd>SWL_View_Element_Form_Image</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Image
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Form/Element.php';
require_once 'SWL/View/Renderer/Form/Image.php';

/**
 * Image element
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Image
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form_Image extends SWL_View_Element_Form_Element {
    
    public function __construct($name, $value = '', $attributes = array(), $options = array()) {    
        parent::__construct('image', $name, $value, $attributes, $options);
        $this->setRenderer(new SWL_View_Renderer_Form_Image($this));
    }
    
}

