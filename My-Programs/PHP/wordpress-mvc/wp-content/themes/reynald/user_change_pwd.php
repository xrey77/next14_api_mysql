<?php session_start(); ?>
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
    <div class="card text-white mb-3 forgot" style="max-width: 25rem;background-color:green;">
    <div class="card-header"><h4>Change your Password</h4></div>
    <div class="card-body">

        <form method="post" action="/wp-content/themes/reynald/user_forgot_change_pwd.php" autocomplete="off">
        <div class="col-auto">
            <div class="form-group">
                <input type="email" class="form-control" id="mail_add" name="mail_add" value="<?= $_SESSION['EMAIL'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="new_pwd">Enter your new password.</label>
                <input type="password" class="form-control" id="new_pwd" name="new_pwd" required>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>

        </form>

    </div>
    </div>



</div>

<?php get_footer(); ?>

<script>

$(":input").inputmask();

$("#reynald").inputmask({"mask": "(999) 999-9999"});
</script>
<style>
input {
  font-family: monospace;
}
label {
  display: block;
}
div {
  margin: 0 0 1rem 0;
}
</style>
</body>
</html>
