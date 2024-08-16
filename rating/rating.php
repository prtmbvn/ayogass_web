<?php
session_start();
if (!isset($_SESSION['masuk'])) {
    header("location:../Login.php");
    exit;
}

//--------Conector-To-Database---------
require "../connector/koneksi.php";
//-------------------------------------

$getEmail = "";
$getId_pesanan = "";
$getId_produk = "";
$getEmail = $_SESSION['email'];
$rating = "";
$komentar = "";

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
}
$emailView = $row[0];
$namaView = strtok(strtoupper($row[1]), " ");
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];

if (isset($_POST['ulasan'])) {
    $getId_pesanan = $_GET['id_pesanan'];
    $getId_produk = $_GET['id_produk'];
    if (!isset($_POST['rating'])) {
        echo "<script>alert('Gagal. Rating Harus Diisi!')</script>";
        header("Refresh: 0; url = rating.php");
        return false;
    } else {
        $rating = $_POST['rating'];
    }
    $komentar = $_POST['komentar'];

    $duplikasi = mysqli_query($koneksi, "SELECT*FROM ulasan WHERE email = '$getEmail' AND id_pesanan = '$getId_pesanan'");
    if (mysqli_fetch_assoc($duplikasi)) {
        $renew = "DELETE FROM ulasan WHERE email = '$getEmail' AND id_pesanan = '$getId_pesanan'";
        $renewUlasan = mysqli_query($koneksi, $renew);
    }

    $sql = "INSERT INTO ulasan(rating, komentar, email, id_produk, id_pesanan) 
        values('$rating','$komentar','$getEmail','$getId_produk','$getId_pesanan')";
    $inputUlasan = mysqli_query($koneksi, $sql);
    if ($inputUlasan) {
        echo "<script> alert('Terimakasih telah memberikan ulasan')</script>";
        header("Refresh: 0; url = ../Pesanan/pesanan.php");
        //$sukses = "Berhasil memasukkan data baru";
    } else {
        $error = "gagal memasukkan data";
    }
    //echo $rating." ".$komentar." ".$getId_pesanan." ".$getId_produk." ".$getEmail ;
}
$getEmail = $_SESSION['email'];
$sql = "SELECT email, nama, kelamin, noTelepon, alamat, password FROM akun WHERE email='$getEmail'";
$result = $koneksi->query($sql);
if (!$result) {
    echo "Data tidak dapat diakses";
}
$row = mysqli_fetch_row($result);
if(is_null($row[0]) && $row[0] == ""){
    echo "<script>alert('Sepertinya terjadi perubahan pada akun anda. silahkan login kembali')</script>";
        header("Refresh: 0; url = ../logout/logout.php");
}
$emailView = $row[0];
$namaView = strtok(strtoupper($row[1]), " ");
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>" />

    <title>rating</title>


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
            <div class="space">


                <h1>YUK BERI ULASAN</h1>
                <p>Terimakasih <b><?php echo $namaView ?></b> telah memesan produk kami. ayo beri ulasan tentang produk dan layanan kami</p>
                <p>Rating dari pemesanan ini :</p>
                <div class="stars">
                    <form method="post" action="" id="ulasan">
                        <input class="star star-5" id="star-5" type="radio" name="rating" value="5" />
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" name="rating" value="4" />
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" name="rating" value="3" />
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" name="rating" value="2" />
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" type="radio" name="rating" value="1" />
                        <label class="star star-1" for="star-1"></label>
                </div>
                <br>
                <p>Berikan Komentar dari pemesanan ini :</p>
                <textarea style="padding-left:5px; padding-top:5px;" rows="3" cols="50" form="ulasan" name="komentar" value="<?php echo $komentar ?>"></textarea>
                <p>Anda dapat merubah rating dan ulasan yang telah diberikan</p>
                </form>
                <br>
                <form id=reset></form>

                <button type='submit' form="ulasan" name="ulasan" onclick="return confirm('Kirim Ulasan ? Anda dapat merubah rating dan ulasan yang telah diberikan.')">Kirim Ulasan</button>


            </div>
        </div>
        </section>


    </div>

    </div>
    </div>
    </div>

    </div>


</body>



</html>