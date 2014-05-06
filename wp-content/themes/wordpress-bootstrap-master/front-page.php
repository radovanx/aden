<?php get_header(); ?>
<?php echo do_shortcode( '[image-carousel interval="12000"]') ?> 
<div class="container">
    <div class="row clearfix"> 
        <div class="col-md-9 column"> 
            <h1 class="primary border-right">Top projects</h1>
        </div> 
        <div class="col-md-9 column"> 
            <div class="row"> 
            <?php
            $args = array(
                'post_type' => 'program',
                'post_status' => 'publish',
            );
            $query = new WP_Query($args); 
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <div class="col-md-6 column">
                        <div class="thumbnail">
                            <a class="" href="<?php the_permalink(); ?>">
                                
                                <?php the_post_thumbnail( 'property-list-thumb' ); ?>
                                <!--<img src="<?php echo get_template_directory_uri() ?>/images/choriner-hoefe_src_1.-w316-h0-p0-F-S1.jpg"/>-->
                            
                            </a>
                            <div class="panel-body">
                                <h4 class="blue"><?php the_title() ?></h4>
                            </div> 
                            <div class="panel-body">
                                <span class="propertyListBoxDataItemName"><i class="fa fa-home"></i><strong>Type of property:</strong> Exclusive Apartments</span>                      
                                <span class="propertyListBoxDataItemName"><i class="fa fa-map-marker"></i><strong>Address:</strong> Krausenstrasse 37 - Schützenstrasse 46, Berlin-Mitte</span>
                                <span class="propertyListBoxDataItemName"><i class="fa fa-arrows-alt"></i><strong>Size range:</strong><?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)) ?> m² - <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)) ?> m²</span>
                                <span class="propertyListBoxDataItemName"><i class="fa fa-money"></i><strong>Price range:</strong><strong class="red"> € 152.000 - € 822.500</strong></span>
                                <br>                                
                               
                            </div>
                            <div class="panel-body excerpt"> 
                                <?php the_excerpt() ?>
                            </div>
                            <div class="clearfix">		
                                <span class="col-lg-6 nopadding">    
                                    <a class="btn btn-lg bold btn-default btn-block btn-upper" href="<?php the_permalink(); ?> ">view details ></a> 
                                </span>
                                <span class="col-lg-6 nopadding">
                                   <a class="btn btn-lg bold btn-primary btn-block btn-upper" href="<?php the_permalink(); ?>">make an enquiry</a> 
                            </div>
                        </div>	
                    </div>
                    <?php
                endwhile;
            }
            wp_reset_query();
            ?>
                </div> 
        </div> 
        <div class="col-md-3 column"> 
            <img src="<?php echo get_template_directory_uri() ?>/images/sidebar_left.png">
        </div>	
    </div>
    <?php get_footer(); ?>