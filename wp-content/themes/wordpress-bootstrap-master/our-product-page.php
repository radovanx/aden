<?php
/*
  Template Name: Search Page
 */
?>


<?php get_header(); ?>
<div class="container">
    <div id="content" class="clearfix row">
        <div class="col-sm-12 clearfix" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                        <header> 
                            <div class="page-header"><h1 class="page-title border-left uppercase" itemprop="headline"><?php the_title(); ?>  </h1>
                                <h2><small>Select a property type and start your search</small></h2>
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
            <form role="form" class="border background clearfix">

                <div class="col-md-6 column">
                    <div class="form-group">
                        <label for="City"><?php _e("City:", "wpbootstrap"); ?></label><input name="city" class="form-control input-lg" id="City"  type="text"  placeholder="City:"/>
                    </div>
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
                                <option value="<?php echo $type->term_id ?>"><?php _e($type->name) ?></option>
                            <?php endforeach; ?>
                        </select>

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
                        <label for="Disctrict"><?php _e("Disctrict:", "wpbootstrap"); ?></label><input name="Disctrict" class="form-control input-lg" id="Disctrict" type="text" placeholder="Disctrict:"/>
                    </div>

                    <div class="row">


                        <div class="form-group col-md-6">
                            <label for="Areaf"><?php _e("Area from:", "wpbootstrap"); ?></label><input name="Areaf" class="form-control input-lg" id="Areaf" type="text" placeholder="Area from:" />
                        </div>


                        <div class="form-group col-md-6">
                            <label for="Areat"><?php _e("Area to:", "wpbootstrap"); ?></label><input name="Areat" class="form-control input-lg" id="Areat" type="text" placeholder="Area to:" />
                        </div>
                    </div>      

                    <div class="row">    
                        <div class="form-group col-md-6">
                            <label for="Roomsf"><?php _e("Rooms from:", "wpbootstrap"); ?></label><input name="Roomsf" class="form-control input-lg" id="Roomsf" type="text" placeholder="Rooms from:" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Roomst"><?php _e("Rooms to:", "wpbootstrap"); ?></label><input name="Roomst" class="form-control input-lg" id="Roomst" type="text" placeholder="Rooms to:" />
                        </div> 
                        <div class="form-group col-md-3 col-md-offset-3">  
                            
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i>Search</button>      
                        
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
        <div class="col-md-3">
            <select name="sort_by_list" class="form-control input-lg">
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
            </select>
        </div>
        <div class="col-md-3">
            <a href="#" class="active blue"><i class="fa fa-list"></i></a>
            <a href="#" class="red"><i class="fa fa-th "></i></a>
        </div>
        <div class="col-md-12 column">
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
                
                $flat_props = EstateProgram::get_all_flats($post->ID, $lang, 0, 1500);
  
                $i = 0;
                $data_object = '';
                  
                if (!empty($flat_props)):
                    foreach ($flat_props as $key => $val):
                        $prop = unserialize($val->prop);
                        $key = unserialize($key);

                        $url_image = wp_get_attachment_url( get_post_thumbnail_id( $val->ID ) );
                        $url = get_permalink($val->ID); 
     
                        $city = !empty($prop['geo|ort']) ? esc_attr($prop['geo|ort']) : "-";  
                        $district = !empty($prop['geo|regionaler_zusatz']) ? esc_attr($prop['geo|regionaler_zusatz']) : "-";
                        $area = !empty($prop['flaechen|wohnflaeche']) ? esc_attr($prop['flaechen|wohnflaeche']) : 0;
                        
                        $rooms = !empty($prop['flaechen|anzahl_zimmer']) ? esc_attr($prop['flaechen|anzahl_zimmer']) : 0;   
                        
           
                        $data_object.="{city:\"".$city."\", district:\"".$district."\",area:".$area.", rooms:".$rooms.", references:".esc_attr($prop['anbieternr']).",price: " . esc_attr($prop['preise|kaufpreis']) . ", url:\"".$url."\", image_url:  \"".$url_image."\"},";
                        
                        //$url = 
 
                        $autocomplete.= "\"" . esc_attr($prop['geo|ort']) . "\",";
                            
                         if($i<10): 
                         ?> 
                            <tr>
                                <td>   
                                    <a class="add-to-preference" data-toggle="modal"  data-flat_id="<?php echo $val->ID ?>" href="#myModal"><i class="fa fa-star-o <?php echo EstateProgram::is_user_favorite($val->ID) ? 'red' : 'blue' ?>"></i><?php echo $val->is_favorite; ?></a>
                                </td>
                                <td>
                                    <?php echo esc_attr($prop['anbieternr']) ?>
                                </td>
                                <td>
                                    <a href="<?php echo get_permalink($val->ID); ?>" class="blue"><?php echo esc_attr($prop['geo|strasse']) ?> <?php echo esc_attr($prop['geo|hausnummer']) ?> , <?php echo esc_attr($prop['geo|ort']) ?>, <?php echo esc_attr($prop['geo|regionaler_zusatz']) ?> <?php echo esc_attr($prop['geo|plz']) ?> </a>
                                </td>
                                <td>

                                </td>
                                <td>
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
                          endif;  
                        $i++;    
                    endforeach;
                endif;

                $autocomplete = substr("$autocomplete", 0, -1);
                $autocomplete = "[" . $autocomplete . "]";
                $data_object = substr("$data_object", 0, -1);
                $data_object = "[" . $data_object . "]";
                
                ?>   

            </table>   
        </div>
        <!-- /all product --> 
    </div>
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

    var availableCity;
    availableCity = <?php echo $autocomplete; ?>

    GetUnique(availableCity)

    function GetUnique(inputArray)
    {
        var outputArray = [];
        for (var i = 0; i < inputArray.length; i++)
        {
            if ((jQuery.inArray(inputArray[i], outputArray)) == -1)
            {
                outputArray.push(inputArray[i]);
            }
        }
        return outputArray;
    }
    availableCity = GetUnique(availableCity)


