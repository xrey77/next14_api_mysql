<?php

    $id = $_POST['id'];
    $contactname = $_POST['contactname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $table_name = $wpdb->prefix . "wp_contacts";

    require_once('../../../wp-load.php');
    if ($id == "") {
            //VALIDATE CONTACT NAME
            $contact_name = $wpdb->get_results(
                $wpdb->prepare("SELECT contact_name FROM wp_contacts WHERE contact_name= %s", $contactname)
            );
            if ($contact_name) {
                foreach ( $contact_name as $cname ) {
                    $retval1 = $cname->contact_name;
                }
                if ($retval1 != "") {
                    $out1 = "Contact Name already taken.";
                    wp_redirect('/wp-content/themes/reynald/templates/contacts/index.php'.'?msg='. $out1);
                    return;
                }    
            }

            //VALIDATE CONTACT EMAIL
            if ($email != "") {
                $contact_email = $wpdb->get_results(
                    $wpdb->prepare("SELECT contact_email FROM wp_contacts WHERE contact_email= %s", $email) 
                );
                if ($contact_email) {
                    foreach ( $contact_email as $mail ) {
                        $retval2 = $mail->contact_email;
                    }
                    if ($retval2 != "") {
                        $out2 = "Contact Email Address already taken.";
                        wp_redirect('/wp-content/themes/reynald/templates/contacts/index.php'.'?msg='. $out2);
                        return;
                    }
                }
            }

            //INSERT
            $wpdb->insert('wp_contacts', array(
                'contact_name' => $contactname,
                'contact_address' => $address,
                'contact_email' => $email,
            ),
            array(
                '%s',
                '%s',
                '%s',
            ));
            $out3 = "Successfully added to the database.";
            wp_redirect('/wp-content/themes/reynald/templates/contacts/index.php'. '?msg=' . $out3);
            return;
    }
    else {

        //UPDATE
        $wpdb->update('wp_contacts', array(
            'contact_name' => $contactname,
            'contact_address' => $address,
            'contact_email' => $email,
        ),
        array(
            'id' => $id
        ),
        array(
            '%s',
            '%s',
            '%s',
        ),
        array(
            '%d'
        ));
        $out1 = "Successfully updated Contact.";
        wp_redirect('/wp-content/themes/reynald/templates/contacts/index.php'.'?msg='. $out1);
        return;


    }



?>
