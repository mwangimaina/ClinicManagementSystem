<?php
  session_start();
  session_unset($_SESSION['username']);
  session_destroy(); //all sessions
  header("location:login.php");
?>