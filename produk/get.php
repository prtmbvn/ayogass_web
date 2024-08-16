<?php
session_start();
$id_produk = $_GET['id'];
echo $id_produk;
$_SESSION['id'] = $id_produk;
header('refresh 1: url = ../Pembayaran/pembayaran.php');
?>