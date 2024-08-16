<?php
session_start();
if(!isset($_SESSION['masuk'])){
  header("location:../login.php");
  exit;
}

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


$getEmail = $_SESSION['email'];
//---------------------------------
/*$cek = mysqli_query($koneksi, "SELECT email FROM pesanan WHERE email = '$getEmail'");
if (!mysqli_fetch_assoc($cek)) {
	echo "<script>alert('Anda Belum memesan produk. Silahkan pilih Produk yang tersedia!')</script>";
	header("Refresh: 0; url = ../produk/produk.php");
	return false;
}*/
//---------------------------------
//$id_barang = $_SESSION['idBarang'];
$sql = "SELECT email, nama, kelamin, noTelepon, alamat, password FROM akun WHERE email='$getEmail'";
$result = $koneksi->query($sql);
if (!$result) {
  echo "Data tidak dapat diakses";
}
$row = mysqli_fetch_row($result);
$emailView = $row[0];
$namaView = $row[1];
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];
//----------------------------------
$getID_pesanan = $_GET['id'];
//------------get-pesanan------------
$sql3 = "select *from pesanan where id_pesanan = '$getID_pesanan'"; //"SELECT id_pesanan, tgl_pesanan, pembayaran, catatan, status_pembayaran, status_pengiriman, status_penerimaan, id_produk, email FROM pesanan WHERE email='$getEmail'";
$result3 = $koneksi->query($sql3);
if (!$result3) {
  echo "Data tidak dapat diakses";
}
$row = mysqli_fetch_row($result3);
$id_pesanan = $row[0];
$tgl_pesanan = $row[1];
$pembayaran = $row[2];
$catatan = $row[3];
$status_pembayaran = $row[4];
$status_pengiriman = $row[5];
$status_penerimaan = $row[6];
$id_produk = $row[7];
$email = $row[8];
//------------get-produk------------
$sql2 = "SELECT id_produk, nama, harga FROM produk WHERE id_produk='$id_produk'";
$result2 = $koneksi->query($sql2);
if (!$result2) {
  echo "Data tidak dapat diakses";
}
$row2 = mysqli_fetch_row($result2);
$idProdukView = $row2[0];
$namaProdukView = $row2[1];
$hargaProdukView = $row2[2];
//----------------------------------

/*else{
  echo "<script>alert('Anda Belum memesan produk!')</script>";
	header("Refresh: 0; url = ../home/home.php");
	exit;
}*/

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/x-icon" href="logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <title>Detail</title>
        <link rel="stylesheet" href="style-detail.css">
    </head>
    <body>
        <div class="banner">
          <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
              <i class="fas fa-bars"></i>
            </label>
            <img src="logo-4.png" class="logo">
            <!--<label class="logo">DesignX</label>-->
            <ul>
              <li><a href="../home/home.php">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="../produk/produk.php">Produk</a></li>
              <li><a href="#">Pesanan</a></li>
              <li><a href="../akun/akun.php"><i class="fa fa-fw fa-user"></i> Akun</a></li>
            
            </ul>
          </nav>
          <div class="content">
          <div class="space">
            
                
                <h1>PESANAN &#128196;</h1>
                <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae quos libero accusamus aut                 
                </p> -->
                <table>
                    <tr>
                      <td class="left"><b>ID Pesanan</b></td>
                      <td><?php echo $id_pesanan?></td>
                      
                    </tr>
                    <tr>
                      <td class="left"><b>No. Pembayaran</b></td>
                      <td><?php echo $pembayaran?></td>
                      
                    </tr>
                    <tr>
                        <td class="left"><b>Nama Penerima</b></td>
                        <td><?php echo $namaView?></td>
                        
                      </tr>
                    <tr>
                        <td class="left"><b>Tgl. Pemesanan</b></td>
                        <td><?php echo $tgl_pesanan?></td>
                        
                      </tr>
                    <tr>
                      <td class="left"><b>Alamat Tujuan</b></td>
                      <td><?php echo $alamatView?></td>
                      
                    </tr>
                    <tr>
                        <td class="left"><b>No. Telepon</b></td>
                        <td><?php echo $noTeleponView?></td>
                        
                      </tr>
                      <tr>
                        <td class="left"><b>Pesanan</b></td>
                        <td><?php echo $id_produk." [".$namaProdukView."]"?></td>
                        
                      </tr>
                      <tr>
                        <td><b>Catatan</b></td>
                        <td><textarea id="w3review" name="w3review" rows="2" cols="50"><?php echo $catatan?></textarea></td>
                        
                      </tr>
                  </table>
                  <hr>
                  <div class="status">
                  <h1>STATUS <i class="fa fa-bell" style="font-size:40px;"></i></i></h1>
                  <table>
                    <tr>
                      <td class="left"><b>Pemesanan </b></td>
                      <td>Berhasil &#9989;</td>
                      
                    </tr>
                    <tr>
                      <td class="left"><b>Pembayaran</b></td>
                      <td><?php echo $status_pembayaran?> &#10060;</td>
                      
                    </tr>
                    <tr>
                      <td class="left"><b>Pengiriman</b></td>
                      <td><?php echo $status_pengiriman?>&#9940;</td>
                      
                    </tr>
                    <tr>
                        <td class="left"><b>Penerimaan</b></td>
                        <td><?php echo $status_penerimaan?>&#9940;</td>
                        
                      </tr>
                  </table>
                  </div>   
                     
                 </div>
                </div>
            </div>
            <!--<div class="menu">
                <h1>pppppppppp</h1>
            </div>?-->
        </div>
    </body>
</html>