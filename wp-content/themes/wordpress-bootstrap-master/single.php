<?php get_header(); ?>

<div id="content" class="clearfix row">

    <div id="main" class="col-sm-8 clearfix" role="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                    <header>

                        <?php the_post_thumbnail('wpbs-featured'); ?>

                        <div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>

                        <p class="meta"><?php _e("Posted", "wpbootstrap"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "wpbootstrap"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "wpbootstrap"); ?> <?php the_category(', '); ?>.</p>

                    </header> <!-- end article header -->

                    <section class="post_content clearfix" itemprop="articleBody">
                        <?php the_content(); ?>

                        <?php wp_link_pages(); ?>

                    </section> <!-- end article section -->

                    <footer>

                        <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags", "wpbootstrap") . ':</span> ', ' ', '</p>'); ?>

                        <?php
                        // only show edit button if user has permission to edit posts
                        if ($user_level > 0) {
                            ?>
                            <a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post", "wpbootstrap"); ?></a>
                        <?php } ?>

                    </footer> <!-- end article footer -->

                </article> <!-- end article -->

                <?php comments_template('', true); ?>

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

    <?php get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

<?php get_footer(); ?>












<?php
$options = get_option('so_theme_options');
?> 
<h2><?php _e('Latest news', $this->plugin_slug); ?></h2>  
<div class="latest-news">
    <?php
    $facebookfeed = $this->facebookfeed();
// set counter to 0, because we only want to display 10 posts

    foreach ($facebookfeed['data'] as $facebookpost) {
        ?>    
        <?php if ($facebookpost['type'] == 'status' || $facebookpost['type'] == 'link' || $facebookpost['type'] == 'photo') { ?>   
            <div class="facebook-news col-sm-6 news-item">
                <div class="one-news">          

                    <?php if ($facebookpost['type'] == 'status') { ?>	
                        <div class="one-news-top">      
                            <i class="left fa fa-facebook medium"></i>
                            <div class="follow right">
                                <i class="fa fa-thumbs-o-up"></i><?php echo date("jS M, Y", (strtotime($facebookpost['created_time']))) ?>
                            </div>
                        </div>    
                        <p class="social-info"><?php echo $this->hyperlinks($facebookpost['message']); ?></p> 
                        <?php
                    }
                    // check if post type is a link
                    if ($facebookpost['type'] == 'link') {
                        ?> 
                        <div class="one-news-top">     
                            <i class="left fa fa-facebook medium"></i>
                            <div class="follow right">
                                <i class="fa fa-thumbs-o-up"></i><?php echo date("jS M, Y", (strtotime($facebookpost['created_time']))) ?>
                            </div>
                        </div>  
                        <p class="author"><?php echo $facebookpost['name']; ?></p>
                        <p class="social-info"><?php echo $this->hyperlinks($facebookpost['message']); ?></p>    
                        <p><a href="<?php echo $facebookpost['link']; ?>"  target="_blank"><?php echo $facebookpost['link']; ?></a></p> 
                            <?php
                        }

                        $i++; // add 1 to the counter if our condition for $facebookpost['type'] is met
                        ?>
                </div>          
            </div>     

            <?php
        }
        break;
    }

    $twitterfeed = $this->twitterfeed();
    if (!empty($twitterfeed) || !isset($twitterfeed['error'])) {
        $hyperlinks = true;
        $encode_utf8 = true;
        $twitter_users = true;
        $update = true;
        ?>


        <?php
        foreach ($twitterfeed as $item) {
            $msg = $item->text;
            $permalinktwitter = 'http://twitter.com/#!/' . $this->screen_name . '/status/' . $item->id_str;

            if ($encode_utf8)
                $msg = utf8_encode($msg);
            $msg = $this->encode_tweet($msg);
            $link = $permalinktwitter;
            ?> 
            <div class="twitter-news col-sm-6 news-item">
                <div class="one-news"> 
                    <div class="one-news-top">
                        <i class="left fa fa-twitter medium"></i>
                        <div class="follow right"><a href="https://twitter.com/<?php echo $this->screen_name; ?>"><i class="fa fa-twitter"></i><?php _e('Follow', $this->plugin_slug); ?> @<?php echo $this->screen_name; ?></a> 
                        </div>

                    </div><!-- .one-news-top -->
                    <p class="author">@<?php echo $this->screen_name; ?></p>
                    <p class="social-info"><strong><?php
                            if ($hyperlinks) {
                                $msg = $this->hyperlinks($msg);
                            }
                            if ($twitter_users) {
                                $msg = $this->twitter_users($msg);
                            }
                            echo $msg;
                            ?></strong></p>
                    <?php
                    if ($update) {
                        $time = strtotime($item->created_at);
                        if (( abs(time() - $time) ) < 86400)
                            $h_time = sprintf(__('%s ago'), human_time_diff($time));
                        else
                            $h_time = date(__('Y/m/d'), $time);
                        echo sprintf(__('%s', $this->plugin_slug), ' <span class="twitter-timestamp"><abbr title="' . date(__('Y/m/d H:i:s'), $time) . '">' . $h_time . '</abbr></span>');
                    }
                    ?>
                </div><!-- .one-news -->  
            </div><!-- .twitter-news .col-sm-6 .news-item -->   

            <?php
            if ($i >= 1)
                break;
        }
        ?>  


        <?php
    }
    ?> 