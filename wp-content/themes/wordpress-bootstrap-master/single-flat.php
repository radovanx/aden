<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
redirect_if_cannot_see_detail();
get_header();
?>
<div class="container">
    <div id="content" class="clearfix row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php
                $lang = qtrans_getLanguage();
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                $url = $thumb['0'];
                //$props = get_post_meta($post->ID, 'flat_props_' . $lang, true); 
                $props = get_props($post->ID, $lang); 
                $program_id = EstateProgram::flat_program_id($post->ID);
                //$title = get_the_title($post->ID);                
                $title = $props['freitexte|objekttitel']; 
                $video = $props['youtube'];
                $progra_reference = $props['verwaltung_techn|objektnr_extern'];
                $city = !empty($props['geo|ort']) ? esc_attr($props['geo|ort']) : "-";
                $district = !empty($props['geo|regionaler_zusatz']) ? esc_attr($props['geo|regionaler_zusatz']) : "-";
                $hnumber = !empty($props['geo|hausnummer']) ? esc_attr($props['geo|hausnummer']) : 0;
                $street = !empty($props['geo|strasse']) ? esc_attr($props['geo|strasse']) : "-";
                $zip = !empty($props['geo|plz']) ? esc_attr($props['geo|plz']) : 0;
                $name = !empty($props['freitexte|objekttitel']) ? esc_attr($props['freitexte|objekttitel']) : "-";
                $rental_status = isset($props['verwaltung_objekt|vermietet']) ? esc_attr($props['verwaltung_objekt|vermietet']) : "-";
                $flat_num = !empty($props['geo|wohnungsnr']) ? esc_attr($props['geo|wohnungsnr']) : 0;
 
                ?>
                <div class="col-md-12 column">
                    <div class="page-header"><h1 class="single-title primary" itemprop="headline"><?php echo $title ?>
                            <a href="<?php echo get_permalink($program_id); ?> "><small class="clearfix doublesmall blue"><?php _e("reference program:", "wpbootstrap"); ?> <?php echo get_the_title($program_id); ?></small></a>
                            <span class="apartment-row-<?php echo $post->ID ?>">
                                <a class="add-to-preference" href="#myModal" data-flat_id="<?php echo $post->ID; ?>" data-toggle="modal">
                                    <strong class="blue triplesmall"> 
                                        <span class="fav-label"><?php echo EstateProgram::is_user_favorite($post->ID) ? 'Added to favorites' : 'Add to favorite' ?> </span>
                                        <i class="fa <?php echo EstateProgram::is_user_favorite($post->ID) ? 'red fa-star' : 'blue fa-star-o' ?>"></i>
                                    </strong>                                                            
                                </a>
                            </span>
                        </h1>
                    </div>
                </div>
                <div id="main" class="col-md-7 column clearfix" role="main">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                        <!-- Tab panes -->
                        <div class="tab-content"> 
                            <!-- img slide --> 
                            <?php get_template_part('partial', 'slide') ?> 
                            <!-- /img slide -->
                            <div class="tab-pane fade" id="video_tab">
                                <?php
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
                            <li class="active"><a href="#gallery_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper"><i class="fa fa-eye"></i><?php _e("Gallery", "wpbootstrap"); ?></a></li>
                            <?php
                            if (!empty($video)):
                                ?>
                                <li><a href="#video_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper"><i class="fa fa-video-camera"></i><?php _e("Video", "wpbootstrap"); ?></a></li>
                            <?php endif; ?>
                        </ul>
                        <section class="post_content clearfix" itemprop="articleBody">
                        </section> <!-- end article section -->
                        <!-- end article footer -->
                    </article> <!-- end article -->
                </div>
                <div class="col-md-5 column">
                    <div class="border col-md-12 column">
                        <div class="row clearfix"> 
                            <span class="propertyListBoxDataItemName"> 
                                <div class="col-md-12 column "> 
                                    <h3 class="blue"> <i class="red fa fa-map-marker"></i><small>  
                                            <?php echo $street; ?> <?php echo $hnumber; ?> , <?php echo $city; ?>, <?php echo $district; ?> <?php echo $zip; ?></small> 
                                        <small class="blue clearfix"><?php _e("reference:", "wpbootstrap"); ?> <?php echo $progra_reference; ?></small>  
                                    </h3> 
                                </div> 
                            </span> 
                            <div class="col-md-12 column product-key-info">
                                <address> 
                                    <strong><?php // echo esc_attr($props['kontaktperson|firma'])    ?></strong>
                                    <?php echo esc_attr($props['kontaktperson|vorname']) ?>  <?php echo esc_attr($props['kontaktperson|name']) ?>
                                    <?php //echo esc_attr($props['kontaktperson|hausnummer']) ?> <?php //echo esc_attr($props['kontaktperson|strasse']) ?> 
                                    <?php // echo esc_attr($props['kontaktperson|ort']) ?> <?php //echo esc_attr($props['kontaktperson|plz']) ?><br> 
                                    <strong>Phone:</strong> <?php echo esc_attr($props['kontaktperson|tel_zentrale']) ?><br>   
                                    <strong>Email:</strong> <?php echo strtolower($props['kontaktperson|vorname']) ?>.<?php echo strtolower($props['kontaktperson|name']) ?>@immoneda.com 
                                </address>
                                <span class="propertyListBoxDataItemName">
                                    <i class="fa fa-money"></i><strong><?php _e("Purchase price:", "wpbootstrap"); ?></strong>
                                    <strong class="red pull-right"><?php echo esc_attr(price_format($props['preise|kaufpreis'])) ?> €
                                    </strong>
                                </span>
                                <span class="propertyListBoxDataItemName">
                                    <i class="fa fa-home"></i><strong><?php _e("Living area:", "wpbootstrap"); ?></strong>
                                    <strong class="red pull-right"><?php echo esc_attr($props['flaechen|wohnflaeche']) ?> m² </strong>
                                </span>
                                <span class="propertyListBoxDataItemName">
                                    <i class="fa fa-map-marker"></i><strong><?php _e("Rooms:", "wpbootstrap"); ?></strong>
                                    <strong class="red pull-right"><?php echo (int) $props['flaechen|anzahl_zimmer'] ?></strong>
                                </span>
                                <a  href="#recomendModal" class="btn btn-lg bold btn-primary btn-block" data-toggle="modal"><?php _e("Recommend product", "wpbootstrap"); ?></a> 
                                <a href="/generate-pdf/product/<?php echo $post->ID ?>/<?php echo $lang ?>" class="blue clearfix printlink"><i class="fa fa-print"></i> <?php _e("Print presentation", "wpbootstrap"); ?></a>
                                <a href="/reservation-document/<?php echo $post->ID ?>/<?php echo $lang ?>" class="blue clearfix printlink"><i class="fa fa-print"></i> <?php _e("Print reservation documents", "wpbootstrap"); ?></a> 
                                <?php if (!empty($props['dropbox|building'])): ?>
                                    <a href="<?php echo esc_attr($props['dropbox|building']) ?>" target="_blank" class="blue clearfix droplink"><i class="fa fa-download"></i> <?php _e("Download building data", "wpbootstrap"); ?></a>
                                <?php endif; ?>
                                <?php if (!empty($props['dropbox|flat'])): ?>
                                    <a href="<?php echo esc_attr($props['dropbox|flat']) ?>" target="_blank" class="blue clearfix droplink"><i class="fa fa-download"></i> <?php _e("Download product data", "wpbootstrap"); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 column">
                    <div class="col-md-12 column border">
                        <!-- apartment properties -->
                        <h3 class="border-left uppercase"><?php _e("Features", "wpbootstrap"); ?></h3>
                        <ul class="list-unstyled featured-single-flat bigger-text">
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Year of construction: ", "wpbootstrap"); ?></strong>
                                <span class="pull-right"><?php
                                    if (isset($props['zustand_angaben|baujahr'])):
                                        echo esc_attr($props['zustand_angaben|baujahr']);
                                    endif;
                                    ?>
                                </span>
                            </li>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Purchase price /sm:", "wpbootstrap"); ?></strong>
                                <span class="pull-right">
                                    <?php
                                    if (isset($props['preise|kaufpreis_pro_qm'])):
                                        echo esc_attr(price_format($props['preise|kaufpreis_pro_qm'])) . ' €/m² (sm)';
                                    endif;
                                    ?>
                                </span>
                            </li>
                            <?php if (isset(EstateProgram::$apartment_type[$props['objektart|wohnung|wohnungtyp']])): ?>
                                <li class="col-md-6 border-bottom">
                                    <strong><?php _e("Apartment type:", "wpbootstrap"); ?> </strong>
                                    <span class="pull-right">
                                        <?php echo EstateProgram::$apartment_type[$props['objektart|wohnung|wohnungtyp']] ?>
                                    </span>
                                </li>
                            <?php endif; ?>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Floor:", "wpbootstrap"); ?> </strong>
                                <span class="pull-right">
                                    <?php 
                                    if (isset($props['geo|etage'])):
                                        echo esc_attr($props['geo|etage']);
                                    endif;
                                    ?>
                                </span>
                            </li>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Number of floors:", "wpbootstrap"); ?> </strong>
                                <span class="pull-right">
                                    <?php
                                    if ($props['geo|anzahl_etagen']):
                                        echo (int) $props['geo|anzahl_etagen'];
                                    endif;
                                    ?>
                                </span>
                            </li>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Rooms:", "wpbootstrap"); ?> </strong>
                                <span class="pull-right">
                                    <?php
                                    if ($props['flaechen|anzahl_zimmer']):
                                        echo (int) $props['flaechen|anzahl_zimmer'];
                                    endif;
                                    ?>
                                </span>
                            </li>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Bathroom(s):", "wpbootstrap"); ?> </strong>
                                <span class="pull-right">
                                    <?php
                                    if (isset($props['flaechen|anzahl_badezimmer'])) {
                                        echo (int) $props['flaechen|anzahl_badezimmer'];
                                    }
                                    ?>
                                </span>
                            </li>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Elevator:", "wpbootstrap"); ?></strong>
                                <span class="pull-right">
                                    <?php echo isset($prop['ausstattung|fahrstuhl|PERSONEN']) ? "YES" : "NO"; ?>
                                </span>
                            </li>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Type of heating system:", "wpbootstrap"); ?></strong>
                                <span class="pull-right">
                                    <?php
                                    echo EstateProgram::heatingSystem($props);
                                    ?>
                                </span>
                            </li>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Garage / parking spot:", "wpbootstrap"); ?>
                                </strong>
                                <span class="pull-right">
                                    <?php echo (int) ($props['preise|stp_sonstige|stellplatzmiete ']); ?>
                                </span>
                            </li>
                            <li class="col-md-6 border-bottom">
                                <strong><?php _e("Buyer commission (incl. VAT):", "wpbootstrap"); ?></strong>
                                <span class="pull-right">
                                    <?php
                                    if (isset($props['preise|aussen_courtage'])):
                                        echo esc_attr($props['preise|aussen_courtage']);
                                    endif;
                                    ?>
                                </span>
                            </li>
                        </ul>
                        <!-- /apartment properties -->
                    </div>
                </div>
                <div class="col-md-12 column border-bottom margin-top">
                    <h4 class="border-left uppercase"><?php _e("Description", "wpbootstrap"); ?></h4>
                    <p class="bigger-text">
                        <?php echo esc_attr($props['freitexte|ausstatt_beschr']) ?>
                    </p>
                </div>
                <div class="col-md-6 margin-top">
                    <h4 class="border-left uppercase"><?php _e("Description of the building", "wpbootstrap"); ?></h4>
                    <p class="bigger-text"> <?php echo esc_attr($props['freitexte|objektbeschreibung']) ?></p>
                </div>
                <div class="col-md-6 margin-top">
                    <h4 class="border-left uppercase"><?php _e("Description SURROUNDINGs", "wpbootstrap"); ?></h4>
                    <p class="bigger-text"> <?php echo esc_attr($props['freitexte|lage']) ?></p>
                </div>
                <div class="clearfix border-bottom"></div>
                <div class="col-md-12 column">
                    <h3 class="border-left uppercase"><?php _e("Area map", "wpbootstrap"); ?></h3>
                    <?php
                    $langt = esc_attr($props['geo|geokoordinaten|breitengrad']);
                    $longt = esc_attr($props['geo|geokoordinaten|laengengrad']);
                    ?>
                    <div id="map-canvas">
                    </div>
                </div>
                 <div class="col-md-3 pull-right big_icons margin-top">
                        <ul class="nav nav-tabs">
                            <a href="#list"  data-toggle="tab" class="blue active"><i class="fa fa-list"></i></a>
                            <a href="#table" data-toggle="tab" class="red"><i class="fa fa-th"></i></a>
                        </ul>
                 </div> 
                <div class="col-md-12 column margin-top">
                    <h3 class="border-left uppercase"><?php _e("Other products that might interest you", "wpbootstrap"); ?></h3> 
                    <!-- Tab panes -->
                    <div class="tab-content">
   
                        <div class="tab-pane" id="table">
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
                                $flat_props = EstateProgram::get_flats_props_by_program($program_id, $lang, $post->ID);
                                ?>
                                <?php include TEMPLATEPATH . '/table_row.php'; ?> 
                            </table>
                        </div>
                         <div class="col-md-12 column active border tab-pane" id="list">
                                <?php
                                include TEMPLATEPATH . '/row_row.php';  
                                ?>
                         </div>
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
            </article>
        <?php endif; ?>
        <!-- end #main -->
    </div> <!-- end #content -->
