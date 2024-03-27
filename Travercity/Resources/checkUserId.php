<?php 
  session_start();
  if (!isset($_SESSION['id'])) {
    header("Location: " . $pathToRoot . "Account/Signin.php");
    die();
  }
?>