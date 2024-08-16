<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:../crud-admin/admin.php");
    exit;
}

//--------Conector-To-Database---------
require "../connector/koneksi.php";
//-------------------------------------

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$getEmail = $_GET['email'];
$newNama = "";
$newJenis_kelamin = "";
$newNoTelepon = "";
$newAlamat = "";
if (isset($_POST['update'])) {
    //$newEmail = $_POST['email'];
    $newNama = $_POST['nama'];
    $newJenis_kelamin = $_POST['kelamin'];
    $newNoTelepon = $_POST['noTelepon'];
    $newAlamat = $_POST['alamat'];

    /*$newEmail = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email tidak sesuai')</script>";
        header("Refresh: 0; url = ../akun/akun.php");
        return false;
    }*/

    $newNama = test_input($_POST["nama"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $newNama)) {
        echo "<script>alert('Gagal Update! Nama harus menggunakan huruf dan spasi')</script>";
        header("Refresh: 0; url = crud-agen.php");
        return false;
    } else {
        $updateNama = mysqli_query($koneksi, "UPDATE akun SET nama='$newNama' WHERE email='$getEmail'");
    }
    $updateKelamin = mysqli_query($koneksi, "UPDATE akun SET kelamin='$newJenis_kelamin' WHERE email='$getEmail'");
    $updateAlamat = mysqli_query($koneksi, "UPDATE akun SET alamat='$newAlamat' WHERE email='$getEmail'");
    $updateNoTelepon = mysqli_query($koneksi, "UPDATE akun SET noTelepon='$newNoTelepon' WHERE email='$getEmail'");
    header("Refresh: 0; url = crud-agen.php");
}

$sql = "SELECT*FROM akun WHERE email = '$getEmail'"; //"SELECT*FROM pesanan ORDER BY id_pesanan DESC";
$result = mysqli_query($koneksi, $sql);
$urutan = 1;
$row = mysqli_fetch_array($result);
$emailView = $row[0];
$namaView = $row[1];
$jenis_kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];
$password = $row[5];





?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update-Agent</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        * {
           
            font-family: 'Poppins', sans-serif;
        }

        .mx-auto {
            margin-top: 70px;
            width: 95%;
            font-size: 13px;


        }

        .mx-auto h1 {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        textarea {
            resize: none;
            width: 100%;
            font-size: 1em;
            font-weight: bold;
            padding-left: 4px;
            padding-right: 4px;
        }

        thead {
            font-weight: bold;
        }

        .table .act {
            text-align: center;
            width: 10%;
        }

        .table .ctt {
            max-width: 150px;
        }
        .table .alamat{
            max-width: 1150%;
        }
        .btn {
            width: 100%;
            margin-bottom: 5px;
            font-size: 13px;
            font-weight: bold;
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
            .navb .logo{
                width: 150px;
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

            <li><a href="logout.php" onclick="return confirm('Keluar dari Menu CRUD')"><i class="fa fa-fw fa-user"></i> logout</a></li>

        </ul>
    </div>
    <div class="mx-auto">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <h1 class="card-header text-white bg-success"><b>DATA AGEN : <?php echo $namaView ?></b></h1>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Nomor Telepon</th>
                                <!--<th scope="col" class="ctt">Catatan</th>-->
                                <th scope="col" class="alamat">Alamat</th>
                                <th scope="col">Password</th>

                                <th scope="col" class="act">Action</th>
                            <tr>
                        <tbody>
                            <?php
                            /*$sql = "SELECT*FROM akun"; //"SELECT*FROM pesanan ORDER BY id_pesanan DESC";
                            $result = mysqli_query($koneksi, $sql);
                            $urutan = 1;
                            $row = mysqli_fetch_array($result);
                            $email = $row[0];
                            $nama = $row[1];
                            $jenis_kelamin = $row[2];
                            $no_telepon = $row[3];
                            $alamat = $row[4];
                            $password = $row[5];*/


                            ?>



                            <tr>
                                <form action="" method="post" id="update">
                                    <th scope='row'><?php echo $urutan++ ?></th>
                                    <th scope='row'><?php echo $emailView ?></th>
                                    <th scope='row'><textarea rows="2" placeholder="" form="update" name="nama" value="<?php echo $newNama ?>"><?php echo $namaView ?></textarea></th>
                                    <th scope='row'><textarea rows="2" placeholder="" form="update" name="kelamin" value="<?php echo $newJenis_kelamin ?>"><?php echo $jenis_kelaminView ?></textarea></th>


                                    <th scope='row'><textarea rows="2" placeholder="" form="update" name="noTelepon" value="<?php echo $newNoTelepon ?>"><?php echo $noTeleponView ?></textarea></th>
                                    <th scope='row' class="alamat"><textarea rows="2" placeholder="" form="update" name="alamat" value="<?php echo $newAlamat ?>"><?php echo $alamatView ?></textarea></th>
                                    <!--<th scope='row' type="password"><?php echo $password ?></th>-->
                                    <th scope='row' class='act'>
                                </form>
                                <a href='crud-admin.php?op=edit&id=$id_pesanan' onclick="return confirm('Update Informasi Agent ?')"><button type='submit' form='update' name='update' class='btn btn-success'>Update</button></a><br>

                                </th>

                            <tr>
                        </tbody>
                        <thead>
                    </table>
                    <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>
        </div>
    </div>
</body>

</html>