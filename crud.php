<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "pt-1";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa  terkoneksi ke database ");
} /*else {
   echo "Koneksi berhasil";
}*/
$email = "";
$nama = "";
$kelamin = "";
$noTelepon = "";
$alamat = "";
$password = "";
$password2 = "";

$sukses = "";
$error = "";
//-----------------------------------------------------------
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//-------------------------------------------------------------
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $kelamin = $_POST['kelamin'];
    $noTelepon = $_POST['noTelepon'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if ($email && $nama && $kelamin && $noTelepon && $alamat && $password) {
        
        $nama = test_input($_POST["nama"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
            echo "<script>alert('Nama harus menggunakan huruf dan spasi')</script>";
            header("Refresh: 0; url = login.php");
            return false;
        }

        $email = test_input($_POST["email"]);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Email tidak sesuai')</script>";
            header("Refresh: 0; url = login.php");
            return false;
        }
        
        if ($password !== $password2) {
            echo "<script>alert('Konfirmasi Password Salah')</script>";
            header("Refresh: 0; url = login.php");
            return false;
        }
        //$password = md5($password);
        $sql1 = "insert into akun(email, nama, kelamin, noTelepon, alamat, password) 
        values('$email','$nama','$kelamin','$noTelepon','$alamat','$password')";

        $duplikasi = mysqli_query($koneksi, "SELECT email FROM akun WHERE email = '$email'");
        if (mysqli_fetch_assoc($duplikasi)) {
            echo "<script>alert('Email Sudah Terdaftar!!!')</script>";
            header("Refresh: 0; url = login.php");
            return false;
        }
        $q1 = mysqli_query($koneksi, $sql1);

        if ($q1) {
            echo "<script> alert('Registrasi Berhasil !!!')</script>";
            header("Refresh: 0; url = login.php");
            //$sukses = "Berhasil memasukkan data baru";
        } else {
            $error = "gagal memasukkan data";
        }
    } else {
        $error = "Silahkan Memasukkan Data";
    }
}
