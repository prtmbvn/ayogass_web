<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "pt_1";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
  die("Tidak bisa  terkoneksi ke database ");
} /*else {
    echo "Koneksi berhasil";
}*/
?>