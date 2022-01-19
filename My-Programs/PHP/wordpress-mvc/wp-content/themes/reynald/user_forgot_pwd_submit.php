<?php
require_once('../../../wp-load.php');

$mailToken = rand(1231,7879);
$email = $_POST['forgot_mail'];

//VALIDATE USER EMAIL
if (!empty($email)) {
    $xemail = $wpdb->get_results(
        $wpdb->prepare("SELECT user_email FROM wp_users WHERE user_email= %s", trim($email)) 
    );
    if ($xemail) {
        foreach ( $xemail as $mail ) {
            $retval2 = $mail->user_email;
        }
        if (!empty($retval2)) {
            //UPDATE
            $wpdb->update('wp_users', array(
                'user_activation_key' => $mailToken,
            ),
            array(
                'user_email' => $email
            ),
            array(
                '%s',
            ),
            array(
                '%s'
            ));

            //SEND MAIL TOKEN
            $msgbody = "Please copy and paste this token to the Mail Token input box " . '<span style="font-size:14px;font-weight:bold;">' .$mailToken . '</span>';
            $status = sendGmail($email,$msgbody);

            session_start();
            $_SESSION['EMAIL'] = $email;

            wp_redirect('/wp-content/themes/reynald/user_forgot_token.php'.'?msg='. $status);
            return;

        }
    } else {
        $out2 = "Email Address does not exists.";
        wp_redirect('/wp-content/themes/reynald/user_forgot_pwd.php'.'?msg='. $out2 . '&ctr=0');
        return;

    }
}


die($pwd);
?>