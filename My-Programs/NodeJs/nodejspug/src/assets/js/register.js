$( document ).ready(function() {
    $('#registerModal').modal('show');
    $("#registerModal").on("hidden.bs.modal", function () {
        location.href="/";
        return;
    });

    $("#subRegform").click(function() {
        $("#regForm").on("submit", function(e) {
            e.preventDefault();
            var regformValues= $(this).serialize();
            $.ajax({
                url: "/user/registration",
                type: "POST",
                data: regformValues,
                success: function(res) {
                  console.log(res);
                  $("#regMsg").text(res.message);
                  regformValues = null;
                }
            })
        });
    });

    $("#regClose").click(function() {
        $("#regForm")[0].reset();
    });

    $('#registerModal').on('shown.bs.modal', function () {
        $('#firstname').focus();
      })
     
    $("#regReset").click(function() {
        $("#regMsg").text(null);
    })

});
