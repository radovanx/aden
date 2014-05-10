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
                        <label for="City"><?php _e("City:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="City" type="text"  placeholder="City:"/>
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
                        <select class="form-control input-lg">
                            <option value="">---</option>
                            <?php foreach ($accomodion_types as $type): ?>
                                <option value="<?php echo $type->term_id ?>"><?php _e($type->name) ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Pricef"><?php _e("Price from:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="Pricef" type="text" placeholder="Price from:" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Pricet"><?php _e("Price to:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="Pricet" type="text" placeholder="Price to:" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="References"><?php _e("References:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="References" type="text" placeholder="References:" />
                    </div>


                </div>
                <div class="col-md-6 column">

                    <div class="form-group">
                        <label for="Disctrict"><?php _e("Disctrict:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="Disctrict" type="text" placeholder="Disctrict:"/>
                    </div>

                    <div class="row">


                        <div class="form-group col-md-6">
                            <label for="Areaf"><?php _e("Area from:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="Areaf" type="text" placeholder="Area from:" />
                        </div>


                        <div class="form-group col-md-6">
                            <label for="Areat"><?php _e("Area to:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="Areat" type="text" placeholder="Area to:" />
                        </div>
                    </div>      

                    <div class="row">    
                        <div class="form-group col-md-6">
                            <label for="Roomsf"><?php _e("Rooms from:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="Roomsf" type="text" placeholder="Rooms from:" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Roomst"><?php _e("Rooms to:", "wpbootstrap"); ?></label><input class="form-control input-lg" id="Roomst" type="text" placeholder="Rooms to:" />
                        </div> 
                        <div class="form-group col-md-3 col-md-offset-3">  
                            <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-search"></i>Search</button>      
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
                $flat_props = EstateProgram::get_all_flats($post->ID, $lang);
                
                $i = 0;
                $data_object = '';

                $i = 0;

                if (!empty($flat_props)):
                    foreach ($flat_props as $key => $val):
                        $prop = unserialize($val->prop);
                        $key = unserialize($key);

                        $url_image = wp_get_attachment_url( get_post_thumbnail_id( $val->ID ) );
                        
                        $url = get_permalink($val->ID);
   
                        $data_object.="{city:\"" . esc_attr($prop['geo|ort']) . "\", district:\"" . esc_attr($prop['geo|regionaler_zusatz']) . "\",area:" . esc_attr($prop['flaechen|wohnflaeche']) . ", rooms:".esc_attr($prop['flaechen|anzahl_zimmer']).", references:".esc_attr($prop['anbieternr']).",price: " . esc_attr($prop['preise|kaufpreis']) . ", url:\"".$url."\", image_url:  \"".$url_image."\"},";
                       
                        $autocomplete.= "\"" . esc_attr($prop['geo|ort']) . "\",";

                        if ($i < 10):
                            ?> 

                            <tr>
                                <td>   
                                    <a class="add-to-preference" data-toggle="modal"  data-flat_id="<?php echo $val->ID ?>" href="#myModal"><i class="fa fa-star-o <?php echo EstateProgram::is_user_favorite($val->ID) ? 'red' : 'blue' ?>"></i></a>
                                </td>
                                <td>
                                    <?php echo esc_attr($prop['anbieternr']) ?>
                                </td>
                                <td>
                                    <a href="<?php echo get_permalink($val->ID); ?>" class="blue"><?php echo esc_attr($prop['geo|strasse']) ?>, <?php echo esc_attr($prop['geo|ort']) ?>,  <?php echo esc_attr($prop['geo|plz']) ?> </a>
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
    //first output


    var collection = new PourOver.Collection(data);

    //make Range filter  
    //CITY FILTER
    
    
    
    
    
    
    
    

    //PRICE FILTER
    var price_range_filter = PourOver.makeRangeFilter("price_range", [[300000, 400000]], {attr: "price"})
    collection.addFilters([price_range_filter])
    var some_price_cids = collection.filters.price_range.getFn([300000, 400000]).cids
    var some_price = collection.get(some_price_cids)

    //OUTPUT 


</script>  
<?php get_footer(); ?> 