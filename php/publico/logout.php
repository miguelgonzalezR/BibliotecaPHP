<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /biblioteca/php/publico/login.php');
?>
