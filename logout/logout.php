<?php 
 session_start();
 session_unset();
 session_destroy();
 header("location:../load-opening.php");
 exit;
 ?>
