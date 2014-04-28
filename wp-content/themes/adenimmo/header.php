<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="robots" content="noindex,nofollow">

        <?php wp_head(); ?>

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append ‘#!watch’ to the browser URL, then refresh the page. -->


        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/images/favicon.png">

    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#">
                        LOGO
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://www.adenimmo.web-4-all.cz">Home</a>	</li>
                        <li><a href="http://www.adenimmo.web-4-all.cz/buy_page.html">Buy</a></li>
                        <li><a href="http://www.adenimmo.web-4-all.cz/partner_page.html">Partner</a></li>
                        <li><a href="http://www.adenimmo.web-4-all.cz/about_us.html">About Us</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle blue" data-toggle="dropdown">Login<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="http://www.adenimmo.web-4-all.cz/our_product.html">Login</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>	

        <?php
        // slider na homepage
        if (is_home() || is_front_page()):
            ?>
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
        <?php endif; ?>

        <div class="container">