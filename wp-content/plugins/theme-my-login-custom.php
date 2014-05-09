<?php
/**
 * Validace inputu z registrace
 * 
 * @param type $errors
 * @return type
 */
function tml_registration_errors($errors) {

    if (isset($_POST['action']) && 'register' == $_POST['action']) {
        
        if(empty($_POST['title'])){
            $errors->add('title', '<strong>Error:</strong> Please enter your title.');
        }
        
        if(empty($_POST['first_name'])){
            $errors->add('first_name', '<strong>Error:</strong> Please enter your first name.');
        }
        
        if(empty($_POST['last_name'])){
            $errors->add('last_name', '<strong>Error:</strong> Please enter your last name.');
        }
        
        if(empty($_POST['company'])){
            $errors->add('company', '<strong>Error:</strong> Please, enter company.');
        }        
        
        if(empty($_POST['phone'])){
            $errors->add('phone', '<strong>Error:</strong> Please, enter phone.');
        }
        
        if(empty($_POST['address'])){
            $errors->add('address', '<strong>Error:</strong> Please, enter address.');
        }        
        
        if(empty($_POST['country'])){
            $errors->add('country', '<strong>Error:</strong> Please, enter country.');
        }        
    }
    return $errors;
}

add_filter('registration_errors', 'tml_registration_errors');

/**
 * Uložení inputů z registrace
 *
 * @global type $wpdb
 * @param type $user_id
 */
function tml_user_register($user_id) {

    global $wpdb;

    $user_data = array();

    if (!empty($_POST['first_name'])) {
        $user_data['first_name'] = htmlspecialchars($_POST['first_name']);
    }

    if (!empty($_POST['last_name'])) {
        $user_data['last_name'] = htmlspecialchars($_POST['last_name']);
    }

    if (!empty($user_data)) {
        $user_data['ID'] = $user_id;
        wp_update_user($user_data);
    }

    update_user_meta($user_id, 'title', $_POST['title']);
    update_user_meta($user_id, 'company', $_POST['company']);
    update_user_meta($user_id, 'phone', $_POST['phone']);
    update_user_meta($user_id, 'address', $_POST['address']);
    update_user_meta($user_id, 'city', $_POST['city']);
    update_user_meta($user_id, 'country', $_POST['country']);
    
    
    // prihlaseni uzivatele po registraci
    //$creds = array();
    //$creds['user_login'] = $_POST['user_email'];
    //$creds['user_password'] = esc_sql($_POST['pass1']);
    //$creds['remember'] = true;    
    
    // $user = wp_signon($creds, false);
    
    if (is_wp_error($user)){
        
    }
}

add_action('user_register', 'tml_user_register');
?>