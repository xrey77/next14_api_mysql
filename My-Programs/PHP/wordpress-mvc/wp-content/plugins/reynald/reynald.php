<?php
/**
 * Plugin Name: Reynald Plugin
 * Plugin URI: http://www.mywebsite.com/my-first-plugin
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Reynald Marquez-Gragasin
 * Author URI: http://www.mywebsite.com
 */

function reynald_contact_form()
{
    $content = '';
    // $content .= '<style>label{ display:block; padding:8px 0px 4px 0px; } </style>';
    //  $content .= '<div id="response_div"></div>'
    // $content .= '<form method="post" action=""';
    //$content .= '<label for="contact_name">Contact Name</label>';
    // $content .= '<input type="text" name="contact_name" id="contact_name"/>';
    //$content .= '<label for="contact_address">Contact Address</label>';
    // $content .= '<input type="text" name="contact_address" id="contact_address"/>';
    //$content .= '<label for="contact_email">Email Address</label>';
    // $content .= '<input type="text" name="contact_email" id="contact_email"/>';
    // $content .= '<input type="submit" name="submit_contact" id="submit_contact" value="Submit" onclick="submit_contact_form()" />';
    // $content .= '</form>';
    $content .= '<h1>TEST AJAX CALL</h1>';
    return $content;
}
add_shortcode('wp_ajax_contact_form','reynald_contact_form');

//IN CASE YOU DID NOT INSTALL JQUERY, YOU CAN DO THIS
// function reynald_add_javascript() {
//     ?sdf>
//         <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
//     <?php
// }
// add_action('wp_footer', "reynad_add_javascript")
// die(get_template_directory());
 ?>