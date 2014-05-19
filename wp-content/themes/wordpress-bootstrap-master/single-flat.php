<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php get_header(); ?>
<div class="container">
    <div id="content" class="clearfix row"> 
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>         
         <?php
         
            $lang = qtrans_getLanguage();
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            $url = $thumb['0']; 
            $props = get_post_meta($post->ID, 'flat_props_' . $lang, true);  
            $program_id = EstateProgram::flat_program_id($post->ID);  
            $title = get_the_title($post->ID); 
            $video =  $props['youtube'];   
            
            ?>
        <div class="col-md-12 column">
            <div class="page-header"><h1 class="single-title primary" itemprop="headline"><?php the_title(); ?> 
            <a href="<?php echo get_permalink($program_id); ?> "><small class="clearfix doublesmall blue"><?php _e("reference program:", "wpbootstrap"); ?><?php echo get_the_title($program_id); ?></small></a>
            
            <a class="add-to-preference" href="#myModal" data-flat_id="<?php echo $post->ID; ?>" data-toggle="modal">
            <strong class="blue doublesmall"> <?php echo EstateProgram::is_user_favorite($post->ID) ? 'Added to favorites' : 'Add to favorite' ?><i class="fa <?php echo EstateProgram::is_user_favorite($post->ID) ? 'red fa-star' : 'blue fa-star-o' ?>"></i></strong>
            </a>    
                </h1>
            </div>
        </div>
        <div id="main" class="col-md-7 column clearfix" role="main">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="gallery_tab">
                                <!--slider here -->
                                <span class="test-popup-link">
                                    <?php the_post_thumbnail('project-detail-big'); ?>
                                </span>
                                <ul class="bxslider parent-container">
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
                                        <?php
                                        foreach ($images as $attachment_id => $attachment) {
                                            $full_size = wp_get_attachment_image_src($attachment_id, 'full');
                                            $full_size = $full_size[0];

                                            echo '<li><a href="' . $full_size . '">' . wp_get_attachment_image($attachment_id, 'project-detail-small') . '</a></li>';

                                            $i++;
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
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
                                    <li class="active"><a href="#gallery_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper"><i class="fa fa-eye"></i>Gallery</a></li>
                                    <?php            
                                      if (!empty($video)):
                                    ?> 
                                    <li><a href="#video_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper"><i class="fa fa-video-camera"></i>Video</a></li>

                                 <?php endif; ?>    
                                </ul> 
                                <section class="post_content clearfix" itemprop="articleBody">
                                </section> <!-- end article section -->
                                <footer>
                                </footer> <!-- end article footer -->
                                </article> <!-- end article -->
                            </div>
                            <div class="col-md-5 column">
                                <div class="border col-md-12 column">
                                    <div class="row clearfix">
                                        <div class="col-md-12 column product-key-info">
                                            <address>
                                                <strong><?php echo esc_attr($props['kontaktperson|firma']) ?></strong><br>
                                                <?php echo esc_attr($props['kontaktperson|vorname']) ?>  <?php echo esc_attr($props['kontaktperson|name']) ?>
                                                <br><?php echo esc_attr($props['kontaktperson|hausnummer']) ?> <?php echo esc_attr($props['kontaktperson|strasse']) ?>
                                                <br><?php echo esc_attr($props['kontaktperson|ort']) ?> <?php echo esc_attr($props['kontaktperson|plz']) ?><br>
                                                <abbr title="Phone">Phone:</abbr> <?php echo esc_attr($props['kontaktperson|tel_durchw']) ?><br>
                                                <abbr title="Email">Email:</abbr> <?php echo esc_attr($props['kontaktperson|email_direkt']) ?>
                                            </address> 
                                            <span class="propertyListBoxDataItemName">
                                                <i class="fa fa-money"></i>
                                                <strong><?php _e("Purchase price:", "wpbootstrap"); ?></strong>
                                                <strong class="red">
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
                                                    <?php echo (int) $props['flaechen|anzahl_zimmer'] ?>
                                                </strong>
                                            </span>
                                            <a  href="#recomendModal" class="btn btn-lg bold btn-primary btn-block" data-toggle="modal"><?php _e("Recommend product", "wpbootstrap"); ?></a>


                            <?php endif; ?>
                        </ul>
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
                                    <strong><?php echo esc_attr($props['kontaktperson|firma']) ?></strong><br>
                                    <?php echo esc_attr($props['kontaktperson|vorname']) ?>  <?php echo esc_attr($props['kontaktperson|name']) ?>
                                    <br><?php echo esc_attr($props['kontaktperson|hausnummer']) ?> <?php echo esc_attr($props['kontaktperson|strasse']) ?>
                                    <br><?php echo esc_attr($props['kontaktperson|ort']) ?> <?php echo esc_attr($props['kontaktperson|plz']) ?><br>
                                    <abbr title="Phone">Phone:</abbr> <?php echo esc_attr($props['kontaktperson|tel_durchw']) ?><br>
                                    <abbr title="Email">Email:</abbr> <?php echo esc_attr($props['kontaktperson|email_direkt']) ?>
                                </address>
                                <span class="propertyListBoxDataItemName">
                                    <i class="fa fa-money"></i>
                                    <strong><?php _e("Purchase price:", "wpbootstrap"); ?></strong>
                                    <strong class="red">
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
                                        <?php echo (int) $props['flaechen|anzahl_zimmer'] ?>
                                    </strong>
                                </span>
                                <a  href="#recomendModal" class="btn btn-lg bold btn-primary btn-block" data-toggle="modal"><?php _e("Recommend product", "wpbootstrap"); ?></a>

                                <a href="/generate-pdf/product/<?php echo $post->ID ?>" class="blue clearfix printlink"><i class="fa fa-print"></i> <?php _e("Print presentation", "wpbootstrap"); ?></a>
                                <a href="#" class="blue clearfix printlink"><i class="fa fa-print"></i> <?php _e("Print reservation documents", "wpbootstrap"); ?></a>

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
                                <strong><?php _e("Type of property to search for:", "wpbootstrap"); ?></strong>
                            </li>
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
                                        echo esc_attr($props['preise|kaufpreis_pro_qm']) . ' ';
                                        echo esc_attr($props['preise|waehrung|iso_waehrung']);
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
                                <tbody>
                                    <?php
                                    $lang = qtrans_getLanguage();
                                    $flat_props = EstateProgram::get_flats_props_by_program($post->ID, $lang);
                                    ?>
                                    <?php
                                    $i = 0;
                                    if (!empty($flat_props)):
                                        foreach ($flat_props as $key => $val):
                                            $prop = unserialize($val->prop);
                                            ?>
                                            <tr class="<?php echo $i % 2 ? 'background' : 'no-background'; ?>">
                                                <td>
                                                    <a class="add-to-preference" data-toggle="modal"  data-flat_id="<?php echo $val->ID ?>" href="#myModal"><i class="fa <?php echo $val->is_favorite == 0 ? 'blue fa-star-o' : 'red fa-star' ?>"></i></a>
                                                </td>
                                                <td>
                                                    <?php echo esc_attr($prop['anbieternr']) ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo get_permalink($val->ID); ?>" class="blue"><?php echo esc_attr($prop['geo|strasse']) ?>, <?php echo esc_attr($prop['geo|ort']) ?>,  <?php echo esc_attr($prop['geo|plz']) ?> </a>
                                                </td>
                                                <td>
                                                    <?php echo esc_attr($prop['geo|wohnungsnr']) ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset(EstateProgram::$rental_status[$prop['verwaltung_objekt|vermietet']])) {
                                                        _e(EstateProgram::$rental_status[$prop['verwaltung_objekt|vermietet']]);
                                                    }
                                                    ?>
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
                                            $i++;
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
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
                                                            <?php echo esc_attr($prop['anbieternr']) ?>
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
        <!-- end #main -->
    </div> <!-- end #content -->
