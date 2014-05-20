<?php get_header(); ?>
<div class="visible-lg">
<?php echo do_shortcode( '[image-carousel interval="12000"]') ?> 
</div>
    <div class="container">
    <div class="row clearfix"> 
        <div class="col-md-12 column"> 
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
                    <?php
                    $terms = wp_get_post_terms(get_the_ID(), 'type_of_accommodation', $args);
                    $type_of_accomodation = array();
                    foreach ($terms as $t) {
                    $type_of_accomodation[] = $t->name;
                    }
                    ?>
                    <div class="col-md-6 column">
                        <div class="thumbnail">
                            <a class="" href="<?php the_permalink(); ?>"> 
                                <?php the_post_thumbnail( 'property-list-thumb' ); ?>                                 
                            </a>
                            <div class="panel-body">
                                <h4 class="blue"><?php the_title() ?></h4>
                            </div> 
                            <div class="panel-body">  
                                <span class="propertyListBoxDataItemName">
                                      <i class="fa fa-home"></i><strong><?php _e("Type of property:", "wpbootstrap"); ?></strong><span class="pull-right"><?php echo implode(', ', $type_of_accomodation) ?></span></span>
                                <span class="propertyListBoxDataItemName">
                                    <i class="fa fa-map-marker"></i><strong><?php _e("Address:", "wpbootstrap"); ?></strong>
                                    <span class="pull-right"> 
                                <?php echo esc_attr(get_post_meta($post->ID, '_program_street', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_house_number', true)); ?>, <?php echo esc_attr(get_post_meta($post->ID, '_program_region', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_city', true)); ?></span></span>
                                <span class="propertyListBoxDataItemName">
                                    <i class="fa fa-arrows-alt"></i><strong><?php _e("Size range:", "wpbootstrap"); ?></strong><span class="pull-right"><?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)); ?> m² - <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)); ?> m²</span></span> 
                                <span class="propertyListBoxDataItemName">
                                    <i class="fa fa-money"></i><strong><?php _e("Price range:", "wpbootstrap"); ?></strong><span class="pull-right"><strong class="red"><?php echo esc_attr(get_post_meta($post->ID, '_program_price_from', true)); ?> &euro; -  <?php echo esc_attr(get_post_meta($post->ID, '_program_price_to', true)); ?> &euro;</strong></span></span>                
                            </div>
                            <div class="panel-body excerpt"> 
                                <?php the_excerpt() ?>
                            </div>
                            <div class="clearfix">		
                                <span class="col-lg-12 nopadding">    
                                    <a class="btn btn-lg bold btn-primary btn-block btn-upper" href="<?php the_permalink(); ?> ">view details ></a> 
                                </span>
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
            <div class="save col-md-3 column border background contact_form_block">  
                <h3>
                 <?php _e("Guide" , "wpbootstrap"); ?>  </br> 
                 <?php _e("investissement" , "wpbootstrap"); ?>  </br> 
                 <?php _e("Berlin" , "wpbootstrap"); ?>  </br>
                </h3>
                <div class="form-group">
                <a class="btn btn-lg bold btn-primary btn-block btn-upper" href="<?php the_permalink(); ?> "> 
                  <?php _e("download for free", "wpbootstrap"); ?>
                </a>
                </div>    
            </div>
            <div class="col-md-3 column border background contact_form_block"> 
            <h2 class="border-left uppercase"><?php _e("Contact us", "wpbootstrap"); ?></h2>
            <span class="phone red bold"><i class="fa fa-phone"></i> +33 0632140564</span>
             <?php echo do_shortcode( '[contact-form-7 id="1728" title="contact-home-en"]' ) ?>  
            </div> 
            <div class="col-md-3 column border background contact_form_block"> 
              <h2 class="border-left"><?php _e("NEWSLETTER", "wpbootstrap"); ?></h2> 
            </div>
    </div></div>
    <?php get_footer();?>