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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../asset-img/logo gas.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <img src="../asset-img/logo-4BEFORE.png" class="logo">
    <ul>
      <li><a href="../home/home.php"> Home </a></li>
      <li><a href="../about/about.php">About</a></li>
      <li><a href="../Produk2/produk.php">Produk</a></li>
      <li><a href="../Pesanan/pesanan.php">Pesanan</a></li>
      <li><a href="../contact/contact.php">Contact</a></li>
      <li><a href="../akun/akun.php"><i class="fa fa-fw fa-user"></i> Akun</a></li>
    </ul>
  </nav>
  <section class="py-5 my-5">
    <div class="about-section">
      <h1>ABOUT US</h1>
      <p>Aplikasi Web Ayo Gas merupakan Sistem Layanan Pemesanan Gas Berbasis Web untuk mempermudah
        Agen dalam pemesanan Gas. Menyediakan Berbagai Macam Produk GAS LPG, Bright Gas dan Blue Gas.</p>

    </div>

    <h2 class="judul" style="text-align:center; color: aliceblue; text-transform: uppercase;">Our Team</h2>
    <div class="row">
      <div class="column">
        <div class="card">
          <img src="../asset-img/PROFIL BEVAN.jpg" alt="Jane" style="width:100%">
          <div class="container">
            <b>
              <p class="nama">Pratama Bevan Nurrohman
            </b><br><br>152021105<br>INFORMATIKA ITENAS<br>
            <div style="font-size: 13px;"></div>
            <div class="mid"><a href="https://www.instagram.com/prtmbvn_/" target="_blank"><button>INSTAGRAM</button></a></div>
            </p>

          </div>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <img src="../asset-img/PROFIL PANJI.jpeg" alt="Mike" style="width: 325px" style="length:100px">
          <div class="container">
            <b>
              <p class="nama">I Komang Panji 
            </b><br><br>152021120<br>INFORMATIKA ITENAS<br>
            <div style="font-size: 13px;"></div>
            <div class="mid"><a href="https://www.instagram.com/panjinatha/" target="_blank"><button>INSTAGRAM</button></a></div>
            </p>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <img src="../asset-img/PROFIL HADID.jpeg" alt="John" style="width:100%">
          <div class="container">
            <b>
              <p class="nama">Abdullah Marwan Hadid
            </b><br><br>152021109<br>INFORMATIKA ITENAS<br>
            <div style="font-size: 13px;"></div>
            <div class="mid"><a href="https://www.instagram.com/a.duleee/" target="_blank"><button>INSTAGRAM</button></a></div>
            </p>
          </div>
        </div>
      </div>
    </div>

</body>

</html>