<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$i = 0;
if (!empty($flat_props)):
    foreach ($flat_props as $key => $val):
        $prop = unserialize($val->prop);
        $key = unserialize($key);
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($val->ID), 'flat-small');
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
        $rental_status = isset($prop['verwaltung_objekt|vermietet']) ? esc_attr($prop['verwaltung_objekt|vermietet']) : "free";
        if ($rental_status == 1) {
            $rental_status = 'rented';
        }
        //$status = isset($prop['zustand_angaben|verkaufstatus|stand']) ? esc_attr($prop['zustand_angaben|verkaufstatus|stand']) : "-";  

        $status_raw = isset($prop['zustand_angaben|verkaufstatus|stand']) ? esc_attr($prop['zustand_angaben|verkaufstatus|stand']) : "-";

        $status = statusL($prop);
        $flat_num = !empty($prop['geo|wohnungsnr']) ? esc_attr($prop['geo|wohnungsnr']) : "-";
        //$elevator = !empty($prop['vermietet']) ? esc_attr($prop['vermietet']) : "-"; 
        ?> 
        <div class="row apartment-row apartment-row-<?php echo $val->ID ?>">
            <div class="col-md-12 <?php echo $i % 2 ? 'background' : 'no-background'; ?> flats_box"> 
                <div class="col-md-3">   

                    <?php if ($status_raw != 'OFFEN'): ?>
                        <span class="green"><?php echo $status; ?></span>  
                    <?php endif; ?>

                    <a href="<?php echo $url; ?>"><img src="<?php echo $url_image; ?>" class="img-responsive" alt="<?php echo $name; ?>"/></a>    
                </div>    
                <div class="col-md-9"> 
                    <h4 class="blue"><a href="<?php echo $url; ?>"><?php echo $name; ?><small class="clearfix"><i class="red fa fa-map-marker"></i>  
                                <?php echo $street; ?> <?php echo $hnumber; ?>, <?php echo $city; ?>, <?php echo $district; ?>, <?php echo $zip; ?></small></a></h4>
                    <div class="row">
                        <div class="col-md-3">  
                            <span class="data_item clearfix">
                                <strong><?php _e("Ref.:", "wpbootstrap"); ?></strong> 
                                <span class="pull-right">
                                    <?php echo esc_attr($prop['verwaltung_techn|objektnr_extern']) ?>
                                </span>    
                            </span>                         
                            <span class="data_item clearfix">
                                <strong><?php _e("Flat n°:", "wpbootstrap"); ?></strong> 
                                <span class="pull-right">
                                    <?php echo $flat_num; ?>
                                </span>        
                            </span>
                            <span class="data_item clearfix">
                                <strong><?php _e("Rental status: ", "wpbootstrap"); ?></strong> 
                                <span class="pull-right">
                                    <?php echo $rental_status; ?>
                                </span>    
                            </span> 
                        </div>
                        <div class="col-md-3"> 
                            <span class="data_item clearfix">
                                <strong><?php _e("Floor:", "wpbootstrap"); ?></strong> 
                                <span class="pull-right">
                                    <?php echo $floor; ?>
                                </span>    
                            </span>
                            <span class="data_item clearfix">
                                <strong><?php _e("Rooms:  ", "wpbootstrap"); ?></strong> 
                                <span class="pull-right">
                                    <?php echo (int) $rooms; ?>
                                </span>    
                            </span>
                            <span class="data_item clearfix">
                                <strong><?php _e("Surface:  ", "wpbootstrap"); ?></strong> 
                                <span class="pull-right"> 
                                    <?php echo $area; ?> m²
                                </span>     
                            </span>
                        </div>
                        <div class="col-md-3"> 
                            <span class="data_item clearfix">
                                <strong><?php _e("Price:", "wpbootstrap"); ?></strong> 
                                <span class="pull-right"> 
                                    <?php echo price_format($price) ?> &euro;
                                </span>    
                            </span>
                            <span class="data_item clearfix">
                                <strong><?php _e("Price/m2:", "wpbootstrap"); ?></strong> 
                                <span class="pull-right"> 
                                    <?php echo price_format($pricem) ?> €/m²
                                </span>
                            </span>
                            <span class="data_item clearfix">
                                <strong><?php _e("Yield:", "wpbootstrap"); ?></strong>  
                            </span>
                        </div> 
                        <div class="col-md-3"> 
                            <a class="add-to-preference pull-right" href="#myModal" data-flat_id="<?php echo $val->ID; ?>" data-toggle="modal">
                                <strong class="blue clearfix  bigger-text"><i class="fa <?php echo EstateProgram::is_user_favorite($val->ID) ? 'red fa-star' : 'blue fa-star-o' ?>"></i>
                                    <span class="fav-label"><?php echo EstateProgram::is_user_favorite($val->ID) ? __("Added to favorites", "wpbootstrap") : __("Add to favorite", "wpbootstrap") ?></span>
                                </strong>    
                            </a>   
                            <a href="<?php echo $url; ?>" class="pull-right"><?php _e("VIEW DETAILS:", "wpbootstrap"); ?></a>     
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
