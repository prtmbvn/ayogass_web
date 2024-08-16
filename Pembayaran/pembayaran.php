<?php
session_start();
if (!isset($_SESSION['masuk'])) {
  header("location:../Login.php");
  exit;
} else {
  $id_barang = $_GET['id'];
  $_SESSION['idBarang'] = $id_barang;
}


//--------Conector-To-Database---------
require "../connector/koneksi.php";
//-------------------------------------
//------time------
date_default_timezone_set("Asia/Jakarta");
//----------------

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
//------------get-produk------------
$sql2 = "SELECT id_produk, nama, harga FROM produk WHERE id_produk='$id_barang'";
$result2 = $koneksi->query($sql2);
if (!$result2) {
  echo "Data tidak dapat diakses";
}
$row2 = mysqli_fetch_row($result2);
$idProdukView = $row2[0];
$namaProdukView = $row2[1];
$hargaProdukView = $row2[2];
//echo $idProdukView." ".$namaProdukView." ".$hargaProdukView;
//----------------------------------
//--------Pilih-Produk-lain---------
if (isset($_POST['back'])) {
  header("Refresh: 0; url = ../Produk2/produk.php");
}
//--------Proses-Pesanan
$id_pesanan = "";
$tgl_pesanan = "";
$pembayaran = "";
$catatan = "";
$status_pembayaran = "";
$status_pengiriman = "";
$status_penerimaan = "";
if (isset($_POST['pesanan'])) {
  $id_pesanan = strtoupper(uniqid('ID'));
  //$tgl_pesanan = date("Y-m-d");
  $tgl_pesanan = date('Y-m-d H:i:s');
  $pembayaran = $_POST['bayar'];
  $catatan = $_POST['catatan'];
  $status_pembayaran = "Belum dibayar";
  $status_pengiriman = "Menunggu pembayaran";
  $status_penerimaan = "Belum diterima";
  $pesanan = "insert into pesanan(id_pesanan, tgl_pesanan, pembayaran, catatan, status_pembayaran, status_pengiriman, status_penerimaan, id_produk, email) 
        values('$id_pesanan','$tgl_pesanan','$pembayaran','$catatan','$status_pembayaran','$status_pengiriman','$status_penerimaan','$id_barang','$getEmail')";
  $query = mysqli_query($koneksi, $pesanan);
  if ($query) {
    echo "<script> alert('Pesanan Berhasil')</script>";
    header("Location: load-pembayaran.php");
  } else {
    //echo "<script> alert('Pesanan Berhasil')</script>";
    header("Refresh: 0; url = ..pembayaran.php");
    return false;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Pembayaran</title>
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
  <div class="banner">
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <img src="../asset-img/logo-4.png" class="logo">
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

      <h1>KERANJANG</h1>
      <?php
      //echo $id_barang . "===" . $pembayaran . "===" . $catatan."===".$id_pesanan."===".$tgl_pesanan
      ?>
      <form action="" method="post" id="pesan">
        <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae quos libero accusamus aut                 
                </p> -->

        <table>
          <tr>
            <td class="left"></i>Nama</i></td>
            <td><?php echo $namaView ?></td>

          </tr>
          <tr>
            <td class="left"></i>E-mail</i></td>
            <td><?php echo $emailView ?></td>

          </tr>
          <tr>
            <td class="left">Alamat</td>
            <td><?php echo $alamatView ?></td>

          </tr>
          <tr>
            <td class="left">No. Telepon</td>
            <td>0<?php echo $noTeleponView ?></td>

          </tr>
          <tr>
            <td class="left">Pesanan</td>
            <td><?php echo $id_barang . " - " . $namaProdukView ?> : 20 Unit</td>

          </tr>

          <tr>
            <td class="left">Catatan</td>
            <td><textarea style="font-size:12px; padding-left:5px; padding-top:5px;" rows="2" cols="50" form="pesan" name="catatan" value="<?php echo $catatan ?>"></textarea></td>

          </tr>

        </table>
        <hr>

        <h1>METODE PEMBAYARAN</h1>
        <!--<form action="" method="post" id="pesan2">-->
        <table class="table-2">
          <tr>
            <td class="radio-row">
              <label>

                <input type="radio" name="bayar" value="BRI-[98762345]" required <?php if ($pembayaran == "BRI-[98762345]") echo "selected" ?>>
                <span></span>
              </label>
            </td>
            <td><img src="../asset-img/bri.png" class="logo-bank"></td>
            <td class="bank-row">
              <b>BRI-MOBILE</b><br>Perlu Bukti Transfer
            </td>
          </tr>
          <tr>
            <td class="radio-row">
              <label>
                <input type="radio" value="DANA-[56784321]" name="bayar" <?php if ($pembayaran == "DANA-[56784321]") echo "selected" ?>>
                <span></span>
              </label>
            </td>
            <td class="logo-row"><img src="../asset-img/dana.png" class="logo-bank"></td>
            <td class="bank-row"><b>DANA</b><br>Perlu Bukti Transfer</td>
          </tr>
          <tr>
            <td class="radio-row">
              <label>
                <input type="radio" value="Mandiri-[23459876]" name="bayar" <?php if ($pembayaran == "Mandiri-[23459876]") echo "selected" ?>>
                <span></span>
              </label>
            </td>
            <td class="logo-row"><img src="../asset-img/mandiri.png" class="logo-bank"></td>
            <td class="bank-row"><b>MANDIRI-MOBILE</b><br>Perlu Bukti Transfer</td>
          </tr>
          <tr>
            <td class="radio-row">
              <label>
                <input type="radio" value="BCA-[45567812]" name="bayar" <?php if ($pembayaran == "BCA-[45567812]") echo "selected" ?>>
                <span></span>
              </label>
            </td>
            <td class="logo-row"><img src="../asset-img/bca.png" class="logo-bank"></td>
            <td class="bank-row"><b>BCA-MOBILE</b><br>Perlu Bukti Transfer</td>
          </tr>
        </table>
      </form>
      <div class="tagihan">

        <strong>
          <p>Total Pembayaran : <?php echo $hargaProdukView ?></p>
        </strong>
      </div>
      <div>



      </div>
      <form action="" id="back" method="post"></form>
      <button type="submit" form="back" name="back">Pilih Produk Lain</button>
      <button onclick="return confirm('Konfirmasi Pesanan ?')" type="submit" form="pesan" name="pesanan">Konfirmasi Pembayaran</button>
      <div class="radio-group">


      </div>
    </div>
  </div>
</body>

</html>