<!-- FOOTER -->

<footer class="border-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 clearfix">
                <?php
                wp_nav_menu(
                        array(
                            'menu' => 'bottom_nav', /* menu name */
                            'menu_class' => 'nav navbar-nav collapse navbar-collapse navbar-responsive-collapse navbar',
                            'theme_location' => 'main_nav', /* where in the theme it's assigned */
                            'container' => 'false', /* container class */
                            'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
                            // 'depth' => '2',  suppress lower levels for now 
                            'walker' => new Bootstrap_walker()
                        )
                );
                ?> 
            </div>        
            <div class="col-sm-3 clearfix">
                <p class="padding-top pull-right"><a href="#">Back to top</a></p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); // js scripts are inserted using this function ?>

</body>
</html>
