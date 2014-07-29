<?php
/*
  Template Name: Our program Page
 */
?>
<?php
redirect_if_cannot_see_detail();
get_header(); 
$post_per_page = 6;
$args = array(
    'post_type' => 'program',
    'post_status' => 'publish',
    'posts_per_page' => $post_per_page
);
$query = new WP_Query($args);
?>  
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <header>
                <div class="page-header"><h1 class="page-title border-left" itemprop="headline"><?php the_title(); ?></h1></div>
            </header> <!-- end article header -->
        </div>
        <div id="project-list">
            <div class="col-md-12 column">
                <div class="row">
                    <?php
                    $i = 0;
                    if ($query->have_posts()) {
                        while ($query->have_posts()) : $query->the_post();
                            $i++;
                            //get_template_part('partial', 'project_projects');
                            include get_template_directory() . '/partial-project_projects.php';
                        //echo 0 == $i % 3 ? '</div></div><div class="col-md-12 column"><div class="row">' : '';
                        endwhile;
                    }
                    wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
        <!-- ajax loader -->
        <div id="next-ajax-loading" class="text-center no-visible row">
            <img src="<?php echo get_template_directory_uri() ?>/images/ajax-loader.gif">
        </div>
        <!-- /ajax loader -->        
    </div>
</div>
<script>
    var total_item = <?php echo $query->found_posts ?>;
    // pocatecni offset
    var count = <?php echo (int) $post_per_page ?>; 
    var active_load = 0; 
    var load_next_item = true;
    // pocet polozek, ktere vrati ajax
    var ajax_ppp = 3; 
    jQuery(document).ready(function() {
        jQuery(window).scroll(function() {
            if (count >= (total_item)) {
                return;
            }
            if (load_next_item && (jQuery(window).scrollTop() >= jQuery(document).height() - (jQuery(window).height() + 200))) {
                loadArticle(count);
                count += ajax_ppp;
            }
        });
    });
    function loadArticle(offset) {
        jQuery.ajax({
            url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            type: 'POST',
            dataType: 'json',
            data: "action=item_pagination&offset=" + offset + "&part=project_projects&ppp=" + ajax_ppp,
            beforeSend: function() {
                active_load++;
                jQuery('#next-ajax-loading').removeClass('no-visible');
                load_next_item = false;
            },
            success: function(ret) {
                jQuery("#project-list").append(ret.content);
            },
            complete: function(ret) {
                load_next_item = true;
                active_load--;
                if (active_load < 1) {
                    jQuery("#next-ajax-loading").addClass('no-visible');
                }
            }
        });
        return false;
    }
</script>
<?php get_footer(); ?>