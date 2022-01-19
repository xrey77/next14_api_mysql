<!DOCTYPE html>
<html lang="en">

<?php 

        require_once('../../../wp-load.php');
        get_template_part('header');

        $getrole = reynald_getCurrent_user_role();
        $role = $getrole[0];

        // require_once(ABSPATH . 'wp-includes/pluggable.php');
        if( !is_user_logged_in()) {
          wp_redirect('http://localhost:8090');
          exit();
        }
?>

<body>
<div class="container">

<?php
   $msg = "";
   $_GET['msg'] = "";
   $msg = $_GET['msg'];
   
   if ($msg != "") {

    echo "<div class=\"alert alert-warning alert-dismissible msg fade show\" role=\"alert\">" . 
    "<strong>Alert Message!</strong> " . $msg .
    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" .
    "<span aria-hidden=\"true\">&times;</span></button></div>";
  }
?>


<h1>Contact List</h1>
<?php 
if ($role == "subscriber") { ?>
  <button id="add" type="button"  class="btn btn-primary" style="margin-bottom:10px;" data-toggle="modal" disabled>Add Contact</button>
<?php } else { ?>
  <button id="add" type="button"  class="btn btn-primary" style="margin-bottom:10px;" data-toggle="modal">Add Contact</button>
<?php
} ?>
<table class="table table-sm table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Contact Name</th>
      <th scope="col">Business Address</th>
      <th scope="col">Email Address</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">Actions</th>
      <th scope="col">&nbsp;</th>
    </tr>
  </thead>
  <tbody>

  <?php
   $query = "SELECT id, contact_name, contact_address, contact_email FROM wp_contacts";

   $total_query = "SELECT COUNT(1) FROM wp_contacts AS combined_table";
   $total = $wpdb->get_var( $total_query );
   $totalpage = round($total/5,0);
   $items_per_page = 5;
   $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
   $offset = ( $page * $items_per_page ) - $items_per_page;

   $results = $wpdb->get_results( $query . " ORDER BY id LIMIT ${offset}, ${items_per_page}" );

    if ($results) {
        foreach ( $results as $data ) {
            echo '<tr><td>' . $data->id . '</td><td id="contactName">' . $data->contact_name . '</td><td>' . $data->contact_address . '</td><td>' . $data->contact_email . '</td>' .
          '<td><button id="view_contact" onclick="view(' . $data->id  .')"  class="btn btn-warning">VIEW</button></td>' .
          '<td><button id="edit_contact" onclick="edit(' . $data->id . ')" class="btn btn-secondary">EDIT</button></td>' .
            '<td><button onclick="del(' . $data->id . ')" class="btn btn-danger">DEL</button></td>' .
            '</tr>';
        }
    }
    
  ?>
  </tbody>
</table>
  <div style="margin-top:10px;margin-bottom:50px;font-size:28px;" class="text-center">
  <?php  
    
    if (ceil($total / $items_per_page) < 2) {
      return;
    } 

    $pages = paginate_links( array(
          'base' => add_query_arg('cpage', '%#%' ),
          'format' => '?page=%#%',
          'show_all'     => false,
          'type'         => 'plain',
          'end_size'     => 2,
          'mid_size'     => 1,
          'prev_next'    => true,          
          'prev_text' => __('&laquo;prev'),
          'next_text' => __('next&raquo;'),
          'total' =>  ceil($total / $items_per_page),
          'current' => $page,
          'aria_current'       => 'page',
          'add_args'     => false,
          'add_fragment' => '',          
        ));

    echo $pages;
    echo '<divs style="font-size:10px;float:right;">Total record(s) : ' . $total . '</div>';
?>

  </div>
</div>



<!-- Add/Edit Modal -->
<div class="modal fade" id="addeditBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addeditBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div id="bg-header" class="modal-header">
        <h5 class="modal-title" id="addeditBackdropLabel"></h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="/wp-content/themes/reynald/contact_add.php" method="post" autocomplete="off">
      <div class="mb-3">
          <label id="idlbl" for="id" class="form-label">ID</label>
          <input type="text" class="form-control" name="id" id="id" readonly="true">
        </div>
        <div class="mb-3">
          <label id="contactnamelbl" for="contactname" class="form-label">Contact Name</label>
          <input type="text" class="form-control" name="contactname" id="contactname" aria-describedby="contctnameHelp" required>
          <div class="invalid-feedback">
            Please provide a Contact Name.
          </div>
          <div id="contactnameHelp" class="form-text txt">Please enter Contact Name.</div>
        </div>
        <div class="mb-3">
          <label id="addresslbl" for="address" class="form-label">Business Address</label>
          <input type="text" class="form-control" name="address" id="address" aria-describedby="addressHelp" required>
          <div class="invalid-feedback">
            Please provide a Business Address.
          </div>
          <div id="addressHelp" class="form-text txt">Please enter Business Address.</div>
        </div>
        <div class="mb-3">
          <label id="emaillbl" for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" name="email" id="xrey" aria-describedby="emailHelp" required>
          <div class="invalid-feedback">
            Please provide a Email Address.
          </div>      
          <div id="emailHelp" class="form-text txt">Please enter your Email Address.</div>
        </div>
        <div id="msg" class="mb-3"></div>
        <?php   if ($role == "subscriber") { ?>
          <button id="submit" type="submit" class="btn" disabled>Submit</button>
        <?php } else { ?>
          <button id="submit" type="submit" class="btn">Submit</button>
        <?php } ?>
        <!-- <button id="delete" type="button" onclick="deleteContact()" class="btn">Delete</button> -->

      </form>

      </div>
    </div>
  </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div id="del-bg-header" class="modal-header">
        <h5 class="modal-title" id="deleteBackdropLabel"></h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/wp-content/themes/reynald/contact_delete.php" method="post" autocomplete="off">
      <div class="mb-3">
          <label id="idnolbl" for="idno" class="form-label">ID</label>
          <input type="text" class="form-control" name="idno" id="idno" readonly="true">
        </div>
        <div id="delMsg" class="mb-3"></div>
        <?php   if ($role == "subscriber") { ?>
          <button id="submitdel" type="submit" class="btn" disabled>Delete</button>
        <?php } else { ?>
          <button id="submitdel" type="submit" class="btn">Delete</button>
        <?php } ?>
      </form>
      </div>
    </div>
  </div>
</div>

<?php 
  get_footer(); 
?>
<script src="/wp-content/themes/reynald/assets/js/main.js"></script>
</body>
</html>

