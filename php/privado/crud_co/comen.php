<?php 
require '../../database.php';
require '../helpers/menu.php';


    $consultaSQL = "SELECT comentarios.id, clientes.username, libros.titulo, comentarios.comen, comentarios.fecha 
    FROM comentarios
    INNER JOIN clientes on clientes.id = comentarios.idcliente 
    INNER JOIN libros ON libros.id = comentarios.idlibro
    ORDER BY comentarios.id ASC";
    $sentencia = $conn->prepare($consultaSQL);
    $sentencia->execute();

    $come = $sentencia->fetchAll();
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



<?php if(isset($_SESSION['user_id']) && $_SESSION['lopri'] == 1): ?>

    <center>
        <h1>Comentarios</h1>
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

        </div>
  </div>
</div>


    <div class="container">

        <table>
            <thead>
              <tr>
                  <th>Cliente</th>
                  <th>Libro</th>
                  <th>Comentario</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
              </tr>
            </thead>
    
            <tbody>

            <?php

                    if(isset($_GET['enviar'])){
                        $buscar = $_GET['buscador'];    

                        $consultaSQL = "SELECT comentarios.id, clientes.username, libros.titulo, comentarios.comen, comentarios.fecha 
                        FROM comentarios
                        INNER JOIN clientes on clientes.id = comentarios.idcliente 
                        INNER JOIN libros ON libros.id = comentarios.idlibro WHERE comentarios.comen LIKE '%$buscar%'";
                        $sentencia = $conn->prepare($consultaSQL);
                        $sentencia->execute();

                        $come = $sentencia->fetchAll();

                    }

                    if ($come && $sentencia->rowCount() > 0) {
                        foreach ($come as $fila) {
                ?>

              <tr>
                <td><?php echo ($fila["username"]); ?></td>
                <td><?php echo ($fila["titulo"]); ?></td>
                <td><?php echo ($fila["comen"]); ?></td>
                <td><?php echo ($fila["fecha"]); ?></td>

                <td>
                    <a href="eli_com.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Eliminar"><i class="material-icons" style="color:red;  padding: 5% 7% 5% 7%;">delete</i></a>

                </td>

                <?php
                        }
                    } else{
                    print('No se han ingresado comentarios aun');
                    }
                ?>

              </tr>

              

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
