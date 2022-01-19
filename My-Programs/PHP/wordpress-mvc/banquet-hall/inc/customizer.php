<?php
/**
 * Banquet Hall Theme Customizer
 *
 * @package Banquet Hall
 */
function banquet_hall_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'banquet_hall_custom_header_args', array(
		'default-text-color'     => '949494',
		'width'                  => 1600,
		'height'                 => 230,
		'wp-head-callback'       => 'banquet_hall_header_style',
 		'default-text-color' => false,
 		'header-text' => false,
	) ) );
}
add_action( 'after_setup_theme', 'banquet_hall_custom_header_setup' );
if ( ! function_exists( 'banquet_hall_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see banquet_hall_custom_header_setup().
 */
function banquet_hall_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() ) :
	?>
		.header {
			background: url(<?php echo esc_url(get_header_image()); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	
	</style>
	<?php
}
endif; // banquet_hall_header_style 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */ 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function banquet_hall_customize_register( $wp_customize ) {
	//Add a class for titles
    class banquet_hall_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#ff5f6a',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => esc_html__('Color Scheme','banquet-hall'),			
			 'description'	=> esc_html__('More color options in PRO Version','banquet-hall'),	
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_section('header_top_bar',array(
			'title'	=> esc_html__('Header Contact Number','banquet-hall'),					
			'priority'		=> null
	));
	
	$wp_customize->add_setting('header_contactnumber',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('header_contactnumber',array(
			'label'	=> esc_html__('Add contact number here','banquet-hall'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'header_contactnumber'
	));	

	// Hide Header Contact Number
	$wp_customize->add_setting('hide_header_topbar',array(
			'sanitize_callback' => 'banquet_hall_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_header_topbar', array(
    	   'section'   => 'header_top_bar',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','banquet-hall'),
    	   'type'      => 'checkbox'
     )); 	
	 // Hide Header Contact Number 	

	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => esc_html__('Slider Settings', 'banquet-hall'),
            'priority' => null,
            'description'	=> esc_html__('Featured Image Size Should be ( 1400 X 774 ) More slider settings available in PRO Version','banquet-hall'),		
        )
    );
	$wp_customize->add_setting('page-setting7',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'banquet_hall_sanitize_integer'
	));
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide one:','banquet-hall'),
			'section'	=> 'slider_section'
	));	
	$wp_customize->add_setting('page-setting8',array(
			'default' => '0',
			'capability' => 'edit_theme_options',			
			'sanitize_callback'	=> 'banquet_hall_sanitize_integer'
	));
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide two:','banquet-hall'),
			'section'	=> 'slider_section'
	));	
	$wp_customize->add_setting('page-setting9',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'banquet_hall_sanitize_integer'
	));
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide three:','banquet-hall'),
			'section'	=> 'slider_section'
	));	
	//Slider hide
	$wp_customize->add_setting('hide_slides',array(
			'sanitize_callback' => 'banquet_hall_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_slides', array(
    	   'section'   => 'slider_section',    	 
		   'label'	=> esc_html__('Uncheck To Show Slider','banquet-hall'),
    	   'type'      => 'checkbox'
     )); // Slider Section	
	 
// Home Section 1
	$wp_customize->add_section('section_one', array(
		'title'	=> esc_html__('Home Section one','banquet-hall'),
		'description'	=> esc_html__('Select Page from the dropdown','banquet-hall'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('section1_title',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('section1_title',array(
			'label'	=> __('Section Title','banquet-hall'),
			'section'	=> 'section_one',
			'setting'	=> 'section1_title'
	));		
	
	$wp_customize->add_setting('page-column-left1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'banquet_hall_sanitize_integer',
		));
	$wp_customize->add_control(	'page-column-left1',array('type' => 'dropdown-pages',
			'section' => 'section_one'
	));	
	
	$wp_customize->add_setting('page-column-left2',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'banquet_hall_sanitize_integer',
		));
	$wp_customize->add_control(	'page-column-left2',array('type' => 'dropdown-pages',
			'section' => 'section_one'
	));	
	
	$wp_customize->add_setting('page-column-left3',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'banquet_hall_sanitize_integer',
		));
	$wp_customize->add_control(	'page-column-left3',array('type' => 'dropdown-pages',
			'section' => 'section_one'
	));	
	
	$wp_customize->add_setting('page-column-left4',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'banquet_hall_sanitize_integer',
		));
	$wp_customize->add_control(	'page-column-left4',array('type' => 'dropdown-pages',
			'section' => 'section_one'
	));				
	
	//Hide Section
	$wp_customize->add_setting('hide_sectionone',array(
			'sanitize_callback' => 'banquet_hall_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_sectionone', array(
    	   'section'   => 'section_one',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','banquet-hall'),
    	   'type'      => 'checkbox'
     )); //Hide Section	 	 

	// Home Section 2
	$wp_customize->add_section('hm_section_2', array(
		'title'	=> esc_html__('Home Section Two','banquet-hall'),
		'description'	=> esc_html__('Select Page from the dropdown for section','banquet-hall'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('page-sectwo-1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'banquet_hall_sanitize_integer',
		));
	$wp_customize->add_control(	'page-sectwo-1',array('type' => 'dropdown-pages',
			'section' => 'hm_section_2'
	));	
	
	$wp_customize->add_setting('page-sectwo-2',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'banquet_hall_sanitize_integer',
		));
	$wp_customize->add_control(	'page-sectwo-2',array('type' => 'dropdown-pages',
			'section' => 'hm_section_2'
	));	
	
	$wp_customize->add_setting('page-sectwo-3',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'banquet_hall_sanitize_integer',
		));
	$wp_customize->add_control(	'page-sectwo-3',array('type' => 'dropdown-pages',
			'section' => 'hm_section_2'
	));	
	
	$wp_customize->add_setting('page-sectwo-4',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'banquet_hall_sanitize_integer',
		));
	$wp_customize->add_control(	'page-sectwo-4',array('type' => 'dropdown-pages',
			'section' => 'hm_section_2'
	));		

	//Hide Section 	
	$wp_customize->add_setting('hide_home_2_content',array(
			'sanitize_callback' => 'banquet_hall_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_home_2_content', array(
    	   'section'   => 'hm_section_2',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','banquet-hall'),
    	   'type'      => 'checkbox'
     )); // Hide Section 	
}
add_action( 'customize_register', 'banquet_hall_customize_register' );
//Integer
function banquet_hall_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
function banquet_hall_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

//setting inline css.
function banquet_hall_custom_css() {
    wp_enqueue_style(
        'banquet-hall-custom-style',
        get_template_directory_uri() . '/css/banquet-hall-custom-style.css'
    );
        $color = get_theme_mod( 'color_scheme' ); //E.g. #e64d43
		$header_text_color = get_header_textcolor();
        $custom_css = "
					#sidebar ul li a:hover,
					.footerarea a:hover,
					.cols-3 ul li.current_page_item a,				
					.phone-no strong,					
					.left a:hover,
					.blog_lists h4 a:hover,
					.recent-post h6 a:hover,
					.recent-post a:hover,
					.design-by a,
					.fancy-title h2 span,
					.postmeta a:hover,
					.left-fitbox a:hover h3, .right-fitbox a:hover h3, .tagcloud a,
					.blocksbox:hover h3,
					.homefour_section_content h2 span,
					.section5-column:hover h3,
					.cols-3 span,
					.section1top-block-area h2 span,
					.hometwo_section_content h2 span,
					.rdmore a,
					.hometwo_section_area h2 small,
					.hometwo_section_area .woocommerce ul.products li.product:hover .woocommerce-loop-product__title,
					.home3_section_area h2 small,
					.sec3-block-button2,
					.designboxbg:hover .designbox-content h3,
					.hometwo-service-column-title a:hover,
					.serviceboxbg:hover .servicebox-content h4
					{ 
						 color: {$color} !important;
					}
					.pagination .nav-links span.current, .pagination .nav-links a:hover,
					#commentform input#submit:hover,
					.wpcf7 input[type='submit'],
					a.ReadMore,
					.section2button,
					input.search-submit,
					.recent-post .morebtn:hover, 
					.slide_info .slide_more,
					.sc1-service-box-outer,
					.read-more-btn,
					.woocommerce-product-search button[type='submit'],
					.head-info-area,
					.designs-thumb,
					.hometwo-block-button,
					.nivo-controlNav a,
					.aboutmore,
					.service-thumb-box,
					.view-all-btn a:hover,
					.header
					{ 
					   background-color: {$color} !important;
					}
					.sc1-service-box-outer h3 a:hover, .sc1-service-box-outer:hover h3 a,
					.hometwo_section_area .woocommerce ul.products li.product:hover,
					.nivo-controlNav a
					{
					   border-color: {$color} !important;
					}
					.titleborder span:after, .perf-thumb:before, .cols-3 h5:after{border-bottom-color: {$color} !important;}
					.perf-thumb:after{border-top-color: {$color} !important;}					
					
				";
        wp_add_inline_style( 'banquet-hall-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'banquet_hall_custom_css' );          
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function banquet_hall_customize_preview_js() {
	wp_enqueue_script( 'banquet_hall_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'banquet_hall_customize_preview_js' );