</script>

<script src="<?php bloginfo('template_directory'); ?>/library/js/underscore-min.js"></script>      
<script src="<?php bloginfo('template_directory'); ?>/library/js/pourover.js"></script> 
<script>
 
    
    var data = <?php echo $data_object; ?>;
    var collection = new PourOver.Collection(data);
    
    
     //make Range filter  
    //CITY FILTER  
    
    function CityFilter(fcity)
    {  
    var city_filter = PourOver.makeExactFilter("city", [fcity]);    
    collection.addFilters([city_filter]);    
    var city_filter_return = collection.filters.city.getFn(fcity);        
        
    return city_filter_return;  
   
    }    
    jQuery( "form" ).on( "submit", function( event ) {
             event.preventDefault();
    
        var SerializedObject = ( jQuery( "form" ).serializeArray() );
 
        //value from form
        var fcity = SerializedObject[0].value;  
        var ftype = SerializedObject[1].value;  
        var freferences = SerializedObject[4].value;    
        var fdistrict = SerializedObject[5].value; 
        var fareaf = SerializedObject[6].value;
        var fareat = SerializedObject[7].value;
        var froomsf = SerializedObject[8].value;
        var froomst = SerializedObject[9].value;  
        var fpricef = SerializedObject[2].value; 
        var fpricet = SerializedObject[3].value;  
        
       //make a filter
       
       var finalfilter=false;
   
        if(fcity!='')
        { 
           var city_filter = PourOver.makeExactFilter("city", [fcity]);    
           collection.addFilters([city_filter]);    
           finalfilter = collection.filters.city.getFn(fcity);  
   
        } 
        if(ftype!='')
        {
            var type_filter = PourOver.makeExactFilter("type", [ftype]); 
            collection.addFilters([type_filter]); 
            
            if (finalfilter !=false)
            {
            finalfilter = finalfilter.and(collection.filters.type.getFn(ftype));
            }
            else
            {  
            finalfilter = collection.filters.type.getFn(ftype);          
            }    
           
            //var type_f = collection.filters.type.getFn(ftype);   
 
        }
        if(freferences!='')
        {
              var references_filter = PourOver.makeExactFilter("references", [freferences]); 
              collection.addFilters([references_filter]); 
            
              if (finalfilter !=false)
                {
                finalfilter = finalfilter.and(collection.filters.references.getFn(freferences));
                }
              else
                {  
                finalfilter = collection.filters.references.getFn(freferences);          
                } 
               
               // var references_f = collection.filters.references.getFn(freferences); 
              
        }
        if(fdistrict!='')
        {
            
             var district_filter = PourOver.makeExactFilter("district", [fdistrict]); 
             collection.addFilters([district_filter]); 
            
              if (finalfilter !=false)
                {
                finalfilter = finalfilter.and(collection.filters.district.getFn(fdistrict));
                }
              else
                {  
                finalfilter = collection.filters.district.getFn(fdistrict);          
                }
 
                
        }  
        
        if(fpricef!=''||fpricet!='')
        {
             var price_range_filter = PourOver.makeRangeFilter("price_range", [[fpricef, fpricet]], {attr: "price"}); 
             collection.addFilters([price_range_filter]);  
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
             if (finalfilter !=false)
                {
                finalfilter = finalfilter.and(collection.filters.price_range.getFn([fpricef,fpricet]));
                }
              else
                {  
                finalfilter = collection.filters.price_range.getFn([fpricef,fpricet]);          
                }  
        }
        
        if(fareaf!=''||fareat!='')
        {
             var area_range_filter = PourOver.makeRangeFilter("area_range", [[fareaf, fareat]], {attr: "area"}); 
             collection.addFilters([area_range_filter]);  
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
             if (finalfilter !=false)
                {
                finalfilter = finalfilter.and(collection.filters.area_range.getFn([fareaf,fareat]));
                }
              else
                {  
                finalfilter = collection.filters.area_range.getFn([fareaf,fareat]);          
                }  
        }
        
         if(froomsf!=''||froomst!='')
        {
             var rooms_range_filter = PourOver.makeRangeFilter("rooms_range", [[froomsf, froomst]], {attr: "rooms"}); 
             collection.addFilters([rooms_range_filter]);  
            // var price_range_f = collection.filters.price_range.getFn([fpricef,fpricet]); 
             if (finalfilter !=false)
                {
                finalfilter = finalfilter.and(collection.filters.rooms_range.getFn([fpricef,fpricet]));
                }
              else
                {  
                finalfilter = collection.filters.rooms_range.getFn([froomsf,froomst]);          
                }  
        }
 
       // var group_filter = city_f.and(price_range_f);  
       var myfilterfinal = collection.get(finalfilter.cids);  
      
        console.log(myfilterfinal);
        
       <tr><td>   
       
       </td>
       <td>
    
       </td>
       <td>
       <a href="<?php echo get_permalink($val->ID); ?>" class="blue"><?php echo esc_attr($prop['geo|strasse']) ?>, <?php echo esc_attr($prop['geo|ort']) ?>, <?php echo esc_attr($prop['geo|plz']) ?> </a>
       </td>
        <td>

         </td>
          <td>
          </td>
          <td>
                
          </td>
          <td>
            
          </td>
           <td>
          
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
                
 
});
 

</script>  



<script type="text/javascript">
    
      jQuery(document).ready(function($) {
          var count = 2;
          $(window).scroll(function(){
                  if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                     loadArticle(count);
                     count++;
                  }
          });
 
          function loadArticle(pageNumber){   
                  $('a#inifiniteLoader').show('fast');
                  $.ajax({
                      url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                      type:'POST',
                      data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop',
                      success: function(html){
                          $('a#inifiniteLoader').hide('1000');
                          $("#content").append(html);    // This will be the div where our content will be loaded
                      }
                  });
              return false;
          }
   
      });
      
  </script>
 
<?php get_footer(); ?>