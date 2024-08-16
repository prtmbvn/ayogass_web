<?php 
$getID_produk = $row4['id_produk'];
$sql2 = "SELECT id_produk, nama, harga FROM produk WHERE id_produk='$getID_produk'";
$result2 = $koneksi->query($sql2);
if (!$result2) {
  echo "Data tidak dapat diakses";
}
$row2 = mysqli_fetch_row($result2);
$idProdukView = $row2[0];
$namaProdukView = strtoupper($row2[1]);
$hargaProdukView = $row2[2];
$getID_pesanan = $row4['id_pesanan'];
$id_pesanan = "";
$emote = "";
//---------emote-status-------------------------------
if($row4['status_pengiriman'] == "Menunggu pembayaran"){
  $emote = " &#128308;";
  $feed = "";
}
if($row4['status_pengiriman'] == "Pesanan telah sampai"){
  $emote = " &#9989;";
  $feed = "<a href=\"../rating/rating.php?id_pesanan=$getID_pesanan&id_produk=$idProdukView\"><button type='submit' name='back'>Beri Ulasan</button></a>";
}
if($row4['status_pengiriman'] == "Mengirimkan ke alamat tujuan"){
  $emote = " &#128667;";
  $feed = "";
}
if($row4['status_pengiriman'] == "Pengiriman ditunda"){
  $emote = " &#9940;";
  $feed = "";
}
if($row4['status_pengiriman'] == "Mempersiapkan Pengiriman"){
  $emote = " &#128230;";
  $feed = "";
  
}


$sql3 = "SELECT*FROM ulasan WHERE id_pesanan='$getID_pesanan' AND email='$getEmail'";

$result3 = $koneksi->query($sql3);
if (!$result3) {
    echo "Data tidak dapat diakses";
}
$row5 = mysqli_fetch_row($result3);
if($row5 == null){
  $ratingView = "Belum Diberi Rating";
  $ulasanView = "Belum ada Ulasan";
}
else{
  
  $ratingView = $row5[0];
  $ulasanView = $row5[1];
  $printUlasan = "";
}
//---------rating------------------
if($ratingView == 5){
  $printUlasan = "
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span>&#129321;</span>
  ";
}
else if($ratingView == 4){
  $printUlasan = "
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star \"></span>
    <span>&#x1F600;</span>
    
  ";
}
else if($ratingView == 3){
  $printUlasan = "
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star \"></span>
    <span class=\"fa fa-star \"></span>
    <span>&#x1F642;</span>
    
  ";
}
else if($ratingView == 2){
  $printUlasan = "
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star \"></span>
    <span class=\"fa fa-star \"></span>
    <span class=\"fa fa-star \"></span>
    <span>&#x1F641;</span>
  ";
}
else if($ratingView == 1){
  $printUlasan = "
    <span class=\"fa fa-star checked\"></span>
    <span class=\"fa fa-star \"></span>
    <span class=\"fa fa-star \"></span>
    <span class=\"fa fa-star \"></span>
    <span class=\"fa fa-star \"></span>
    <span>&#x1F61E;</span>
  ";
}
else{
  $printUlasan = "Belum diberi rating";
  
}


echo "
<div class='space'>
 
  <h2>".$count.". PESANAN ".$namaProdukView."</h2>
  <table>
    <tr>
      <td class='left'><b>ID Pesanan</b></td>
      <td>".$row4['id_pesanan']."</td>

    </tr>
    <!--<tr>
      <td class='left'><b>Nama Agen</b></td>
      <td>".$namaView."</td>

    </tr>-->
    <tr>
      <td class='left'><b>Tanggal Pemesanan</b></td>
      <td>".$row4['tgl_pesanan']."</td>

    </tr>
    <tr>
      <td class='left'><b>Produk Pesanan</b></td>
      <td>".$row4['id_produk']." - ".$namaProdukView." : 20 Unit</td>

    </tr>
    <tr>
      <td class='left'><b>Total Pembayaran</b></td>
      <td>".$hargaProdukView." ".$row4['pembayaran']."</td>

    </tr>
    <tr>
      <td class='left'><b>Status Pengiriman</b></td>
      <td>".$row4['status_pengiriman']. $emote."</td>

    </tr>
    <tr>
      <td class='left'><b>Rating Pesanan</b></td>
      <td>".$printUlasan." 
      </td>

    </tr>
    <tr>
      <td class='left'><b>Ulasan</b></td>
      <td><i>".$ulasanView."</i> 
      </td>

    </tr>
  </table>
  
  <div class='lihat'>
  <br>
  <a href=\"detail.php?id=$getID_pesanan\"><button type='submit' name='back'>Detail Pesanan</button></a>&ensp;
  ".$feed."
  </div>
</div>
";
