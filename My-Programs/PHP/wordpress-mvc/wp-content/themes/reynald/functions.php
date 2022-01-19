<?php

wp_enqueue_script('jquery'); 

function session_init() {
    if (!session_id()) {
        session_start();
    }
}
add_action( 'init', 'session_init' );
   
// function w5dev_enqueue_jquery(){
//     wp_enqueue_script( 'jquery' );
// }
// add_action( 'wp_enqueue_scripts', 'w5dev_enqueue_jquery');

//ADD DYNAMIC TITLE TAG
function reynald_theme_support() {
   add_theme_support('title-tag');
   add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'reynald_theme_support');

function wpb_custom_new_menu() {
    register_nav_menu('my-custom-menu',__( 'My Customized Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

//ADD MENUS
// function reynald_menus() {
//     $locations = array(
//         'primary' => 'Desktop Primary NavBar',
//         'footer' => 'Footer Menu Items'
//     );
//     register_new_menus($locations);
// }
// add_action('init','reynald_menus');

function reynald_register_styles() {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('reynald-style', get_template_directory_uri() . "/style.css", array('reynald-boostrap'), $version, 'all');
    wp_enqueue_style('reynald-boostrap', "https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css", array(), '4.5.3', 'all');
    wp_enqueue_style('reynald-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css", array(), '5.13.0', 'all');
    wp_enqueue_style('reynald-socialmedia', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css", array(), '4.7.0', 'all');
}
add_action('wp_enqueue_scripts', 'reynald_register_styles');

function reynald_register_scripts() {
    wp_enqueue_script('reynald-jquery', "https://code.jquery.com/jquery-3.5.1.slim.min.js", array(), '3.5.1',true);
    wp_enqueue_script('reynald-popper', "https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js", array(), '1.16.1', true);
    wp_enqueue_script('reynald-boostrap', "https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js", array(), '4.5.3',true);
    wp_enqueue_script('reynald-script', get_template_directory_uri() . "/assets/js/main.js", array(),'1.0',true);
}
add_action('wp_enqueue_scripts', 'reynald_register_scripts');


// The Javascript
function add_this_script_footer(){ ?>
 
<script>
    jQuery(document).ready(function($) {
    
        // This is the variable we are passing via AJAX
        var fruit = 'Banana';
        
        // This does the ajax request (The Call).
        $.ajax({
            url: ajaxurl, // Since WP 2.8 ajaxurl is always defined and points to admin-ajax.php
            data: {
                'action':'example_ajax_request', // This is a our PHP function below
                'fruit' : fruit // This is the variable we are sending via AJAX
            },
            success:function(data) {
        // This outputs the result of the ajax request (The Callback)
                window.alert(data);
            },  
            error: function(errorThrown){
                window.alert(errorThrown);
            }
        });   
                
    });
}
</script>
<?php } 
 
add_action('in_admin_footer', 'add_this_script_footer');


// The PHP
function example_ajax_request() {
 
    // The $_REQUEST contains all the data sent via AJAX from the Javascript call
    if ( isset($_REQUEST) ) {
     
        $fruit = $_REQUEST['fruit'];
         
        // This bit is going to process our fruit variable into an Apple
        if ( $fruit == 'Banana' ) {
            $fruit = 'Fuji Apple';
        }
     
        // Now let's return the result to the Javascript function (The Callback) 
        echo $fruit;        
    }
     
    // Always die in functions echoing AJAX content
   die();
}
 
// This bit is a special action hook that works with the WordPress AJAX functionality. 
// You will notice that the name of the function "example_ajax_request" is included in the hook
// This is how WordPress knows which function to use when Javascript makes the call
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );
// add_action( 'wp_ajax_nopriv_example_ajax_request', 'example_ajax_request' );

//change login logo
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/wincor.png);
		height:65px;
		width:220px;
		background-size: 220px 65px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php 

}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//Redirect to home page after successful login
function home_page() {
    return '/';
}  
add_filter('login_redirect', 'home_page');

function sendGmail($to, $msg) {
    include_once (ABSPATH . WPINC . '/class-phpmailer.php');
    include_once (ABSPATH . WPINC . '/PHPMailer/SMTP.php');
    $mail = new PHPMailer();    
    
    try {
        // Server settings
    //    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        $mail->Username = 'rey107@gmail.com';
        $mail->Password = 'Reynald@88.88';
    
        // Sender and recipient settings
        $mail->setFrom('rey107@gmail.com', 'Wincor-Nixdorf');
        $mail->addAddress($to, '');
        $mail->addReplyTo('rey107@gmail.com', 'Jacky Chan'); // to set the reply to
    
        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = "Forgot password Mail Token";
        $mail->Body = $msg;
        // $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
        $mail->send();
        return "Email message sent.";
    } catch (\Exception $e) {
        return "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}
add_action('phpmailer_init','sendGmail');





//redefine wp_new_user_notification as soon as all plugins are loaded
add_action( 'plugins_loaded', 'new_user_notifiaction' );
function new_user_notifiaction(){
    /**
     * Notify the blog admin of a new user, normally via email.
     *
     * @since 2.0
     *
     * @param int $user_id User ID
     * @param string $plaintext_pass Optional. The user's plaintext password
     */
    function wp_new_user_notification($user_id, $plaintext_pass = '') {
        $user = get_userdata( $user_id );

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        // The blogname option is escaped with esc_html on the way into the database in sanitize_option
        // we want to reverse this for the plain text arena of emails.
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

        $message  = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = sprintf(__('Username: %s'), $user_login) . "\r\n";
        $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n";
        $message .= wp_login_url() . "\r\n";
        wp_mail($user_email, sprintf(__('[%s] Your username and password'), $blogname), $message);
    }
}

// Disable the user admin bar on public side on registration or Toolbar
add_action('user_register','trash_public_admin_bar');
function trash_public_admin_bar($user_ID) {
    // die(get_current_user_id());
    update_user_meta( 1, 'show_admin_bar_front', 'false' );
}

//UPDATE IMAGE
function wpse_141088_upload_dir( $dir ) {
    return array(
        'path'   => $dir['basedir'] . '/reynald/users',
        'url'    => $dir['baseurl'] . '/reynald/users',
        'subdir' => '/reynald/users',
    ) + $dir;
}
add_filter( 'upload_dir', 'wpse_141088_upload_dir' );


/**
 * Destroys all sessions for this user except the one with the given token (presumably the one in use).
 */
// add_action( 'init', 'destroy_all_other_current_user_sessions' );
// function destroy_all_other_current_user_sessions() {
//     // die('stop logout');
//     $manager = WP_Session_Tokens::get_instance( get_current_user_id() );
//     $manager->destroy_others( wp_get_session_token() );

// };

function reynald_getCurrent_user_role() {
    if(is_user_logged_in()) {
        $user = wp_get_current_user();
        $roles = (array)$user->roles;
        return $roles;
    } else {
        return array();
    }
}
add_action('wp_head','reynald_getCurrent_user_role');

//ENABLE is_user_logged_in() function========
function app_output_buffer() {
    ob_start();
}
add_action('init', 'app_output_buffer');

//EXPORT DATA TO EXCEL
function contacts_csv_pull() {

    global $wpdb;

    $table = 'wp_contacts';// table name
    $file = 'contacts_csv'; // csv file name
    $results = $wpdb->get_results("SELECT id,contact_name AS 'Contact Name', contact_address AS 'Business Address', contact_email as 'Email Address' FROM wp_contacts",ARRAY_A );
    // $data = json_encode($results);
    // echo $data;
    if(count($results) > 0){
       foreach($results as $result){
       $result = array_values($result);
       $result = implode(", ", $result);
       $csv_output .= $result."\n";
     }
   }

   $filename = $file."_".date("Y-m-d_H-i",time());
   header("Content-type: application/vnd.ms-excel");
   header("Content-disposition: csv" . date("Y-m-d") . ".csv");
   header( "Content-disposition: filename=".$filename.".csv");
   print $csv_output;
   exit;
   //http://localhost:8090/wp-admin/admin-ajax.php?action=csv_pull
   //call anywhere : $ajax_url = admin_url('admin-ajax.php?action=csv_pull');

 }
add_action('wp_ajax_csv_pull','contacts_csv_pull');






// function no_tag_suggest() {
//     include_once(ABSPATH . 'wp-admin/edit.php');
//     if( DOING_AJAX == true && $_GET['action'] == 'ajax-tag-search' && $_SERVER['HTTP_REFERER'] == admin_url( 'edit.php' ) ) {
//         die;
//     }
// }    
// add_action('admin_init', 'no_tag_suggest');

?>

