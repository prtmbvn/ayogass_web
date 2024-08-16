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
  $error = true;
}
else{
    $error = false;
}
$emailView = $row[0];
$namaView = $row[1];
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];
$count = "";
//----------------------------------
//---------------------------------
if($error == false){
  $cek = mysqli_query($koneksi, "SELECT email FROM pesanan WHERE email = '$getEmail'");
  if (!mysqli_fetch_assoc($cek) && $getEmail != is_null($getEmail) && $getEmail != "") {  
    echo "<script>alert('History Transaksi Kosong. Silahkan Belanja Produk!')</script>";
    header("Refresh: 0; url = ../Produk2/produk.php");
    return false;
  }
}

//---------------------------------
//$id_barang = $_SESSION['idBarang'];

//----------------------------------

/*else{
  echo "<script>alert('Anda Belum memesan produk!')</script>";
	header("Refresh: 0; url = ../home/home.php");
	exit;
}*/


$rating = "Belum diberi rating";
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="refresh" content="<?php echo $sec ?>;URL='<?php echo $page ?>'">
  <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
      <?php
      $get = "SELECT id_pesanan, tgl_pesanan, pembayaran, catatan, status_pembayaran, status_pengiriman, status_penerimaan, id_produk FROM pesanan WHERE email='$getEmail'";
      $result4 = $koneksi->query($get);

      if ($result4->num_rows > 0) {
        while ($row4 = $result4->fetch_assoc()) {
          $count++;
          echo include 'view.php';
        }
      }
      ?>
    </div>
  </div>
  <!--<div class="menu">
                <h1>pppppppppp</h1>
            </div>?-->
  </div>
</body>

</html>