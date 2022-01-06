$(document).ready(function() {
    $("#forgotModal").modal('hide');
    $("#changePasswordModal").modal('hide');
    $("#mailTokenModal").modal('show');

    $("#submitMtoken").click(function() {
        $("#mtokenForm").on("submit", function(e) {
            e.preventDefault();
            const mtokenFormValues = $(this).serialize();
            $.ajax({
                url: "/user/mailtoken",
                type: "POST",
                data: mtokenFormValues,
                success: function(res) {
                    if(res.statuscode == 200) {
                        $("#mailTokenModal").modal('hide');
                        $("#changePasswordModal").modal('show');
                    }
                    console.log(res);
                    $("#mtokenMsg").text(res.message);
                }
            })
        });
    });
});