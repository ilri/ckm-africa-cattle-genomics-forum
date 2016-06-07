			<!-- Start footer -->
			<div class="b_body_f clearfix" id="footer">
				<?php
					$pattern = explode( '.' , options::get_value( 'styling' , 'background' ) ) ;
					if( isset( $pattern[ count( $pattern ) - 1 ] ) && $pattern[ count( $pattern ) - 1 ] == 'none' ){
						$background_img = '';
					}else{
						$background_img = "url(" . str_replace( 's.pattern.' , 'pattern.' , options::get_value( 'styling' , 'background' ) ) . ")";

					}  
				?>
				<div class="b_f_c" style="background: <?php echo options::get_value( 'styling' , 'footer_bg_color' ); ?> <?php echo $background_img; ?>;">
                   <div class="b_page clearfix footer-area">
                        <div class="b w_300">
                            <?php get_sidebar( 'footer-first' ); ?>
                        </div>
                        <div class="b w_300">
                            <?php get_sidebar( 'footer-second' ); ?>
                        </div>
                        <div class="b w_300"> 
                            <?php get_sidebar( 'footer-third' ); ?>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="b_page clearfix">
							<div class="b w_460">					
								<p class="copyright"><?php echo options::get_value( 'general' , 'footer_text' ) ; ?> </p>
							</div>
							<div class="b w_460">
								<?php echo menu( 'footer_menu' , array( 'class' => 'footer-menu' , 'number-items' => options::get_value( 'menu' , 'footer' )  , 'current-class' => 'active' ) ); ?>
							</div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </div>
<?php
    echo options::get_value('general' , 'tracking_code');

    wp_footer();
?>
</body>
</html>
