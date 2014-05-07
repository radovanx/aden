<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>
<div class="container">
			<div id="content" class="clearfix row">
				<div class="col-sm-12 clearfix" role="main">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						<header>
							
							<div class="page-header"><h1 class="page-title border-left" itemprop="headline"><?php the_title(); ?></h1></div>
						
						</header> <!-- end article header -->
	 
					</article> <!-- end article -->
			 
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
			 
			</div> <!-- end #content -->
  
	<div class="row clearfix">
            <form role="form">
		<div class="col-md-6 column">
			
				<div class="form-group">
					 <label for="exampleInputEmail1"><?php _e("City:", "wpbootstrap"); ?></label><input class="form-control" id="exampleInputEmail1" type="text" />
				</div>
                            
                            
                            
                            
				<div class="form-group">
					 <label for="exampleInputEmail1"><?php _e("City:", "wpbootstrap"); ?></label> 
                                         
                                         <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>      
				</div>
		 
                            <row>
                                <div class="col-md-6 column">    
                                <div class="form-group">
					 <label for="exampleInputFile">File input</label><input id="exampleInputFile" type="file" />
					<p class="help-block">
						Example block-level help text here.
					</p>
				
                                
                                
                                </div>
                                </div>    
                                    
                            </row> 
                            
                            <div class="form-group">
					 <label for="exampleInputEmail1"><?php _e("City:", "wpbootstrap"); ?></label><input class="form-control" id="exampleInputEmail1" type="text" />
				</div>
         
		</div>
		<div class="col-md-6 column">
			 
				<div class="form-group">
					 <label for="exampleInputEmail1">Email address</label><input class="form-control" id="exampleInputEmail1" type="email" />
				</div>
				<div class="form-group">
					 <label for="exampleInputPassword1">Password</label><input class="form-control" id="exampleInputPassword1" type="password" />
				</div>
				<div class="form-group">
					 <label for="exampleInputFile">File input</label><input id="exampleInputFile" type="file" />
					<p class="help-block">
						Example block-level help text here.
					</p>
				</div>
				<div class="checkbox">
					 <label><input type="checkbox" /> Check me out</label>
				</div> <button type="submit" class="btn btn-default">Submit</button>
		</div>
            
            			</form>

	</div>
</div>




<?php get_footer(); ?>