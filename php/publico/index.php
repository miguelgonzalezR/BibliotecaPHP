<?php
  session_start();

  require '../database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id,username, nombre, apellidos, correo, imagen,contra, tipo FROM clientes WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }




  $link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  /*
  if((time() - $_SESSION['time']) > 10){
    header('Location: /biblioteca/php/publico/logout.php');
  }
  */



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body>

    <?php if(isset($_SESSION['user_id'])): ?>
      <br> Bienvenido. <?= $user['correo']; ?>
      <br>You are Successfully Logged In
      <br> Nombre. <?= $_SESSION['user_name']; ?>
      <br> <img src="../../libros/clientes/<?php echo ($_SESSION["img"]);?>">
      <br>tipo. <?= $_SESSION['tipo']; ?><br>



      <p><?php echo $link; ?></p>

      <a href="logout.php">
        Logout
      </a>

      <br><br>

      <a href="edi_pre.php?id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-success add-new"><i class="fa fa-pencil-square-o"></i> Editar perfil</a>
      <a href="edi_con.php?id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-success add-new"><i class="fa fa-pencil-square-o"></i> Editar Contraseña</a>

    <?php else: 
        header('Location: /biblioteca/php/publico/login.php');
        ?>

    <?php endif; ?>


    

  </body>
  
</html>