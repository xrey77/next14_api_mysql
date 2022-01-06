$(document).ready(function() {
    $('#loginModal').modal('show');
    $("#loginModal").on("hidden.bs.modal", function () {
        location.href="/";
        return;
    });

    $("#submitSignin").click(function() {
        $("form#siginForm").on("submit", function(e) {
            e.preventDefault();
            const loginFormValues = $(this).serialize();
            $.ajax({
                url: "/signin",
                type: "POST",
                data: loginFormValues,
                success: function(res) {
                    $("#loginMsg").text(res.message);
                    if(res.statuscode == 200) {
                        // $("#loginModal").modal('hide');

                        if(res.mfa > 0) {
                            $('#loginModal').css('opacity', .10);
                            $("#hdr1").hide();
                            $("#ftr").hide();
                            $("#mfaAuthentication").modal('show');

                            return true;
                        } else {
                            $('#loginModal').modal('hide');
                            location.href="/";
                        }

                    }
                }
            });
        });
    });

    $('#loginModal').on('shown.bs.modal', function () {
        $('#username').focus();
    });


});
