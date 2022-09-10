<?php
session_start();
include 'config.php';
$connectionString = "host=" . $config['DB_HOST'] . " port =5432 dbname=" . $config['DB_DATABASE'] . " user=" . $config['DB_USERNAME'] . " password=" . $config['DB_PASSWORD'];
$conn = pg_connect($connectionString);

if (!$conn) {
    echo 'something went wrong!';
    exit();
}
$myfile = fopen("logfile.txt", "w");
fwrite($myfile,'called');
if (isset($_POST['imgId'])) {
    $_SESSION['imgId']=$_POST['imgId'];
    echo $_SESSION['imgId'];
}
?>