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
$namaView = $row[1];
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../asset-img/logo gas.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
  <div class="banner">
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <img src="../asset-img/logo-4BEFORE.png" class="logo">
      <!--<label class="logo">DesignX</label>-->
      <ul>
        <li><a href="../home/home.php"> Home </a></li>
        <li><a href="../about/about.php">About</a></li>
        <li><a href="../Produk2/produk.php">Produk</a></li>
        <li><a href="../Pesanan/pesanan.php">Pesanan</a></li>
        <li><a href="../contact/contact.php">Contact</a></li>
        <li><a href="../akun/akun.php"><i class="fa fa-fw fa-user"></i> Akun</a></li>
      </ul>
    </nav>
    <div class="content">
      <div class="space">
        <h1><i class='fas fa-comment-alt'></i> CONTACT US</h1>
        <h2>WHATSAPP<br></h2>
        <p><i class="fab fa-whatsapp" style="font-size: 60px ;"></i> </p>
        <p>Anda dapat menghubungi kami melalui media sosial whatsapp Ayo Gass</p>
        <div class="mid-button">
          <a href="https://wa.me/628882030708" target="_blank"><button type="button">Chat Kami</button></a>
        </div>


        <h2>E-MAIL<br></h2>
        <p><i class='fas fa-envelope' style='font-size:50px'></i> </p>
        <p>Anda Juga dapat menghubungi kami melalui media sosial E-mail Ayo Gass</p>
        <a href="mailto:eksotic473@gmail.com" target="_blank"><button type="button">Email Kami</button></a>

      </div>

    </div>
  </div>

  </div>
</body>

</html>