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
        <?php     
        include get_template_directory() . '/partial-search-form.php'; 
        ?>    
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
                <a href="#list"  data-toggle="tab" class="active blue"><i class="fa fa-list"></i></a> 
                <a href="#table" data-toggle="tab" class="red"><i class="fa fa-th"></i></a>
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
                                        $term = accomodationTypeL($prop); 
                                        if($term==""){ 
                                           $term = '-';   
                                        } 
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
                                    $pricem = (int)$pricem;
                                    $price = !empty($prop['preise|kaufpreis']) ? esc_attr($prop['preise|kaufpreis']) : 0;
                                    $price = (int)$price;
                                    $idval = (int)$val->ID;  
                                    $name = !empty($prop['freitexte|objekttitel']) ? esc_attr($prop['freitexte|objekttitel']) : "-";
                                    $flat_num = !empty($prop['geo|wohnungsnr']) ? esc_attr($prop['geo|wohnungsnr']) : "-";
                                    $rental_status = isset($prop['verwaltung_objekt|vermietet']) ? esc_attr($prop['verwaltung_objekt|vermietet']) : "free"; 
                                    if($rental_status == 1)
                                    { $rental_status = 'rented'; } 
                                    $status = isset($prop['zustand_angaben|verkaufstatus|stand']) ? esc_attr($prop['zustand_angaben|verkaufstatus|stand']) : "-";
                                    $reference = isset($prop['verwaltung_techn|objektnr_extern']) ? esc_attr($prop['verwaltung_techn|objektnr_extern']) : "-";                                                    
                                    $data_object.="{city:\"" . $city . "\",name:\"" . $name . "\", district:\"" . $district . "\", hnumber:" . $hnumber . ",  street:\"" . $street . "\", area:" . $area . ", zip:" . $zip . ", rooms:" . $rooms . ", flatnum:\"" . $flat_num . "\", references:\"" . $reference . "\",price: " . esc_attr($prop['preise|kaufpreis']) . ", fprice: \"" . esc_attr(price_format($prop['preise|kaufpreis'])) . "\" ,pricem: ".$pricem.", fpricem: \"" . price_format($pricem) . "\"  , url:\"" . $url . "\", image_url:  \"" . $url_image . "\", floor:" . $floor . ", rstatus: \"" .$rental_status."\", status: \"" .$status."\", favorite: \"" .$favor."\",type: \"" .$term."\", idval: ".$idval." },";
                                     
                                    if ($i < 10):
                                        ?>  
                                        <tr class="<?php echo $i % 2 ? 'background' : 'no-background'; ?> apartment-row-<?php echo $val->ID ?>">
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
                    ?>          
                    <?php include TEMPLATEPATH . '/row_row.php'; ?>  
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
        
        jQuery.get('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) { 
        jQuery('#district-list').append(response);       
        });                
        }
        
        else { 
        jQuery('#district-wrap-'+id).remove();
        }  
        });
        });
       
        function format(comma, period) {
        comma = comma || ',';
        period = period || '.';
        var split = this.toString().split('.');
        var numeric = split[0];
        var decimal = split.length > 1 ? period + split[1] : '';
        var reg = /(\d+)(\d{3})/;
  while (reg.test(numeric)) {
    numeric = numeric.replace(reg, '$1' + comma + '$2');
  }
  return numeric + decimal;
  } 
    jQuery('#Pricef').live('keyup', function(){
    jQuery(this).val(format.call(jQuery(this).val().split(' ').join(''),' ','.'));
    }); 
    jQuery('#Pricet').live('keyup', function(){
    jQuery(this).val(format.call(jQuery(this).val().split(' ').join(''),' ','.'));
    }); 
