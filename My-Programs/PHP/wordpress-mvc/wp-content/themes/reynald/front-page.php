<?php
	get_header(); 

	$msg = "";
	if (isset($_GET['usermsg'])) {
		$msg = $_GET['usermsg'];
	}

	// $popmsg = "";
	// if (isset($_GET['register'])) {
	// 	$popmsg = $_GET['register'];
	// }

	// $data = [
	// 	'status' => 'active',
	//   ];
	//   get_template_part('xhead', 'modal-status', $data);	

?>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-danger text-light">
					<h5 class="modal-title" id="staticBackdropLabel">Alert Message</h5>
				</div>
				<div class="modal-body"><?= $msg; ?></div>
			</div>
		</div>
</div>


<!-- START CAROUSEL -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				<ol id="xindicators" class="carousel-indicators">
					<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></li>
					<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></li>
					<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></li>
					<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 4"></li>
				</ol>
				<div class="carousel-inner">
				  <div class="carousel-item active">
					  <div class="view">
						<video class="video-fluid xvideo" autoplay loop muted>
							<source src="/wp-content/themes/reynald/assets/images/vid1.mp4" type="video/mp4" />
						</video>
					  </div>
					<div class="carousel-caption  d-md-block">
						<h5 class="text-light">Connected commerce for a connected world.</h5> -->
						<!-- <p class="text-light">Some representative placeholder content for the first slide.</p> -->
					</div>				  
				</div>
				  <div class="carousel-item">
					<img src="/wp-content/themes/reynald/assets/images/atm2.jpeg" class="w-100 slides" alt="2">
					<div class="carousel-caption d-md-block">
						<h5 class="text-light">Banking Solutions</h5>
						<p class="text-light">Managed Services: Flexible Support for Your Modern Banking Environment</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="/wp-content/themes/reynald/assets/images/atm3.jpeg" class="w-100 slides" alt="3">
					<div class="carousel-caption d-md-block">
						<h5 class="text-light">Connected retail for a connected world.</h5>
						<p class="text-light">Explore our latest banking and retail solutions with the new DN Visualizer app.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="/wp-content/themes/reynald/assets/images/atm4.jpeg" class="w-100 slides" alt="3">
					<div class="carousel-caption d-md-block">
						<h5 class="text-light">Third slide label</h5>
						<p class="text-light">Some representative placeholder content for the third slide.</p>
					</div>
				</div>


				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
				
			</div>
			
</div>	
<!-- END CAROUSEL -->
    
		<article class="content px-3 py-5 p-md-5">
	    <div class='container-fluid'>
			<header class="page-title theme-bg-light text-center gradient py-5 header-top">
			  <h1 class="heading">Banking Solutions</h1>
   		    </header>
			<p class="mt-30 lead lead-top">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
						

			<section class="theme-bg-dark py-5 section-top text-center">
				<h3 class='text-mute d-block'>Subscribe to the Newsletter</h3>
			    <form class="signup-form form-inline justify-content-center pt-3">
                    <div class="form-group">
                        <label class="sr-only" for="semail">Your email</label>
                        <input type="email" id="semail" name="semail1" class="form-control mr-md-1 semail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Subscribe</button>
					</div>
                </form>
			</section>


			<!-- <div class="row row-cols-1 card-top row-cols-md-2">
				<div class="col mb-4">
				  <div class="card">
					<div class="card-body">
					  <h5 class="card-title">Card title</h5>
					  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
					</div>
				  </div>
				</div>
				<div class="col mb-4">
				  <div class="card">
					<div class="card-body">
					  <h5 class="card-title">Card title</h5>
					  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
					</div>
				  </div>
				</div>
			</div> -->

			<div class="row row-cols-1 row-cols-md-2">
			<div class="col mb-4">
				<div class="card">
				<img src="/wp-content/themes/reynald/assets/images/1.jpeg" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title">Join Us at Intersect Online, Oct. 26, 2021</h5>
					<p class="card-text">Get an exclusive first look at new research from a collaboration between NielsenIQ and DN. We’re going beyond “who” and “how” to focus on WHY consumers behave the way they do.</p>
				</div>
				</div>
			</div>
			<div class="col mb-4">
				<div class="card">
				<img src="/wp-content/themes/reynald/assets/images/2.jpeg" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title">DN SeriesTM EASY: The next level of self-service is here.</h5>
					<p class="card-text">Retail is changing fast. Our new retail self-service solutions are highly modular, more open than ever before and offer you the ultimate uptime and reliability, so you can be prepared for the future of retail.</p>
				</div>
				</div>
			</div>
			</div>

			<script>
				$('.carousel').carousel({
				interval: 10000
				})
			</script>

			<!-- <?php
				if( have_posts() ) {
					while( have_posts() ) {
						the_post();
						the_content();
					}
				}
			?> -->
	<?php
	
?>	

		</article>







<?php get_footer(); ?>
<?php
if (empty($popmsg)) {  
	?>
	<script>
	  $('.loginpopover').popover('hide');
	</script>
	<?php
} else {
	?>
	<script>
	  $('.loginpopover').popover('show');
	</script>
	<?php

}


if (empty($msg)) {  ?>
		<script> 
			$('#staticBackdrop').modal('hide'); 
		</script>
		<?php
} else { ?>
		<script> 
			$('#staticBackdrop').modal('show'); 
		</script>
<?php
}
?>

<?php
	unset($msg);
	unset($_GET['usermsg']);
	unset($popmsg);
	unset($_GET['popmsg']);
?>

