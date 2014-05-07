<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EstateProgramAjax {
    
    public function __construct() {
        add_action('wp_ajax_add_to_preference', array(&$this, 'add_to_preference'));
        add_action('wp_ajax_nopriv_add_to_preference', array(&$this, 'add_to_preference'));
    }
    
    
    public function add_to_preference(){
        
        if(!is_user_logged_in()){
            header("HTTP/1.0 404 Not Found");
            echo 'Prosím zvolte "Platnost od"';
            die();            
        }
        
        global $wpdb;
        
        $flat_id = $_POST['flat'];
        $user_id = get_current_user_id();
        
        // current preference
        $sql = "
            REPLACE INTO 
                user_preference (flat_id, user_id, date_add)
            VALUES(
                '" . (int) $flat_id . "',
                '" . (int) $user_id . "',
                'NOW()'    
            )";
        
        $wpdb->query($sql);
        
        // update history
        $sql = "
            INSERT INTO 
                user_preference_history (user_id, flat_id, date_change, operation)
            VALUES(
                '" . (int) $user_id . "',
                '" . (int) $flat_id . "',                
                'NOW()',
                '1'
            )";
        
        $wpdb->query($sql);        
    }
    
}

