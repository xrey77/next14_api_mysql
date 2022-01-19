<?php

/* Template Name: Wincor-Nixdorf Login */
global $user_ID;

if (!user_ID) {
    get_header();
?>

<form method="post" action="/wp-content/themes/reynald/user_login.php" autocomplete="off">
                          <div class="form-group text-left">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                            <small id="usernameHelp" class="form-text text-muted">Please enter your Username.</small>
                          </div>
                          <div class="form-group text-left">
                            <label for="password1">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                            <small id="passwordHelp" class="form-text text-muted">Please enter your password.</small>

                          </div>
                          <!-- <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Regist</label>
                          </div> -->
                          <button type="submit" class="btn btn-info text-left">Sign-In</button>
                    </form>                      
<?php
                    get_footer();

}
?>