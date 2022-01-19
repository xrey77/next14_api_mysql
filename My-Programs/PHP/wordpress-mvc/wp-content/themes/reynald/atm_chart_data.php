<?php
    require_once('../../../wp-load.php');

    $atm_data = $wpdb->get_results(
        $wpdb->prepare("SELECT MONTHNAME(date_deployed) AS 'datedeployed',qty FROM wp_atmdata ORDER BY date_deployed")
    );
    $data = json_encode($atm_data);
    echo $data;
    die();

?>