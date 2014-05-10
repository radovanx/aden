<?php
/*
 * Template Name: User preferences
 */
?>
<?php get_header(); ?>
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
                                <tbody>
                                    <?php
                                    $lang = qtrans_getLanguage();
                                    $flat_props = EstateProgram::user_preferences($lang)
                                    ?>
                                    <?php
                                    $i = 0;
                                    if (!empty($flat_props)):
                                        foreach ($flat_props as $key => $val):
                                            $prop = unserialize($val->prop);
                                            ?>
                                            <tr>
                                                <td>   
                                                    <a class="add-to-preference" data-toggle="modal"  data-flat_id="<?php echo $val->ID ?>" href="#myModal"><i class="fa fa-star-o <?php echo EstateProgram::is_user_favorite($val->ID) ? 'red' : 'blue' ?>"></i></a>
                                                </td>
                                                <td>
                                                    <?php echo esc_attr($prop['anbieternr']) ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo get_permalink($val->ID); ?>" class="blue"><?php echo esc_attr($prop['geo|strasse']) ?>, <?php echo esc_attr($prop['geo|ort']) ?>,  <?php echo esc_attr($prop['geo|plz']) ?> </a>
                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>

                                                <td>
                                                    <?php echo esc_attr($prop['geo|etage']) ?>          
                                                </td>
                                                <td>
                                                    <?php echo (int) $prop['flaechen|anzahl_zimmer'] ?>
                                                </td>
                                                <td>
                                                    <?php echo esc_attr($prop['flaechen|wohnflaeche']) ?>
                                                </td>
                                                <td>
                                                    <?php echo esc_attr($prop['preise|kaufpreis']) ?>
                                                </td>

                                                <td>
                                                    <?php echo esc_attr($prop['preise|kaufpreis_pro_qm']) ?>
                                                </td>

                                                <td>

                                                </td>

                                                <td>

                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
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
<?php get_footer(); ?>