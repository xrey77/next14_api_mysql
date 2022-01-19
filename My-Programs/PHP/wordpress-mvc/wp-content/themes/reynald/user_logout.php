<?php
require_once('../../../wp-load.php');

$user_id = get_current_user_id();
$session = wp_get_session_token();
$sessions = WP_Session_Tokens::get_instance($user_id);
$sessions->destroy_others($session);

wp_clear_auth_cookie();
wp_set_auth_cookie( 0, 0, 0);
wp_logout();
wp_set_current_user(0);

wp_redirect('/');
die();
?>