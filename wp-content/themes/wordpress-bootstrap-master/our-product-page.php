<?php
/*
  Template Name: Search Page
 */
?> 
<?php 
redirect_if_cannot_see_detail();
get_header(); 
?>
 
<div class="container">
    <div id="content" class="clearfix row">
        <div class="col-sm-12 clearfix" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                        <header> 
                            <div class="page-header"><h1 class="page-title border-left uppercase" itemprop="headline"><?php the_title(); ?></h1>
                                <h2><small><?php _e("Select a property type and start your search.", "wpbootstrap"); ?></small></h2>
                            </div>
                        </header> <!-- end article header --> 
                    </article> <!-- end article --> 
                <?php endwhile; ?> 
            <?php else : ?>
                <article id="post-not-found">
                    <header>
                        <h1><?php _e("Not Found", "wpbootstrap"); ?><small></small></h1>
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
    <div class="row clearfix">
        <div class="col-md-12 column">         
            <form role="form" class="border background clearfix searchform col-md-12">
                <div class="col-md-6 column">
                    <div class="form-group"> 
                        <label for="City"><?php _e("City:", "wpbootstrap"); ?></label>
                        <div class="row"> 
                            <div class="col-md-12">
                            <!-- cities from taxonomy -->                    
                            <?php
                            $args = array(
                                'taxonomy' => 'location',
                                'hide_empty' => true,
                                'parent' => 0
                            );
                            $cities = get_categories($args);
                            foreach ($cities as $key => $value):                                  
                                ?>  
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox-<?php echo $value->name; ?>" name="cities" data-myAttri="<?php _e($value->term_id); ?>" class="city-checkbox" value="<?php _e($value->name); ?>"><?php _e($value->name); ?>
                                </label>
                            <?php endforeach; ?>
                            <!-- /cities from taxonomy -->
                        </div>
                        </div>                
                    </div>
                     <div class="form-group"> 
                        <label><?php _e("Disctrict:", "wpbootstrap"); ?></label>
                        <div id="district-list"></div>
                        <!--<label for="Disctrict"></label><input name="Disctrict" class="form-control input-lg" id="Disctrict" type="text" placeholder="Disctrict:"/>-->
                        <!-- district from ajax --> 
                        <!-- /district from ajax -->
                    </div>
   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Pricef"><?php _e("Price from:", "wpbootstrap"); ?></label><input name="Pricef" class="form-control input-lg" id="Pricef" type="text" placeholder="Price from:" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Pricet"><?php _e("Price to:", "wpbootstrap"); ?></label><input  name="Pricet" class="form-control input-lg" id="Pricet" type="text" placeholder="Price to:" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="References"><?php _e("References:", "wpbootstrap"); ?></label><input name="References" class="form-control input-lg" id="References" type="text" placeholder="References:" />
                    </div>
                </div>
                <div class="col-md-6 column">
                       <div class="form-group">  
                        <label for="accommodation"><?php _e("Type of accommodation::", "wpbootstrap"); ?></label>
                        <?php
                        $args = array(
                            'taxonomy' => 'type_of_accommodation',
                            'hide_empty' => false
                        );
                        $accomodion_types = get_categories($args);
                        ?>
                        <select class="form-control input-lg" name="type" >
                            <option value="">---</option>
                            <?php foreach ($accomodion_types as $type): ?>
                                <option class="" value="<?php echo $type->name; ?>"><?php _e($type->name) ?></option>
                            <?php endforeach; ?>
                        </select> 
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Areaf"><?php _e("Area from (m2):", "wpbootstrap"); ?></label><input name="Areaf" class="form-control input-lg" id="Areaf" type="text" placeholder="Area from:" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Areat"><?php _e("Area to (m2):", "wpbootstrap"); ?></label><input name="Areat" class="form-control input-lg" id="Areat" type="text" placeholder="Area to:" />
                        </div>
                    </div>      
                    <div class="row">    
                        <div class="form-group col-md-6">
                            <label for="Roomsf"><?php _e("Rooms from:", "wpbootstrap"); ?></label> 
                            <select class="form-control input-lg" name="Roomsf" > 
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option> 
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option> 
                            </select>     
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="Roomst"><?php _e("Rooms to:", "wpbootstrap"); ?></label>
                            <select class="form-control input-lg" name="Roomst" > 
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option> 
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>    
                        </div> 
                        <div class="form-group col-md-6 col-md-offset-6">  
                            <button type="submit" class="btn btn-primary btn-lg btn-block searchbutton margin-button"><i class="fa fa-search"></i><?php _e("Search", "wpbootstrap"); ?></button>
                        </div>   
                    </div>       
                </div>
            </form>
        </div>
    </div> 
    <div class="row">
        <!-- all product -->
        <div class="col-md-6">
            <h3 class="border-left inline uppercase">
                <?php _e("All products", "wpbootstrap"); ?>
            </h3>
        </div>
        <div class="col-md-3 hidden">
            <select name="sort_by_list" class="form-control input-lg">
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
            </select>
        </div>
        <div class="col-md-3 pull-right big_icons margin-top">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs"> 
                <a href="#table" data-toggle="tab" class="red"><i class="fa fa-th"></i></a>
                <a href="#list"  data-toggle="tab" class="active blue"><i class="fa fa-list"></i></a> 
            </ul> 
        </div>
        <div class="col-md-12 column margin-top">
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
                        <tbody id="table_data_filter">    
                            <?php
                            $lang = qtrans_getLanguage();
                            $flat_props = EstateProgram::get_all_flats($post->ID, $lang);
                            $i = 0;
                            $data_object = '';
                            if (!empty($flat_props)):
                                foreach ($flat_props as $key => $val):
                                    $prop = unserialize($val->prop);
                                  
                                    //$url_image = wp_get_attachment_url(get_post_thumbnail_id($val->ID, '')); 
                                        if ( $val->is_favorite == 0 )
                                        {
                                        $favor = "blue fa-star-o";
                                        }
                                        else {
                                        $favor = "red fa-star"; 
                                        } 
                                        $program_id = $val->program_id;
                                        $terms = wp_get_post_terms($program_id, 'type_of_accommodation'); 
                                        if(!empty($terms)){ 
                                        $term = $terms[0]->name;
                                        }
                     
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
                                    $pricem = (int)$pricem;
                                    $price = !empty($prop['preise|kaufpreis']) ? esc_attr($prop['preise|kaufpreis']) : 0;
                                    $price = (int)$price;
                                    $idval = (int)$val->ID;  
                                    $name = !empty($prop['freitexte|objekttitel']) ? esc_attr($prop['freitexte|objekttitel']) : "-";
                                    $flat_num = !empty($prop['geo|wohnungsnr']) ? esc_attr($prop['geo|wohnungsnr']) : 0;
                                    $rental_status = isset($prop['verwaltung_objekt|vermietet']) ? esc_attr($prop['verwaltung_objekt|vermietet']) : "free"; 
                                    if($rental_status == 1)
                                    { $rental_status = 'rented'; } 
                                    $status = isset($prop['zustand_angaben|verkaufstatus|stand']) ? esc_attr($prop['zustand_angaben|verkaufstatus|stand']) : "-";
                                    $reference = isset($prop['verwaltung_techn|objektnr_extern']) ? esc_attr($prop['verwaltung_techn|objektnr_extern']) : "-";  
                                    $data_object.="{city:\"" . $city . "\",name:\"" . $name . "\", district:\"" . $district . "\", hnumber:" . $hnumber . ",  street:\"" . $street . "\", area:" . $area . ", zip:" . $zip . ", rooms:" . $rooms . ", flatnum:" . $flat_num . ", references:\"" . $reference . "\",price: " . esc_attr($prop['preise|kaufpreis']) . ", fprice: \"" . esc_attr(price_format($prop['preise|kaufpreis'])) . "\" ,pricem: ".$pricem.", fpricem: \"" . price_format($pricem) . "\"  , url:\"" . $url . "\", image_url:  \"" . $url_image . "\", floor:" . $floor . ", rstatus: \"" .$rental_status."\", status: \"" .$status."\", favorite: \"" .$favor."\",type: \"" .$term."\", idval: ".$idval." },";
               

                                    if ($i < 10):
                                        ?>  
                                        <tr class="<?php echo $i % 2 ? 'background' : 'no-background'; ?>">
                                            <td>   
                                                <a class="add-to-preference" data-toggle="modal"  data-flat_id="<?php echo $val->ID ?>" href="#myModal">
                                                    <i class="fa <?php echo $val->is_favorite == 0 ? 'blue fa-star-o' : 'red fa-star' ?>"></i>
                                                    <span class="small-text hidden"><?php echo $val->is_favorite; ?></span>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $reference; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $url; ?>" class="blue"><?php echo $street; ?> <?php echo $hnumber; ?> , <?php echo $city; ?>, <?php echo $district; ?> <?php echo $zip; ?> </a>
                                            </td>
                                            <td>
                                                <?php echo $flat_num; ?>       
                                            </td>
                                            <td>
                                                <?php echo $rental_status; ?> 
                                            </td>
                                            <td>
                                                <?php echo $floor; ?>          
                                            </td>
                                            <td>
                                                <?php echo (int) $rooms; ?>
                                            </td>
                                            <td>
                                                <?php echo $area; ?>
                                            </td>
                                            <td>
                                                <?php echo price_format($price) ?> &euro;
                                            </td>
                                            <td>
                                                <?php echo price_format($pricem) ?> &euro;
                                            </td>
                                            <td>   
                                                    
                                            </td>
                                            <td>
                                                <?php echo $status; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    endif;
                                    $i++;
                                endforeach;
                            endif;
                            $data_object = substr("$data_object", 0, -1);
                            $data_object = "[" . $data_object . "]";
                            ?>   
                        </tbody>                  
                    </table>  
                </div>    
                <div class="col-md-12 column border tab-pane active" id="list">     
                    <?php
                    $lang = qtrans_getLanguage();
                    $flat_props = EstateProgram::get_all_flats($post->ID, $lang, 0, 10);
                    $i = 0;
                    if (!empty($flat_props)):
                        foreach ($flat_props as $key => $val):  
                            $prop = unserialize($val->prop);
                      
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
                            $rental_status = isset($prop['verwaltung_objekt|vermietet']) ? esc_attr($prop['verwaltung_objekt|vermietet']) : "-"; 
                            $flat_num = !empty($prop['geo|wohnungsnr']) ? esc_attr($prop['geo|wohnungsnr']) : 0;       
                            //$elevator = !empty($prop['vermietet']) ? esc_attr($prop['vermietet']) : "-"; 
                            if ($i < 10):
                            ?> 
                            <div class="row">
                                <div class="col-md-12 <?php echo $i % 2 ? 'background' : 'no-background'; ?> flats_box"> 
                                    <div class="col-md-3">  
                                        <a href="<?php echo $url; ?>"><img src="<?php echo $url_image; ?>" class="img-responsive" alt="<?php echo $name; ?>"/></a>    
                                    </div>    
                                    <div class="col-md-9"> 
                                        <h4 class="blue"><a href="<?php echo $url; ?>"><?php echo $name; ?><small class="clearfix"><i class="red fa fa-map-marker"></i>  
                                                    <?php echo $street; ?> <?php echo $hnumber; ?> , <?php echo $city; ?>, <?php echo $district; ?> <?php echo $zip; ?></small></a></h4>

                                        <div class="row">
                                            <div class="col-md-3">  
                                                <span class="data_item clearfix">
                                                    <strong><?php _e("Prg. ref.:", "wpbootstrap"); ?></strong> 
                                                    <?php echo esc_attr($prop['verwaltung_techn|objektnr_extern']) ?>
                                                </span>                         
                                                <span class="data_item clearfix">
                                                    <strong><?php _e("Flat n°:", "wpbootstrap"); ?></strong> 
                                                    <?php echo $flat_num; ?>
                                                </span>
                                                <span class="data_item clearfix">
                                                    <strong><?php _e("Rental status: ", "wpbootstrap"); ?></strong> 
                                                    <?php echo $rental_status; ?>
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
                                                    <?php echo price_format($price); ?> &euro;
                                                </span>
                                                <span class="data_item clearfix">
                                                    <strong><?php _e("Price/m2:", "wpbootstrap"); ?></strong> 
                                                    <span class="pull">
                                                    <?php echo price_format($pricem); ?> &euro;
                                                    </span>
                                                </span>
                                                <span class="data_item clearfix">
                                                    <strong><?php _e("Yield:", "wpbootstrap"); ?></strong>  
                                                </span>
                                            </div> 
                                            <div class="col-md-3"> 
                                                <a class="add-to-preference pull-right" href="#myModal" data-flat_id="<?php echo $val->ID; ?>" data-toggle="modal">
                                                    <strong class="blue clearfix"><i class="fa <?php echo EstateProgram::is_user_favorite($val->ID) ? 'red fa-star' : 'blue fa-star-o' ?>"></i>
                                                        <span class="fav-label"><?php echo EstateProgram::is_user_favorite($val->ID) ? 'Added to favorites' : 'Add to favorite' ?></span>
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
                            endif; 
                        endforeach;
                    endif;
                    ?>  
                </div>   
            </div>
        </div>
    </div>
    <!-- /all product --> 
