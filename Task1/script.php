<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script>
    function validatePassword() {

        var pass = $('#newPassword').val();
        var cpass = $('#confirmPassword').val();
        var flag = true;
        if($('#username').val().length===0) $('#username').css('border-color', 'red').after("<br><span>Name can't be empty!</span>");
        else if ($('#newPassword').val().length != $('#confirmPassword').val().length) {
            $('#confirmPassword').css('border-color', 'red').after("<br><span>Passwords doesn't match</span>");
        } else if ($('#newPassword').val().length < 8) {
            $('#confirmPassword').css('border-color', 'red').after("<br><span>Password too short! Minimum 8 Characters</span>");
        } else if (pass !== cpass && flag) {
            $('#confirmPassword').css('border-color', 'red').after("<br><span>Passwords doesn't match</span>");
            flag = false;
        } else registerUser();
    }

    function registerUser() {
        var data = {
            'name': $('#username').val(),
            'email': $('#useremail').val(),
            'password': $('#newPassword').val(),
            'action': 'register',
        };

        $.ajax({
            url: 'process.php',
            type: 'post',
            data: data,
            success: function(response) {
                alert(response);
                console.log("response");
            }
        });
    }
</script>