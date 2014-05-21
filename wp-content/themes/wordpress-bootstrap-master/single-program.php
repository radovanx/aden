<?php 

get_header();
?>
<div class="container">
    <div id="content" class="clearfix row">
        <div class="col-md-12 column">
            <div class="page-header"><h1 class="single-title primary" itemprop="headline"><?php the_title(); ?></h1></div>
        </div>
        <div id="main" class="col-md-7 column clearfix" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- img slide -->
                            <?php get_template_part('partial', 'slide') ?>
                            <!-- /img slide --> 
                            <div class="tab-pane fade" id="map_tab">
                                <div id="gmap" class="gmap">google map</div>
                            </div>
                            <div class="tab-pane" id="street_tab">
                                <div id="gmapstreet" class="gmapstreet">street</div> 
                            </div>
                            <div class="tab-pane fade" id="video_tab"> 
                                <?php
                                $video = get_post_meta($post->ID, '_program_video', true);
                                if (!empty($video)):
                                    ?>
                                    <div class="flex-video">
                                        <?php
                                        global $wp_embed;
                                        $post_embed = $wp_embed->run_shortcode('[embed width="750" ]' . $video . '[/embed]');
                                        echo $post_embed;
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!--/TAB CONTENT END-->
                        <ul class="nav nav-pills margin-top">
                            <li class="active"><a href="#gallery_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper"><i class="fa fa-eye"></i>Gallery</a></li>
                            <li><a href="#map_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper create_map"><i class="fa fa-map-marker"></i>Map View</a></li>
                            <li><a href="#street_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper create_street"><i class="fa fa-globe"></i>Street View</a> </li>

                            <?php
                            $video = get_post_meta($post->ID, '_program_video', true);
                            if (!empty($video)):
                                ?>
                                <li><a href="#video_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper create_street"><i class="fa fa-video-camera"></i>Video</a></li>
                            <?php endif; ?>
                        </ul>
                        <section class="post_content clearfix" itemprop="articleBody">
                        </section> <!-- end article section -->
                        <footer>
                        </footer> <!-- end article footer -->
                    </article> <!-- end article -->
                    <?php
                    $summary = __(get_post_meta(get_the_ID(), '_program_hightlight', true));
                    if (!empty($summary)):
                        ?>
                        <div class="column ">
                            <div class="col-md-12 column border">
                                <h3 class="border-left uppercase"><?php _e("Summary", "wpbootstrap"); ?></h3>

                                <ul class="list-unstyled bigger-text line-big">
                                    <li><i class="fa fa-check red"></i>
                                        <?php echo str_replace(';', '</li><li><i class="fa fa-check red"></i>', $summary) ?>
                                    </li>
                                    <!--
                                    <li><i class="fa fa-check"></i>
                                        Top location within the central press and lifestyle district of Berlin
                                    </li>
                                    -->
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-5 column">
                     <div class="border col-md-12 column">
                        <h3 class="border-left uppercase">
                            <?php _e("Key Facts", "wpbootstrap"); ?>
                        </h3>
                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <div class="key_fact">
                                    <div class="panel-body">
                                        <?php
                                        $terms = wp_get_post_terms(get_the_ID(), 'type_of_accommodation', $args);

                                        $type_of_accomodation = array();

                                        foreach ($terms as $t) {
                                            $type_of_accomodation[] = $t->name;
                                        }
                                        ?>
                                        <span class="propertyListBoxDataItemName"><i class="fa fa-home round-border"></i><strong><?php _e("Type of property:", "wpbootstrap"); ?></strong> <?php echo implode(', ', $type_of_accomodation) ?></span>
                                    </div>
                                    <div class="panel-body">
                                        <span class="propertyListBoxDataItemName"><i class="fa fa-map-marker round-border"></i><strong><?php _e("Address:", "wpbootstrap"); ?></strong> <?php esc_attr_e(get_post_meta($post->ID, '_program_address', true)) ?></span>
                                    </div>
                                    <div class="panel-body">
                                        <span class="propertyListBoxDataItemName"><i class="fa fa-arrows-alt round-border"></i><strong><?php _e("Size range:", "wpbootstrap"); ?></strong> <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)); ?> m² - <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)); ?> m²
                                        </span>
                                    </div>
                                    <div class="panel-body">
                                        <span class="propertyListBoxDataItemName">
                                            <i class="fa fa-money round-border"></i><strong><?php _e("Price range:", "wpbootstrap"); ?></strong><strong class="red"> &euro; <?php echo esc_attr(price_format(get_post_meta($post->ID, '_program_price_from', true))); ?>  - &euro; <?php echo esc_attr(price_format(get_post_meta($post->ID, '_program_price_to', true))); ?></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border col-md-12 column border background contact_form_block margin-top">
                        <h2 class="border-left uppercase"><?php _e('Ce programme vous intéresse ?', 'wpbootstrap') ?></h2>
                        <span class="phone red bold"><i class="fa fa-phone"></i> +33 0632140564</span>
                        <?php echo do_shortcode('[contact-form-7 id="4080" title=""]') ?>
                    </div> 
                </div>
                <?php if (is_user_logged_in()): ?>
                    <div class="col-md-6 ">
                        <h3 class="border-left inline uppercase">
                            <?php _e("List of products available in this program", "wpbootstrap"); ?>
                        </h3>
                    </div>
                    <div class="col-md-3 pull-right big_icons margin-top">
                        <ul class="nav nav-tabs">
                            <a href="#table" data-toggle="tab" class="active red"><i class="fa fa-th"></i></a>
                            <a href="#list"  data-toggle="tab" class="blue"><i class="fa fa-list"></i></a>
                        </ul>
                    </div>
                    <div class="col-md-12 column margin-top">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="table">
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
                                    $flat_props = EstateProgram::get_flats_props_by_program($post->ID, $lang);
                                    ?>
                                    <?php include TEMPLATEPATH . '/table_row.php'; ?> 
                                </table>
                            </div>
                            <div class="col-md-12 column border tab-pane" id="list">
                                <?php
                                $i = 0;
                                if (!empty($flat_props)):
                                    foreach ($flat_props as $key => $val):
                                        $prop = unserialize($val->prop);
                                        $key = unserialize($key);
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($val->ID), 'thumbnail');
                                        $url_image = $thumb['0'];
                                        $url = get_permalink($val->ID);
                                        $city = !empty($prop['geo|ort']) ? esc_attr($prop['geo|ort']) : "-";
                                        $district = !empty($prop['geo|regionaler_zusatz']) ? esc_attr($prop['geo|regionaler_zusatz']) : "-";
                                        $area = !empty($prop['flaechen|wohnflaeche']) ? esc_attr($prop['flaechen|wohnflaeche']) : 0;
                                        $rooms = !empty($prop['flaechen|anzahl_zimmer']) ? esc_attr($prop['flaechen|anzahl_zimmer']) : 0;
                                        $hnumber = !empty($prop['geo|hausnummer']) ? esc_attr($prop['geo|hausnummer']) : 0;
                                        $floor = !empty($prop['geo|etage']) ? esc_attr($prop['geo|etage']) : 0;
                                        $street = !empty($prop['geo|strasse']) ? esc_attr($prop['geo|strasse']) : "-";
                                        $zip = !empty($prop['geo|plz']) ? esc_attr($prop['geo|plz']) : 0;
                                        $pricem = !empty($prop['preise|kaufpreis_pro_qm']) ? esc_attr($prop['preise|kaufpreis_pro_qm']) : 0;
                                        $price = !empty($prop['preise|kaufpreis']) ? esc_attr($prop['preise|kaufpreis']) : 0;
                                        $name = !empty($prop['freitexte|objekttitel']) ? esc_attr($prop['freitexte|objekttitel']) : "-";
                                        ?> 
                                        <div class="row">
                                            <div class="col-md-12 <?php echo $i % 2 ? 'background' : 'no-background'; ?> flats_box">
                                                <div class="col-md-3">
                                                    <a href="<?php echo $url; ?>"><img src="<?php echo $url_image; ?>"/></a>
                                                </div>
                                                <div class="col-md-9">
                                                    <h4 class="blue"><?php echo $name; ?><small class="clearfix"><i class="red fa fa-map-marker"></i>
                                                            <?php echo $street; ?> <?php echo $hnumber; ?> , <?php echo $city; ?>, <?php echo $district; ?> <?php echo $zip; ?></small></h4>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Prg. ref.:", "wpbootstrap"); ?></strong>
                                                                <?php echo esc_attr($prop['verwaltung_techn|objektnr_extern']) ?>
                                                            </span>
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Flat n°:", "wpbootstrap"); ?></strong>
                                                                <?php echo esc_attr($prop['anbieternr']) ?>
                                                            </span>
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Rental status: ", "wpbootstrap"); ?></strong>
                                                                <?php echo esc_attr($prop['anbieternr']) ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Floor:", "wpbootstrap"); ?></strong>
                                                                <?php echo $floor; ?>
                                                            </span> 
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Rooms:  ", "wpbootstrap"); ?></strong>
                                                                <?php echo esc_attr($prop['anbieternr']) ?>
                                                            </span>
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Surface:  ", "wpbootstrap"); ?></strong>
                                                                <?php echo $area; ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Price:", "wpbootstrap"); ?></strong>
                                                                <?php echo $price; ?>
                                                            </span>
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Price/m2:", "wpbootstrap"); ?></strong>
                                                                <?php echo $pricem; ?>
                                                            </span>
                                                            <span class="data_item clearfix">
                                                                <strong><?php _e("Yield:", "wpbootstrap"); ?></strong>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <strong class="blue clearfix"><i class="fa <?php echo EstateProgram::is_user_favorite($val->ID) ? 'red fa-star' : 'blue fa-star-o' ?>"></i>
                                                                <?php echo EstateProgram::is_user_favorite($val->ID) ? 'Added to favorites' : 'Add to favorite' ?>
                                                            </strong>
                                                            <a href="<?php echo $url; ?>" class=" "><?php _e("VIEW DETAILS:", "wpbootstrap"); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div> 
                    </div>
                </div>
            <?php endif; ?>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo the_title(); ?></h4>
            </div>
            <div class="modal-body"> 
                <?php _e("You modified", "wpbootstrap"); ?> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Ok", "wpbootstrap"); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $lang = esc_attr(get_post_meta($post->ID, '_program_latitude', true)); ?>