</div> 
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
<script>
  
      jQuery(function() {
        jQuery('.city-checkbox').click(function() { 
            
        var id = jQuery(this).attr("data-myAttri");      
        if(jQuery(this).is(':checked')){   
             
        var data = {       
         'action':'get_district', 
         'id':+id 
        }; 
        
        jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) { 
        jQuery('#district-list').append(response);       
        });                
        }   
        else { 
        jQuery('#district-wrap-'+id).remove();
        }
        });
        });
 
</script> 
<script src="<?php bloginfo('template_directory'); ?>/library/js/underscore-min.js"></script>      
<script src="<?php bloginfo('template_directory'); ?>/library/js/pourover.js"></script> 
<script> 
        var datatable = <?php echo $data_object; ?>;
        var collection = new PourOver.Collection(datatable);
  
        jQuery("form").on("submit", function(event) { 
        event.preventDefault();   
        var values = {}; 
        jQuery.each(jQuery('form').serializeArray(), function(i, field) { 
            values[field.name] = field.value; 
        });  
        var checkedcities='';     
        var helper = []; 
        var i =0; 
        var city="";  
        jQuery('.city-checkbox:checked').each(function() { 
        cityfilter = jQuery(this).val();   
        helper.push(jQuery(this).val()); 
        }); 
        checkedcities = '"'+helper.join('","')+'"';          
        var checkedcitiesf = checkedcities.substring(1, checkedcities.length-1); 
        var checkeddistrict='';     
        var helperd = [];
        jQuery('.district-checkbox:checked').each(function(){ 
                helperd.push(jQuery(this).val()); 
               // checkedcities=checkedcities+','+jQuery(this).val();    
        });           
        //magic - refactoring needed !!!     
        checkeddistrict = '"' + helperd.join('","') + '"';
        checkeddistrict = checkeddistrict.substring(1, checkeddistrict.length - 1); 
        //uppercase sensitive
        values.References = values.References.toUpperCase();   
        var fcity = checkedcitiesf; 
        var fdistrict = checkeddistrict; 
        var ftype = values.type;              
        var freferences = values.References;   
        var fareaf = values.Areaf;   
        var fareat = values.Areat;  
        var froomsf = values.Roomsf;
        var froomst = values.Roomst; 
        var fpricef = values.Pricef;
        var fpricet = values.Pricet;              
        //make a filter  
        var finalfilter = false;
        
        if (fcity != '')
        { 
                var i =0; 
                var output_set;  
                var city_filter = PourOver.makeExactFilter("city", helper);        
                collection.addFilters([city_filter]);  
                jQuery('.city-checkbox:checked').each(function() {
                var cityfilter = jQuery(this).val();   
                var citys = collection.filters.city.getFn(cityfilter);  
                if (i == 0)
                {  
                output_set = citys; 
                }
                else
                {       
                output_set = output_set.or(citys); 
                } 
                i++;
                });
                finalfilter = output_set;
        } 
         if (fdistrict != '')
        {  
                var i =0; 
                var output_set;  
                var district_filter = PourOver.makeExactFilter("district", helperd);        
                
                collection.addFilters([district_filter]);  
                
                jQuery('.district-checkbox:checked').each(function() {
                var districtfilter = jQuery(this).val();   
                var districtss = collection.filters.district.getFn(districtfilter);  
                if (i == 0)
                {  
                output_set = districtss; 
                }
                else
                {       
                output_set = output_set.or(districtss); 
                } 
                i++;
                });
                finaloutput = output_set;
                if (finalfilter != false)
                {
                finalfilter = finalfilter.and(finaloutput);
                }
                else
                {
                finalfilter = finaloutput;
                }
            } 
        if (ftype != '')
        {
            var type_filter = PourOver.makeExactFilter("type", [ftype]);
            collection.addFilters([type_filter]);

            if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.type.getFn(ftype));
            }
            else
            {
                finalfilter = collection.filters.type.getFn(ftype);
            }
            //var type_f = collection.filters.type.getFn(ftype);   
        }
        if (freferences != '')
        {
            var references_filter = PourOver.makeExactFilter("references", [freferences]);
            collection.addFilters([references_filter]);

            if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.references.getFn(freferences));
            }
            else
            {
                finalfilter = collection.filters.references.getFn(freferences);
            } 
            // var references_f = collection.filters.references.getFn(freferences);  
        } 
        if (fpricef != '' && fpricet == '')
        {
            var price_range_filter = PourOver.makeRangeFilter("price_range", [[fpricef, 100000000]], {attr: "price"});
            collection.addFilters([price_range_filter]);
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
            if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.price_range.getFn([fpricef, 100000000]));
            }
            else
            {
                finalfilter = collection.filters.price_range.getFn([fpricef, 100000000]);
            }
        }
        else if (fpricef == '' && fpricet != '')
        {
            var price_range_filter = PourOver.makeRangeFilter("price_range", [[1, fpricet]], {attr: "price"});
            collection.addFilters([price_range_filter]);
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
            if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.price_range.getFn([1, fpricet]));
            }
            else
            {
                finalfilter = collection.filters.price_range.getFn([1, fpricet]);
            }
        }
        else if (fpricef != '' || fpricet != '')
        {
            var price_range_filter = PourOver.makeRangeFilter("price_range", [[fpricef, fpricet]], {attr: "price"});

            collection.addFilters([price_range_filter]);
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
            if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.price_range.getFn([fpricef, fpricet]));
            }
            else
            {
                finalfilter = collection.filters.price_range.getFn([fpricef, fpricet]);
            }
        }
        if (fareaf != '' || fareat != '')
        {
            var area_range_filter = PourOver.makeRangeFilter("area_range", [[fareaf, fareat]], {attr: "area"});
            collection.addFilters([area_range_filter]);
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
            if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.area_range.getFn([fareaf, fareat]));
            }
            else
            {
                finalfilter = collection.filters.area_range.getFn([fareaf, fareat]);
            }
        }
        else if (fareaf == '' && fareat != '')
        {
            var area_range_filter = PourOver.makeRangeFilter("area_range", [[0, fareat]], {attr: "area"});
            collection.addFilters([area_range_filter]);
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
            if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.area_range.getFn([0, fareat]));
            }
            else
            {
                finalfilter = collection.filters.area_range.getFn([0, fareat]);
            }
        }
        else if (fareaf != '' && fareat == '')
        {
            var area_range_filter = PourOver.makeRangeFilter("area_range", [[fareaf, 999]], {attr: "area"});
            collection.addFilters([area_range_filter]);
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
            if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.area_range.getFn([fareaf, 999]));
            }
            else
            {
                finalfilter = collection.filters.area_range.getFn([fareaf, 999]);
            }
        }
        //ROOMS     
        if (froomsf != '' || froomst != '')
        {
            var rooms_range_filter = PourOver.makeRangeFilter("rooms_range", [[froomsf, froomst]], {attr: "rooms"}); 
            collection.addFilters([rooms_range_filter]); 
        if (finalfilter != false)
            {
                finalfilter = finalfilter.and(collection.filters.rooms_range.getFn([froomsf, froomst]));
            } 
        else
            {
                finalfilter = collection.filters.rooms_range.getFn([froomsf, froomst]);
            } 
        }   
        // var group_filter = city_f.and(price_range_f);  
        var myfilterfinal = collection.get(finalfilter.cids); 
        console.log(myfilterfinal);  
        if (jQuery.isEmptyObject(myfilterfinal))
        {
            jQuery("#table_data_filter").empty(); 
            var table_data = "<tr><td><h1> NO RESULT FOUND </h1></td></tr>";
            jQuery("tbody").append(table_data); 
        }
        else
        {
            jQuery("#table_data_filter").empty();
            jQuery.each(myfilterfinal, function(i, val) {

                /*    area
                 54.6 
                 cid
                 3 
                 city
                 "Berlin"                 
                 street  

                 district
                 "Mitte"
                 floor
                 1
                 
                 hnumber
                 26
                 
                 image_url
                 "http://www.adenimmo.loc.../2014/05/Foto_18294.jpg"
                 
                 price
                 234000 
                 references
                 5382 
                 rooms
                 2
                 rstatus 
                 pricem 
                 url
                 "http://www.adenimmo.loc...eart-of-berlin-mitte-4/"
                 
                 zip*/
                var table_data = "<tr><td><a class=\"add-to-preference\" data-toggle=\"modal\"  data-flat_id=\""+val.idval+"\" href=\"#myModal\"><i class=\"fa "+val.favorite+"\"></i><span class=\"small-text hidden\"></span></a></td><td>"+val.references+"</td><td><a href=\"" + val.url + "\" class=\"blue\">" + val.street +" "+ val.hnumber  +", "+ val.district +", "+ val.city +", " + val.zip + "</a></td><td>"+val.flatnum+"</td><td>"+val.rstatus+"</td><td>"+val.floor+"</td><td>"+val.rooms+"</td><td>"+val.area+"</td><td>"+val.fprice+"&euro;</td><td>"+val.fpricem+"&euro;</td><td></td><td>"+val.status+"</td></tr>";
                jQuery("tbody").append(table_data);
                jQuery("table").trigger("update");     
                jQuery("table").tablesorter(); 
 
                /*var row_data = "<div class=\"row\"><div class=\"col-md-12\" ?> flats_box"> ;
     
                
                
                
                
                
                
                          
          
                */
                //doplnit druhou tabulku 
            });
        }  
        });
</script>    
<script>   
    jQuery(document).ready(function($) { 
        $( ".searchbutton" ).fadeIn( "fast", function() { 
        });
    });       
</script> 
<script type="text/javascript">
    //strankovani
    jQuery(document).ready(function($) {
        var count = 2;
        $(window).scroll(function() {
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                loadArticle(count);
                count++;
            }
        });
        function loadArticle(pageNumber) {
            $('a#inifiniteLoader').show('fast');
            $.ajax({
                url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                type: 'POST',
                data: "action=infinite_scroll&page_no=" + pageNumber + '&loop_file=loop',
                success: function(html) {
                    $('a#inifiniteLoader').hide('1000');
                    $("#content").append(html);    // This will be the div where our content will be loaded
                }
            });
            return false;
        }
    });
</script>
<?php get_footer(); ?>
