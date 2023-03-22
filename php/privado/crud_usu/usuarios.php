<?php 


require '../../database.php';
require '../helpers/menu.php';

    $consultaSQL = "SELECT * FROM usuarios";
    $sentencia = $conn->prepare($consultaSQL);
    $sentencia->execute();

    $usuarios = $sentencia->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<style type="text/css">
    img.li{width: 200px; height: 150px;}

    .bus{
        color:white;
        background-color:#6200ea;
        
    }
    .bus:hover{
        color:white;
        background-color:#6200ea;
    }

</style>


<?php if(isset($_SESSION['user_id']) && $_SESSION['lopri'] == 1 && $_SESSION['tipo'] == 1): ?>

    <center>
        <h1>Usuarios</h1>
    </center><br>

<div class="container">
  <div class="row">
    <form action="" method="get">

        <div class="input-field col s4">
          <i class="material-icons prefix">search</i>
          <input id="icon_prefix" type="text" class="validate" name="buscador">
        </div>

        <div class="input-field col s4">
          <input class="btn bus" type="submit" name="enviar" value="buscar">
        </div>

    </form>
    <div class="input-field col s4">
          <a href="crear_usu.php" class="waves-effect deep-purple accent-4 btn"><i class="material-icons left">add</i>Agregar usurios</a>
        </div>
  </div>
</div>


    <div class="container">

        <table>
            <thead>
              <tr>
                  <th>Usuario</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Correo</th>
                  <th>Tipo</th>
                  <th>Acciones</th>
              </tr>
            </thead>
    
            <tbody>

                <?php

                    if(isset($_GET['enviar'])){
                        $buscar = $_GET['buscador'];    

                        $consultaSQL = "SELECT * FROM usuarios WHERE username LIKE '%$buscar%'";
                        $sentencia = $conn->prepare($consultaSQL);
                        $sentencia->execute();

                        $usuarios = $sentencia->fetchAll();

                    }

                    if ($usuarios && $sentencia->rowCount() > 0) {
                        foreach ($usuarios as $fila) {
                ?>

              <tr>
                <td><?php echo ($fila["username"]); ?></td>
                <td><?php echo ($fila["nombre"]); ?></td>
                <td><?php echo ($fila["apellidos"]); ?></td>
                <td><?php echo ($fila["correo"]); ?></td>
                <td><?php if($fila["tipo"] == 1){
                    echo ("Administrador");
                    }
                    else{
                        echo ("Empleado");
                    }

                  ?>
                </td>
                <td>

                    <?php if ($fila["ban"] == 0): ?>
                        <a href="ban.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Bloquear"><i class="material-icons" style="color:#d50000;  padding: 5% 7% 5% 7%;">lock</i></a>
                    <?php else: ?>
                        <a href="ban.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Desbloquear"><i class="material-icons" style="color:#1b5e20;  padding: 5% 7% 5% 7%;">lock_open</i></a>
                    <?php endif; ?>

                    <a href="act_usu.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Editar"><i class="material-icons" style="color:blue;  padding: 5% 7% 5% 7%;">edit</i></a>
                    <a href="eli_usu.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Eliminar"><i class="material-icons" style="color:red;  padding: 5% 7% 5% 7%;">delete</i></a>


                </td>    
        


                    
              </tr>
              <?php
            }
          }

          else{
              print('No se han ingresado datos aun');
          }
          ?>
              

            </tbody>
          </table>
    </div>



    <script>
      $('.tooltipped').tooltip({delay: 50})

    </script>



<?php else: 
    header('Location: /biblioteca/php/privado/login.php');
    ?>
<?php endif; ?> 

</body>
</html>