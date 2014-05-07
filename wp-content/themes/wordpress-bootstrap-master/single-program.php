<?php get_header(); ?>
<div class="container">
			<div id="content" class="clearfix row">
                            
                            <div class="col-md-12 column">
                                <div class="page-header"><h1 class="single-title primary" itemprop="headline"><?php the_title(); ?></h1></div>     
                            </div>
			
				<div id="main" class="col-md-8 column clearfix" role="main">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				  
                                                <!-- Tab panes -->
                                                <div class="tab-content">   
                                                <div class="tab-pane fade in active"  id="gallery_tab">    
                                                <!--slider here -->        
                                                <?php the_post_thumbnail( 'project-detail-big' ); ?>
					 
                                                <?php
                                                    $images =& get_children( array (
                                                    'post_parent' => $post->ID,
                                                    'post_type' => 'attachment',
                                                    'post_mime_type' => 'image'
                                                ));

                                                if ( empty($images) ) {
                                                // no attachments here
                                                } else {
                                                foreach ( $images as $attachment_id => $attachment ) {
                                                echo wp_get_attachment_image( $attachment_id, 'thumbnail' );
                                                }
                                                }
                                                ?>
                                                </div>
                                                    <div class="tab-pane fade"  id="map_tab">
                                                        <div id="gmap"></div>
                                                    </div>   
                                                    <div class="tab-pane fade"   id="street_tab">                                                       
                                                        <div id="gmapstreet"></div> 
                                                    </div>
                                                </div>
                                            
                                            <ul class="nav nav-pills">
                                                <li class="active"><a href="#gallery_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper"><i class="fa fa-eye"></i>Gallery</a></li>
                                                <li><a href="#map_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper"><i class="fa fa-map-marker"></i>Map View</a></li>   
                                                <li><a href="#street_tab" data-toggle="tab" class="btn blue btn-lg bold btn-default btn-upper"><i class="fa fa-video-camera"></i>Street View</a> </li> 
                                            </ul>
                                                
                                                
						<section class="post_content clearfix" itemprop="articleBody">
							 
						 
					
						</section> <!-- end article section -->
						
						<footer>
                                                    
						</footer> <!-- end article footer --> 
					</article> <!-- end article -->
                                        <div class="row clearfix">
                                        <div class="col-md-12 column border">
                                            <h3 class="border-left uppercase"><?php _e("Summary", "wpbootstrap"); ?></h3>
                                            <ul class="no-style">
						<li><i class="fa fa-check"></i>
							Top location within the central press and lifestyle district of Berlin
						</li>
						<li><i class="fa fa-check"></i>
							Superb construction and quality of materials providing utmost comfort and privacy
						</li>
						<li><i class="fa fa-check"></i>
							Excellent residential investment potential for a booming European capital city
						</li>
						<li><i class="fa fa-check"></i>
							In immediate vicitiny of world-class hotels, embassies and large international companies
						</li>
						<li><i class="fa fa-check"></i>
							Large penthouses with private roof terraces, smaller city living apartments
						</li>
						<li><i class="fa fa-check"></i>
							Option available to combine multiple apartments
						</li>
						<li><i class="fa fa-check"></i>
							On-site house concierge for daily errands and tasks
						</li>
						<li><i class="fa fa-check"></i>
							Start of construction: ca. April 2014
						</li>
					</ul>
                                        </div>
                                        </div>
                                </div>
                        <div class="col-md-4 column border"> 
                         <h3 class="border-left uppercase">
				<?php _e("Key Facts", "wpbootstrap"); ?>
			</h3>
			<div class="row clearfix"> 
				<div class="col-md-12 column">
					<div class="key_fact">
						<div class="panel-body">
                                                    <span class="propertyListBoxDataItemName"><i class="fa fa-home round-border"></i><strong><?php _e("Type of property:", "wpbootstrap"); ?></strong> Exclusive Apartments</span>  
						</div>
						 <div class="panel-body">  
						   <span class="propertyListBoxDataItemName"><i class="fa fa-map-marker round-border"></i><strong><?php _e("Address:", "wpbootstrap"); ?></strong><?php echo esc_attr(get_post_meta($post->ID, '_program_street', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_district', true)); ?> <?php echo esc_attr(get_post_meta($post->ID, '_program_city', true)); ?></span>
						</div>
					 	<div class="panel-body">
						<span class="propertyListBoxDataItemName"><i class="fa fa-arrows-alt round-border"></i><strong><?php _e("Size range:", "wpbootstrap"); ?></strong><?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)); ?> m² - <?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)); ?> m²
						 </span>
						</div>
					 	<div class="panel-body">
                                                      <span class="propertyListBoxDataItemName">
                                                        <i class="fa fa-money round-border"></i><strong><?php _e("Price range:", "wpbootstrap"); ?></strong><strong class="red"> &euro; <?php echo esc_attr(get_post_meta($post->ID, '_program_price_from', true)); ?>  - &euro; <?php echo esc_attr(get_post_meta($post->ID, '_program_price_to', true)); ?></strong></span>     
						</div>
					</div>
				</div>
			</div> 
                        </div>  
                       <?php if ( is_user_logged_in() ):?>       
                        <div class="row clearfix">
                                <div class="col-md-6">    
                                <h3 class="border-left inline uppercase">
				<?php _e("List of products available in this program", "wpbootstrap"); ?>	
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
                                            
                                                
                                                
                                                
                                                
                                                ?>
                                            <tr>    
                                                <td>
						 <i class="fa fa-star-o blue"></i>
						</td>
						<td>
							1
						</td>
						<td>
							 
						</td>
						<td>
						 
						</td>
						<td>
						 
						</td>
						
						<td>
							 
						</td>
						<td>
						 
						</td>
						<td>
						 
						</td>
						<td>
						 
						</td>
						
						<td>
						 
						</td>
						
						<td>
						 
						</td>
						
						<td>
						 
						</td>
					</tr>
					<tr class="background">
                                            <td>
                                                <i class="fa fa-star red"></i>
                                            </td>
                                            <td>
							2
						</td>
						<td>	 
						</td>
						<td>
						 
						</td>
						<td>
						 
						</td>
						
						<td>
							 
						</td>
						<td>
						 
						</td>
						<td>
						 
						</td>
						<td>
						 
						</td>
						
						<td>
						 
						</td>
						
						<td>
						 
						</td>
						
						<td>
						 
						</td>
						
					</tr>
				 
				</tbody>
			</table>
        
                                </div>
                        </div>
                        <?php endif; ?>    
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
</div>
<?php get_footer(); ?>
