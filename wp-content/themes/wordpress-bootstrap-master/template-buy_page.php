<?php
/**
 * Template Name: Buy page
 */
get_header();
?>
<div class="container">
    <div id="content" class="clearfix row">

        <div id="main" class="col-sm-12 clearfix" role="main">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                        <header>

                            <div class="page-header"><h1 class="page-title border-left" itemprop="headline"><?php the_title(); ?></h1></div>

                        </header> <!-- end article header -->

                        <section class="post_content clearfix" itemprop="articleBody">
                            <?php the_content(); ?>

                        </section> <!-- end article section -->

                        <footer>

                            <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags", "wpbootstrap") . ':</span> ', ', ', '</p>'); ?>

                        </footer> <!-- end article footer -->

                    </article> <!-- end article -->


                    <div class="border col-md-12 column border background contact_form_block">
                        <h2 class="border-left uppercase"><?php _e('Contact Form', 'wpbootstrap') ?></h2>
                        <span class="phone red bold"><i class="fa fa-phone"></i> +33 0632140564</span>
                        <?php echo do_shortcode('[contact-form-7 id="4082" title="Buy page form - en"]') ?>
                    </div>


                <?php endwhile; ?>

            <?php else : ?>

                <article id="post-not-found">
                    <header>
                        <h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
                    </header>
                    <section class="post_content">
                        <p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
                    </section>
                    <footer>
                    </footer>
                </article>

            <?php endif; ?>

        </div> <!-- end #main -->


    </div> <!-- end #content -->
</div>
<?php get_footer(); ?>