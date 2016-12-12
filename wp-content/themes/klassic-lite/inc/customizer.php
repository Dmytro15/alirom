<?php
/**
 * Klassic Lite Theme Customizer
 *
 * @package Klassic Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function klassic_lite_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class klassic_lite_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }	

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';	
	
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#31cafd',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','klassic-lite'),			
			 'description'	=> __('More color options in PRO Version','klassic-lite'),	
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	
	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => __('Slider Settings', 'klassic-lite'),
            'priority' => null,
            'description'	=> __('Featured Image Size Should be ( 1400x600 )','klassic-lite'),		
        )
    );
	
	$wp_customize->add_setting('page-setting7',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','klassic-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','klassic-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','klassic-lite'),
			'section'	=> 'slider_section'
	));	// Slider Section
	
	$wp_customize->add_setting('disabled_slides',array(
				'default' => true,
				'sanitize_callback' => 'sanitize_text_field',
				'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_slides', array(
			   'settings' => 'disabled_slides',
			   'section'   => 'slider_section',
			   'label'     => __('Uncheck To Enable This Section','klassic-lite'),
			   'type'      => 'checkbox'
	 ));//Disable Slider Section
	
	
	// Home page What We Do Section 	
	$wp_customize->add_section('section_first',array(
		'title'	=> __('Homepage What We Do Section','klassic-lite'),
		'description'	=> __('Select Page from the dropdown for what we do section','klassic-lite'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('page-setting1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-setting1',array(
			'type' => 'dropdown-pages',		
			'section' => 'section_first',
	));
	
	$wp_customize->add_setting('disabled_whatwedo',array(
				'default' => true,
				'sanitize_callback' => 'sanitize_text_field',
				'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_whatwedo', array(
			   'settings' => 'disabled_whatwedo',
			   'section'   => 'section_first',
			   'label'     => __('Uncheck To Enable This Section','klassic-lite'),
			   'type'      => 'checkbox'
	 ));//Disable what we do Section	
	
	// Homepage Four Boxes Section 	
	$wp_customize->add_section('section_second', array(
		'title'	=> __('Homepage Four Boxes Section','klassic-lite'),
		'description'	=> __('Select Pages from the dropdown for homepage four boxes section','klassic-lite'),
		'priority'	=> null
	));		
	
	$wp_customize->add_setting('page-column1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column1',array(
			'type' => 'dropdown-pages',
			'label' => __('select page for box first','klassic-lite'),
			'section' => 'section_second',
	));		
	
	$wp_customize->add_setting('page-column2',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column2',array(
			'type' => 'dropdown-pages',
			'label' => __('select page for box second','klassic-lite'),
			'section' => 'section_second',
	));
	
	$wp_customize->add_setting('page-column3',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column3',array(
			'type' => 'dropdown-pages',
			'label' => __('select page for box third','klassic-lite'),
			'section' => 'section_second',
	));
	
	$wp_customize->add_setting('page-column4',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column4',array(
			'type' => 'dropdown-pages',
			'label' => __('select page for box fourth','klassic-lite'),
			'section' => 'section_second',
	));	//end four column part	
	
	$wp_customize->add_setting('disabled_pageboxes',array(
				'default' => true,
				'sanitize_callback' => 'sanitize_text_field',
				'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_pageboxes', array(
			   'settings' => 'disabled_pageboxes',
			   'section'   => 'section_second',
			   'label'     => __('Uncheck To Enable This Section','klassic-lite'),
			   'type'      => 'checkbox'
	 ));//Disable four boxes Section	
	
}
add_action( 'customize_register', 'klassic_lite_customize_register' );

function klassic_lite_custom_css(){
		?>
        	<style type="text/css"> 					
					a, .blog_lists h2 a:hover,
					#sidebar ul li a:hover,								
					.cols-3 ul li a:hover, .cols-3 ul li.current_page_item a,									
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a,					
					.headertop .left a:hover,
					.fourbox:hover h3,
					.headertop .left .fa,
					.headertop .social-icons a:hover,
					.contactdetail a:hover		
					{ color:<?php echo esc_html( get_theme_mod('color_scheme','#31cafd')); ?>;}
					 
					.pagination .nav-links span.current, .pagination .nav-links a:hover,
					#commentform input#submit:hover,
					h2.headingtitle:after,	
					.fourbox:hover .pagemore,
					.slidemore,				
					.nivo-controlNav a.active,				
					h3.widget-title,				
					.wpcf7 input[type='submit']					
					{ background-color:<?php echo esc_html( get_theme_mod('color_scheme','#31cafd')); ?>;}
					
					.fourbox:hover .pagemore
					{ border-color:<?php echo esc_html( get_theme_mod('color_scheme','#31cafd')); ?>;}
					
			</style> 
<?php        
}
           
add_action('wp_head','klassic_lite_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function klassic_lite_customize_preview_js() {
	wp_enqueue_script( 'klassic_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'klassic_lite_customize_preview_js' );