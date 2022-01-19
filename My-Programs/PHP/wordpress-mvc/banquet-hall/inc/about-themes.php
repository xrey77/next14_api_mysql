<?php
//about theme info
add_action( 'admin_menu', 'banquet_hall_abouttheme' );
function banquet_hall_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'banquet-hall'), esc_html__('About Theme', 'banquet-hall'), 'edit_theme_options', 'banquet_hall_guide', 'banquet_hall_mostrar_guide');   
} 
//guidline for about theme
function banquet_hall_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'banquet-hall'); ?>
		   </div>
          <p><?php esc_html_e('Banquet Hall is marriage, wedding, celebration, events, conference, campaigns, fundraisers, music band event, DJ night, commemoration, festivals, enjoyment, parties, meetings, encounter, jubiliation, revelry, carnival, presentation, marital, engagement, ring, naming ceremony. It is multipurpose template and comes with a ready to import Elementor template plugin as add on which allows to import 63+ design templates for making use in home and other inner pages. Use it to create any type of business, personal, blog and eCommerce website. It is fast, flexible, simple and fully customizable. WooCommerce ready designs. Since the theme is pictoral can be used for portfolio and photographers as well. Interior designers, architects, speakers, online coaches and business houses can also make use of this theme.','banquet-hall'); ?></p>
		  <a href="<?php echo esc_url(BANQUET_HALL_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(BANQUET_HALL_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'banquet-hall'); ?></a> | 
				<a href="<?php echo esc_url(BANQUET_HALL_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'banquet-hall'); ?></a> | 
				<a href="<?php echo esc_url(BANQUET_HALL_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'banquet-hall'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(BANQUET_HALL_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>