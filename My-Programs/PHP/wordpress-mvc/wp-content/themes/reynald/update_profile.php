<?php
require_once('../../../wp-load.php');

$id = $_POST['uid'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$email = $_POST['email'];
$usrname = $_POST['uname'];
if (isset($_POST['pwd'])) {
  $pwd = $_POST['pwd'];
}
$file=$_FILES['picture']; 

require_once('../../../wp-admin/includes/file.php');
$xfile = $_FILES['picture']['name'];
$path = '/wp-content/uploads/reynald/users/' . $xfile;
$ext = pathinfo($xfile, PATHINFO_EXTENSION);
$uid = '00' . get_current_user_id();
$pix = '/wp-content/uploads/reynald/users/' . trim($uid) . '.' . $ext;

$rootdir = get_home_path() . '/wp-content/uploads/reynald/users';
$currentuser = wp_get_current_user();
require_once('../../../wp-includes/functions.php');

//IF NOT EMPTY UPLOAD IMAGE
if (!empty($file['name'])) {
    if (in_array($_FILES['picture']['type'], array("image/gif", "image/jpeg", "image/png"))) {
        $uploaded = wp_handle_upload($_FILES['picture'], array('test_form' => false));
        if ($uploaded) {
            $editor = wp_get_image_editor($uploaded['file']);
            $editor->resize(150, 150);
            $editor->save($pix);

            //DELETE OLD IMAGE
            if(is_dir($rootdir)) {
                $dfile = get_home_path() . $currentuser->user_url;                
                wp_delete_file($dfile);
                unlink($dfile);
            }            
        }
    }


}

//CONVERT IMAGE TO BINARY
// $encdata = base64_encode($pix);

//INSERT DETAILS TO THE DATABASE
$cred = array();
$cred['ID'] = $id;
$cred['first_name'] = $fname;
$cred['last_name'] = $lname;
$cred['user_email'] = $email;
$cred['user_login'] = $usrname;
$cred['user_url'] =  $path;
$cred['rich_editing'] =  false;
$cred['show_admin_bar_front'] =  false;

$user_id = wp_insert_user($cred);
wp_new_user_notification($user_id);

//DISABLE USER TOP TOOL BAR
update_user_meta( $id, 'show_admin_bar_front', 'false' );

//CHANGE PASSWORD
if (!empty($pwd)) {
    wp_set_password($pwd, $id);

    // Log-in again.
    wp_set_auth_cookie($id);
    wp_set_current_user($id);
    do_action('wp_login', $usrname, $currentuser);
}

//REDIRECT TO HOME PAGE
wp_redirect('/');
return;
?>

