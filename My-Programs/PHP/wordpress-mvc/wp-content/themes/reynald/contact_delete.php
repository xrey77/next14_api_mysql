<?php

    $idno = $_POST['idno'];
    require_once('../../../wp-load.php');
    $out = 'Successfully Deleted Contact ID# ' . $idno;

    //DELETE
    $wpdb->delete( 'wp_contacts', array( 'id' => $idno ), array( '%d' ) );
    wp_redirect('/wp-content/themes/reynald/templates/contacts/index.php'.'?msg='. $out);
    return;

?>