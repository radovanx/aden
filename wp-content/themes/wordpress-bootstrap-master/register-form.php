<?php
/*
  If you would like to edit this file, copy it to your current theme's directory and edit it there.
  Theme My Login will always look in your theme's directory first, before using this default template.
 */
?>
<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
    <?php $template->the_action_template_message('register'); ?>
    <?php $template->the_errors(); ?>
    <form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('register'); ?>" method="post">
        <p>
            <label for="user_login<?php $template->the_instance(); ?>"><?php _e('Username', 'wpbootstrap'); ?></label>
            <input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('user_login'); ?>" size="20">
        </p>

        <!--
        <p>
            <label for="user_email<?php $template->the_instance(); ?>"><?php _e('E-mail'); ?></label>
            <input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('user_email'); ?>" size="20" />
        </p>-->

        xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

        <p>
            <label for="title<?php $template->the_instance(); ?>"><?php _e('Title:', 'wpbootstrap'); ?></label>
            <input type="text" name="title" id="title<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('title'); ?>" size="20">
        </p>

        <p>
            <label for="first_name<?php $template->the_instance(); ?>"><?php _e('First name:', 'wpbootstrap'); ?></label>
            <input type="text" name="first_name" id="first_name<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('first_name'); ?>" size="20">
        </p>

        <p>
            <label for="last_name<?php $template->the_instance(); ?>"><?php _e('Last name:', 'wpbootstrap'); ?></label>
            <input type="text" name="last_name" id="last_name<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('last_name'); ?>" size="20">
        </p>

        <p>
            <label for="user_email<?php $template->the_instance(); ?>"><?php _e('E-mail:', 'wpbootsrap'); ?></label>
            <input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('user_email'); ?>" size="20">
        </p>

        <h2><?php _e('Company', 'wpbootstrap') ?></h2>
        <p>
            <label for="company<?php $template->the_instance(); ?>"><?php _e('Company:', 'wpbootsrap'); ?></label>
            <input type="text" name="company" id="company<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('company'); ?>" size="20">
        </p>

        <p>
            <label for="phone<?php $template->the_instance(); ?>"><?php _e('Phone:', 'wpbootsrap'); ?></label>
            <input type="text" name="phone" id="phone<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('phone'); ?>" size="20">
        </p>

        <p>
            <label for="address<?php $template->the_instance(); ?>"><?php _e('Address:', 'wpbootsrap'); ?></label>
            <input type="text" name="address" id="address<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('address'); ?>" size="20">
        </p>

        <p>
            <label for="city<?php $template->the_instance(); ?>"><?php _e('City:', 'wpbootsrap'); ?></label>
            <input type="text" name="city" id="city<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('city'); ?>" size="20">
        </p>

        <p>
            <label for="country<?php $template->the_instance(); ?>"><?php _e('Country:', 'wpbootsrap'); ?></label>
            <input type="text" name="country" id="country<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('country'); ?>" size="20">
        </p>

        <?php do_action('register_form'); ?>

        <p id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters('tml_register_passmail_template_message', __('A password will be e-mailed to you.')); ?></p>

        <p class="submit">
            <input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e('Register'); ?>" />
            <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('register'); ?>" />
            <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
            <input type="hidden" name="action" value="register" />
        </p>
    </form>
    <?php $template->the_action_links(array('register' => false)); ?>
</div>
