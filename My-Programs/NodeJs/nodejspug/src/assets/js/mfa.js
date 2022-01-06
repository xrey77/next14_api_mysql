$(document).ready(function() {
    $("#submitMfaAuth").click(function() {
        $("#mfaAuthForm").on("submit", function(e) {
            e.preventDefault();
            const mfaFormValue = $(this).serialize();
            $.ajax({
                url: "/mfaverify",
                type: "POST",
                data: mfaFormValue,
                success: function(res) {
                    $("#mfaAuthMsg").text(res.message);
                    if(res.statuscode == 200) {
                        $("#mfaAuthModal").modal('hide');
                        location.href ="/";
                    }
                }
            })
        });
    });

    $("#mfaClose").click(function() {
        location.href="/user/logout";
    });
});