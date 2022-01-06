$(document).ready(function() {
  $("#loginModal").modal('hide');
  $("#forgotModal").modal('show');

  $("#submitForgot").click(function() {
    $("#forgotForm").on("submit", function(e) {
      e.preventDefault();
      const forgotFormValues = $(this).serialize();
      $.ajax({
        url: "/user/forgotpwd",
        type: "POST",
        data: forgotFormValues,
        success: function(res) {
          console.log(res);
          $("#forgotMsg").text(res.message);
          if(res.statuscode == 200) {
            $("#forgotModal").modal('hide');
            location.href ="/mailtoken";
          }
        }
      })
    });
  });
});