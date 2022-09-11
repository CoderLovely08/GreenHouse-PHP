<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script>
    function validatePassword() {
        var pass = $('#newPassword').val();
        var cpass = $('#confirmPassword').val();
        var flag = true;
        if ($('#username').val().length === 0) {
            $('#username').css('border-color', 'red').after("<br><span>Name can't be empty!</span>");
        } else if ($('#newPassword').val().length != $('#confirmPassword').val().length) {
            $('#confirmPassword').css('border-color', 'red').after("<br><span>Passwords doesn't match</span>");
        } else if ($('#newPassword').val().length < 8) {
            $('#confirmPassword').css('border-color', 'red').after("<br><span>Password too short! Minimum 8 Characters</span>");
        } else if (pass !== cpass && flag) {
            $('#confirmPassword').css('border-color', 'red').after("<br><span>Passwords doesn't match</span>");
            flag = false;
        } else {
            registerUser();
        }
    }

    function validateLogin() {
        if ($('#userpass').val().length < 8) {
            $('#userpass').css('border-color', 'red').after("<br><span>Passwords doesn't match</span>");
        } else if ($('#useremail').val().length == 0) {
            $('#useremail').css('border-color', 'red').after("<br><span>Email can't be empty!</span>");
        } else loginUser();
    }

    function registerUser() {
        var data = {
            'name': $('#username').val(),
            'email': $('#useremail').val(),
            'password': $('#newPassword').val(),
            'action': 'register',
        };
        alert('hi');
        $.ajax({
            url: 'process.php',
            type: 'post',
            data: data,
            success: function(response) {
                alert(response);
                console.log("response");
                if (response === 'Registration Successful') window.location = "login.php"
            }
        });
    }

    function loginUser() {
        var data = {
            'email': $('#useremail').val(),
            'password': $('#userpass').val(),
            'action': 'login',
        };

        $.ajax({
            url: 'process.php',
            type: 'post',
            data: data,
            success: function(response) {
                alert(response);
                if (response === 'Login Successfull') window.location = 'dashboard.php';
            }
        });
    }

    function logoutUser() {
        session_unset();
        session_destroy();
        window.location = 'login.php'
    }

    function uploadImage() {
        var formData = $('#file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', formData);
        console.log(form_data);
        // alert(form_data);
        var data = {
            'imageTitle': $('#imageTitle').val(),
            'imageDescription': $('#imageDescription').val(),
            'formdata': form_data,
            'action': 'upload'
        };
        $myfile = fopen("logfile.txt", "a");
        fwrite($myfile, 'upload Image \n');
        alert('hi');
        $.ajax({
            url: 'process.php',
            type: 'post',
            data: data,
            success: function(response) {
                alert(response);
                // if(response==='Upload Successfull') window.location='dashboard.php';
            }
        });
    }
</script>