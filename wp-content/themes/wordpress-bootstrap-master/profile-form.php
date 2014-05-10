<?php
/*
  If you would like to edit this file, copy it to your current theme's directory and edit it there.
  Theme My Login will always look in your theme's directory first, before using this default template.
 */
?>


<div class="login profile row" id="theme-my-login<?php $template->the_instance(); ?>">
    <div class="col-md-12 column">
        <?php $template->the_action_template_message('profile'); ?>
        <?php $template->the_errors(); ?>
        <form id="your-profile" class="border background clearfix" action="<?php $template->the_action_url('profile'); ?>" method="post">
            <?php wp_nonce_field('update-user_' . $current_user->ID); ?>
            <input type="hidden" name="from" value="profile" />
            <input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
            <?php wp_nonce_field('update_custom_profile', 'update_custom_profile'); ?>

            <?php /* if (has_action('personal_options')) : ?>

              <h3><?php _e('Personal Options'); ?></h3>

              <table class="form-table">
              <?php do_action('personal_options', $profileuser); ?>
              </table>

              <?php endif; */ ?>

            <?php do_action('profile_personal_options', $profileuser); ?>

            <div class="col-md-6 column">

                <label for="title"><?php _e('Title', 'wpbootstrap'); ?></label>
                <input type="text" name="title" id="title" value="<?php echo esc_attr(get_user_meta($profileuser->ID, 'title', true)) ?>" class="form-control input-lg">

                <label for="first_name"><?php _e('First Name', 'wpbootstrap'); ?></label>
                <input type="text" name="first_name" id="first_name" value="<?php echo esc_attr($profileuser->first_name); ?>" class="form-control input-lg">

                <label for="last_name"><?php _e('Last Name', 'wpbootstrap'); ?></label>
                <input type="text" name="last_name" id="last_name" value="<?php echo esc_attr($profileuser->last_name); ?>" class="form-control input-lg">

                <label for="email"><?php _e('E-mail', 'wpbootstrap'); ?> <span class="description"><?php _e('(required)'); ?></span></label>
                <input type="text" name="email" id="email" value="<?php echo esc_attr($profileuser->user_email); ?>" class="form-control input-lg">

                <h3><?php _e('New password', 'wpbootstrap'); ?></h3>

                <?php
                $show_password_fields = apply_filters('show_password_fields', true, $profileuser);
                if ($show_password_fields) :
                    ?>
                    <label for="pass1"><?php _e('New Password', 'wpbootstrap'); ?></label>
                    <input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" class="form-control input-lg"> <span class="description"><?php _e('If you would like to change the password type a new one. Otherwise leave this blank.'); ?></span><br />
                    <input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" class="form-control input-lg"> <span class="description"><?php _e('Type your new password again.'); ?></span><br />
                    <div id="pass-strength-result"><?php _e('Strength indicator', 'wpbootstrap'); ?>
                    </div>
                    <p class="description indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', 'wpbootstrap'); ?></p>

                <?php endif; ?>                

            </div>

            <div class="col-md-6 column">
                <!--<h3><?php _e('Company', 'wpbootstrap'); ?></h3>-->

                <label for="company"><?php _e('Company', 'wpbootstrap'); ?></label>
                <input type="text" name="company" id="company" value="<?php echo esc_attr(get_user_meta($profileuser->ID, 'company', true)) ?>" class="form-control input-lg">

                <label for="phone"><?php _e('Phone', 'wpbootstrap'); ?></label>
                <input type="text" name="phone" id="phone" value="<?php echo esc_attr(get_user_meta($profileuser->ID, 'phone', true)) ?>" class="form-control input-lg">

                <label for="address"><?php _e('Address', 'wpbootstrap'); ?></label>
                <input type="text" name="address" id="address" value="<?php echo esc_attr(get_user_meta($profileuser->ID, 'address', true)) ?>" class="form-control input-lg">

                <label for="city"><?php _e('City', 'wpbootstrap'); ?></label>
                <input type="text" name="city" id="city" value="<?php echo esc_attr(get_user_meta($profileuser->ID, 'city', true)) ?>" class="form-control input-lg">

                <label for="country"><?php _e('Country', 'wpbootstrap'); ?></label>
                <input type="text" name="country" id="country" value="<?php echo esc_attr(get_user_meta($profileuser->ID, 'country', true)) ?>" class="form-control input-lg" />
            </div>



            <?php do_action('show_user_profile', $profileuser); ?>

            
            <div class="col-md-12 column form-group">
                <p class="submit">
                    <input type="hidden" name="action" value="profile" />
                    <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>" />
                    <input type="submit" class="pull-right btn btn-primary btn-lg" value="<?php esc_attr_e('Update Profile'); ?>" name="submit" />
                </p>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
