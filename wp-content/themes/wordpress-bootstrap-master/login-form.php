<?php
/*
  If you would like to edit this file, copy it to your current theme's directory and edit it there.
  Theme My Login will always look in your theme's directory first, before using this default template.
 */
?> 
<div class="row clearfix"> 
    <div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
        <div class="col-md-6 column">	
            <div class="bg-danger text-danger"><?php $template->the_errors(); ?></div>
            <form name="loginform" class="contact_form_block border background clearfix col-md-12" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('login'); ?>" method="post">

                <h2 class="border-left uppercase "><?php _e('Log in', 'wpbootstrap') ?></h2>

                <h2><?php $template->the_action_template_message('login'); ?></h2>
                <div class="col-md-12 column">	

                    <div class="form-group">
                        <label for="user_login<?php $template->the_instance(); ?>"><?php _e('Email'); ?></label>
                        <input type="text" name="log" class="form-control input-lg" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('log'); ?>" size="20" />
                    </div>
                    <div class="form-group">
                        <label for="user_pass<?php $template->the_instance(); ?>"><?php _e('Password'); ?></label>
                        <input type="password" name="pwd" class="form-control input-lg" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" />
                    </div> 
                    <?php do_action('login_form'); ?> 
                    <div class="form-group col-md-6">
                        <input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
                        <label for="rememberme<?php $template->the_instance(); ?>" class="input-lg"><?php esc_attr_e('Remember Me'); ?></label>
                    </div>
                    <div class="form-group col-md-6">
                            <div class="col-md-12 column">	
                                <input type="submit" name="wp-submit" class="pull-right btn btn-primary btn-lg" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e('Log In'); ?>" />
                                <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('login'); ?>" />
                                <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
                                <input type="hidden" name="action" value="login" />
                            </div>
                    </div>
                     <div class="form-group col-md-12">
                       <?php $template->the_action_links(array('login' => false)); ?>
                    </div>
                </div> 
            </form>
        </div>    

    </div>
</div>
