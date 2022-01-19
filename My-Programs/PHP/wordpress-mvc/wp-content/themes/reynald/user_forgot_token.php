<!DOCTYPE html>
<html lang="en">
    <?php 
        require_once('../../../wp-load.php');
        get_template_part('header');        

        $msg="";
        if (isset($_GET['msg'])) {
            if (!empty($_GET['msg'])) {
                $msg = $_GET['msg'];
                unset($_GET['msg']);
            }
        }
        
    ?>
    <style>
        body {
            background-image: url('/wp-content/themes/reynald/assets/images/about-me.jpg');
            background-size: cover;
        }
    </style>
<body>
<div class="container" style="margin-bottom:120px;">    

<?php

    if(!empty($msg)) { ?>

    <div class="alert alert-warning alert-dismissible fade show" style="margin-top:20px;" role="alert">
    <strong>Alert Message!</strong> <?= $msg ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

<?php } ?>

    <!-- TOKEN VALIDATION -->
    <div class="card text-white mb-3 forgot" style="max-width: 25rem;background-color:orange;">
    <div class="card-header"><h4>Mail Token</h4></div>
    <div class="card-body">

        <form method="post" action="/wp-content/themes/reynald/user_forgot_token_submit.php" autocomplete="off">
        <div class="col-auto">
            <label for="forgot_mail">Enter the 4 digit Mail Token</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="mail_token" name="mail_token" required>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>

        </form>

    </div>
    </div>



</div>

<?php get_footer(); ?>
</body>
</html>
