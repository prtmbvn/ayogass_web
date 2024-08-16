<?php
session_start();
if (isset($_SESSION['masuk'])) {
   header("location:home/home.php");
   exit;
}
//--------Conector-To-Database---------
require "connector/koneksi.php";
//-------------------------------------


//------------REGISTRASI---------------
$email = "";
$nama = "";
$kelamin = "";
$noTelepon = "";
$alamat = "";
$password = "";
$password2 = "";

$sukses = "";
$error = "";
//-----------------------------------------------------------
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";



function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
//-------------------------------------------------------------
if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $nama = $_POST['nama'];
   $kelamin = $_POST['kelamin'];
   $noTelepon = $_POST['noTelepon'];
   $alamat = $_POST['alamat'];
   $password = $_POST['password'];
   $password2 = $_POST['password2'];
   if ($email && $nama && $kelamin && $noTelepon && $alamat && $password) {

      $nama = test_input($_POST["nama"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
         echo "<script>alert('Nama harus menggunakan huruf dan spasi')</script>";
         header("Refresh: 0; url = Login.php");
         return false;
      }

      $email = test_input($_POST["email"]);

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         echo "<script>alert('Email tidak sesuai')</script>";
         header("Refresh: 0; url = Login.php");
         return false;
      }

      if ($password !== $password2) {
         echo "<script>alert('Konfirmasi Password Salah')</script>";
         header("Refresh: 0; url = Login.php");
         return false;
      }
      //$password = md5($password);
      $sql1 = "insert into akun(email, nama, kelamin, noTelepon, alamat, password) 
        values('$email','$nama','$kelamin','$noTelepon','$alamat','$password')";

      $duplikasi = mysqli_query($koneksi, "SELECT email FROM akun WHERE email = '$email'");
      if (mysqli_fetch_assoc($duplikasi)) {
         echo "<script>alert('Email Sudah Terdaftar!!!')</script>";
         header("Refresh: 0; url = Login.php");
         return false;
      }
      $q1 = mysqli_query($koneksi, $sql1);

      if ($q1) {
         echo "<script> alert('Registrasi Berhasil !!!')</script>";
         header("Refresh: 0; url = Login.php");
         //$sukses = "Berhasil memasukkan data baru";
      } else {
         $error = "gagal memasukkan data";
      }
   } else {
      $error = "Silahkan Memasukkan Data";
   }
}

//----------LOGIN--------------
$email = "";
$password = "";

if (isset($_POST['masuk'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];
   $_SESSION['email'] = $email;
   $_SESSION['password'] = $password;

   $sql2 = "select *from akun where email = '$email' and password = '$password'";
   $result = mysqli_query($koneksi, $sql2);
   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
   $count = mysqli_num_rows($result);

   if ($count == 1) {
      $_SESSION['masuk'] = true;

      header("location: loading/load-login.php");
   } else {
      echo "<script>alert('Email atau Password tidak sesuai')</script>";
      header("Refresh: 0; url = Login.php");
   }
}
//require "crud.php";
//require "log.php";
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title>Login and Registration Ayo Gass</title>
   <link rel="stylesheet" href="log-css/style.css?v=<?php echo time(); ?>">
   <link rel="icon" type="image/x-icon" href="asset-img/logo gas.png">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
   <div class="wrapper">
      <img class="logo" src="asset-img/logo gas.png">

      <div class="title-text">
         <div class="title login">
            Login
         </div>
         <div class="title signup">
            Registrasi
         </div>
      </div>
      <div class="form-container">
         <div class="slide-controls">
            <input type="radio" name="slide" id="login" checked>
            <input type="radio" name="slide" id="signup">
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Buat Akun</label>
            <div class="slider-tab"></div>

         </div>
         <div style="text-align: center;">
         </div>
         <div class="form-inner">
            <form action="" method="post" class="login">
               <div class="field">
                  <input type="text" placeholder="Email Address" required name="email" value="<?php echo $email ?>">
               </div>
               <div class="field">
                  <input type="password" placeholder="Password" required name="password" value="<?php echo $password ?>">
               </div>
               <div class="pass-link">
                  <!--<a href="#">Lupa password?</a>-->
               </div>
               <div class="field btn">
                  <div class="btn-layer"></div>
                  <input type="submit" value="masuk" name="masuk">
               </div>

               <div class="pass-link" style="text-align: center;">
                  <br>
                  Masuk sebagai <a href="crud-admin/admin.php">Administrator</a>
               </div>
            </form>
            <form action="" method="post" class="signup">
               <div class="field-signup">
                  <input type="text" placeholder="Email Address" required name="email" value="<?php echo $email ?>">
                  <span><?php echo $emailErr; ?></span>
               </div>
               <div class="field-signup">
                  <input type="text" placeholder="Nama lengkap" required name="nama" value="<?php echo $nama ?>">
                  <span><?php echo $nameErr; ?></span>
               </div>
               <div class="field-signup">
                  <select class="option" name="kelamin" id="stt_pembayaran" required>
                     <option value="">Pilih Jenis Kelamin</option>
                     <option class="opsi" value="Laki-laki" <?php if ($kelamin == "Laki-laki") echo "selected" ?>>Laki-laki</option>
                     <option class="opsi" value="Perempuan" <?php if ($kelamin == "Perempuan") echo "selected" ?>>Perempuan</option>
                  </select>
               </div>
               <!--<div class="container">
                  <div class="gender">
                     <table class="table">
                        <tr>
                           <td><input type="radio" name="kelamin" value="Laki-laki" required <?php if ($kelamin == "Laki-laki") echo "selected" ?>><span></span>
                           </td>
                           <td>&ensp;  Laki-laki</td>
                           

                        </tr>
                        <td class="left"> <input type="radio" name="kelamin" value="Perempuan" required <?php if ($kelamin == "Perempuan") echo "selected" ?>><span></span>
                           </td>
                           <td>&ensp;  Perempuan</td>
                        <tr>

                        </tr>
                     </table>


                     </label>
                  </div>
               </div>-->
               <div class="field-signup">
                  <input type="text" placeholder="Nomor Telepon" required name="noTelepon" <?php echo $noTelepon ?>>>
               </div>

               <div class="field-signup">
                  <input type="text" placeholder="Alamat" required name="alamat" <?php echo $alamat ?>>
               </div>
               <div class="field-signup">
                  <input type="password" placeholder="Password" required name="password" <?php echo $password ?>>
               </div>
               <div class="field-signup">
                  <input type="password" placeholder="Konfirmasi password" required name="password2" <?php echo $password2 ?>>
               </div>

               <div class="field btn">
                  <div class="btn-layer"></div>
                  <input type="submit" name="submit" value="Buat Akun">
               </div>
            </form>
         </div>
      </div>
   </div>
   <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (() => {
         loginForm.style.marginLeft = "-50%";
         loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (() => {
         loginForm.style.marginLeft = "0%";
         loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (() => {
         signupBtn.click();
         return false;
      });
   </script>
</body>

</html>