</div>

<script>
    jQuery(function() {
        jQuery('#recomend-form').submit(function(event) {

            jQuery('#recomend-form .form-response').html('').hide();

            var data = {
                'id': <?php echo $post->ID ?>,
                'receiver_email': jQuery('#receiver_email').val(),
                'receiver_message': jQuery('#receiver_message').val(),
                'action':'recommend_product'
            };

            jQuery.ajax({
                type: 'POST',
                cache: false,
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: data,
                beforeSend: function() {
                    jQuery('#recomend-form .form-response').html('').hide();                    
                },                
                success: function(response) {
                    jQuery('#recomend-form .form-response').show().html('<div class="alert alert-success"><?php _e('Your recommendation has been successfully sent') ?></div>');
                },
                error: function(response) {
                    jQuery('#recomend-form .form-response').show().html('<div class="alert alert-danger">' + response.responseText + '</div>');
                }
            });

            event.preventDefault();
        });
    });
</script>

<div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="recomendModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="recomend-form" method="post">
                <input type="hidden" name="action" value="recommend_product">
                <input type="hidden" name="id" value="<?php echo $post->ID ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php _e('Recommend this product', '') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-response display-none"></div>
                    <div class="form-group">
                        <label for="receiver_email"><?php _e('Receiver email:', 'wpbootstrap') ?></label>
                        <input type="text" class="form-control" value="" id="receiver_email" name="receiver_email">
                    </div>
                    <div class="form-group">
                        <label for="receiver_message"><?php _e('Message:', 'wpbootstrap') ?></label>
                        <textarea class="form-control" id="receiver_message" name="receiver_message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="send_recommendation" value="<?php _e('Send recommendation', 'wpbootstrap') ?>">
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
            zoom: 8,
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
    jQuery(document).ready(function($) {

        $(".test-popup-link").click(function(event) {

            $('.parent-container').magnificPopup({
                delegate: 'a', // child items selector, by clicking on it popup will open
                type: 'image',
                gallery: {enabled: true}
                // other options
            });
        });
    });
</script>
<?php get_footer(); ?>
