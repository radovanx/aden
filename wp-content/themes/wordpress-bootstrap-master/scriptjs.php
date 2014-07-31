<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script src="<?php bloginfo('template_directory'); ?>/library/js/underscore-min.js"></script>      
<script src="<?php bloginfo('template_directory'); ?>/library/js/pourover.js"></script> 
<script>
   jQuery(function(){jQuery(".city-checkbox").click(function(){var a=jQuery(this).attr("data-myAttri");jQuery(this).is(":checked")?jQuery.get('<?php echo admin_url("admin-ajax.php"); ?>',{action:"get_district",id:+a},function(a){jQuery("#district-list").append(a)}):jQuery("#district-wrap-"+a).remove()})});  
   function format(c,d){c=c||",";d=d||".";for(var a=this.toString().split("."),b=a[0],a=1<a.length?d+a[1]:"",e=/(\d+)(\d{3})/;e.test(b);)b=b.replace(e,"$1"+c+"$2");return b+a};
 
   jQuery("#Pricef").live("keyup",function(){jQuery(this).val(format.call(jQuery(this).val().split(" ").join("")," ","."))});jQuery("#Pricet").live("keyup",function(){jQuery(this).val(format.call(jQuery(this).val().split(" ").join("")," ","."))});
    
    var datatable = <?php echo $data_object; ?>;
     
    var collection = new PourOver.Collection(datatable); 
  
     jQuery("form").on("submit", function(event) { 
        event.preventDefault();  
        var values = {};
        jQuery.each(jQuery('form').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        
        var checkedcities = '';
        var helper = [];
        var i = 0;
        var city = "";

        jQuery('.city-checkbox:checked').each(function() {
            cityfilter = jQuery(this).val();
            helper.push(jQuery(this).val());
        });
        checkedcities = '"' + helper.join('","') + '"';
        var checkedcitiesf = checkedcities.substring(1, checkedcities.length - 1);
        var checkeddistrict = '';
        var helperd = [];
        jQuery('.district-checkbox:checked').each(function() {
            helperd.push(jQuery(this).val());
            // checkedcities=checkedcities+','+jQuery(this).val();    
        });
        //magic - refactoring needed !!!     
        checkeddistrict = '"' + helperd.join('","') + '"';
        checkeddistrict = checkeddistrict.substring(1, checkeddistrict.length - 1);
        //uppercase sensitive

        var checkedtype = '';
        var helpert = [];
        jQuery('.type-checkbox:checked').each(function() {
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
            var i = 0;
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
            var i = 0;
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
            var i = 0;
            
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
        datatable = myfilterfinal; 
        if (jQuery.isEmptyObject(myfilterfinal))
        {
            jQuery("#table_data_filter").empty();
            jQuery("#list").empty();
            var table_data = "<tr><td><h1><?php _e('NO RESULT FOUND', 'wpbootstrap'); ?></h1></td></tr>";
            var row_data = "<div class=\"row\"><div class=\"col-md-12 flats_box\"><h1>NO RESULT FOUND</h1></div></div>";
            jQuery("tbody").append(table_data);
            jQuery("#list").append(row_data);
        }
        else
        {
            jQuery("#table_data_filter").empty();
            jQuery("#list").empty(); 
            var totalcount = 0;     
            
            
            jQuery.each(myfilterfinal, function(i, val) { 
                if (val.status_raw != 'OFFEN')
                {
                    var stats = "<span class=\"green\">" + val.status + "</span>";
                }
                else
                {
                    var stats = "";
                }  
                var backgroundClass = 0 != i % 2 ? ' no-background' : ' background';
              
var table_data = "<tr class=\"apartment-row-" + val.idval + "" + backgroundClass + "\"><td><a class=\"add-to-preference\" data-toggle=\"modal\"  data-flat_id=\"" + val.idval + "\" href=\"#myModal\"><i class=\"fa " + val.favorite + "\"></i><span class=\"small-text hidden\"></span></a></td><td>" + val.references + "</td><td><a href=\"" + val.url + "\" class=\"blue\">" + val.street + " " + val.hnumber + ",  " + val.city + ", " + val.district + ", " + val.zip + "</a></td><td>" + val.flatnum + "</td><td>" + val.rstatus + "</td><td>" + val.floor + "</td><td>" + val.rooms + "</td><td>" + val.area + "</td><td>" + val.fprice + " &euro;</td><td>" + val.fpricem + " &euro;</td><td>"+ val.yield +"</td><td>" + val.status + "</td></tr>";

                jQuery("tbody").append(table_data);
                jQuery("table").trigger("update");
                jQuery("table").tablesorter(
                      {      
                         headers:
                                {   
                                8 : { sorter: 'digit'},
                                9 : { sorter: 'digit'} 
                                },
                         usNumberFormat:false           
                      } 
                ); 
                //console.log(val); 
                  var row_data = "<div class=\"row apartment-row apartment-row-" + val.idval + ""+ backgroundClass + "\"><div class=\"col-md-12 flats_box\"><div class=\"col-md-3\">" + stats + "<a href=\"" + val.url + "\"><img src=\"" + val.image_url + "\" class=\"img-responsive\" /></a></div><div class=\"col-md-9\"> <h4 class=\"blue\"><a href=\"" + val.url + "\">" + val.name + "<small class=\"clearfix\"><i class=\"red fa fa-map-marker\"></i> " + val.street + " " + val.hnumber + ", " + val.city + ", " + val.district + ", " + val.zip + "</small></a></h4><div class=\"row\"><div class=\"col-md-3\"><span class=\"data_item clearfix\"><strong><?php _e('Ref.:', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.references + "</span></span><span class=\"data_item clearfix\"><strong><?php _e('Flat n°:', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.flatnum + "</span></span><span class=\"data_item clearfix\"><strong><?php _e('Rental status: ', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.rstatus + "</span></span></div><div class=\"col-md-3\"><span class=\"data_item clearfix\"> <strong><?php _e('Floor:', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.floor + "</span></span><span class=\"data_item clearfix\"><strong><?php _e('Rooms:  ', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.rooms + "</span></span><span class=\"data_item clearfix\"><strong><?php _e('Surface:  ', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.area + " m²</span></span></div><div class=\"col-md-3\"> <span class=\"data_item clearfix\"><strong><?php _e('Price:', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.fprice + " &euro; </span></span><span class=\"data_item clearfix\"><strong><?php _e('Price/m2: ', 'wpbootstrap'); ?></strong><span class=\"pull-right\"> " + val.fpricem + " €/m²</span></span><span class=\"data_item clearfix\"><strong><?php _e('Yield:', 'wpbootstrap'); ?></strong><span class=\"pull-right\"> " + val.yield + "</span></span></div><div class=\"col-md-3\"><a class=\"add-to-preference pull-right\" href=\"#myModal\" data-flat_id=\"" + val.idval + "\" data-toggle=\"modal\"><strong class=\"blue clearfix\"><i class=\"fa " + val.favorite + "\"></i><span class=\"fav-label\">" + val.favorite_text + "</span></strong></a><a href=\"" + val.url + "\" class=\"pull-right\"><?php _e('VIEW DETAILS:', 'wpbootstrap'); ?></a></div></div></div></div></div>"; 
                jQuery("#list").append(row_data); 
                totalcount++; 
                });  
                jQuery( '.placeithere' ).text(totalcount);               
        }
    });
    
     
    jQuery(document).ready(function() {   
        var total_item = 0;   
        jQuery.each(datatable, function(i, val) {
        total_item++;  
        });  
        jQuery( '.placeithere' ).text(total_item);   
        var count = 10;
        var load_next_item = true;  
        jQuery( ".searchbutton" ).click(function() { 
        total_item = -1; 
        }); 
        jQuery(window).scroll(function() {  
            console.log(total_item); 
            if (count >= (total_item)) {
                return;
            }
            if (load_next_item && (jQuery(window).scrollTop() >= jQuery(document).height() - (jQuery(window).height() + 10))) {
                var starter = count;
                console.log(count); 
                count = count + 10;
                var ie = 0;
                
                jQuery.each(datatable, function(i, val) {
                    if (ie > starter && ie <= count)
                    {
                        if (val.status_raw != 'OFFEN')
                        {
                            var stats = "<span class=\"green\">" + val.status + "</span>";
                        }
                        else
                        {
                            var stats = "";
                        }
                       
var backgroundClass = 0 != i % 2 ? ' no-background' : ' background'; 
                       
var table_data = "<tr class=\"apartment-row-" + val.idval + "" + backgroundClass + "\"><td><a class=\"add-to-preference\" data-toggle=\"modal\"  data-flat_id=\"" + val.idval + "\" href=\"#myModal\"><i class=\"fa " + val.favorite + "\"></i><span class=\"small-text hidden\"></span></a></td><td>" + val.references + "</td><td><a href=\"" + val.url + "\" class=\"blue\">" + val.street + " " + val.hnumber + ",  " + val.city + ", " + val.district + ", " + val.zip + "</a></td><td>" + val.flatnum + "</td><td>" + val.rstatus + "</td><td>" + val.floor + "</td><td>" + val.rooms + "</td><td>" + val.area + "</td><td>" + val.fprice + " &euro;</td><td>" + val.fpricem + " &euro;</td><td>" + val.yield + "</td><td>" + val.status + "</td></tr>"; 
                        //var table_data = "<tr><td><a class=\"add-to-preference\" data-toggle=\"modal\"  data-flat_id=\"" + val.idval + "\" href=\"#myModal\"><i class=\"fa " + val.favorite + "\"></i><span class=\"small-text hidden\"></span></a></td><td>" + val.references + "</td><td><a href=\"" + val.url + "\" class=\"blue\">" + val.street + " " + val.hnumber + ",  " + val.city + ", " + val.district + ", " + val.zip + "</a></td><td>" + val.flatnum + "</td><td>" + val.rstatus + "</td><td>" + val.floor + "</td><td>" + val.rooms + "</td><td>" + val.area + "</td><td>" + val.fprice + " &euro;</td><td>" + val.fpricem + " &euro;</td><td></td><td>" + val.status + "</td></tr>"; 
                        jQuery("tbody").append(table_data);
                        jQuery("table").trigger("update");
                        
                        jQuery("table").tablesorter(
                                {      
                        headers:
                                {   
                                8 : { sorter: 'digit'},
                                9 : { sorter: 'digit'}, 
                                },
                        usNumberFormat:false           
                            } 
                        ); 
                        console.log(val); 
                        
                        var row_data = "<div class=\"row apartment-row apartment-row-" + val.idval + ""+ backgroundClass + "\"><div class=\"col-md-12 flats_box\"><div class=\"col-md-3\">" + stats + "<a href=\"" + val.url + "\"><img src=\"" + val.image_url + "\" class=\"img-responsive\" /></a></div><div class=\"col-md-9\"> <h4 class=\"blue\"><a href=\"" + val.url + "\">" + val.name + "<small class=\"clearfix\"><i class=\"red fa fa-map-marker\"></i> " + val.street + " " + val.hnumber + ", " + val.city + ", " + val.district + ", " + val.zip + "</small></a></h4><div class=\"row\"><div class=\"col-md-3\"><span class=\"data_item clearfix\"><strong><?php _e("Ref.:", "wpbootstrap"); ?></strong><span class=\"pull-right\">" + val.references + "</span></span><span class=\"data_item clearfix\"><strong><?php _e("Flat n°:", "wpbootstrap"); ?></strong><span class=\"pull-right\">" + val.flatnum + "</span></span><span class=\"data_item clearfix\"><strong><?php _e('Rental status: ', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.rstatus + "</span></span></div><div class=\"col-md-3\"><span class=\"data_item clearfix\"> <strong><?php _e('Floor:', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.floor + "</span></span><span class=\"data_item clearfix\"><strong><?php _e('Rooms:  ', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.rooms + "</span></span><span class=\"data_item clearfix\"><strong><?php _e('Surface:  ', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.area + " m²</span></span></div><div class=\"col-md-3\"> <span class=\"data_item clearfix\"><strong><?php _e('Price:', 'wpbootstrap'); ?></strong><span class=\"pull-right\">" + val.fprice + " &euro; </span></span><span class=\"data_item clearfix\"><strong><?php _e('Price/m2: ', 'wpbootstrap'); ?></strong><span class=\"pull-right\"> " + val.fpricem + " €/m²</span></span><span class=\"data_item clearfix\"><strong><?php _e('Yield:', 'wpbootstrap'); ?></strong><span class=\"pull-right\"> " + val.yield + "</span></span></div><div class=\"col-md-3\"><a class=\"add-to-preference pull-right\" href=\"#myModal\" data-flat_id=\"" + val.idval + "\" data-toggle=\"modal\"><strong class=\"blue clearfix\"><i class=\"fa " + val.favorite + "\"></i><span class=\"fav-label\">" + val.favorite_text + "</span></strong></a><a href=\"" + val.url + "\" class=\"pull-right\"><?php _e('VIEW DETAILS:', 'wpbootstrap'); ?></a></div></div></div></div></div>"; 
                        jQuery("#list").append(row_data);
                    }
                    ie++;
                });
            }
        });
    });
 
    jQuery(document).ready(function(n) {
        n(".searchbutton").fadeIn("fast", function() {
        })
    });
</script>  

