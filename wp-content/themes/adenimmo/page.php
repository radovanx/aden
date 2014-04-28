<?php get_header(); ?>

    <div id="content">
        <div class="clearfix row">
            <div id="main" class="col-md-12 clearfix" role="main">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                            <h1><?php the_title() ?></h1>
                            <?php the_content(); ?>
                        </article> <!-- end article -->
                    <?php endwhile; ?>
                <?php else : ?>
                    <article id="post-not-found">
                        <h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
                        <p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
                    </article>
                <?php endif; ?>
            </div> <!-- end #main -->

        </div>
    </div>

<?php get_footer(); ?>