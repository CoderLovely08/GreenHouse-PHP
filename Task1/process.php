<?php
session_start();

include 'config.php';
$connectionString = "host=" . $config['DB_HOST'] . " port =5432 dbname=" . $config['DB_DATABASE'] . " user=" . $config['DB_USERNAME'] . " password=" . $config['DB_PASSWORD'];
$conn = pg_connect($connectionString);
$myfile = fopen("logfile.txt", "w");
fwrite($myfile, 'inside acasdfsafftion \n');

if (!$conn) {
    echo 'something went wrong!';
    exit();
}

if(isset($_POST['upload'])) {
    echo '<script>alert("how are you");</script>';
    uploadNewImageData();
}
// echo '<script>alert("how are you");</script>';
if (isset($_POST['action'])) {
    fwrite($myfile, 'inside acasdfsafftion \n');
    if ($_POST['action'] == 'register') {
        register();
    } else if ($_POST['action'] == 'login') {
        login();
    }else if($_POST['action'] == 'upload'){
        uploadNewImageData();
    }
}

// Register
function register()
{
    global $conn, $myfile;
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

function login()
{
    global $myfile, $conn;
    // fwrite($myfile,'logging user');
    $useremail = $_POST['email'];
    $userpass = md5($_POST['password']);
    $query = "Select * from UserInfo where email='$useremail' and userpassword='$userpass'";
    fwrite($myfile, $query);
    $result = pg_query($conn, $query);
    if (pg_num_rows($result) == 1) {
        $row = pg_fetch_row($result);
        $loggedUserName = $row[1];
        $loggedUserEmail = $row[2];
        $loggedUserPassword = $row[3];
        $_SESSION['loggedUserName'] = $loggedUserName;
        $_SESSION['loggedUserEmail'] = $loggedUserEmail;
        $_SESSION['loggedUserPassword'] = $loggedUserPassword;
        echo 'Login Successfull ' . $loggedUserName;
    } else echo 'Password Incorrect';
}


function uploadNewImageData()
{
    global $conn,$myfile;
    // fwrite($myfile,$_FILES['file']);
    $file = $_FILES['file'];

    $imgTitle=trim($_POST['imageTitle']);
    $imgDesc=pg_escape_string(trim($_POST['imageDescription']));
    $imgAuthor=$_SESSION['loggedUserName'];
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileTempLocation = $_FILES['file']['tmp_name'];
    echo "File name is: " . $fileName . "<br>\nFile type is: " . $fileType . "<br>\nFile Size is: " . ($fileSize / 1000) . " kb";

    // get the file extension
    $fileExt = explode('.', $fileName);
    // print_r($fileExt);
    $fileExtension = strtolower(end($fileExt));

    // list of file types which can be uploaded
    $allowedExtension = array('jpg', 'jpeg', 'png');

    // check if the correct file type is selected
    if (in_array($fileExtension, $allowedExtension)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                // $fileUniqueName=uniqid('',true).".".$fileExtension;
                $fileUniqueName = "$fileExt[0]." . $fileExtension;
                echo $fileUniqueName;
                $fileDestinantion = 'uploads/' . $fileUniqueName;
                move_uploaded_file($fileTempLocation, $fileDestinantion);
                $query = "insert into ImageData(imageName,ImageDescription,imageAuthor,imageTitle) values('$fileUniqueName','{$imgDesc}','$imgAuthor','$imgTitle')";
                // echo $query;
                $run = pg_query($conn, $query);
                if ($run) {
                    echo '<br>upload successfull';
                    header("Location: dashboard.php");
                }
                else echo 'error';
                // header("Location: index.html?uploaded");
            } else echo 'File size is larger than 500kb';
        }
    } else echo 'Selected file type not allowed!';
}
