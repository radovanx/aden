<?php

define('WP_USE_THEMES', false);
require('../wp-load.php');

$custom_email = Theme_My_Login_Custom_Email::get_object();




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


// uživatelé kteří nebyli do 15 dní schváleni
$user_query = new WP_User_Query(array('role' => 'waiting_for_approval'));

if (!empty($user_query->results)) {
    foreach ($user_query->results as $user) {

        $user_data = $user->data;

        $register_date = DateTime::createFromFormat('Y-m-d H:i:s', $user_data->user_registered);

        $valid_to = clone $register_date;
        $valid_to->modify("+15 day");

        $now = new DateTime();

        if ($now > $valid_to) {
            // freeze user
            $args = array(
                'ID' => $user->ID,
                'role' => 'frozen'
            );
            wp_update_user($args);
        }

        // poslu email 7 dni pred zmrazenim
        $send_email_time = clone $register_date;
        $send_email_time->modify("+7 day");

        if ($now > $send_email_time) {
            // send email
            $already_sent = get_user_meta($user->ID, 'freeze_email', true);

            if (1 != $already_sent) {
                if (false !== $custom_email->frozen_user_notification($user->ID)) {
                    update_user_meta($user->ID, 'freeze_email', 1);
                }
            }
        }
    }
}

mail('ales@web-4-all.cz', 'immomedia.com freeze_users.php', 'running');