</div>
<div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="recomendModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php _e('Recommend this product', '') ?></h4>
            </div>
            <form id="recomend-form" method="post">                
                <div class="modal-body">
                    <div id="form-response" class="display-none"></div>
                    <input type="hidden" name="action" value="recommend_product">
                    <input type="hidden" name="id" value="<?php echo $post->ID ?>">
                    <div class="form-group">
                        <label for="receiver_email"><?php _e('Receiver email:', 'wpbootstrap') ?></label>
                        <input type="text" class="form-control erase-after-sent" value="" id="receiver_email" name="receiver_email">
                    </div>
                    <div class="form-group">
                        <label for="receiver_message"><?php _e('Message:', 'wpbootstrap') ?></label>
                        <textarea class="form-control erase-after-sent" id="receiver_message" name="receiver_message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="loading-recommand" class="pull-left display-none"><i class="fa fa-spinner fa-spin"></i> <?php _e('Sending... ') ?></div>
                    <input type="submit" class="btn btn-primary pull-right" id="send_recommendation" value="<?php _e('Send recommendation', 'wpbootstrap') ?>">                    
                </div>
            </form> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
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
<?php $LangLong = esc_attr(get_post_meta($post->ID, '_program_latitude', true)) . ' ,' . esc_attr(get_post_meta($post->ID, '_program_longitude', true)); ?>
<script>
// MAP //
    var params;
    var lang = <?php echo $langt; ?>;
    var long = <?php echo $longt; ?>;
