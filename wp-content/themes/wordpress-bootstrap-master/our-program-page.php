<?php
/*
  Template Name: Our program Page
 */
?>
<?php
redirect_if_cannot_see_detail();
get_header();
?> 
<div class="container">
    <div class="row clearfix"> 
        <div class="col-md-12 column"> 
            <header> 
                <div class="page-header"><h1 class="page-title border-left" itemprop="headline"><?php the_title(); ?></h1></div>				
            </header> <!-- end article header -->    
        </div> 
        <?php
        $args = array(
            'post_type' => 'program',
            'post_status' => 'publish',
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="col-md-4 column">
                    <div class="thumbnail">
                        <a class="" href="<?php the_permalink(); ?>"> 
                            <?php the_post_thumbnail('property-list-thumb'); ?>
                            <!--<img src="<?php echo get_template_directory_uri() ?>/images/choriner-hoefe_src_1.-w316-h0-p0-F-S1.jpg"/>-->
                        </a>
                        <div class="panel-body">
                            <h4 class="blue"><?php the_title() ?></h4>
                        </div> 
                        <div class="panel-body">  
                            <span class="propertyListBoxDataItemName">
                                <i class="fa fa-home"></i><strong><?php _e("Type of property:", "wpbootstrap"); ?></strong><span class="pull-right">    </span></span>                      
                            <span class="propertyListBoxDataItemName">
                                <i class="fa fa-map-marker"></i><strong><?php _e("Address:", "wpbootstrap"); ?></strong>
                                <span class="pull-right">
                                    <?php echo esc_attr(get_post_meta($post->ID, '_program_street', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_house_number', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_region', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_city', true)); ?></span></span>
                            <span class="propertyListBoxDataItemName">
                                <i class="fa fa-arrows-alt"></i><strong><?php _e("Size range:", "wpbootstrap"); ?></strong> <span class="pull-right"><?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)); ?> m² - <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)); ?> m²</span></span>
                            <span class="propertyListBoxDataItemName">
                                <i class="fa fa-money"></i><strong><?php _e("Price range:", "wpbootstrap"); ?></strong><strong class="red pull-right"><?php echo esc_attr(price_format(get_post_meta($post->ID, '_program_price_from', true))) ?> &euro; -  <?php echo esc_attr(price_format(get_post_meta($post->ID, '_program_price_to', true))) ?> &euro;</strong></span>
                        </div>
                        <div class="panel-body excerpt">  
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="clearfix">		
                            <span class="col-lg-12 nopadding">    
                                <a class="btn btn-lg bold btn-primary btn-block btn-upper" href="<?php the_permalink(); ?>">view details ></a> 
                            </span> 
                        </div>
                    </div>	
                </div>
                <?php
            endwhile;
        }
        wp_reset_query();
        ?>
    </div></div>
<?php get_footer(); ?>
