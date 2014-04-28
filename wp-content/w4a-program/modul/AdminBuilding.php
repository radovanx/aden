<?php

class AdminBuilding {
    
    public function __construct(){
        add_action('load-post.php', array(&$this, 'meta_boxes_setup'));
        add_action('load-post-new.php', array(&$this, 'meta_boxes_setup'));

        //add_filter('manage_boy_posts_columns', array(&$this, 'column_head'));
        //add_action('manage_boy_posts_custom_column', array(&$this, 'column_content'), 10, 2);        
        
        //add_action('save_post', array($this, 'save'));        
    }    
    
    /**
     *
     */
    public function meta_boxes_setup() {
        add_action('add_meta_boxes', array($this, 'custom_boxes'));
    }
    
    /**
     *
     */
    public function custom_boxes() {
        add_meta_box(
                'campaigne_logo', __('Charity', 'campaign'), array($this, 'campaign_logo_box'), 'campaign_item', 'side'
        );
    }    
}

$adminBuilding = new AdminBuilding();