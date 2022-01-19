<!DOCTYPE html>
<html lang="en">
    <?php 
        require_once('../../../wp-load.php');
        get_template_part('header');
    ?>
    <style>
        body {
            background-image: url('/wp-content/themes/reynald/assets/images/about-me.jpg');
            background-size: cover;
        }
    </style>
<body>
<div class="container-fluid">    
<h1>About Us</h1>

<div class="jumbotron" style="background-color:transparent;color:white;">
  <h1 class="display-4">Company</h1>
  <h4>Who We Are</h4>
  <p class="lead">At Diebold Nixdorf, we're driven by your needs. Find out what the means to us.</p>
  <hr class="my-4">

  <p>Diebold Nixdorf's leadership team is comprised of an international group of insightful problem-solvers and creative thinkers. Meet the expers championing connected commerce for the new digital era.</p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
</div>
    </div>


<?php get_footer(); ?>
</body>
</html>
