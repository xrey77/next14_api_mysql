<?php
require_once('../../../wp-load.php');

$mtoken = $_POST['mail_token'];

//VALIDATE MAIL TOKEN
if (!empty($mtoken)) {
    $xtoken = $wpdb->get_results(
        $wpdb->prepare("SELECT user_activation_key FROM wp_users WHERE user_activation_key= %s", trim($mtoken)) 
    );
    if ($xtoken) {
        foreach ( $xtoken as $mailtoken ) {
            $retval2 = $mailtoken->user_activation_key;
        }
        if (!empty($retval2)) {
            $out1 = "You can now enter your new password.";
            wp_redirect('/wp-content/themes/reynald/user_change_pwd.php'.'?msg='. $out1);
            return;

        }
    } else {
        $out2 = "Mail Token is not valid.";
        wp_redirect('/wp-content/themes/reynald/user_forgot_token.php'.'?msg='. $out2 );
        return;

    }
}

?>