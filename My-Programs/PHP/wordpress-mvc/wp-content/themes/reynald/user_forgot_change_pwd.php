<?php
require_once('../../../wp-load.php');

if (isset($_POST['mail_add'])) {
    $email = $_POST['mail_add'];
}

if (isset($_POST['new_pwd'])) {
    $newpwd = $_POST['new_pwd'];
}

$hashPwd = wp_hash_password($newpwd);

//GET USER ID
if (!empty($email)) {
    $xemail = $wpdb->get_results(
        $wpdb->prepare("SELECT ID FROM wp_users WHERE user_email= %s", trim($email)) 
    );
    if ($xemail) {
        foreach ( $xemail as $mail ) {
            $id = $mail->ID;
        }
        if (!empty($id)) {

                $hashPwd = wp_hash_password($newpwd);

                //UPDATE PASSWORD
                $wpdb->update('wp_users', array(
                    'user_pass' => $hashPwd,
                ),
                array(
                    'ID' => $id
                ),
                array(
                    '%s',
                ),
                array(
                    '%d'
                ));


            $out1 = "Your password has been change successfuly.";
            wp_redirect('/'.'?usermsg='. $out1);
            return;

        }
    } else {
        $out2 = "Error!, Unable to change password.";
        wp_redirect('/wp-content/themes/reynald/user_change_pwd.php'.'?msg='. $out1);
        return;

    }
}

?>