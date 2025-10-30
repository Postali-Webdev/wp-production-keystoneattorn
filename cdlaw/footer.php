<?php global $qode_options_passage; ?>
				
		</div>
	</div>

		<footer>
		
		
					
						<!-- add Contact bar -->
                        <div class="footer_top_bar">
                        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-consultation') ) : ?><?php endif; ?>
                       	</div>    
                        <!-- -->   
		
			<div class="footer_holder clearfix">	
					
						<?php	
						$display_footer_widget = false;
						if ($qode_options_passage['footer_widget_area'] == "yes") $display_footer_widget = true;
						if($display_footer_widget): ?> 
						<div class="footer_top_holder">
							<div class="footer_top">		
														
							<div class="container_inner">	
								
									<?php
										$header_in_grid = false;
										if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

									?>
									
									<?php if($header_in_grid){ ?>
										<div class="container">
											<div class="container_inner clearfix">
									<?php } ?>
									<div class="footer_top_inner">
										<div class="three_columns clearfix">
											<div class="column1">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_1' ); ?>
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_2' ); ?>
												</div>
											</div>
                                            <div class="column3">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_3' ); ?>
												</div>
											</div>
										</div>
									</div>
									<?php if($header_in_grid){ ?>
										</div>
									</div>
								<?php } ?>
								
							</div>
						</div>
						</div>
						<?php endif; ?>
						
						<?php
						$display_footer_text = false;
						if (isset($qode_options_passage['footer_text'])) {
							if ($qode_options_passage['footer_text'] == "yes") $display_footer_text = true;
						}
						if($display_footer_text): ?>
						<div class="footer_bottom_holder">
							<div class="footer_bottom">
								<div class="container_inner">
								<?php dynamic_sidebar( 'footer_text' ); ?>
								</div>	
							</div>
						</div>
						<?php endif; ?>
			</div>
		</footer>
		
		<!-- Add sticky mobile phone bar -->
<div id="mobile_contact_bar"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Mobile-Contact-Bar') ) : ?><?php endif; ?></div>

</div>
<?php
global $qode_toolbar;
if(isset($qode_toolbar)) include("toolbar.php")
?>
	<?php wp_footer(); ?>
	<!-- Google font call -->
	<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet"> -->

</body>
</html>