<?php
$vals = array(
    'company' => __('Company', $this->plugin_slug),
    'phone' => __('Phone', $this->plugin_slug),
    'address' => __('Address', $this->plugin_slug),
    'city' => __('City', $this->plugin_slug),
    'country' => __('Country', $this->plugin_slug),
);
?>

<table class="form-table">
    <tr>
        <th>
            Register date
        </th>
        <td>
            <?php
            $user_data = get_userdata($user->ID);
            $register_date = DateTime::createFromFormat('Y-m-d H:i:s', $user_data->user_registered);
            ?>
            <?php echo false != $register_date ? $register_date->format('j. n. Y H:i') : '' ?>
        </td>
    </tr>    
    <tr>
        <th>
            Last login
        </th>
        <td>
            <?php
            global $wpdb;
            $sql = "SELECT DATE_FORMAT(login_date, '%e. %c. %Y %H:%i') FROM last_login WHERE user_id = ".  $user->ID;
            echo $wpdb->get_var($sql);            
            ?>            
        </td>
    </tr>     
    <tr>
        <th>
            <label for="user_title"><?php _e('User title', $this->plugin_slug) ?></label>
        </th>
        <td>
            <input type="text" id="user_title" name="title" value="<?php echo esc_attr(get_user_meta($user->ID, 'title', true)) ?>">
        </td>
    </tr>
</table>

<h3><?php _e('Company', $this->plugin_slug) ?></h3>
<table class="form-table">
    <?php
    foreach ($vals as $key => $val):
        ?>
        <tr>
            <th>
                <label for="<?php echo $key ?>"><?php echo $val ?></label>
            </th>
            <td>
                <input type="text" id="<?php echo $key ?>" name="<?php echo $key ?>" value="<?php echo esc_attr(get_user_meta($user->ID, $key, true)) ?>">
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
wp_nonce_field(__FILE__, 'user_profile_nonce');
