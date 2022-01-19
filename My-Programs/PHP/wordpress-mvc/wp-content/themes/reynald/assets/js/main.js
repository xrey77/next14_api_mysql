$(document).ready(function() {
	
	$(window).scroll(function() {
		if ($(this).scrollTop() > 1){  
			$('.page-title').addClass("sticky");
		}
		else{
			$('.page-title').removeClass("sticky");
		}
	});

});

function view(id) {
	fetch('http://localhost:8090/wp-content/themes/reynald/view_contact.php?id=' + id)
	.then(response => response.json())
	.then(data => {
			document.getElementById('email').value="xxxx";
			$('#id').val(data[0].id);
			$('#contactname').val(data[0].contact_name);
			$('#address').val(data[0].contact_address);
			$('#xrey').val(data[0].contact_email);
		}
	);

	//SHOW MODAL DIALOG
	$('#idlbl').show();
	$('#id').show();
	$('#bg-header').css({'background-color':'orange','color': 'black'});
	$('#submit').css({'background-color':'orange', 'color':'black'});
	$('#submit').hide();
	$('#delete').hide();

	$('#msg').html(null);	
	$('#contactname').show(); $('#address').show(); $('#email').show();
	$('#contactnameHelp').hide(); $('#addressHelp').hide(); $('#emailHelp').hide();
	$('#contactnamelbl').show(); $('#addresslbl').show(); $('#emaillbl').show();
	$('#addeditBackdropLabel').text('View Contact Details');
	$('#addeditBackdrop').modal('show');		
}

function edit(id) {
	fetch('http://localhost:8090/wp-content/themes/reynald/view_contact.php?id=' + id)
	.then(response => response.json())
	.then(data1 => {
			$('#id').val(data1[0].id);
			$('#contactname').val(data1[0].contact_name);
			$('#address').val(data1[0].contact_address);
			$("#xrey").val(data1[0].contact_email);
			
		}
	);

	//SHOW MODAL DIALOG
	$('#idlbl').show();
	$('#id').show();
	$('#bg-header').css({'background-color':'black', 'color': 'white'});
	$('#delete').hide();
	$('#submit').show();
	$('#submit').css({'background-color':'black', 'color':'white'});

	$('#msg').html(null);	
	$('#contactname').show(); $('#address').show(); $('#email').show();
	$('#contactnameHelp').show(); $('#addressHelp').show(); $('#emailHelp').show();
	$('#contactnamelbl').show(); $('#addresslbl').show(); $('#emaillbl').show();
	$('#addeditBackdropLabel').text('View Contact Details');
	$('#addeditBackdrop').modal('show');		
}

function del(id) {
	$('#idnolbl').hide();
	$('#idno').val(id);
	$('#idno').hide();
	$('#delMsg').html("Are you sure you want to delete Contact ID# " + id);	
	$('#del-bg-header').css({'background-color':'red', 'color': 'white'});
	$('#submitdel').css({'background-color':'red', 'color':'white'});
	$('#deleteBackdropLabel').text('Delete Contact');
	$('#deleteBackdrop').modal('show');		
}

$(document).ready(function(){
    $('#add').click(function(){
		$('#idlbl').hide();
		$('#id').hide();
		$('#bg-header').css({'background-color':'blue', 'color':'white'});
		$('#submit').css({'background-color':'blue', 'color': 'white'});
		$('#msg').html(null);	
		$('#id').val(null); $('#contactname').val(null); $('#address').val(null); $('#email').val(null);
		$('#contactname').show(); $('#address').show(); $('#email').show();
		$('#contactnameHelp').show(); $('#addressHelp').show(); $('#emailHelp').show();
		$('#contactnamelbl').show(); $('#addresslbl').show(); $('#emaillbl').show();
		$('#submit').show();	
		$('#delete').hide();

		$('#staticBackdropLabel').text('Add New Contact');
		$('#staticBackdrop').modal('show');		
    });
});

function submit_contact_form() 
{
	var fd = new FormData();
	fd.append('reynaldContactSubmit','1');
	fd.append('cname', $("#contact_name").val()  );
	fd.append('caddress', $("#contact_address").val()  );
	fd.append('cemail', $("#contact_email").val()  );
	js_submit(fd,submit_contact_form_callback);
}

function submit_contact_form_callback(data)
{
	var jdata = JSON.parse(data);
	if (jdata.success == 1)
	{
		var msgText = jdata.message;
		$('#response_div').html(msgText);
		$('#response_div').css("background-color","green");
		$('#response_div').css("color","#FFFFFF");
		$('#response_div').css("padding","20px");

		//ok
	} 
	else if (jdata.success == 2)
	{
		return;
	}
}

function js_submit(fd,callback)
{
	var submitUrl = '/wp-content/plugins/reynald/process/';
	$.ajax({url: submitUrl, type:'post', data:fd, contentType:false, processData:false, success:function(response) { callback(response);}, })	
}

/*
IN PHP CREATE BELOW:
<?php

$path = preg_replace('/wp-content.*$/','',__DIR__);
require_once($path . "wp-load.php");
(isset($_POST['renaldContactSubmit])  && $_POST['reynaldContactSubmit'],"1")
{
	$cname = sanitize_text_field($_POST['cname']);
	$caddress = sanitize_text_field($_POST['caddress']);
	$cemail = sanitize_email($POST['cemail']);
	// $comments = sanitize_text_area_field($_POST['xx'])	

	//SEND EMAIL
	$to = 'reynald88@yahoo.com';
	$subj = 'Contact Form Submitted';
	$msg = '';
	$msg .= 'Contact Name : ' . $cname . '<br />';
	$msg .= 'Address : ' . $caddress . '<br />';
	$msg .= 'Email Address : ' . $cemail . '<br />';

	//FOR TEXT AREA FIELD
	$comment = wpautop($comments);
	$comment = str_replace("<p>","", $comment);
	$comment = str_replace("</p>","<br /><br />", $comment)
	$msg .= 'Comments : <br />' . $comment . '<br /><br />';
	$msg .= 'Thank you.';
	wp_mail($to, $subj, $msg);

	//RETURN DATA FOR USER		   
	$return = [];
	$return['success'] = 1;
	$return['message'] = "Contact Information has been received.";
	echo json_encode($return);
}

?>
*/

  


