<?php
get_header();
$post_per_page = 4;
$args = array(
    'show' => 'homepage',
    'post_type' => 'program',
    'post_status' => 'publish',
    'posts_per_page' => $post_per_page
);
$query = new WP_Query($args);
?>
<script type="text/javascript">
    var total_item = <?php echo $query->found_posts ?>;
    // pocatecni offset
    var count = <?php echo (int) $post_per_page ?>; 
    var active_load = 0; 
    var load_next_item = true;
    // pocet polozek, ktere vrati ajax
    var ajax_ppp = 2; 
    var translate_lang = "<?php echo qtrans_getLanguage(); ?>"; 
      function loadArticle(offset) {
        jQuery.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: 'POST',
            dataType: 'json',
            data: "action=item_pagination&offset=" + offset + "&part=project_frontpage&ppp=" + ajax_ppp + '&lang=' + translate_lang + '&show=homepage',
            beforeSend: function() {
                active_load++;
                jQuery('#next-ajax-loading').removeClass('no-visible');
                load_next_item = false;
            },
            success: function(ret) {
                jQuery("#project-list").append(ret.content);
            },
            complete: function(ret) {
                load_next_item = true;
                active_load--;
                if (active_load < 1) {
                    jQuery("#next-ajax-loading").addClass('no-visible');
                }
            }
        });
        return false;
    } 
    jQuery(document).ready(function() {
        jQuery(window).scroll(function() {
            if (count >= (total_item)) {
                return;
            }
            if (load_next_item && (jQuery(window).scrollTop() >= jQuery(document).height() - (jQuery(window).height() + 200))) {
                loadArticle(count);
                count += ajax_ppp;
            }
        });
    });    
</script>
<div class="visible-lg">
    <?php echo do_shortcode('[image-carousel interval="12000"]') ?>
</div>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <h1 class="primary border-right"><?php _e("Top projects", "wpbootstrap"); ?></h1>
        </div>
        <div class="col-md-9 column">
            <div id="project-list" class="row">
                <div class="col-md-12 column">
                    <div class="row">
                        <?php
                        $i = 0;
                        if ($query->have_posts()) {
                            $i++;
                            while ($query->have_posts()) : $query->the_post();
                                //get_template_part('partial', 'project_frontpage');
                                include get_template_directory() . '/partial-project_frontpage.php';
                            endwhile;
                        }
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>
            <!-- ajax loader -->
            <div id="next-ajax-loading" class="text-center no-visible row">
                <img src="<?php echo get_template_directory_uri() ?>/images/ajax-loader.gif">
            </div>
            <!-- /ajax loader -->
        </div>
        <div class="save col-md-3 column border background contact_form_block background-image-en">
            <h3>
                <?php $currentLang = qtrans_getLanguage(); ?> 
                <a href="<?php bloginfo('template_url'); ?>/images/GuideinvestisseurBERLINgd_fr.pdf"> 
                    <?php _e("Guide", "wpbootstrap"); ?></br>
                    <?php _e("investissement", "wpbootstrap"); ?></br>
                    <?php _e("Berlin", "wpbootstrap"); ?></br>
                </a>
            </h3>
            <div class="form-group">
                <?php 
                if (is_user_logged_in()): 
                //if(1):
                ?>
                    <a class="btn btn-lg bold btn-primary btn-block btn-upper" href="<?php bloginfo('template_url'); ?>/images/GuideinvestisseurBERLINgd_fr.pdf">
                    <?php else: ?>
                        <a class="btn btn-lg bold btn-primary btn-block btn-upper" href="<?php echo get_permalink(10566) ?>">
                        <?php endif; ?>
                        <?php _e("download for free", "wpbootstrap"); ?>
                    </a>
            </div>
        </div>
        <div class="col-md-3 column">
            <div class="row">
                <div class="col-md-12 column border background contact_form_block">
                    <h2 class="border-left uppercase"><?php _e("Contact us", "wpbootstrap"); ?></h2> 
                    <?php
                    $lang = qtrans_getLanguage(); 
                    switch ($lang) {
                        case 'en':
                            echo do_shortcode('[contact-form-7 id="1728" title=""]');
                            break;
                        case 'de':
                            echo do_shortcode('[contact-form-7 id="10261" title=""]');
                            break;
                        case 'fr':
                            echo do_shortcode('[contact-form-7 id="10265" title=""]');
                            break;
                    }
                    ?> 
                </div>
                <div class="col-md-12 column border newsletter-background contact_form_block">
                    <h2 class="border-left"><?php _e("NEWSLETTER", "wpbootstrap"); ?></h2>
                    <!-- Begin MailChimp Signup Form -->
                    <div id="mc_embed_signup">
                        <form action="http://aden-immo.us3.list-manage.com/subscribe/post?u=17d843b86bdd3339c6dbc1da5&amp;id=49b2f803a7" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div class="form-group"> 
                                <input type="email" value="" name="EMAIL" class="pull-left required email form-control input-lg" id="mce-EMAIL" placeholder="<?php _e('Insert your email', 'wpbootstrap') ?>">
                                <input type="submit" value="<?php _e('OK', 'wpbootstrap') ?>" name="subscribe" id="mc-embedded-subscribe" class="button pull-left btn-primary"> 
                                <div class="clearfix"></div>
                            </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;"><input type="text" name="b_17d843b86bdd3339c6dbc1da5_49b2f803a7" tabindex="-1" value=""></div>
                        </form>
                    </div>
                    <!--End mc_embed_signup--> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>