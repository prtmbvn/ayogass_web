<?php
session_start();

//--------Conector-To-Database---------
require "../connector/koneksi.php";
//-------------------------------------

$email = "";
$password = "";
$admin = "administaror";
if (isset($_POST['masuk'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql3 = "select *from admin where email = '$email' and password = '$password'";
    $result = mysqli_query($koneksi, $sql3);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);
    if($count == 1){  
      $_SESSION['admin'] = true;
      header("Refresh: 0; url = crud-pesanan.php");
      
        
    }  
    else{  
        echo "<h1> Login failed. Invalid username or password.</h1>";  
    }     
}



?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title>Login and Registration Ayo Gass</title>
   <link rel="stylesheet" href="../log-css/style.css?v=<?php echo time(); ?>">
   <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
   <div class="wrapper">
      <img class="logo" src="../asset-img/logo.png">

      <div class="title-text">
         <div class="title login">
            Login
         </div>
         <div class="title signup">
            ------------
         </div>
      </div>
      <div class="form-container">

         <div style="text-align: center;">
            
         </div>
         <div class="form-inner">
            <form action="" method="post" class="login">
               <div class="field">
                  <input type="text" placeholder="Username" required name="email" value="<?php echo $email ?>">
               </div>
               <div class="field">
                  <input type="password" placeholder="Password" required name="password" value="<?php echo $password ?>">
               </div>
               <div class="field btn">
                  <div class="btn-layer"></div>
                  <input type="submit" value="masuk" name="masuk">
               </div>
               <div class="pass-link" style="text-align: center;">
                  <br>
                  Bukan Admin? <a href="../Login.php">Silahkan Kembali</a>
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