</script>  
<script>  
     var datatable = <?php echo $data_object; ?>;    
 
     var total_item = 0; 
     jQuery.each(datatable, function(i, val) {       
     total_item ++;  
     });    
     console.log(total_item);  
     var count = 10; 
     var load_next_item = true;  
      
     jQuery(document).ready(function() {  
        jQuery(window).scroll(function() {         
            if (count >= (total_item)) {
                return; 
            }  
            if (load_next_item && (jQuery(window).scrollTop() >= jQuery(document).height() - (jQuery(window).height() + 10))) {         
                var starter = count;
                count = count+10;   
                var ie = 0;   
                jQuery.each(datatable, function(i, val) {    
                if(ie > starter && ie <= count)
                {           
                if(val.status != 'OFFEN')
                {
                var stats = "<span class=\"green\">"+ val.status +"</span>";
                }    
                else
                {
                var stats ="";
                }  
                     
                var table_data = "<tr><td><a class=\"add-to-preference\" data-toggle=\"modal\"  data-flat_id=\""+val.idval+"\" href=\"#myModal\"><i class=\"fa "+val.favorite+"\"></i><span class=\"small-text hidden\"></span></a></td><td>"+val.references+"</td><td><a href=\"" + val.url + "\" class=\"blue\">" + val.street +" "+ val.hnumber  +",  "+ val.city +", "+ val.district +", " + val.zip + "</a></td><td>"+val.flatnum+"</td><td>"+val.rstatus+"</td><td>"+val.floor+"</td><td>"+val.rooms+"</td><td>"+val.area+"</td><td>"+val.fprice+" &euro;</td><td>"+val.fpricem+" &euro;</td><td></td><td>"+val.status+"</td></tr>"; 
                 
                    jQuery("tbody").append(table_data);
                    jQuery("table").trigger("update");     
                    jQuery("table").tablesorter();  
                
                var row_data = "<div class=\"row\"><div class=\"col-md-12 flats_box\"><div class=\"col-md-3\">"+ stats +"<a href=\"" + val.url + "\"><img src=\""+val.image_url+"\" class=\"img-responsive\" /></a></div><div class=\"col-md-9\"> <h4 class=\"blue\"><a href=\"" + val.url + "\">"+val.name+"<small class=\"clearfix\"><i class=\"red fa fa-map-marker\"></i> " + val.street +" "+ val.hnumber +", "+ val.city +", "+ val.district +", " + val.zip + "</small></a></h4><div class=\"row\"><div class=\"col-md-3\"><span class=\"data_item clearfix\"><strong><?php _e("Ref.:", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.references+"</span></span><span class=\"data_item clearfix\"><strong><?php _e("Flat n°:", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.flatnum+"</span></span><span class=\"data_item clearfix\"><strong><?php _e("Rental status: ", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.rstatus+"</span></span></div><div class=\"col-md-3\"><span class=\"data_item clearfix\"> <strong><?php _e("Floor:", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.floor+"</span></span><span class=\"data_item clearfix\"><strong><?php _e("Rooms:  ", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.rooms+"</span></span><span class=\"data_item clearfix\"><strong><?php _e("Surface:  ", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.area+" m²</span></span></div><div class=\"col-md-3\"> <span class=\"data_item clearfix\"><strong><?php _e("Price:", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.fprice+" &euro; </span></span><span class=\"data_item clearfix\"><strong><?php _e("Price/m2:", "wpbootstrap"); ?></strong><span class=\"pull-right\"> "+val.fpricem+" €/m²</span></span><span class=\"data_item clearfix\"><strong><?php _e("Yield:", "wpbootstrap"); ?></strong></span></div><div class=\"col-md-3\"><a class=\"add-to-preference pull-right\" href=\"#myModal\" data-flat_id=\" "+val.idval+"\" data-toggle=\"modal\"><strong class=\"blue clearfix\"><i class=\"fa "+val.favorite+"\"></i><span class=\"fav-label\">Add to favorite</span></strong></a><a href=\"" + val.url + "\" class=\"pull-right\"><?php _e("VIEW DETAILS:", "wpbootstrap"); ?></a></div></div></div></div></div>"; 
                
                jQuery("#list").append(row_data);  
                }
                 ie++; 
            });     
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
         
        var checkedtype='';     
        var helpert = [];
        jQuery('.type-checkbox:checked').each(function(){ 
        helpert.push(jQuery(this).val()); 
        // checkedcities=checkedcities+','+jQuery(this).val();    
        }); 
        //magic - refactoring needed !!!     
        checkedtype = '"' + helpert.join('","') + '"';
        checkedtype = checkedtype.substring(1, checkedtype.length - 1); 
        //uppercase sensitive
   
        values.References = values.References.toUpperCase();   
        
        var fcity = checkedcitiesf; 
        var fdistrict = checkeddistrict; 
        var ftype = checkedtype;  
        
        var freferences = values.References;   
        var fareaf = values.Areaf;   
        var fareat = values.Areat;  
        var froomsf = values.Roomsf;
        var froomst = values.Roomst;  
        var fpricef = values.Pricef;
        var fpricet = values.Pricet;               
        var fpricef = fpricef.replace(/\s+/g, '');
        var fpricet = fpricet.replace(/\s+/g, ''); 
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
                var i =0; 
                var output_set;  
                var type_filter = PourOver.makeExactFilter("type", helpert);        
                collection.addFilters([type_filter]);  
                jQuery('.type-checkbox:checked').each(function() {
                var typefilter = jQuery(this).val();   
                var typess = collection.filters.type.getFn(typefilter);  
                if (i == 0)
                {  
                output_set = typess; 
                }
                else
                {       
                output_set = output_set.or(typess); 
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
            jQuery("#list").empty(); 
            var table_data = "<tr><td><h1> NO RESULT FOUND </h1></td></tr>";
            var row_data = "<div class=\"row\"><div class=\"col-md-12 flats_box\"><h1>NO RESULT FOUND</h1></div></div>";            
            jQuery("tbody").append(table_data); 
            jQuery("#list").append(row_data);  
        }
        else
        { 
            jQuery("#table_data_filter").empty(); 
            jQuery("#list").empty();
            
            jQuery.each(myfilterfinal, function(i, val) { 
             
            if(val.status != 'OFFEN')
            {
              var stats = "<span class=\"green\">"+ val.status +"</span>";
            }    
            else
            {
             var stats ="";
            }    
  
            var table_data = "<tr><td><a class=\"add-to-preference\" data-toggle=\"modal\"  data-flat_id=\""+val.idval+"\" href=\"#myModal\"><i class=\"fa "+val.favorite+"\"></i><span class=\"small-text hidden\"></span></a></td><td>"+val.references+"</td><td><a href=\"" + val.url + "\" class=\"blue\">" + val.street +" "+ val.hnumber  +",  "+ val.city +", "+ val.district +", " + val.zip + "</a></td><td>"+val.flatnum+"</td><td>"+val.rstatus+"</td><td>"+val.floor+"</td><td>"+val.rooms+"</td><td>"+val.area+"</td><td>"+val.fprice+" &euro;</td><td>"+val.fpricem+" &euro;</td><td></td><td>"+val.status+"</td></tr>"; 
              
            jQuery("tbody").append(table_data);
            jQuery("table").trigger("update");     
            jQuery("table").tablesorter();  
 
            var row_data = "<div class=\"row\"><div class=\"col-md-12 flats_box\"><div class=\"col-md-3\"> "+ stats +" <a href=\"" + val.url + "\"><img src=\""+val.image_url+"\" class=\"img-responsive\" /></a></div><div class=\"col-md-9\"> <h4 class=\"blue\"><a href=\"" + val.url + "\">"+val.name+"<small class=\"clearfix\"><i class=\"red fa fa-map-marker\"></i> " + val.street +" "+ val.hnumber +", "+ val.city +", "+ val.district +", " + val.zip + "</small></a></h4><div class=\"row\"><div class=\"col-md-3\"><span class=\"data_item clearfix\"><strong><?php _e("Ref.:", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.references+"</span></span><span class=\"data_item clearfix\"><strong><?php _e("Flat n°:", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.flatnum+"</span></span><span class=\"data_item clearfix\"><strong><?php _e("Rental status: ", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.rstatus+"</span></span></div><div class=\"col-md-3\"><span class=\"data_item clearfix\"> <strong><?php _e("Floor:", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.floor+"</span></span><span class=\"data_item clearfix\"><strong><?php _e("Rooms:  ", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.rooms+"</span></span><span class=\"data_item clearfix\"><strong><?php _e("Surface:  ", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.area+" m²</span></span></div><div class=\"col-md-3\"> <span class=\"data_item clearfix\"><strong><?php _e("Price:", "wpbootstrap"); ?></strong><span class=\"pull-right\">"+val.fprice+" &euro; </span></span><span class=\"data_item clearfix\"><strong><?php _e("Price/m2:", "wpbootstrap"); ?></strong><span class=\"pull-right\"> "+val.fpricem+" €/m²</span></span><span class=\"data_item clearfix\"><strong><?php _e("Yield:", "wpbootstrap"); ?></strong></span></div><div class=\"col-md-3\"><a class=\"add-to-preference pull-right\" href=\"#myModal\" data-flat_id=\" "+val.idval+"\" data-toggle=\"modal\"><strong class=\"blue clearfix\"><i class=\"fa "+val.favorite+"\"></i><span class=\"fav-label\">Add to favorite</span></strong></a><a href=\"" + val.url + "\" class=\"pull-right\"><?php _e("VIEW DETAILS:", "wpbootstrap"); ?></a></div></div></div></div></div>"; 
            jQuery("#list").append(row_data);      
        });
        }
        });   
</script>    
<script>   
jQuery(document).ready(function(n){n(".searchbutton").fadeIn("fast",function(){})});      
</script>  
<?php get_footer(); ?> 
