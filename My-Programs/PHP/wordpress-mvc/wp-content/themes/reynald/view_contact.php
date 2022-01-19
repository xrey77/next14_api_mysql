<?php
    
    require_once('../../../wp-load.php');
    $id = $_GET['id'];
    $result_array = array();
    $results = $wpdb->get_results(
            $wpdb->prepare("SELECT id,contact_name,contact_address,contact_email FROM wp_contacts WHERE id= %d", $id) 
    );
    if ($results) {
            header('Content-type: application/json');
            echo json_encode($results);
            die();
            // wp_redirect('/wp-content/themes/reynald/templates/contacts/');
            
    }

?>