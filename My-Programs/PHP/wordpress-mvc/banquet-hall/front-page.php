<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Banquet Hall
 */
get_header(); 

$hideslide = get_theme_mod('hide_slides', 1);
$secwithcontent = get_theme_mod('hide_sectionone', 1);
$hide_sectiontwo = get_theme_mod('hide_home_2_content', 1);

if (!is_home() && is_front_page()) { 
if( $hideslide == '') { ?>
<!-- Slider Section -->
<?php 
$slidepages = array();
for($sld=7; $sld<10; $sld++) { 
	$mod = absint( get_theme_mod('page-setting'.$sld));
    if ( 'page-none-selected' != $mod ) {
      $slidepages[] = $mod;
    }	
} 
if( !empty($slidepages) ) :
$args = array(
      'posts_per_page' => 3,
      'post_type' => 'page',
      'post__in' => $slidepages,
      'orderby' => 'post__in'
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :	
	$sld = 7;
?>
<section id="home_slider">
    <div class="slider-shadow"></div>	
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">      	
		<?php
        $i = 0;
        while ( $query->have_posts() ) : $query->the_post();
          $i++;
          $banquet_hall_slideno[] = $i;
          $banquet_hall_slidetitle[] = get_the_title();
		  $banquet_hall_slidedesc[] = get_the_excerpt();
          $banquet_hall_slidelink[] = esc_url(get_permalink());
          ?>
          <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" />
          <?php
        $sld++;
        endwhile;
          ?>
    </div>
        <?php
        $k = 0;
        foreach( $banquet_hall_slideno as $banquet_hall_sln ){ ?>
    <div id="slidecaption<?php echo esc_attr( $banquet_hall_sln ); ?>" class="nivo-html-caption">
      <div class="slide_info">
        <h2><?php echo esc_html($banquet_hall_slidetitle[$k] ); ?></h2>
        <p><?php echo esc_html($banquet_hall_slidedesc[$k] ); ?></p>
        <div class="clear"></div>
        <a class="slide_more" href="<?php echo esc_url($banquet_hall_slidelink[$k] ); ?>">
          <?php esc_html_e('View Our Venue', 'banquet-hall');?>
        </a>
      </div>
    </div>
 	<?php $k++;
       wp_reset_postdata();
      } ?>
<?php endif; endif; ?>
  </div>
  <div class="sliderounded"></div>	
</section>
<?php } } 
	if(!is_home() && is_front_page()){ 
	if( $secwithcontent == '') {
?>
<section id="sectionone">
	<div class="center">
         <div class="home_section1_content">
			<?php
                $section1_title = get_theme_mod('section1_title');
                if(!empty($section1_title)){?>
                  <div class="center-title">	
                  	<h2><?php echo esc_html($section1_title);?></h2>
                  </div>
            <?php } ?>       
            <div class="row_area">
    		<?php 
                for($l=1; $l<5; $l++) { 
                if( get_theme_mod('page-column-left'.$l,false)) {
                $section1block = new WP_query('page_id='.get_theme_mod('page-column-left'.$l,true)); 
                while( $section1block->have_posts() ) : $section1block->the_post(); 
            ?> 
            <div class="servicebox boxpattern-1">
                <a href="<?php echo esc_url( get_permalink() ); ?>">
                    <div class="serviceboxbg">
                        <?php 
                            if( has_post_thumbnail() ) {
                        ?>                	
                        <div class="servicebox-icon"><?php the_post_thumbnail('full');  ?></div>
                        <?php } ?>
                        <div class="servicebox-content"><h4><?php the_title(); ?></h4></div>
                    </div>
                </a>
            </div>
					<?php endwhile; wp_reset_postdata(); 
               }} 
            ?>		
<div class="clear"></div>
</div>  
         </div>
    </div>
</section>
<?php }}  
if (!is_home() && is_front_page()) { 
if( $hide_sectiontwo == '') { ?>
<section class="hometwo_section_area">


<?php 
	for($y=1; $y<5; $y++) { 
	if( get_theme_mod('page-sectwo-'.$y,false)) {
	$section2block = new WP_query('page_id='.get_theme_mod('page-sectwo-'.$y,true)); 
	while( $section2block->have_posts() ) : $section2block->the_post(); 
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?> 
<section class="section_area_bg" style="background:url(<?php echo esc_url($feat_image);?>);">
  <div class="<?php echo esc_html('sec2area'.$y);?>">	
  <div class="col-columns-2 <?php echo esc_html('colside'.$y);?>" id="custom-col">
        <div class="center-title">
          <h2><?php the_title(); ?></h2>
          <?php the_excerpt(); ?>
        </div>
        <div class="view-all-btn"><a href="<?php echo esc_url( get_permalink() ); ?>"><span><?php echo esc_html('Read More');?></span></a></div>
      </div>
      <div class="col-columns-2">&nbsp;</div>
      <div class="clear"></div>
  </div>    
</section>
<?php endwhile; wp_reset_postdata(); 
   }} 
?>

    	 
</section>
<?php } } ?>
<div class="clear"></div>
<div class="container">
     <div class="page_content">
      <?php 
	if ( 'posts' == get_option( 'show_on_front' ) ) {
    ?>
    <section class="site-main">
      <div class="blog-post">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                        endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'banquet-hall' ),
							'next_text' => esc_html__( 'Next', 'banquet-hall' ),
						) );
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
    <?php
} else {
    ?>
	<section class="site-main">
      <div class="blog-post">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
							 ?>
                             <header class="entry-header">           
            				<h1><?php the_title(); ?></h1>
                    		</header>
                             <?php
                            the_content();
                        endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'banquet-hall' ),
							'next_text' => esc_html__( 'Next', 'banquet-hall' ),
						) );
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
	<?php
}
	?>
    <?php get_sidebar();?>
    <div class="clear"></div>
  </div><!-- site-aligner -->
</div><!-- content -->
<?php get_footer(); ?>