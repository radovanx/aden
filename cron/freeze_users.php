<?php

define('WP_USE_THEMES', false);
require('../wp-load.php');

global $wpdb;

// uživatelé, kteří se nepřihlásili déle než tři měsíce
$sql = "
    SELECT
        user_id
    FROM
        $wpdb->users AS u
    JOIN
        last_login AS ll
    ON
        ll.user_id = u.ID
    WHERE
        ll.login_date <= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)        
";

$results = $wpdb->get_col($sql);


if (!empty($results)) {
    foreach ($results as $r) {
        $args = array(
            'ID' => $r,
            'role' => 'frozen'
        );
        wp_update_user($args);
    }
}


// uživatelé kteří nebyli do 14 dní schváleni
$user_query = new WP_User_Query(array('role' => 'waiting_for_approval'));

if (!empty($user_query->results)) {
    foreach ($user_query->results as $user) {

        $user_data = $user->data;

        $register_date = DateTime::createFromFormat('Y-m-d H:i:s', $user_data->user_registered);

        $valid_to = clone $register_date;
        $valid_to->modify("+15 day");

        $now = new DateTime();

        if ($now > $valid_to) {
            //$user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: We are really sorry, your account has not been approved.', $plugin_slug));
            $args = array(
                'ID' => $user->ID,
                'role' => 'frozen'
            );
            wp_update_user($args);
        }
    }
}

mail('ales@web-4-all.cz', 'immomedia.com freeze_users.php', 'running');