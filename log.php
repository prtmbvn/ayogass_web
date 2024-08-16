<?php
session_start();
if(isset($_SESSION['masuk'])){
    header("location:home/Home.php");
    exit;
}
$host = "localhost";
$user = "root";
$pass = "";
$db = "pt-1";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa  terkoneksi ke database ");
} 
$email = "";
$password = "";

if (isset($_POST['masuk'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['email'] = $email;

    $sql2 = "select *from akun where email = '$email' and password = '$password'";
    $result = mysqli_query($koneksi, $sql2);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
     
    if ($count == 1) {
        $_SESSION['masuk'] = true;
        
        header("location:home/Home.php");
    } else {
        echo "<script>alert('Email atau Password tidak sesuai')</script>";
        header("Refresh: 0; url = login.php");
    }
}
