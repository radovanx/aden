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
                <?php _e("All products", "wpbootstrap"); ?> - <span class="placeithere"></span>
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
                                <th class="{sorter: 'digit'}"><?php _e("Price", "wpbootstrap"); ?></th>
                                <th class="{sorter: 'digit'}"><?php _e("Price/m²", "wpbootstrap"); ?></th>
                                <th><?php _e("Yield", "wpbootstrap"); ?></th>
                                <th><?php _e("Status", "wpbootstrap"); ?></th>
                            </tr>
                        </thead>           
                        <tbody id="table_data_filter">    
                            <?php
                            $lang = qtrans_getLanguage();
                            $flat_props = EstateProgram::get_all_flats($lang);
                            $i = 0;
                            $data_object = '';

                            if (!empty($flat_props)):

                                foreach ($flat_props as $key => $val):
                                    $prop = unserialize($val->prop);
                                    //$url_image = wp_get_attachment_url(get_post_thumbnail_id($val->ID, '')); 

                                    if ($val->is_favorite == 0) {
                                        $favor = "blue fa-star-o";
                                        $favorite_text = __('Add to favorite', 'wpbootstrap');
                                    } else {
                                        $favor = "red fa-star";
                                        $favorite_text = __('Added to favorites', 'wpbootstrap');
                                    }
                                    $program_id = $val->program_id;
                                    $term = accomodationTypeL($prop);
                                    if ($term == "") {
                                        $term = '-';
                                    }


                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($val->ID), 'flat-small');
                                    $url_image = $thumb['0'];
                                    $url = get_permalink($val->ID);
                                    $city = !empty($prop['geo|ort']) ? esc_attr($prop['geo|ort']) : "-";
                                    $district = !empty($prop['geo|regionaler_zusatz']) ? esc_attr($prop['geo|regionaler_zusatz']) : "-";
                                    $area = !empty($prop['flaechen|wohnflaeche']) ? esc_attr($prop['flaechen|wohnflaeche']) : 0;
                                    $rooms = !empty($prop['flaechen|anzahl_zimmer']) ? esc_attr($prop['flaechen|anzahl_zimmer']) : 1;

                                    $hnumber = !empty($prop['geo|hausnummer']) ? esc_attr($prop['geo|hausnummer']) : 0;
                                    $floor = !empty($prop['geo|etage']) ? esc_attr($prop['geo|etage']) : 0;
                                    $street = !empty($prop['geo|strasse']) ? esc_attr($prop['geo|strasse']) : "-";
                                    $zip = !empty($prop['geo|plz']) ? esc_attr($prop['geo|plz']) : 0;
                                    $pricem = !empty($prop['preise|kaufpreis_pro_qm']) ? esc_attr($prop['preise|kaufpreis_pro_qm']) : 0;
                                    $pricem = (int) $pricem;
                                    $price = !empty($prop['preise|kaufpreis']) ? esc_attr($prop['preise|kaufpreis']) : 0;
                                    $price = (int) $price;
                                    $idval = (int) $val->ID;
                                    $name = !empty($prop['freitexte|objekttitel']) ? esc_attr($prop['freitexte|objekttitel']) : "-";
                                    $flat_num = !empty($prop['geo|wohnungsnr']) ? esc_attr($prop['geo|wohnungsnr']) : "-";

                                    global $post;

                                    //$yield = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage(get_post($val->ID)->post_excerpt);

                                    $yield = __(get_post($val->ID)->post_excerpt);

                                    $yield = trim($yield);
                                    
                                    if (empty($yield)) {
                                        if (!empty($prop['preise|kaufpreis']) && !empty($prop['preise|mieteinnahmen_ist']) && ((int) $prop['preise|kaufpreis']) > 0) {
                                            $yield = round(100 * $prop['preise|mieteinnahmen_ist'] / $prop['preise|kaufpreis'], 3) . '%';
                                        }
                                    }
                                    
                                    $yield = empty($yield) ? '-' : $yield;


                                    $rental_status = isset($prop['verwaltung_objekt|vermietet']) ? esc_attr($prop['verwaltung_objekt|vermietet']) : __('free', "wpbootstrap");
                                    if ($rental_status == 1) {
                                        $rental_status = __('rented', "wpbootstrap");
                                        $term = __('Rented apartment', "wpbootstrap");
                                    }
                                    if (isset($prop['objektkategorie|objektart|haus'])) {
                                        $term = __('Building', "wpbootstrap");
                                    }

                                    $status_raw = isset($prop['zustand_angaben|verkaufstatus|stand']) ? esc_attr($prop['zustand_angaben|verkaufstatus|stand']) : "-";
                                    $status = statusL($prop);
                                    $reference = isset($prop['verwaltung_techn|objektnr_extern']) ? esc_attr($prop['verwaltung_techn|objektnr_extern']) : "-";
                                    $data_object.="{city:\"" . $city . "\",name:\"" . $name . "\", district:\"" . $district . "\", hnumber:" . $hnumber . ",  street:\"" . $street . "\", area:" . $area . ", zip:" . $zip . ", rooms:" . $rooms . ", flatnum:\"" . $flat_num . "\", references:\"" . $reference . "\",price: " . esc_attr($prop['preise|kaufpreis']) . ", fprice: \"" . esc_attr(price_format($prop['preise|kaufpreis'])) . "\" ,pricem: " . $pricem . ", fpricem: \"" . price_format($pricem) . "\"  , url:\"" . $url . "\", image_url:  \"" . $url_image . "\", floor:" . $floor . ", rstatus: \"" . $rental_status . "\", status: \"" . $status . "\", status_raw: \"" . $status_raw . "\", favorite: \"" . $favor . "\", favorite_text: \"" . $favorite_text . "\",type: \"" . $term . "\", yield: \"" . $yield . "\", idval: " . $idval . " },";

                                    if ($status == 'OFFEN') {
                                        $status = '';
                                    }
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
                                                <?php echo $yield; ?>
                                            </td>
                                            <td>
                                                <?php
                                                //echo $status; 
                                                echo statusL($prop);
                                                ?>
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
                    $flat_props = EstateProgram::get_all_flats($lang, 0, 10);
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
<?php include_once("scriptjs.php"); ?>
<?php get_footer(); ?>
