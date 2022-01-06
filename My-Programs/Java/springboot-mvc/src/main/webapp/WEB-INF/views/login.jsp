<div class="modal fade" id="userLoginBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="userLoginBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h6 class="modal-title" id="userLoginBackdropLabel">LOGIN TO YOUR ACCOUNT</h6>
        <button id="loginClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form id="loginForm" method="POST" autocomplete="off">
		  <div class="form-group">
		    <label for="username">Username</label>
		    <input type="text" class="form-control" id="username" name="username" required>
		  </div>
		  <div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control" id="password" name="password" required>
		    <small id="passwordHelp" style="font-size:10px;" class="form-text text-muted">Never share your email with anyone else.</small>
		    
		  </div>
		  <button id="loginButton" type="submit" class="btn btn-danger text-white mt-2">login</button>
		</form>	
      </div>
      <div class="modal-footer">
	    <div id="loginMsg" class="w-100 text-left text-danger" style="font-size:12px;"></div>
      </div>
    </div>
  </div>
</div>