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

                            <div class="page-header"><h1 class="page-title border-left" itemprop="headline"><?php the_title(); ?></h1></div>

                        </header> <!-- end article header -->

                    </article> <!-- end article -->

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

    </div> <!-- end #content -->

    <div class="row clearfix">
        <form role="form">
            <div class="col-md-6 column">

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php _e("City:", "wpbootstrap"); ?></label><input class="form-control" id="exampleInputEmail1" type="text" />
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php _e("City:", "wpbootstrap"); ?></label> 

                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>      
                </div>

                <row>
                    <div class="col-md-6 column">    
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label><input id="exampleInputFile" type="file" />
                            <p class="help-block">
                                Example block-level help text here.
                            </p>
                        </div>
                    </div>
                </row> 

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php _e("City:", "wpbootstrap"); ?></label><input class="form-control" id="exampleInputEmail1" type="text" />
                </div>

            </div>
            <div class="col-md-6 column">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label><input class="form-control" id="exampleInputEmail1" type="email" />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label><input class="form-control" id="exampleInputPassword1" type="password" />
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label><input id="exampleInputFile" type="file" />
                    <p class="help-block">
                        Example block-level help text here.
                    </p>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" /> Check me out</label>
                </div> <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>

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

            <tbody>
                <?php
                $lang = qtrans_getLanguage();
                $flat_props = EstateProgram::get_all_flats($post->ID, $lang);
                ?>
                <?php
                $i = 0;
                if (!empty($flat_props)):
                    foreach ($flat_props as $key => $val):
                        $prop = unserialize($val->prop);
                        ?>
                        <tr>
                            <td>   
                                <a class="add-to-preference" data-toggle="modal"  data-flat_id="<?php echo $val->ID ?>" href="#myModal"><i class="fa fa-star-o <?php echo EstateProgram::is_user_favorite($val->ID) ? 'red' : 'blue' ?>"></i></a>
                            </td>
                            <td>
                                <?php echo esc_attr($prop['anbieternr']) ?>
                            </td>
                            <td>
                                <a href="<?php echo get_permalink(); ?>" class="blue"><?php echo esc_attr($prop['geo|strasse']) ?>, <?php echo esc_attr($prop['geo|ort']) ?>,  <?php echo esc_attr($prop['geo|plz']) ?> </a>
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
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
    <!-- /all product -->                       

</div>




<?php get_footer(); ?>