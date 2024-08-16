<?php
if ($row5 == null) {
    $ratingView = "Belum Diberi Rating";
  } else {
  
    $ratingView = $row5['rating'];
    $printUlasan = "";
  }
  //---------rating------------------
  if ($ratingView == 5) {
    $printUlasan = "
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      
    ";
    $emote = "<span>&#129321;</span>";
  } else if ($ratingView == 4) {
    $printUlasan = "
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star \"></span>
      
      
    ";
    $emote = "<span>&#x1F600;</span>";
  } else if ($ratingView == 3) {
    $printUlasan = "
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star \"></span>
      <span class=\"fa fa-star \"></span>
      
      
    ";
    $emote = "<span>&#x1F642;</span>";
  } else if ($ratingView == 2) {
    $printUlasan = "
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star \"></span>
      <span class=\"fa fa-star \"></span>
      <span class=\"fa fa-star \"></span>
      
    ";
    $emote = "<span>&#x1F641;</span>";
  } else if ($ratingView == 1) {
    $printUlasan = "
      <span class=\"fa fa-star checked\"></span>
      <span class=\"fa fa-star \"></span>
      <span class=\"fa fa-star \"></span>
      <span class=\"fa fa-star \"></span>
      <span class=\"fa fa-star \"></span>
      
    ";
    $emote = "<span>&#x1F61E;</span>";
  } else {
    $printUlasan = "Belum diberi rating";
  }
$getEmail = $row5['email'];
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

$getID_produk = $row5['id_produk'];
$sql2 = "SELECT id_produk, nama, harga FROM produk WHERE id_produk='$getID_produk'";
$result2 = $koneksi->query($sql2);
if (!$result2) {
  echo "Data tidak dapat diakses";
}
$row2 = mysqli_fetch_row($result2);
$idProdukView = $row2[0];
$namaProdukView = strtoupper($row2[1]);
$hargaProdukView = $row2[2];

echo "<div class=\"space\">


        <!--<h1>PESANAN &#128196;</h1>
        <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae quos libero accusamus aut                 
                </p> 
        <h2>PESANAN XXXXXXXX</h2>-->
        <table>
          <tr>
            <td class=\"left\"><b><span>".$emote."</span></b></td>
            <td class=\"right\">
              <p>
                ".$printUlasan."
                <br>
                <b>".$namaView." - ".$namaProdukView."</b>
                <br>
                <i>
                
                  ".$row5['komentar']."
                </i>

              </p>

            </td>

          </tr>

        </table>


      </div>";
