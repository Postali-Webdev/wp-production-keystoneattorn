<?php 
global $qode_options_passage; 

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

?>	

<?php get_header(); ?>
			<div class="title animate" >
				<?php if($title_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
				<?php } ?>
				<?php if($title_in_grid){ ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="container full_width">
				<div class="container_inner">
						
  						<div class="page_not_found">
                       								                       								
                                <div class="two_columns_33_66 clearfix">
                                <div class="column1"><div class="column_inner">      
                                                    
                                <img src="/wp-content/uploads/2017/06/404.png" alt="404 Page not found">
                            	</div></div>
                                
                                <div class="column2"><div class="column_inner"> 
                            <h1 class="diamond_red">404 - Page Not Found</h1> 

    						<p>Our apologies, but the page you requested could not be found.</p>
                            
                            <h4>Maybe these links are what you are looking for?</h4>
                            
                			<ul>
                			<li><a href="/criminal-defense/" title="Criminal Defense">Criminal Defense</a></li>
                			<li><a href="/family/" title="Family Law">Family Law</a></li>
                			<li><a href="/bankruptcy-lawyers/" title="Bankruptcy">Bankruptcy</a></li>
                			<li><a href="/mortgage-foreclosure-lawyers/" title="Mortgage Foreclosure">Mortgage Foreclosure </a></li>
                			<li><a href="/pardons/" title="Pardons">Pardon & Expungement</a></li>
                			<li><a href="/civil-litigation/" title="Civil Litigation">Civil Litigation</a></li>	
                			</ul>
                            
                            If not, perhaps you should head <a href="/" title="Head back home">Back Home</a> and try again.
                            
                                </div></div>
                                
                                </div> <!-- end 2 columns -->   
						</div>						

				</div>
			</div>
			
<?php get_footer(); ?>	