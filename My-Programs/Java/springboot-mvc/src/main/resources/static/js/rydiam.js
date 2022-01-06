$(document).ready(function() {

	//REGISTER	
	$("#registerButton").click(function() {
		$("#registerForm").on("submit",function(event) {
		  	event.preventDefault();
		  	const regFormValues = $(this).serialize();
		  	$.ajax({
				url: "/signup",
				type: "POST",
				data: regFormValues,
				success: function(res) {
					console.log(res);
					$("#registerMsg").text(res.message);
				}
			});
		});
	});
	
	$("#xregister").click(function() {
		$('#userRegistration').data('bs.modal',null);
		$('#userRegistration').modal({backdrop:'static', keyboard:false});		
		$("#userRegistration").modal("show");
	});
	
	$("#registerClose").click(function() {
		$("#fullaname").val(null);
		$("#emailadd").val(null);
		$("#mobileno").val(null);
		$("#username").val(null);
		$("#password").val(null);
		$("#registerMsg").text("");		
		$("#userRegistration").modal("hide");		
	});
	
	//LOGIN
	$("#loginButton").click(function() {
		$("#loginForm").on("submit",function(event) {
			event.preventDefault();
			const loginFormValues = $(this).serialize();
			$.ajax({
				url: "/signin",
				type: "POST",
				data: loginFormValues,
				success: function(res) {
					console.log(res);
					if (res.statuscode == "400") {
					  $("#loginMsg").text(res.message);						
					} else {
						$("#userLoginBackdrop").modal('hide');
						location.href="/home";
					}
				}
			})
		});
	});
	
	
	$("#loginClose").click(function() {
		$("#username").val(null);
		$("#password").val(null);
		$("loginMsg").text("");				
		$("#userLoginBackdrop").modal("hide");		
	});
	
	$("#xlogin").click(function() {
		$('#userLoginBackdrop').data('bs.modal',null);
		$('#userLoginBackdrop').modal({backdrop:'static', keyboard:false});
		$("#userLoginBackdrop").modal("show");
		
	});
	
});

