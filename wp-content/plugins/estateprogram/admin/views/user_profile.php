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
