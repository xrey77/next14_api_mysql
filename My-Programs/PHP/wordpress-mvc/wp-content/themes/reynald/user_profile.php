<?php
    require_once('../../../wp-load.php');
    $current_user = wp_get_current_user();
    $UID =  $current_user->ID;
    $FNAME = $current_user->first_name;
    $LNAME = $current_user->last_name;
    $EMAIL =  $current_user->user_email;
    $USERNAME =  $current_user->user_login;
    $pix = $current_user->user_url;
?>
<!DOCTYPE html>
<html lang="en">

<?php 
        require_once('../../../wp-load.php');
        get_template_part('header');
?>

<body>

<div class="container">
    <div class="card profile-width" style="margin-top:20px;">
        <div class="card-header bg-info text-light">
            User Profile
        </div>
        <div class="card-body">

        <form method="post" action="/wp-content/themes/reynald/update_profile.php" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group-sm">
                <?php
                        if (empty($pix)) {
                            // . get_avatar( $current_user->user_email, 32 ) .
                            echo '<img id="userpic" src="/wp-content/themes/reynald/assets/images/pix.png" width="100p" height="100"  />';
                        } else {
                          echo '<img style="border-radius:20px;" id="userpic" src="' .  $pix . '" width="100p" height="100"  />';
                        }

                ?>
                <!-- <img id="userpic" src="/wp-content/themes/reynald/assets/images/pix.png" width="100" height="100"/> -->
            </div>
            <div class="form-group-sm">
                <label for="picture">Chage profile picture</label>
                <input onchange="checkImage(event)" type="file" class="form-control-file" id="picture" name="picture">

                <div class="form-group-sm">
                    <label for=fname">User ID</label>
                    <input type="text" class="form-control" value="<?= $UID ?>" id="uid" name="uid" readonly>
                </div>

                <div class="form-group-sm">
                    <label for=fname">First Name</label>
                    <input type="text" class="form-control" value="<?= $FNAME ?>" id="fname" name="fname" aria-describedby="fnameHelp" required>
                    <div class="invalid-feedback">
                        Please provide your First Name.
                    </div>
                </div>
                <div class="form-group-sm">
                    <label for=lname">Last Name</label>
                    <input type="text" class="form-control" value="<?= $LNAME ?>" id="lname" name="lname" aria-describedby="lnameHelp" required>
                    <div class="invalid-feedback">
                        Please provide your Last Name.
                    </div>
                </div>

                <div class="form-group-sm">
                    <label for=lname">Email Addres</label>
                    <input readonly type="text" class="form-control" value="<?= $EMAIL ?>" id="email" name="email">
                </div>

                <div class="form-group-sm">
                    <label for=lname">User Name</label>
                    <input readonly type="text" class="form-control" value="<?= $USERNAME ?>" id="uname" name="uname">
                </div>


                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" name="changepwd" id="changepwd" onclick="changePwd(this)">
                    <label class="form-check-label" for="changepwd">Change Password?</label>
                </div>

                <div class="form-group-sm">
                    <label id="pwdlbl" for=pwd">New Password</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" aria-describedby="pwdHelp" required>
                    <div class="invalid-feedback">
                        Please provide your New Password.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top:10px;">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>

<script>
    $('#pwdlbl').hide();
    $('#pwd').hide();
    $('#pwd').attr('readonly', true);
    function changePwd() {
        isChecked = $('input[name=changepwd]').is(':checked');
        if (isChecked == true) {
            $('#pwdlbl').show();
            $('#pwd').show();    
            $('#pwd').attr('readonly', false);
        } else {
            $('#pwdlbl').hide();
            $('#pwd').hide();    
            $('#pwd').attr('readonly', true);
        }
    }

    function checkImage() {
	    $("#userpic").attr('src',URL.createObjectURL(event.target.files[0]));
    }


</script>


<?php get_footer(); ?>
</body>
</html>





