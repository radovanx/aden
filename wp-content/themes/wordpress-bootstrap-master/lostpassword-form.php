<?php
/*
  If you would like to edit this file, copy it to your current theme's directory and edit it there.
  Theme My Login will always look in your theme's directory first, before using this default template.
 */
?>

<div class="login row clearfix" id="theme-my-login<?php $template->the_instance(); ?>">

    <div class="col-md-7 column">	  
        <?php $template->the_action_template_message('lostpassword'); ?>
        <div class="bg-danger text-danger"><?php $template->the_errors(); ?></div>
        <form name="lostpasswordform" class="border background clearfix col-md-12" id="lostpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('lostpassword'); ?>" method="post">
            <h2 class="border-left uppercase "><?php _e('Lost Password', 'wpbootstrap') ?></h2>
            <div class="col-md-12 column">


                <div class="form-group">
                    <label for="user_login<?php $template->the_instance(); ?>"><?php _e('Username or E-mail:'); ?></label>
                    <input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="form-control input input-lg" value="<?php $template->the_posted_value('user_login'); ?>" size="20" />
                </div>

                <?php do_action('lostpassword_form'); ?>
                <div class="form-group">
                    <p class="submit">
                        <input type="submit" name="wp-submit" class="pull-right btn btn-primary btn-lg" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e('Get New Password'); ?>" />
                        <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('lostpassword'); ?>" />
                        <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
                        <input type="hidden" name="action" value="lostpassword" />
                    </p>
                </div>
            </div>   
        </form>
        <?php $template->the_action_links(array('lostpassword' => false)); ?>
    </div>
</div>


