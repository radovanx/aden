<?php
/*
Template Name: About Us Page
*/
?>

<?php get_header(); ?>

<div class="background">
<div class="container">
    <div id="content" class="clearfix row">		
				<div id="main" class="col col-lg-12 clearfix" role="main">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<div class="jumbotron">
						<header>
							
                                                    <div class="page-header"><h1 class="border-left uppercase"><?php the_title(); ?></h1></div>
						
						</header> <!-- end article header -->
					
						<section class="post_content col col-lg-6">
                                                    
                                            
							<?php the_content(); ?>
                                                        
						</section> <!-- end article section -->
                                                
                  
					 
                                                </div>
					</article> <!-- end article -->
 
                                        <?php endwhile; ?>	
                                        <?php endif; ?>                
            </div>
    </div>    
</div>
 </div>
    <div class="container"> 
    <div class="row clearfix testimonial">
                <h1 class="border-left">TESTIMONIALS</h1> 
		<div class="col-md-4 column">
			<h4>
				Testimonial 1
			</h4>
			<p>
			 <em>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                         </em>
                         </p>
		 
		</div>
		 <div class="col-md-4 column">
			<h4>
				Testimonial 1
			</h4>
			<p>
			 <em>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                         </em>
                         </p>
		 
		</div>
                <div class="col-md-4 column">
			<h4>
				Testimonial 1
			</h4>
			<p>
			 <em>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                         </em>
                         </p>
		 
		</div>
	</div>
    
          <div class="row clearfix">  
		
	 
		<div class="col-md-8 column">
		<h2>Contact Form</h2>	 
                    
                    
                    
                    
		</div>
		 <div class="col-md-4 column">
                     <h3 class="border-left">CONTACT INFORMATIONS</h3> 
                 
					 <address> <strong>Twitter, Inc.</strong><br /> 795 Folsom Ave, Suite 600<br /> San Francisco, CA 94107<br /> <abbr title="Phone">P:</abbr> (123) 456-7890</address>
				</div>
        </div>
    
    

 </div>
 
 
 
<?php get_footer(); ?>