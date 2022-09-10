<?php
session_start();

include 'config.php';
$connectionString = "host=" . $config['DB_HOST'] . " port =5432 dbname=" . $config['DB_DATABASE'] . " user=" . $config['DB_USERNAME'] . " password=" . $config['DB_PASSWORD'];
$conn = pg_connect($connectionString);
$myfile = fopen("testfile.txt", "w");

if (!$conn) {
    echo 'something went wrong!';
    exit();
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'register'){
        register();
    }else if($_POST['action'] == 'login') login();
    // elseif ($_POST['action'] == 'login') login();
}

// register();
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
        echo json_encode(utf8_encode('User already exists!'));
        $txt = "User already exists!";
        fwrite($myfile, $txt);
        exit();
    } else {
        $userpass = md5($userpass);
        $query = "Insert into UserInfo(username,email,userpassword) values('$username','$useremail','$userpass')";
        $result = pg_query($conn, $query);
        if ($result) echo 'Registration Successful';;
    }
}

function login(){
    echo 'login called';
}

?>