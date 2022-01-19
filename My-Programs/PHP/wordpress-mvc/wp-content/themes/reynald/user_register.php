<?php

$usr = $_POST['username'];
$pwd = $_POST['password'];
$mail = $_POST['email'];
$lname = $_POST['last_name'];
$fname = $_POST['first_name'];
require_once('../../../wp-load.php');
wp_clear_auth_cookie();
wp_set_auth_cookie( $user->ID, 0, 0);

// $user_id = wp_create_user($usr,$pwd,$mail);


$creds = array();
$creds['user_login'] = $usr;
$creds['user_pass'] = $pwd;
$creds['user_email'] = $mail;
$creds['first_name'] = $fname;
$creds['last_name'] = $lname;
$user_id = wp_insert_user($creds);
wp_new_user_notification($user_id);

//DISABLE USER TOP TOOL BAR
update_user_meta( $user_id, 'show_admin_bar_front', 'false' );

//echo do_shortcode('[avatar_upload]');
$xout = "Your have successfully created you account, you can log-in now.";
wp_redirect('/'.'?usermsg='. $xout);
return;
?>