<?php $long = esc_attr(get_post_meta($post->ID, '_program_longitude', true)); ?>
 

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>     
// MAP // 
var lang = <?php echo $lang; ?>  
var long = <?php echo $long; ?>   
 
var myCenter = new google.maps.LatLng(lang, long); 
var map = null, marker = null;  
function initialize() { 
 
  var mapProp = {
      center: myCenter,
      zoom: 14,
      panControl: true, //enable pan Control
      zoomControl: true, //enable zoom control
      scaleControl: true, // enable scale control 
      mapTypeId: google.maps.MapTypeId.ROADMAP
  };  
  
    map = new google.maps.Map(document.getElementById("gmap"), mapProp);         
    marker = new google.maps.Marker({ 
        position: myCenter, 
        draggable: false, 
        animation: google.maps.Animation.DROP, 
         
    });  
    marker.setMap(map);   
    }
 
jQuery(".create_map").on('shown.bs.tab', function() {
       
  	/* Trigger map resize event */
	google.maps.event.trigger(map, 'resize'); 
        map.setCenter(marker.getPosition());       
});
 
initialize(); 
 

 
function showStreetview() {
  var myPano;
  var latlng = new google.maps.LatLng(lang, long);
  
  var panoramaOptions = {
    position: latlng,
    pov: {
      heading: 165,
      pitch: 0
         },
    zoom: 1
  };  
  myPano = new google.maps.StreetViewPanorama(
      document.getElementById('gmapstreet'),
      panoramaOptions);
  myPano.setVisible(true);
  window.setInterval(function() {
    var pov = myPano.getPov();
    pov.heading += 0.2;
    myPano.setPov(pov);
}, 10);
}
 
jQuery(".create_street").on('shown.bs.tab', function() { 
  	/* Trigger map resize event */ 
        showStreetview(); 
	google.maps.event.trigger(map, 'resize');  
});
 
 
</script>  
<?php get_footer(); ?>
