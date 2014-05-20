<?php
/*
 * Template Name: User preferences
 */
?>
<?php
redirect_if_not_logged();
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

                        <!-- reference list -->

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?php _e("Favorite", "wpbootstrap"); ?></th>
                                    <th><?php _e("Prg ref", "wpbootstrap"); ?></th>
                                    <th><?php _e("Address", "wpbootstrap"); ?></th>
                                    <th><?php _e("Flat n°", "wpbootstrap"); ?></th>
                                    <th><?php _e("Rental status", "wpbootstrap"); ?></th>
                                    <th><?php _e("Floor", "wpbootstrap"); ?></th>
                                    <th><?php _e("Rooms", "wpbootstrap"); ?></th>
                                    <th><?php _e("Surface", "wpbootstrap"); ?></th>
                                    <th><?php _e("Price", "wpbootstrap"); ?></th>
                                    <th><?php _e("Price/m²", "wpbootstrap"); ?></th>
                                    <th><?php _e("Yield", "wpbootstrap"); ?></th>
                                    <th><?php _e("Status", "wpbootstrap"); ?></th>
                                </tr>
                            </thead>
                             <?php
                                $lang = qtrans_getLanguage();
                                $flat_props = EstateProgram::user_preferences($lang)
                                ?>
                              <?php  include TEMPLATEPATH . '/table_row.php'; ?> 
                        </table>

                        <!-- /reference list -->

                        <footer>
                            <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags", "wpbootstrap") . ':</span> ', ', ', '</p>'); ?>
                        </footer> <!-- end article footer -->

                    </article> <!-- end article -->

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
<div class="modal fade" id="removePreferenceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 class="modal-title"><?php echo the_title(); ?></h4>-->
            </div>
            <div class="modal-body"> 
                <?php _e("Do you really want to remove this preference?", "wpbootstrap"); ?> 
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Ok", "wpbootstrap"); ?></button>-->
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete"><?php _e('Yes', 'wpbootstrap') ?></button>
                    <button type="button" data-dismiss="modal" class="btn"><?php _e('No', 'wpbootstrap') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php get_footer(); ?>