<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title('|', true, 'right'); ?></title>	
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- media-queries.js (fallback) -->
        <!--[if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
        <![endif]--> 
        <!-- html5.js -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- wordpress head functions -->
        <?php wp_head(); ?>
        <!-- end of wordpress head -->
    </head>
    <body <?php body_class(); ?>>
        <div class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
                        <img src="<?php bloginfo('template_url'); ?>/images/logo.png" /></a>
                </div>
                <div class="collapse navbar-collapse navbar-responsive-collapse navbar navbar-right">
                    <?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>	 
                </div> 
            </div> <!-- end .container -->
        </div> <!-- end .navbar -->
        <?php 
        
        $pages = array(
            3305, // My preferences 
            1755, // Profile
            1791, // Search 
            3314, // Webinars
            3310, // Programs
        );
        
        if (current_user_can('see_detail') && (is_page($pages) || is_singular('flat'))) : ?>
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 clearfix">
                            <?php
                            wp_nav_menu(
                                    array(
                                        'menu' => 'user_menu', /* menu name */
                                        'menu_class' => 'nav navbar-nav',
                                        'theme_location' => 'main_nav', /* where in the theme it's assigned */
                                        'container' => 'false', /* container class */
                                        'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
                                        // 'depth' => '2',  suppress lower levels for now 
                                        'walker' => new Bootstrap_walker()
                                    )
                            );
                            ?> 
                        </div>
                    </div>   
                </div>
            </div>
        <?php endif; ?>