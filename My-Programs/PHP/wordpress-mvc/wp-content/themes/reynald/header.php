<?php

    $current_user = wp_get_current_user();
    $uname = $current_user->user_login;
    $pix = $current_user->user_url;
    $getrole = reynald_getCurrent_user_role();
    $role = $getrole[0];
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wincor Nixdorf Template">
    <meta name="author" content="https://youtube.com/reynald">    
    <link rel="shortcut icon" href="/wp-content/themes/reynald/assets/images/wincor.png">     
    <?php wp_head(); ?>

    <script>
        function xlogin() {
          $('#loginBackdrop').modal('show');
          return;
        }

        function xregister() {
          $('#registerBackdrop').modal('show');
          return;
        }

        history.pushState(null, null, location.href);
        window.onpopstate = function () {
          history.go(1);
        };

    </script>
    <style>
      #login:hover {cursor: pointer;}
      #register:hover {cursor: pointer;}

      .forgot { margin:0 auto; margin-top:100px; }
}

    </style>

</head> 
<body>
<header class="header text-right">	    


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">
    <!-- <?php
        if(function_exists('the_custom_logo')) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id);
        }
    ?> -->
  <img class="img-fluid" src="/wp-content/themes/reynald/assets/images/wincor.png" width="90" height="40" />
  <!-- <img class="img-fluid" src="<?php echo $logo[0]; ?>" width="90" height="40" /> -->

</a>

<!-- <?php
  wp_nav_menu(
    array(
        'menu' => 'primary',
        'container' => '',
        'theme_location' => 'primary',
        'items_wrap' => '<ul id="xrey" class="navbar-nav flex-column text-sm-center text-md-left">&3$</ul>'
    )
  );
?> -->

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link lposition" href="/wp-content/themes/reynald/aboutus.php"><i class="fas fa-building"></i>&nbsp;About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link lposition" href="/wp-content/themes/reynald/services.php"><i class="fab fa-servicestack text-dark"></i>&nbsp;Services</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/atm.php">ATM Full Function</a>
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/ats.php">ATS - Automated Teller Safe</a>
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/banking.php">Banking Solutions</a>
        </div>
      </li>

      <?php if( ! empty(trim($current_user->user_login))) { ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item text-right" href="/wp-content/themes/reynald/contact_mgt.php">Contact Management</a>
              <a class="dropdown-item text-right" href="/wp-content/themes/reynald/product_mgt.php">Product Management</a>
              <a class="dropdown-item text-right" href="/wp-content/themes/reynald/services_mgt.php">Services Management</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-right" href="/wp-content/themes/reynald/atm_chart.php">ATM Deployment Chart</a>
              <a class="dropdown-item text-right" href="/wp-content/themes/reynald/contact_to_excel.php">Export Contacts to EXCEL</a>
            </div>
          </li>

      <?php } ?>

      <?php
      
      if( empty($uname) )
      {?>
          <li class="nav-item" style="margin-left:400px;">
          <!-- <a class="nav-link text-right" href="<?= home_url('/login') ?>">Login</a> -->
                <a id="login" onclick="xlogin()" class="nav-link text-right">Login</a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link text-right" href="<?= site_url('/wp-login.php?action=register&redirect_to=' . get_permalink()); ?>">Register</a> -->
            <a id="register" onclick="xregister()" class="nav-link text-right">Register</a>
          </li>
          <?php
      }
      else 
      //$role
      {  ?>



      <li class="nav-item dropdown"  style="margin-left:250px;">
        <a class="nav-link dropdown-toggle lposition" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span>
          <?php 
            if (empty($pix)) {
                // echo get_avatar( $current_user->user_email, 32 );
                echo '<img style="border-radius:50px;" src="/wp-content/themes/reynald/assets/images/pix.png" width="40p" height="40"  />';

            } else {
              echo '<img style="border-radius:50px;" src=' .  $pix . ' width="40p" height="40"  />';
            }
            $current_user = wp_get_current_user();
            echo '&nbsp;' . $current_user->user_login;

          ?>
          </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        
          <a href="/wp-content/themes/reynald/user_logout.php" class="dropdown-item lposition" ><i class="fas fa-sign-out-alt"></i>&nbsp;Log-Out</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item lposition" href="/wp-content/themes/reynald/user_profile.php"><i class="fas fa-id-badge"></i>&nbsp;Profile</a>

        </div>
      </li>

        <?php
      }
      ?>
    </ul>


 </div>
 </nav>    

</header>

<div class="main-wrapper">
<!--Login Modal -->
<div class="modal fade" id="loginBackdrop" data-backdrop="static" data-keyboard="false" 
tabindex="-1" aria-labelledby="loginBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-light">
        <h5 class="modal-title" id="loginBackdropLabel">Account Sign-In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form method="post" action="/wp-content/themes/reynald/user_login.php">
          <div class="form-group text-left">
            <label for="username"Signin-Name</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
            <small id="everlyHelp" class="form-text text-muted">Please enter your User Name</small>
          </div>
          <div class="form-group text-left">
            <label for="password1">Password</label>
            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" required>
            <small id="passwordHelp" class="form-text text-muted">Please enter your password.</small>

          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="remember" value="yes">
            <label class="form-check-label" for="remember">Remember</label>
          </div>
          <button type="submit" class="btn btn-info text-left">Sign-In</button>
          <a style="font-size:11px;float:right;" href="/wp-content/themes/reynald/user_forgot_pwd.php?ctr=0">Forgot Password?</a>
      </form>                      
        
      </div>
    </div>
  </div>
</div>


  <!--Register Modal -->
  <div class="modal fade" id="registerBackdrop" data-backdrop="static" data-keyboard="false" 
  tabindex="-1" aria-labelledby="registerBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-info text-light">
          <h5 class="modal-title" id="registerBackdropLabel">Account Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <form method="post" action="/wp-content/themes/reynald/user_register.php" autocomplete="off">
          <div class="ml-20">

            <div class="row">
                <div class="col">
                  <label class="form-label" for="first_name">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name"  aria-describedby="fnameHelp" required>
                  <div class="invalid-feedback">
                    Please provide your First Name.
                  </div>
                </div>
                <div class="col">
                  <label class="form-label" for="last_name">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name"  aria-describedby=lnameHelp" required>
                  <div class="invalid-feedback">
                    Please provide your Last Name.
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                  <label for="mail">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email"  aria-describedby="mailHelp" required>
                  <div class="invalid-feedback">
                    Please provide your Email Address.
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username"  aria-describedby="usernameHelp" required>
                  <div class="invalid-feedback">
                    Please provide your User Name.
                  </div>
                </div>
                <div class="col">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password"  aria-describedby="passwordHelp" required>
                  <div class="invalid-feedback">
                    Please provide your Password.
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                  <button style="margin-top:10px;" type="submit" class="btn btn-info text-left">Register</button>
                </div>
            </div>

          </div>
      </form>                      
          
        </div>
      </div>
    </div>
  </div>

