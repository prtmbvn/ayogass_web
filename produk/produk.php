<?php
session_start();
if (!isset($_SESSION['masuk'])) {
	header("location:../login.php");
	exit;
}
$getEmail = $_SESSION['email'];
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
/*$result = mysqli_query($koneksi, "SELECT email FROM pesanan WHERE email = '$getEmail'");
if (mysqli_fetch_assoc($result)) {
	echo "<script>alert('Menu Produk Tidak dapat diakses. Menunggu Pengiriman pesanan sebelumnya diterima!')</script>";
	header("Refresh: 0; url = ../pesanan/pesanan.php");
	return false;
}*/
/*if(isset($_SESSION['pemesanan'])){
	echo "<script>alert('Menu Produk Tidak dapat diakses. Menunggu Pengiriman pesanan sebelumnya diterima!')</script>";
	header("Refresh: 0; url = ../home/home.php");
	exit;
  }*/
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="icon" type="image/x-icon" href="gambar/logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Produk</title>
	<link rel="stylesheet" href="css/style2.css">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="inner-page-style.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
</head>

<body>
	<div id="page" class="site" itemscope itemtype="http://schema.org/LocalBusiness">
		<div class="banner1">
			<div class="navb">
				<input type="checkbox" id="check">
				<label for="check" class="checkbtn">
					<i class="fas fa-bars"></i>
				</label>
				<img src="gambar/logo-4.png" class="logoicon">
				<!--<label class="logo">DesignX</label>-->
				<ul>
					<li>
						<div style="color:aliceblue"><a href="../home/home.php"> Home </a></div>
					</li>
					<li><a href="#">About</a></li>
					<li><a href="#">Produk</a></li>
					<li><a href="../Pesanan/pesanan.php">Pesanan</a></li>
					<li><a href="../akun/akun.php"><i class="fa fa-fw fa-user"></i> Akun</a></li>

				</ul>
			</div>
		</div>
		<div class="banner">
			<div class="owl-four owl-carousel" itemprop="image">
				<img src="gambar/background-3.png" alt="Image of Bannner">
				<img src="gambar/background-3kg.png" alt="Image of Bannner">
				<img src="gambar/background-brightgas.png" alt="Image of Bannner">
				<img src="gambar/background-bluegas.png" alt="Image of Bannner">
				<img src="gambar/background-12kg.png" alt="Image of Bannner">
			</div>
			<div class="learn-courses">
				<div class="container">
					<div class="courses">
						<div class="owl-one owl-carousel">
							<div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">
								<div class="img-wrap" itemprop="image"><img src="gambar/gas3kg.png" alt="courses picture"></div>
								<a href="../Pembayaran/pembayaran.php?id=IDG1" class="learn-desining-banner" itemprop="name">
									<<< Pesan di sini>>>
								</a>
								<div class="box-body" itemprop="description">
									<h1><b><i>Gas 3kg</i></b></h1>
								</div>
							</div>

							<div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">
								<div class="img-wrap" itemprop="image"><img src="gambar/brightGas.png" alt="courses picture"></div>
								<a href="../Pembayaran/pembayaran.php?id=IDG2" class="learn-desining-banner" itemprop="name">
									<<< Pesan di sini>>>
								</a>
								<div class="box-body" itemprop="description">
									<h1><b><i>Bright Gas</i></b></h1>
								</div>
							</div>

							<div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">
								<div class="img-wrap" itemprop="image"><img src="gambar/blueGazv2.png" alt="courses picture"></div>
								<a href="../Pembayaran/pembayaran.php?id=IDG3" class="learn-desining-banner" itemprop="name">
									<<< Pesan di sini>>>
								</a>
								<div class="box-body" itemprop="description">
									<h1><b><i>Blue Gas 5,5kg</i></b></h1>
								</div>
							</div>

							<div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">
								<div class="img-wrap" itemprop="image"><img src="gambar/gas12v3.png" alt="courses picture"></div>
								<a href="../Pembayaran/pembayaran.php?id=IDG4" class="learn-desining-banner" itemprop="name">
									<<< Pesan di sini>>>
								</a>
								<div class="box-body" itemprop="description">
									<h1><b><i>Gas 12kg</i></b></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer class="page-footer" itemprop="footer" itemscope itemtype="http://schema.org/WPFooter">
			<div class="footer-last-section">
				<div class="container">
					<p>Official Website of Ayo Gas</a></p>
				</div>
			</div>
		</footer>
	</div>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/owl.carousel.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>

</html>