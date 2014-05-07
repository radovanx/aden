<?php
/*
  If you would like to edit this file, copy it to your current theme's directory and edit it there.
  Theme My Login will always look in your theme's directory first, before using this default template.
 */


// id hlavni stranky profilu
$profile_page_id = '1716';

$args = array(
    'post_parent' => $profile_page_id,
    //'post_type' => 'page',
    //'post_status' => 'publish'
);
$children_pages = get_children($args);

if (!empty($children_pages)):
    ?>
    <ul class="profile-menu">
        <li>
            <a href="<?php echo get_permalink($profile_page_id) ?>"><?php echo get_the_title($profile_page_id) ?></a>
        </li>
        <?php foreach ($children_pages as $page): ?>
            <li>
                <a href="<?php echo get_permalink($page->ID) ?>"><?php echo get_the_title($page->ID) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="login profile" id="theme-my-login<?php $template->the_instance(); ?>">
    <?php $template->the_action_template_message('profile'); ?>
    <?php $template->the_errors(); ?>
    <form id="your-profile" action="<?php $template->the_action_url('profile'); ?>" method="post">
        <?php wp_nonce_field('update-user_' . $current_user->ID); ?>
        <p>
            <input type="hidden" name="from" value="profile" />
            <input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
        </p>

        <?php if (has_action('personal_options')) : ?>

            <h3><?php _e('Personal Options'); ?></h3>

            <table class="form-table">
                <?php do_action('personal_options', $profileuser); ?>
            </table>

        <?php endif; ?>

        <?php do_action('profile_personal_options', $profileuser); ?>

        <h3><?php _e('Name'); ?></h3>

        <table class="form-table">

            <tr>
                <th><label for="first_name"><?php _e('First Name'); ?></label></th>
                <td><input type="text" name="first_name" id="first_name" value="<?php echo esc_attr($profileuser->first_name); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="last_name"><?php _e('Last Name'); ?></label></th>
                <td><input type="text" name="last_name" id="last_name" value="<?php echo esc_attr($profileuser->last_name); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="email"><?php _e('E-mail'); ?> <span class="description"><?php _e('(required)'); ?></span></label></th>
                <td><input type="text" name="email" id="email" value="<?php echo esc_attr($profileuser->user_email); ?>" class="regular-text" /></td>
            </tr>
        </table>


        <h3><?php _e('New password'); ?></h3>
        <table class="form-table">

            <?php
            $show_password_fields = apply_filters('show_password_fields', true, $profileuser);
            if ($show_password_fields) :
                ?>
                <tr id="password">
                    <th><label for="pass1"><?php _e('New Password'); ?></label></th>
                    <td><input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" /> <span class="description"><?php _e('If you would like to change the password type a new one. Otherwise leave this blank.'); ?></span><br />
                        <input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" /> <span class="description"><?php _e('Type your new password again.'); ?></span><br />
                        <div id="pass-strength-result"><?php _e('Strength indicator', 'theme-my-login'); ?></div>
                        <p class="description indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).'); ?></p>
                    </td>
                </tr>
            <?php endif; ?>
        </table>

        <?php do_action('show_user_profile', $profileuser); ?>

        <p class="submit">
            <input type="hidden" name="action" value="profile" />
            <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
            <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>" />
            <input type="submit" class="button-primary" value="<?php esc_attr_e('Update Profile'); ?>" name="submit" />
        </p>
    </form>
</div>
