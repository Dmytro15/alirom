<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Klassic Lite
 */
?>

<div class="footer">     
    	<div class="container">
              <?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>             
               <?php endif; // end footer widget area ?>    
                        
               <?php if ( ! dynamic_sidebar( 'footer-2' ) ) : ?>                                  	
               <?php endif; // end footer widget area ?>   
            
               <?php if ( ! dynamic_sidebar( 'footer-3' ) ) : ?>                
               <?php endif; // end footer widget area ?>                
                
            <div class="clear"></div>
        </div><!--end .container--> 
    </div><!--end .footer--> 
    <div class="copyright-wrapper">
        	<div class="container">
            	<div class="copyright-txt">
				<?php _e('&copy; 2016','klassic-lite');?> <?php bloginfo('name'); ?>. <?php _e('All Rights Reserved', 'klassic-lite');?>             
       			 </div>
                <div class="design-by">
                  <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'klassic-lite' ) ); ?>">
				    <?php printf( __( 'Proudly Powered by %s', 'klassic-lite' ), 'WordPress' ); ?>
                  </a>
                </div>
                <div class="clear"></div>
            </div>            
</div><!--end .copyright-wrapper--> 
<?php wp_footer(); ?>

</body>
</html>