$(document).ready(function() {

    $("#changeSubmitPwd").click(function() {
        $("#changePwdForm").on("submit", function(e) {
            e.preventDefault();
            const changepwdFormValues = $(this).serialize();
            $.ajax({
                url: "/user/changepwd",
                type: "POST",
                data: changepwdFormValues,
                success: function(res) {
                    console.log(res);
                    $("#chagePwdMsg").text(res.message);
                }
            })
        });
    });

    $("#closeChangepwd").click(function() {
        $("#changePwdForm")[0].reset();
        location.href = "/";
    });
});