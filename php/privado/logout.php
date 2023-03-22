<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /biblioteca/php/privado/login.php');
?>
