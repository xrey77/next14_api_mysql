<?php

$usr = $_POST['username'];
$pwd = $_POST['password'];
$isremember = '';
if(!empty($_POST['remember'])) {
    $isremember = 'true';
} else {
    $isremember = 'false';
}


require_once('../../../wp-load.php');
wp_clear_auth_cookie();
wp_set_auth_cookie( $user->ID, 0, 0);

$creds = array();
$creds['user_login'] = $usr;
$creds['user_password'] = $pwd;
$creds['remember'] = $isremember;
$user = wp_signon($creds, false);
if (is_wp_error($user)) {
    // $error = $user->get_error_message();
    $xout = "User is not registered.";
    wp_redirect('/'.'?usermsg='. $xout);
    $xout = '';
    return;

}
else 
{

    // wp_set_current_user($user_id);
    // The next line *really* seemed to help!
    do_action('set_current_user');
    $current_user = wp_get_current_user();
    $xid = $current_user->ID;
    wp_set_current_user($xid);
  
    //DISABLE USER TOP TOOL BAR
    update_user_meta( $xid, 'show_admin_bar_front', 'false' );

    // if (is_wp_error($current_user)) {$error = $user->get_error_message();}
    $xout = "";
    wp_redirect('/'.'?usermsg='. $xout);
    return;

}

//if ($error) {echo $error; print_r($userdata); print_r($current_user);}

?>