<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php get_header(); ?>
<div class="container">
    <div id="content" class="clearfix row">
        <div class="col-md-12 column">
            <div class="page-header"><h1 class="single-title primary" itemprop="headline"><?php the_title(); ?></h1></div>
        </div>
        <div id="main" class="col-md-8 column clearfix" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="gallery_tab">
                                <!--slider here --> 
                                <?php
                                
                                $lang = qtrans_getLanguage();
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                                $url = $thumb['0'];
                                ?>
                                <a href="<?php echo $url; ?>">
                                    <?php the_post_thumbnail('project-detail-big'); ?>
                                </a>
                                <div id="myCarousel" class="carousel slide">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner program-carousel">
                                        <?php
                                        $images = & get_children(array(
                                                    'post_parent' => $post->ID,
                                                    'post_type' => 'attachment',
                                                    'post_mime_type' => 'image'
                                        ));
                                        if (empty($images)) {
                                            // no attachments here
                                        } else {
                                            $i = 1;
                                            ?>
                                            <div class="item active"><div class="row">
                                                    <?php
                                                    foreach ($images as $attachment_id => $attachment) {
                                                        $full_size = wp_get_attachment_image_src($attachment_id, 'full');
                                                        $full_size = $full_size[0];
                                                        echo '<div class="col-xs-3 nopadding"><a href="' . $full_size . '">';
                                                        echo wp_get_attachment_image($attachment_id, 'project-detail-small');
                                                        echo '</a>';
                                                        echo '</div>';
                                                        echo $i % 5 == 0 ? '</div></div><div class="item"><div class="row">' : '';
                                                        $i++;
                                                    }
                                                    echo '</div></div>';
                                                }
                                                ?>
                                            </div>
                                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                                            <!--/myCarousel-->
                                        </div>
                                    </div>
                                
                                </div>
                                <!--/TAB CONTENT END-->   
 
                                <section class="post_content clearfix" itemprop="articleBody">
                                </section> <!-- end article section -->
                                <footer>
                                </footer> <!-- end article footer -->
                                </article> <!-- end article -->
                            </div>
                            <div class="col-md-4 column">
                                <div class="border col-md-12 column">
                                    <div class="row clearfix">
                                        <div class="col-md-12 column product-key-info"> 
                                            <address>
                                            <strong>Adenimmo</strong><br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                            </address>
                                                    <span class="propertyListBoxDataItemName">
                                                    <i class="fa fa-money"></i>
                                                    <strong><?php _e("Purchase price:", "wpbootstrap"); ?></strong>
                                                    
                                                    
                                                    <strong class="red">
                                                         <?php 
                                                          $props = get_post_meta($post->ID, 'flat_props_' . $lang, true);
                                                          ?>
                                                         <?php echo esc_attr($props['preise|kaufpreis']) ?>
                                                         &euro; 
                                                    </strong>
                                                     
                                                    </span>
                                             
                                            <span class="propertyListBoxDataItemName">                                  
                                                <i class="fa fa-home"></i><strong><?php _e("Living area:", "wpbootstrap"); ?></strong>
                                                <strong class="red"> 
                                                     <?php echo esc_attr($props['flaechen|wohnflaeche']) ?>
                                                </strong>
                                            </span>
                                                
                                            
                                            <span class="propertyListBoxDataItemName">
                                                <i class="fa fa-map-marker"></i><strong><?php _e("Rooms:", "wpbootstrap"); ?></strong>
                                                <strong class="red">
                                                      
                                                     <?php echo esc_attr($props['flaechen|anzahl_zimmer']) ?>
                                                    
                                                </strong>
                                              </span>
                                            <a  href="#recomendModal" class="btn btn-lg bold btn-primary btn-block" data-toggle="modal"><?php _e("Recommend product", "wpbootstrap"); ?></a>
   
                                            <a href="#" class="blue clearfix printlink"><i class="fa fa-print"></i> <?php _e("Print presentation", "wpbootstrap"); ?></a>
                                            <a href="#" class="blue clearfix printlink"><i class="fa fa-print"></i> <?php _e("Print reservation documents", "wpbootstrap"); ?></a>
                                            <a href="#" class="blue clearfix droplink"><i class="fa fa-download"></i> <?php _e("Download building data", "wpbootstrap"); ?></a>
                                            <a href="#" class="blue clearfix droplink"><i class="fa fa-download"></i> <?php _e("Download product data", "wpbootstrap"); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                                    <div class="col-md-12 column">
                                        <div class="col-md-12 column border">
                                        <h3 class="border-left uppercase"><?php _e("Features", "wpbootstrap"); ?></h3>
                                        <ul class="list-unstyled featured-single-flat">
                                            <li>
                                            <strong><?php _e("Type of property to search for:", "wpbootstrap"); ?> </strong>
                                            </li>
                                            <li>
                                            <strong><?php _e("Year of construction: ", "wpbootstrap"); ?></strong>
                                            </li>
                                            <li>
                                            <strong><?php _e("Purchase price /sm:", "wpbootstrap"); ?></strong>
                                            </li>
                                            <li>
                                            <strong><?php _e("Apartment type:", "wpbootstrap"); ?> </strong>
                                            </li>
                                            <li>
                                            <strong><?php _e("Floor:", "wpbootstrap"); ?> </strong>
                                            </li>
                                            <li>
                                            <strong><?php _e("Number of floors:", "wpbootstrap"); ?> </strong>
                                            </li>
                                            <li>
                                            <strong><?php _e("Rooms:", "wpbootstrap"); ?> </strong>
                                            </li>
                                            <li>
                                            <strong><?php _e("Bathroom(s):", "wpbootstrap"); ?> </strong>
                                            </li>
                                             <li>
                                            <strong><?php _e("Elevator:", "wpbootstrap"); ?></strong>  
                                            </li>
                                            <li>
                                            <strong><?php _e("Type of heating system:", "wpbootstrap"); ?></strong>
                                            </li>
                                              <li>
                                            <strong><?php _e("Garage / parking spot:", "wpbootstrap"); ?></strong>
                                            </li>
                                            <li>
                                            <strong><?php _e("Buyer commission (incl. VAT):", "wpbootstrap"); ?></strong>
                                            </li>
                                        </ul>
                                         </div>
                                    </div>
                                    <div class="col-md-12 column border-bottom margin-top">
                                     <h4 class="border-left uppercase"><?php _e("Description", "wpbootstrap"); ?></h4>    
                                     <p class="bigger-text"> 
                                       <?php echo esc_attr($props['freitexte|ausstatt_beschr']) ?>    
                                     </p>
                                    </div>    
                            <div class="col-md-6 border-bottom margin-top">
                            <h4 class="border-left uppercase"><?php _e("Description of the building", "wpbootstrap"); ?></h4>       
                                 

                            <p class="bigger-text"> <?php echo esc_attr($props['freitexte|objektbeschreibung']) ?></p>  
                            </div>
                            <div class="col-md-6 border-bottom margin-top">
                            <h4 class="border-left uppercase"><?php _e("Description SURROUNDINGs", "wpbootstrap"); ?></h4>       
                                 <p class="bigger-text"> <?php echo esc_attr($props['freitexte|lage']) ?></p>
                            </div>
                            <div class="col-md-12 column">
                             <h3 class="border-left uppercase"><?php _e("Area map", "wpbootstrap"); ?></h3>   
                             
                             <?php 
                                   $lang =  esc_attr($props['geo|geokoordinaten|breitengrad']);  
                                   $long =  esc_attr($props['geo|geokoordinaten|laengengrad']);    
                              ?>
                             
                             <div id="map-canvas">
   
                             </div> 
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
 
    
<div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="recomendModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php _e('Recommend this product', '') ?></h4>
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
    


<?php $LangLong = esc_attr(get_post_meta($post->ID, '_program_latitude', true)) . ' ,' . esc_attr(get_post_meta($post->ID, '_program_longitude', true)); ?> 

<script>
    // MAP //     
    
    
var lang = <?php echo $lang; ?>;   
var long = <?php echo $long; ?>;       
  

function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(lang,long)
    };
     
    
      
      var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
   
    }  
function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
  document.body.appendChild(script);
} 
window.onload = loadScript;
 
</script>
<?php get_footer(); ?>