                        <?php        
                        //echo $lang;
                       
                        $terms = wp_get_post_terms(get_the_ID(), 'type_of_accommodation'); 
                        $terms = qtrans_useTermLib($terms);
                        
                        $type_of_accomodation = array();
                          
                        foreach ($terms as $t) {
                            $type_of_accomodation[] = __($t->name);
                        }
                        
                        $link = get_the_permalink($post->ID);
                        $link = qtrans_convertURL($link, $post_lang, true);
                        
                        ?>
                        <div class="col-md-6 column">
                            <div class="thumbnail">
                                <a class="" href="<?php  echo $link ?>">
                                    <?php the_post_thumbnail('property-list-thumb'); ?>
                                </a>
                                <div class="panel-body">
                                    <h4 class="blue"><?php the_title() ?></h4>
                                </div>
                                <div class="panel-body">
                                    <span class="propertyListBoxDataItemName">
                                        <i class="fa fa-home"></i><strong><?php _e("Type of property:", "wpbootstrap"); ?></strong>
                                        <span class="pull-right"><?php echo implode(', ', $type_of_accomodation); ?></span>
                                    </span>
                                    <span class="propertyListBoxDataItemName">
                                        <i class="fa fa-map-marker"></i><strong><?php _e("Address:", "wpbootstrap"); ?></strong>
                                        <span class="pull-right">
                                            <?php echo esc_attr(get_post_meta($post->ID, '_program_street', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_house_number', true)); ?>, <?php echo esc_attr(get_post_meta($post->ID, '_program_region', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_city', true)); ?></span></span>
                                    <span class="propertyListBoxDataItemName">
                                        <i class="fa fa-arrows-alt"></i><strong><?php _e("Size range:", "wpbootstrap"); ?></strong><span class="pull-right"><?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)); ?> m² - <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)); ?> m²</span></span>
                                    <span class="propertyListBoxDataItemName">
                                        <i class="fa fa-money"></i><strong><?php _e("Price range:", "wpbootstrap"); ?></strong><span class="pull-right"><strong class="red"><?php echo esc_attr(price_format(get_post_meta($post->ID, '_program_price_from', true))); ?> &euro; -  <?php echo esc_attr(price_format(get_post_meta($post->ID, '_program_price_to', true))); ?> &euro;</strong></span></span>
                                </div>
        
                                <div class="panel-body excerpt min-height">
                                <?php the_excerpt(); ?>
                                </div>
                       
                                <div class="clearfix">
                                    <span class="col-lg-12 nopadding">
                                        <a class="btn btn-lg bold btn-primary btn-block btn-upper" href="<?php  echo $link ?>"><?php _e("View details", "wpbootstrap"); ?></a>
                                    </span>
                                </div>
                            </div>
                        </div>  
                        <?php 
                        echo 0 == $i % 2 ? '</div></div><div class="col-md-12 column"><div class="row">' : '';
                        ?>


                        
