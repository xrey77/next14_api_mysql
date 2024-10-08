<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wincor-Nixdorf</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wincor-Nixdorf Template">
    <meta name="author" content="https://youtube.com/Reynald">    
    <link rel="shortcut icon" href="wp-content/themes/reynald/assets/images/wincor.png">     
    <!-- FontAwesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">	
    <!-- Theme CSS -->
    <link rel="stylesheet" href="/wp-content/themes/reynald/style.css">
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/"><img src="/wp-content/themes/reynald/assets/images/wincor.png" width="90" height="40" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-right" href="/wp-content/themes/reynald/templates/aboutus.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-right" href="/wp-content/themes/reynald/templates/services.php">Services</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-right" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </a>
        <div class="dropdown-menu dropdown-bg" aria-labelledby="navbarDropdown">
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/templates/atm.php">ATM Full Function</a>
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/templates/ats.php">ATS - Automated Teller Safe</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/templates/banking.php">Banking Solutions</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-right" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administration
        </a>
        <div class="dropdown-menu dropdown-bg" aria-labelledby="navbarDropdown">
          <a class="dropdown-item active text-right" href="/wp-content/themes/reynald/templates/atm.php">Contact Management <span class="sr-only">(current)</span></a>
          <a class="dropdown-item text-right" href="#">Product Management</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-right" href="#">Services Management</a>
        </div>
      </li>

    </ul>

</div>
</nav>

<div class="container">
<?php
   $msg = "";
   $msg = $_GET['msg'];
   
   if ($msg != "") {

    echo "<div class=\"alert alert-warning alert-dismissible msg fade show\" role=\"alert\">" . 
    "<strong>Alert Message!</strong> " . $msg .
    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" .
    "<span aria-hidden=\"true\">&times;</span></button></div>";
  }
?>
<h1>Add Contact</h1></br>
<form action="/wp-content/themes/reynald/contact.php" method="post" autocomplete="off">
		<div class="mb-3">
			<label for="contctname" class="form-label">Contact Name</label>
			<input type="text" class="form-control" name="contactname" id="contactname" aria-describedby="contctnameHelp" required>
      <div class="invalid-feedback">
        Please provide a Contact Name.
      </div>
      <div id="contctnameHelp" class="form-text txt">Please enter Contact Name.</div>
		</div>
		<div class="mb-3">
			<label for="address" class="form-label">Business Address</label>
			<input type="text" class="form-control" name="address" id="address" aria-describedby="addressHelp" required>
      <div class="invalid-feedback">
        Please provide a Business Address.
      </div>
      <div id="addressHelp" class="form-text txt">Please enter Business Address.</div>
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Email Address</label>
			<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
      <div class="invalid-feedback">
        Please provide a Email Address.
      </div>
			<div id="emailHelp" class="form-text txt">Please enter your Email Address.</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
		</form>
</div>


<!-- Bootstrap Javascript -->          
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="wp-content/themes/reynald/assets/js/main.js"></script>

</body>
</html>




<!-- <div class="col-md-6">
    <label for="validationCustom03" class="form-label">City</label>
    <input type="text" class="form-control" id="validationCustom03" required>
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div> -->

