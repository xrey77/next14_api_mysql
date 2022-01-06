$( document ).ready(function() {
    var qcode = $("#qcode").val();
    if (qcode.length > 0) {
        $("#mfaEnable").prop( "checked", true );
        $("#mfaDisable").prop( "checked", false );
        $("#qcodeimage").show();
    } else {
        $("#mfaDisable").prop( "checked", true );
        $("#mfaEnable").prop( "checked", false );
        $("#qcodeimage").hide();
    }
    $('#btnUpload').hide();
    $('#btnCancel').hide();

    $( "#btnCancel" ).click(function() {
        $('#btnUpload').hide();
        $('#btnCancel').hide();
        $('#profilepic').show();

    });

    checkImage = () => {
        $("#userpic").attr('src',URL.createObjectURL(event.target.files[0]));
        $('#btnUpload').show();
        $('#btnCancel').show();    
    }
    $("#changePwdCheckbox").click(function() {
        $("#ChangePWDBackdrop").modal('show');
    });

    $("#mfaCheckbox").click(function() {
        $("#MFABackdrop").modal('show');
    });

    $("#CHANGEPWD").click(function() {
        $("#CANGEFORM").on("submit", function(e) {
            e.preventDefault();
            const profChangePwdFormValues = $(this).serialize();
            $.ajax({
                url: "/profile/changepwd",
                type: "POST",
                data: profChangePwdFormValues,
                success: function(res) {
                    $("#CHANGEMSG").text(res.message);
                }
            })
        });
    });



    $("#mfaEnable").click(function() {
        $("#qcodeimage").show();
        $("#mfaDisable").prop( "checked", false );
        $.ajax({
            url: "/profile/mfaauth/true",
            type: "GET",
            success: function(res) {
                console.log(res);
            }
        })
        $("#mfaMsg1").text("If QRCODE did not display, Close dialog window and click checkbox again, then it is very important to scan QRCODE.")
    });

    $("#mfaDisable").click(function() {
        $("#qcode").val(null);
        $("#mfaEnable").prop( "checked", false );
        $("#qcodeimage").hide();
        $.ajax({
            url: "/profile/mfaauth/false",
            type: "GET",
            success: function(res) {
                console.log(res);
            }
        })
        $("#mfaMsg1").text("2-Factor Authentication was diabled.")
    });

    $("#profileSubmit").click(function() {
        $("#profileForm").on("submit", function(e) {
            e.preventDefault();
            const xfile = $('#profilepic')[0].files;
            alert(xfile);
        });
    });

    $("#mfaClosex").click(function() {
        location.reload();
    });

});
