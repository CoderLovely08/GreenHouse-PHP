<?php
session_start();

include 'config.php';
$connectionString = "host=" . $config['DB_HOST'] . " port =5432 dbname=" . $config['DB_DATABASE'] . " user=" . $config['DB_USERNAME'] . " password=" . $config['DB_PASSWORD'];
$conn = pg_connect($connectionString);
$myfile = fopen("logfile.txt", "w");

if (!$conn) {
    echo 'something went wrong!';
    exit();
}

if (isset($_POST['action'])) {
    fwrite($myfile,'inside action \n');
    if ($_POST['action'] == 'register'){
        register();
    }else if($_POST['action'] == 'login'){
        fwrite($myfile,'login called');
        login();
    }
}

// Register
function register()
{
    global $conn,$myfile;
    $username = $_POST['name'];
    $useremail = $_POST['email'];
    $userpass = $_POST['password'];

    $query = "SELECT * FROM UserInfo WHERE email='$useremail'";
    $result = pg_query($conn, $query);
    if (pg_num_rows($result) > 0) {
        echo json_encode(utf8_encode('User already exists! Kindly login.'));
        $txt = "User already exists!";
        fwrite($myfile, $txt);
        exit();
    } else {
        $userpass = md5($userpass);
        $query = "Insert into UserInfo(username,email,userpassword) values('$username','$useremail','$userpass')";
        $result = pg_query($conn, $query);
        if ($result) echo 'Registration Successful';
    }
}

function login(){
    global $myfile,$conn;
    // fwrite($myfile,'logging user');
    $useremail = $_POST['email'];
    $userpass = md5($_POST['password']);
    $query = "Select * from UserInfo where email='$useremail' and userpassword='$userpass'";
    fwrite($myfile,$query);
    $result=pg_query($conn,$query);
    if(pg_num_rows($result)==1){
        $row=pg_fetch_row($result);
        $loggedUserName=$row[1];
        $loggedUserEmail=$row[2];
        $loggedUserPassword=$row[3];
        $_SESSION['loggedUserName']=$loggedUserName;
        $_SESSION['loggedUserEmail']=$loggedUserEmail;
        $_SESSION['loggedUserPassword']=$loggedUserPassword;
        echo 'Login Successfull '. $loggedUserName;
    }
    else echo 'Password Incorrect';
}

?>