<?php
session_start();
if (!isset($_SESSION['masuk'])) {
    header("location:../Login.php");
    exit;
}
//--------Conector-To-Database---------
require "../connector/koneksi.php";
//-------------------------------------
$getEmail = $_SESSION['email'];
if(is_null($getEmail) && $getEmail == ""){
    echo "<script>alert('Sepertinya terjadi perubahan. silahkan login kembali')</script>";
        header("Refresh: 0; url = ../logout/logout.php");
        return false;
}
$sql = "SELECT email, nama, kelamin, noTelepon, alamat, password FROM akun WHERE email='$getEmail'";
$result = $koneksi->query($sql);
if (!$result) {
    echo "Data tidak dapat diakses";
}
$row = mysqli_fetch_row($result);
$getPassword = $_SESSION['password'];
if ($getPassword != $row[5] || $getEmail != $row[0]) {
    echo "<script>alert('Sepertinya terjadi perubahan pada akun anda. silahkan login kembali')</script>";
    header("Refresh: 0; url = ../logout/logout.php");
    return false;
}
$emailView = $row[0];
$namaView = strtok(strtoupper($row[1]), " ");
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];

$g1 = mysqli_query($koneksi, "SELECT*FROM produk WHERE id_produk='IDG1'");
$row1 = mysqli_fetch_row($g1);
$namaGas1= $row1[1];
$gas1 = $row1[2];

$g2 = mysqli_query($koneksi, "SELECT*FROM produk WHERE id_produk='IDG2'");
$row2 = mysqli_fetch_row($g2);
$namaGas2= $row2[1];
$gas2 = $row2[2];

$g3 = mysqli_query($koneksi, "SELECT*FROM produk WHERE id_produk='IDG3'");
$row3 = mysqli_fetch_row($g3);
$namaGas3= $row3[1];
$gas3 = $row3[2];

$g4 = mysqli_query($koneksi, "SELECT*FROM produk WHERE id_produk='IDG4'");
$row4 = mysqli_fetch_row($g4);
$namaGas4= $row4[1];
$gas4 = $row4[2];
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="gambar/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Produk</title>
    <link rel="stylesheet" href="css/style2.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="inner-page-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
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
                <ul>
                    <li><a href="../home/home.php"> Home </a></li>
                    <li><a href="../about/about.php">About</a></li>
                    <li><a href="../Produk2/produk.php">Produk</a></li>
                    <li><a href="../Pesanan/pesanan.php">Pesanan</a></li>
                    <li><a href="../contact/contact.php">Contact</a></li>
                    <li><a href="../akun/akun.php"><i class="fa fa-fw fa-user"></i> Akun</a></li>
                </ul>
            </div>
        </div>
        <div class="banner">
            <div class="owl-four owl-carousel" itemprop="image">
                <!--<img src="gambar/background-3.png" alt="Image of Bannner">
                <img src="gambar/background-3kg.png" alt="Image of Bannner">
                <img src="gambar/background-brightgas.png" alt="Image of Bannner">
                <img src="gambar/background-bluegas.png" alt="Image of Bannner">
                <img src="gambar/background-12kg.png" alt="Image of Bannner">-->
            </div>
            <div class="learn-courses">
                <div class="container">
                    <div class="owl-one owl-carousel">
                        <div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">
                            <div class="img-wrap" itemprop="image"><img src="gambar/gas3kg.png" alt="courses picture"></div>
                            <a href="../Pembayaran/pembayaran.php?id=IDG1" class="learn-desining-banner" itemprop="name">
                                <<< Pesan di sini >>>
                            </a>
                            <div class="box-body" itemprop="description">
                                <b><?php echo $namaGas1?></b><br><b><p><?php echo $gas1 ?>/20 Unit</p></b>
                                <?php
                               
                                ?>
                            </div>
                            <a href="../ulasan-produk/ulasan-produk.php?id=IDG1"><button class="btn-ulasan">Lihat Ulasan</button></a>
                        </div>

                        <div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">
                            <div class="img-wrap" itemprop="image"><img src="gambar/brightGas.png" alt="courses picture"></div>
                            <a href="../Pembayaran/pembayaran.php?id=IDG2" class="learn-desining-banner" itemprop="name">
                                <<< Pesan di sini >>>
                            </a>
                            <div class="box-body" itemprop="description">
                                <b><?php echo $namaGas2?></b><br><b><p><?php echo $gas2 ?>/20 Unit</p></b>
                            </div>
                            <a href="../ulasan-produk/ulasan-produk.php?id=IDG2"><button class="btn-ulasan">Lihat Ulasan</button></a>
                        </div>

                        <div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">
                            <div class="img-wrap" itemprop="image"><img src="gambar/blueGazv2.png" alt="courses picture"></div>
                            <a href="../Pembayaran/pembayaran.php?id=IDG3" class="learn-desining-banner" itemprop="name">
                                <<< Pesan di sini >>>
                            </a>
                            <div class="box-body" itemprop="description">
                                <b><?php echo $namaGas3?></b><br><b><p><?php echo $gas3 ?>/20 Unit</p></b>
                            </div>
                            <a href="../ulasan-produk/ulasan-produk.php?id=IDG3"><button class="btn-ulasan">Lihat Ulasan</button></a>
                        </div>

                        <div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">
                            <div class="img-wrap" itemprop="image"><img src="gambar/gas12v3.png" alt="courses picture"></div>
                            <a href="../Pembayaran/pembayaran.php?id=IDG4" class="learn-desining-banner" itemprop="name">
                                <<< Pesan di sini >>>
                            </a>
                            <div class="box-body" itemprop="description">
                                <b><?php echo $namaGas4?></b><br><b><p><?php echo $gas4 ?>/20 Unit</p></b>
                            </div>
                            <a href="../ulasan-produk/ulasan-produk.php?id=IDG4"><button class="btn-ulasan">Lihat Ulasan</button></a>
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