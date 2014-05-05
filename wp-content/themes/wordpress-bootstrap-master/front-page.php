<?php get_header(); ?>

<div class="carousel slide" id="carousel-519866">
    <ol class="carousel-indicators">
        <li class="active" data-slide-to="0" data-target="#carousel-519866">
        </li>
        <li data-slide-to="1" data-target="#carousel-519866">
        </li>
        <li data-slide-to="2" data-target="#carousel-519866">
        </li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/slide-1.jpg">
            <div class="carousel-caption">
                <h4>
                    First Thumbnail label
                </h4>
                <p>
                    Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
                </p>
            </div>
        </div>
        <div class="item">
            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/slide-1.jpg">
            <div class="carousel-caption">
                <h4>
                    Second Thumbnail label
                </h4>
                <p>
                    Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
                </p>
            </div>
        </div>
        <div class="item">
            <img alt="" src="<?php echo get_template_directory_uri() ?>/images/slide-1.jpg">
            <div class="carousel-caption">
                <h4>
                    Third Thumbnail label
                </h4>
                <p>
                    Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
                </p>
            </div>
        </div>
    </div> <a class="left carousel-control" href="#carousel-519866" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-519866" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>



<div class="container">
    <div class="row clearfix"> 

        <div class="col-md-9 column"> 
            <h1 class="primary red-border-right">Top projects</h1>
        </div>

        <div class="col-md-9 column"> 
            <div class="row">

            <?php
            $args = array(
                'post_type' => 'program',
                'post_status' => 'publish',
            );
            $query = new WP_Query($args); 
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <div class="col-md-6 column">
                        <div class="thumbnail">
                            <a class="" href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'program_thumb' ); ?>
                                <!--<img src="<?php echo get_template_directory_uri() ?>/images/choriner-hoefe_src_1.-w316-h0-p0-F-S1.jpg"/>-->
                            </a>
                            <div class="panel-body">
                                <h4 class="red"><?php the_title() ?></h4>
                            </div> 
                            <div class="panel-body">
                                <span class="propertyListBoxDataItemName"><i class="fa fa-usd"></i><strong>Type of property:</strong> Exclusive Apartments</span> 
                                 
                                <span class="propertyListBoxDataItemName"><i class="fa fa-usd"></i><strong>Address:</strong> Krausenstrasse 37 - Schützenstrasse 46, Berlin-Mitte</span>
                                 
                                <span class="propertyListBoxDataItemName"><i class="fa fa-usd"></i><strong>Size range:</strong> <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)) ?> m² - <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)) ?> m²</span>
                                <span class="propertyListBoxDataItemName"><i class="fa fa-usd"></i><strong>Price range:</strong> € 152.000 - € 822.500    <i class="fa fa-eur"></i>  
                                    <i class="fa fa-usd"></i> <i class="fa fa-gbp"></i>
                                </span>
                                <br>                                
                               
                            </div>
                            <div class="panel-body"> 
                                <?php the_excerpt() ?>
                            </div>
                            <div class="clearfix">		
                                
                                <span class="col-lg-6">    
                                    <a class="btn btn-lg btn-default btn-block btn-upper" href="<?php the_permalink(); ?> ">» view details </a> 
                                </span>
                                <span class="col-lg-6">
                                   <a class="btn btn-lg btn-primary btn-block btn-upper" href="<?php the_permalink(); ?>">make an enquiry</a> 
                                </span>
                                
                               	
                            </div>
                        </div>	
                    </div>
                    <?php
                endwhile;
            }
            wp_reset_query();
            ?>
                </div> 
        </div> 
        <div class="col-md-3 column"> 
 
            <img src="<?php echo get_template_directory_uri() ?>/images/sidebar_left.png">

        </div>	
    </div>
    <?php get_footer(); ?>