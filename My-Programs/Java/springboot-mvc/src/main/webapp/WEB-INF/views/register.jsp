<div class="modal fade" id="userRegistration" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="registerBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="registerBackdropLabel">ACCOUNT REGISTRATION</h5>
        <button id="registerClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form id="registerForm" method="POST" autocomplete="off">
		  <div class="form-group">
		    <label for="fullname" class="mt-1">Full Name</label>
		    <input type="text" class="form-control" id="fullname" name="fullname" required>
		  </div>
		  <div class="form-group">
		    <label for="email" class="mt-1">Email Address</label>
		    <input type="email" class="form-control" id="emailadd" name="emailadd" required>
		  </div>
		  <div class="form-group">
		    <label for="mobileno" class="mt-1">Mobile No.</label>
		    <input type="text" class="form-control" id="mobileno" name="mobileno" required>
		  </div>
		  <div class="form-group">
		    <label for="username" class="mt-1">Username</label>
		    <input type="text" class="form-control" id="username" name="username" required>
		  </div>
		  <div class="form-group">
		    <label for="password" class="mt-1">Password</label>
		    <input type="password" class="form-control" id="password" name="password" required>
		    <small id="passwordHelp" class="form-text text-muted" style="font-size:10px;">Never share your email with anyone else.</small>
		    
		  </div>
		  <button id="registerButton" type="submit" class="btn btn-info text-white mt-2">register</butfton>
		</form>	
      </div>
      <div class="modal-footer">
	    <div id="registerMsg" class="w-100 text-left text-danger" style="font-size:12px;"></div>
      </div>
    </div>
  </div>
</div>
