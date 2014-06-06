<?php
/*
  Template Name: About Us Page
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
<?php endif; ?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-8 column">
            <div class="border col-md-12 column border background contact_form_block">
                <h2 class="border-left uppercase"><?php _e('Contact Form', 'wpbootstrap') ?></h2>
                <span class="phone red bold"><i class="fa fa-phone"></i><?php _e('+33 0632140564', 'wpbootstrap') ?> </span> 
                <?php $lang = qtrans_getLanguage();  
                switch($lang){                
                    case 'en':                    
                        echo do_shortcode('[contact-form-7 id="4717" title=""]'); 
                        break;
                    case 'de':                    
                        echo do_shortcode('[contact-form-7 id="10258" title=""]'); 
                        break;
                    case 'fr':                    
                        echo do_shortcode('[contact-form-7 id="10257" title=""]'); 
                        break;
                }
                ?>
            </div>
        </div>
        <div class="col-md-4 column">
            <h3 class="border-left"><?php _e('CONTACT INFORMATIONS', 'wpbootstrap') ?></h3>
            <address> <strong><?php _e('Twitter, Inc.', 'wpbootstrap') ?></strong><br /><?php _e('795 Folsom Ave, Suite 600', 'wpbootstrap') ?> <br /><?php _e('San Francisco, CA 94107', 'wpbootstrap') ?><br /> <abbr title="Phone">P:</abbr><?php _e('(123) 456-7890', 'wpbootstrap') ?> </address>
        </div>
    </div>
</div>
<?php get_footer(); ?>