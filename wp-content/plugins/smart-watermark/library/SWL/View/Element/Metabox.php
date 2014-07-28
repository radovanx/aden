<?php
/**
 * <kbd>SWL_View_Element_Metabox</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element
 * @package     SWL_View_Element_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Container.php';

/**
 * Metabox container class
 *
 * @category    SWL_View_Element
 * @package     SWL_View_Element_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Metabox extends SWL_View_Element_Container {
    
    protected $id;
    
    protected $title;
    
    protected $type;
    
    protected $context = 'advanced';
    
    protected $priority = 'default';
    
    public function __construct($id, $title = 'Metabox', $attributes = array()) {
        parent::__construct('metabox', $attributes);
        $this->id           = $id;
        $this->title        = $title;
        $this->type         = isset($attributes['type'])?$attributes['type']:$this->id;
        if (isset($attributes['context'])) $this->context = $attributes['context'];
        if (isset($attributes['priority'])) $this->priority = $attributes['priority'];
    }
    
    public function init() {
        add_meta_box(  
                    $this->id, 
                    $this->title, 
                    array($this, 'getMetaboxContent'),
                    $this->type, 
                    $this->context,
                    $this->priority
                );          
    }
    
    public function buildMetabox($post) {
        
    }
    
    public function getMetaboxContent($post) {
        $this->buildMetabox($post);
        echo $this->renderer->render();
    }      
    
}