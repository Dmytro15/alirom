<?php
/**
 * Klassic Lite About Theme
 *
 * @package Klassic Lite
 */
//about theme info
add_action( 'admin_menu', 'klassic_lite_abouttheme' );
function klassic_lite_abouttheme() {    	
	add_theme_page( __('About Theme', 'klassic-lite'), __('About Theme', 'klassic-lite'), 'edit_theme_options', 'klassic_lite_guide', 'klassic_lite_mostrar_guide');   
} 

//guidline for about theme
function klassic_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div>
			  <h2><?php _e('About Theme Info', 'klassic-lite'); ?></h2>
		   </div>
          <p><?php _e('Klassic Lite WordPress theme is a clean and modern multipurpose WordPress theme. You can use Klassic WordPress theme for corporate, business, photography, wedding, industrial, hotels or any type of industry. Enjoy your designed pages on any devices. No matter what screen size is in use the output will make you happy. Compatible with most popular plugin like WooCommerce, Nextgen gallery and Contact form 7. Comes with default gallery to showcase your latest work or projects. Default page templates also included with this theme. The theme is translation ready.','klassic-lite'); ?></p>
		  
	</div><!-- .col-left -->
	
	<div class="col-right">			
				<hr />
				<a href="<?php echo klassic_lite_live_demo; ?>" target="_blank"><?php _e('Live Demo', 'klassic-lite'); ?></a> | 
				<a href="<?php echo klassic_lite_pro_theme_url; ?>"><?php _e('Buy Pro', 'klassic-lite'); ?></a> | 
				<a href="<?php echo klassic_lite_theme_doc; ?>" target="_blank"><?php _e('Documentation', 'klassic-lite'); ?></a>               
				<hr />		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>