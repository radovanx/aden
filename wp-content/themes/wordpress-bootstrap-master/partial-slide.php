<div class="tab-pane fade in active" id="gallery_tab">
    <!--slider here -->
    <?php if (has_post_thumbnail()): ?>
                            
        <span id="thumb-view" class="test-popup-link view-in-box margin-bottom">
            <?php
            $full_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'lightbox');
            $full_url = $full_url[0]; 
            
            $first_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'project-detail-big');
            $first_url = $first_url[0];
 
            ?>
            <a id="full-view" href="<?php echo $full_url ?>">
                <?php
                $atts = array(
                    'id' => 'view-wrap'
                );
                the_post_thumbnail('project-detail-big', $atts);
                ?>
            </a>
        </span>
    <?php endif; ?>
    <ul class="bxslider parent-container">  
        <?php 
            $imagethumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'project-detail-small'); 
            $imagethumb_url = $imagethumb[0];    
            echo '<li><a href="' . $full_url . '" data-view="' . $first_url . '"><img src="'.$imagethumb_url.'"/></a></li>'; 
        ?>  
        <?php
        $images = get_children(array(
                  'post_parent' => $post->ID,
                  'post_type' => 'attachment',
                  'post_mime_type' => 'image'
        ));
        if (empty($images)){
            // no attachments here
        } else {
            $i = 1;
            ?>
            <?php
            foreach ($images as $attachment_id => $attachment) { 
                $view_size = wp_get_attachment_image_src($attachment_id, 'project-detail-big');
                $view_size = $view_size[0];
                $full_size = wp_get_attachment_image_src($attachment_id, 'lightbox');
                $full_size = $full_size[0];                  
                if ($full_url != $full_size)
                {    
                echo '<li><a href="' . $full_size . '" data-view="' . $view_size . '">' . wp_get_attachment_image($attachment_id, 'project-detail-small') . '</a></li>'; 
                $i++;
                }
            }
        }
        ?>
    </ul>
</div> 
     <script>
            jQuery(document).ready(function() {
                jQuery(".parent-container a").click(function(event) {
                    event.preventDefault(); 
                    var view_link = jQuery(this).attr("data-view");
                    jQuery('#view-wrap').attr('src', view_link); 
                    var full_link = jQuery(this).attr("href");
                    jQuery('#full-view').attr('href', full_link);
                });
        
                 jQuery('.view-in-box').on('click', function (event) { 
                
                 event.preventDefault();
                 
                 jQuery('.bxslider').magnificPopup('open');
       
                 
                });
 
                  jQuery('.bxslider').each(function () {
                  jQuery(this).magnificPopup({
                  delegate: 'a',
                  type: 'image',
                    gallery: {
                    enabled: true,
                    navigateByImgClick: false
                    },
                    fixedContentPos: false
                    });
                });
 
            });
        </script>       