// dom ready
    jQuery(function() {
//if (typeof google !== "undefined"){
        if (window.google && google.maps) {
// Map script is already loaded
            initializeMap();
        } else {

            lazyLoadGoogleMap();
        }
    });
    function initialize(params) {
        var myLatlng = new google.maps.LatLng(lang, long);
        var mapOptions = {
            center: myLatlng, 
            zoom: 14,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: "<?php echo $title; ?>"
        });
    }
    function lazyLoadGoogleMap() {
        jQuery.getScript("http://maps.google.com/maps/api/js?sensor=true&callback=initializeMap")
                .done(function(script, textStatus) {
//alert("Google map script loaded successfully");
                })
                .fail(function(jqxhr, settings, ex) {
//alert("Could not load Google Map script: " + jqxhr);
                });
    }
    function initializeMap() {
        initialize(params);
    }
</script>  
<script>
    jQuery(function() {
        jQuery('#recomend-form').submit(function(event) {
            jQuery('#recomend-form .form-response').html('').hide();
            var data = {
                'id': <?php echo $post->ID ?>,
                'receiver_email': jQuery('#receiver_email').val(),
                'receiver_message': jQuery('#receiver_message').val(),
                'action': 'recommend_product',                
                'lang': '<?php echo $lang ?>',
            };
            jQuery.ajax({
                type: 'POST',
                cache: false,
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: data,
                beforeSend: function() {
                    jQuery('#form-response').html('').hide();
                    jQuery('#send_recommendation').attr('disabled', 'disabled');
                    jQuery('#loading-recommand').show();
                },
                success: function(response) {
                    jQuery('#form-response').show().html('<div class="alert alert-success"><?php _e('Your recommendation has been successfully sent') ?></div>');
                    jQuery('.erase-after-sent').val('');
                },
                error: function(response) {
                    jQuery('#form-response').show().html('<div class="alert alert-danger">' + response.responseText + '</div>');
                },
                complete: function(response) {
                    jQuery('#send_recommendation').removeAttr('disabled');
                    jQuery('#loading-recommand').hide();
                }
            });
            event.preventDefault();
        });
        jQuery('#recomendModal').on('hidden.bs.modal', function(e) {
            jQuery('#loading-recommand').hide();
            jQuery('.erase-after-sent').val('');
            jQuery('#form-response').html('').hide();
        });
    });
</script> 
<?php get_footer(); ?>
