<?php get_header(); ?>
<div class="container">
			<div id="content" class="clearfix row">
                            
                            <div class="col-md-12 column">
                                <div class="page-header"><h1 class="single-title primary" itemprop="headline"><?php the_title(); ?></h1></div>     
                            </div>
			
				<div id="main" class="col-md-8 column clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
					

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
                              
						<section class="post_content clearfix" itemprop="articleBody">
							 
						 
					
						</section> <!-- end article section -->
						
						<footer>
			 	 
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
				 
                                        <div class="row clearfix">
                                        <div class="col-md-12 column">
                                            <h3 class="border-left"><?php _e("Summary", "wpbootstrap"); ?></h3>
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
                            <div class="col-md-4 column"> 
                         <h3 class="border-left">
				<?php _e("Key Facts", "wpbootstrap"); ?>
			</h3>
			<div class="row clearfix">
				 
				<div class="col-md-12 column">
					<div class="panel panel-default">
						<div class="panel-body">
							<span class="propertyListBoxDataItemName">
								<strong>Location:</strong> 	Berlin-Mitte
							</span>
						</div>
					 
						<div class="panel-body">
							<span class="propertyListBoxDataItemName"><strong>Type of property:</strong> 	Exclusive Apartments</span>
						</div>
						
							<div class="panel-body">
							<span class="propertyListBoxDataItemName"><strong>Address:</strong> 	Krausenstrasse 37 - Schützenstrasse 46, Berlin-Mitte</span>
						</div>
					 
					 
					 	<div class="panel-body">
							<span class="propertyListBoxDataItemName"><strong>Price range:</strong> 	€ 152.000 - € 822.500    <i class="fa fa-eur"></i>  
							<i class="fa fa-usd"></i> <i class="fa fa-gbp"></i>
							
							</span>
						</div>
					 
					 
					 	<div class="panel-body">
							<span class="propertyListBoxDataItemName"><strong>Commission (incl. VAT):</strong>	5.95 %</span>
						</div>
					 
					 
					 	<div class="panel-body">
							<span class="propertyListBoxDataItemName"><strong>Size range:</strong> 	40 m² - 144 m²</span>
						</div>
					 
		 
						<div class="panel-body">
 
 
								<span class="propertyListBoxDataItemName"><strong>Parking available:</strong> 	yes, optional</span>
 
 						</div>
					</div>
				</div>
			</div> 
                        </div> 
                        
                       <?php if ( is_user_logged_in() ):?>       
                            
                            
                        <div class="row clearfix">
				<div class="col-md-12 column">
                                 
                                <h3 class="border-left inline">
				<?php _e("List of products available in this program", "wpbootstrap"); ?>	
				</h3>
                                    <select name="sort_by_list">
                                     
                                     <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                                     <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                                     <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                                     <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                                      
                                    </select>
                                    
                                    <a href="#" class="active blue"><i class="fa fa-list"></i> </a>
                                    <a href="#" class="red"><i class="fa fa-th"></i></a>
                                     
                                    	<table class="table table-bordered">
				<thead>
					<tr>
						 
						<th>
							Prg ref
						</th>
						<th>
							address
						</th>
						<th>
							Flat n°
						</th>
						
						<th>
							Rental status
						</th>
						
						<th>
							floor
						</th>
						
						<th>
							Rooms
						</th>
						
						<th>
							surface
						</th>
						
						<th>
							Price
						</th>
						
						<th>
							Price/m²
						</th>
						
						<th>
							Yield
						</th>
						
						<th>
							status
						</th>
			 
					</tr>
				</thead>
				<tbody>
					<tr>
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
					<tr class="active">
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
					<tr class="danger">
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
					<tr class="">
							<td>
							3
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
					<tr class="">
							<td>
							4
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
