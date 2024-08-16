<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:../crud-admin/admin.php");
    exit;
}

//--------Conector-To-Database---------
require "../connector/koneksi.php";
//-------------------------------------

$newStatus_pembayaran = "";
$newStatus_pengiriman = "";
$newStatus_penerimaan = "";

$id = "";
$id = $_GET['id'];
if (isset($_POST['update'])) {
    $newStatus_pembayaran = $_POST['stt_pembayaran'];
    $newStatus_pengiriman = $_POST['stt_pengiriman'];
    $newStatus_penerimaan = $_POST['stt_penerimaan'];
    /*if($newStatus_pembayaran == "none"){
        echo "<script>alert('Status Pembayaran Tidak Diubah, Update Gagal')</script>";
        header("Refresh: 0; url = ../akun/akun.php");
        return false;
    }*/
    $updateStatus_pembayaran = mysqli_query($koneksi, "UPDATE pesanan SET status_pembayaran='$newStatus_pembayaran' WHERE id_pesanan='$id'");
    $updateStatus_pengiriman = mysqli_query($koneksi, "UPDATE pesanan SET status_pengiriman='$newStatus_pengiriman' WHERE id_pesanan='$id'");
    $updateStatus_penerimaan = mysqli_query($koneksi, "UPDATE pesanan SET status_penerimaan='$newStatus_penerimaan' WHERE id_pesanan='$id'");
    //echo "<script>alert('Update Status Pesanan Berhasil')</script>";
    header("Refresh: 0; url = crud-pesanan.php");
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update-Pemesanan</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {

            font-family: 'Poppins', sans-serif;
        }
        body {
            background-image: url('../asset-img/background-3.png');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .mx-auto {
            margin-top: 70px;
            width: 95%;
            font-size: 15px;


        }

        .mx-auto h1 {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        select {
            width: 30%;
            height: 30px;
            font-size: 16px;
        }

        .button {
            margin-left: auto;
            margin-right: auto;
        }

        table .left {
            width: 25%;
            font-weight: bold;
        }

        .table .ctt {
            max-width: 150px;
        }

        .btn {
            width: 15%;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 5px;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 10px;
        }

        textarea {
            resize: none;
            width: 100%;
            font-size: 1em;
            font-weight: bold;
            padding-left: 4px;
            padding-right: 4px;
        }

        body {
            background-color: aliceblue;
        }

        .navb {
            background-color: seagreen;
            position: fixed;
            height: 60px;
            width: 100%;
            z-index: 2000;
            margin-top: -70px;


        }

        .navb .logo {
            width: 150px;
            cursor: pointer;
            padding-left: 50px;
            padding-top: 14px;

        }


        .navb ul {
            float: right;
            margin-right: 30px;
            padding-top: 17px;
            padding-bottom: 17px;
            z-index: 2000;

        }

        .navb li {
            margin-right: 5px;

        }

        .navb ul li {
            display: inline-block;

            /*margin: 0 5px;*/
        }

        .navb ul li a {
            color: white;
            font-size: 15px;
            border-radius: 25px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-right: 12px;
            padding-left: 12px;
            text-transform: uppercase;
            text-decoration: none;
        }

        .navb li a:hover {
            background-color: aliceblue;
            color: seagreen;


            transition: 0.3s;
        }

        .checkbtn {
            font-size: 30px;
            color: white;
            float: right;
            line-height: 62px;
            margin-right: 40px;

            cursor: pointer;
            display: none;
        }

        #check {
            display: none;
        }

        .table .act {
            width: 5%;
        }

        .table .ctt {
            max-width: 150px;
        }

        .option {
            width: 300px;
        }
        .card-header {
            text-align: center;
        }
        @media (max-width: 952px) {
            .mx-auto {
                width: 95%;
            }

            .navb .logo {
                width: 100px;
                padding-left: 50px;
                padding-top: 16px;
            }

            .navb ul li a {
                font-size: 16px;
            }

            .navb .logo {
                width: 150px;
            }

            .btn {
                width: 150px;
            }

            .option {
                width: 200px;
            }

        }

        @media (max-width: 858px) {
            .checkbtn {
                display: block;
            }

            ul {
                position: fixed;
                width: 100%;
                height: 100vh;
                background-color: rgb(28, 41, 33);
                top: 60px;
                left: -100%;
                text-align: center;
                transition: all .5s;
            }

            .navb {
                position: fixed;
            }

            .navb ul li {
                display: block;
                margin: 50px 0;
                line-height: 30px;
            }

            .navb ul li a {
                font-size: 20px;
            }

            #check:checked~ul {
                left: 0;
            }

        }
    </style>
</head>

<body>
    <div class="navb">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="../asset-img/logo-4BEFORE.png" class="logo">
        <ul>
            <li><a href="crud-pesanan.php">pemesanan</a></li>
            <li><a href="crud-agen.php">agen</a></li>
            <li><a href="crud-produk.php">produk</a></li>

            <li><a href="../logout/logout.php" onclick="return confirm('Keluar dari Menu CRUD')"><i class="fa fa-fw fa-user"></i> logout</a></li>

        </ul>
    </div>
    <div class="mx-auto">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <h1 class="card-header text-white bg-success"><b>DATA STATUS PEMESANAN <?php echo $id; ?></b></h1>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <?php
                            $sql = "SELECT id_pesanan, tgl_pesanan, pembayaran, catatan, status_pembayaran, status_pengiriman, status_penerimaan, id_produk, email FROM pesanan WHERE id_pesanan = '$id' "; //"SELECT*FROM pesanan ORDER BY id_pesanan DESC";
                            $result = mysqli_query($koneksi, $sql);
                            $urutan = 1;
                            $row = mysqli_fetch_array($result);
                            $id_pesanan = $row['id_pesanan'];
                            $tgl_pesanan = $row['tgl_pesanan'];
                            $pembayaran = $row['pembayaran'];
                            $catatan = $row['catatan'];
                            $status_pembayaran = $row['status_pembayaran'];
                            $status_pengiriman = $row['status_pengiriman'];
                            $status_penerimaan = $row['status_penerimaan'];
                            $email_agen = $row['email'];
                            $id_produk = $row['id_produk'];

                            $namaBarang = "SELECT*FROM produk WHERE id_produk = '$id_produk'";
                            $sql2 = mysqli_query($koneksi, $namaBarang);
                            $row2 = mysqli_fetch_row($sql2);
                            $getNamaBarang = $row2[1];

                            ?>

                    </table>
                    <table class="table">
                        <form action='' method='post' id='update'>
                            <tr>
                                <td class="left">ID Pesanan</td>
                                <td><?php echo $id_pesanan ?></td>
                            </tr>
                            <tr>
                                <td class="left">Tanggal Pemesanan</td>
                                <td><?php echo $tgl_pesanan ?></td>
                            </tr>
                            <tr>
                                <td class="left">Metode Pembayaran</td>
                                <td><?php echo $pembayaran ?></td>
                            </tr>
                            <tr>
                                <td class="left">Catatan Agen</td>
                                <td><?php echo $catatan ?></td>
                            </tr>
                            <tr>
                                <td class="left">Email Agen</td>
                                <td><?php echo $email_agen ?></td>
                            </tr>
                            <tr>
                                <td class="left">ID Produk</td>
                                <td><?php echo $id_produk ?> [ <?php echo $getNamaBarang?> ]</td>
                            </tr>

                            <tr>
                                <td class="left">Status Pembayaran</td>
                                <td>
                                    <select class='option' name="stt_pembayaran" id="stt_pembayaran">
                                        <option value="<?php echo $status_pembayaran ?>" <?php if ($newStatus_pembayaran == $status_pembayaran) echo "selected" ?>><?php echo $status_pembayaran ?></option>
                                        <option value="Belum dibayar" <?php if ($newStatus_pembayaran == "Belum dibayar") echo "selected" ?>>Belum dibayar</option>
                                        <option value="Sudah dibayar" <?php if ($newStatus_pembayaran == "Sudah dibayar") echo "selected" ?>>Sudah dibayar</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Status Pengiriman</td>
                                <td>
                                    <select class='option' name="stt_pengiriman" id="stt_pengiriman">
                                        <option value="<?php echo $status_pengiriman ?>" <?php if ($newStatus_pengiriman == $status_pengiriman) echo "selected" ?>><?php echo $status_pengiriman ?></option>
                                        <option value="Menunggu pembayaran" <?php if ($newStatus_pengiriman == "Menunggu pembayaran") echo "selected" ?>>Menunggu pembayaran</option>
                                        <option value="Pengiriman ditunda" <?php if ($newStatus_pengiriman == "Pengiriman ditunda") echo "selected" ?>>Pengiriman ditunda</option>
                                        <option value="Mempersiapkan Pengiriman" <?php if ($newStatus_pengiriman == "Mempersiapkan Pengiriman") echo "selected" ?>>Mempersiapkan Pengiriman</option>
                                        <option value="Mengirimkan ke alamat tujuan" <?php if ($newStatus_pengiriman == "Mengirimkan ke alamat tujuan") echo "selected" ?>>Mengirimkan ke alamat tujuan</option>
                                        <option value="Pesanan telah sampai" <?php if ($newStatus_pengiriman == "Pesanan telah sampai") echo "selected" ?>>Pesanan telah sampai</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">Status Penerimaan</td>
                                <td>
                                    <select class='option' name="stt_penerimaan" id="stt_penerimaan">
                                        <option value="<?php echo $status_penerimaan ?>" <?php if ($newStatus_penerimaan == $status_penerimaan) echo "selected" ?>><?php echo $status_penerimaan ?></option>
                                        <option value="Belum diterima" <?php if ($newStatus_penerimaan == "Belum diterima") echo "selected" ?>>Belum diterima</option>
                                        <option value="Telah diterima" <?php if ($newStatus_penerimaan == "Telah diterima") echo "selected" ?>>Telah diterima</option>


                                    </select>
                                </td>
                            </tr>
                        </form>

                    </table>
                    <div class=" text-center">
                        <a href='crud-admin.php?op=edit&id=$id_pesanan' onclick="return confirm('Update Status Pesanan ?')"><button type='submit' form='update' name='update' class='btn btn-success'>Update</button></a>
                        <a href='crud-pesanan.php'><button type='submit' class='btn btn-secondary'>Kembali</button></a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>