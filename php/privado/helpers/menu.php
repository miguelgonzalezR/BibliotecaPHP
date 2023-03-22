<?php

session_start();
  
require '../../database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id,username, nombre, apellidos, correo, contra, tipo FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../helpers/css/libros.css">

</head>
<body>

<?php if(!empty($user)): ?>

    <header>
        <nav class="black">
            <div class="nav-wrapper">
              <a href="#" class="brand-logo left logo" style="margin-left: 2%;"><img src="../helpers/logo.png" alt=""></a>
              <ul id="nav-mobile" class="left hide-on-med-and-down op1">
                <li><a  href="../index/index.php">Inicio</a></li>
                <li><a href="../crud_cate/categorias.php">Categorías</a></li>
                <li><a href="../crud_li/libros.php">Libros</a></li>
                <li><a href="../crud_co/comen.php">Comentarios</a></li>
                <li><a href="../crud_usu/usuarios.php">Usuarios</a></li>
                <li><a href="../crud_cli/clientes.php">Clientes</a></li>
                <li><a href="../crud_pa/pagos.php">Suscripciones</a></li>

                <!-- <li><a href="badges.html">Cerrar sesion</a></li> -->

              </ul>

              <ul class="icon">
                <li><a href="../crud_usu/edi_usu.php?id=<?php echo $_SESSION['user_id']; ?>" class="tooltipped" data-tooltip="Editar perfil"><i class="material-icons" style="color:steelblue;">account_circle</i></a></li>
                <li><a href="../logout.php"  class="tooltipped" data-tooltip="Cerrar sesión"><i class="material-icons" style="color:steelblue;" style="color:blueviolet;">exit_to_app</i></a></li>
              </ul>

            </div>
          </nav>
    </header>




<?php else: 
    header('Location: /biblioteca/php/privado/login.php');
?>

<?php endif; ?>


<script>
      $('.tooltipped').tooltip({delay: 50})

    </script>





</body>
</html>