<?php 

require '../../database.php';

require '../helpers/menu.php';



    $consultaSQL = "SELECT libros.id, categorias.nombre, autor, titulo, nomar, sinopsis, numpa, libros.imagen as imgl, premiun, idiomas, edicion, fechala, libros.estado
    FROM libros
    INNER JOIN categorias ON categorias.id = libros.idcategoria
    WHERE libros.estado = 1";
    $sentencia = $conn->prepare($consultaSQL);
    $sentencia->execute();

    $libros = $sentencia->fetchAll();

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

<style>
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
        <h1>Libros</h1>
    </center><br>

<div class="container">
  <div class="row">
    <form class="col s12">
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
          <a href="crear_li.php" class="waves-effect deep-purple accent-4 btn"><i class="material-icons left">add</i>Agregar libro</a>
        </div>
      </div>
      
    </form>
  </div>
</div>


<div class="container">

        <table>
            <thead>
              <tr>
                  <th>Titulo</th>
                  <th>Autor</th>
                  <th>Edicion</th>
                  <th>Categoria</th>
                  <th>Premiun</th>
                  <th>Acciones</th>
              </tr>
            </thead>
    
            <tbody>
            
            
            <?php

                if(isset($_GET['enviar'])){
                    $buscar = $_GET['buscador'];    

                    $consultaSQL = "SELECT libros.id, categorias.nombre, autor, titulo, nomar, sinopsis, numpa, libros.imagen as imgl, premiun, idiomas, edicion, fechala, libros.estado
                    FROM libros
                    INNER JOIN categorias ON categorias.id = libros.idcategoria WHERE titulo LIKE '%$buscar%' and libros.estado = 1";
                    $sentencia = $conn->prepare($consultaSQL);
                    $sentencia->execute();

                    $libros = $sentencia->fetchAll();

                }

                if ($libros && $sentencia->rowCount() > 0) {
                    foreach ($libros as $fila) {    
                ?>


              <tr>
                <td><?php echo ($fila["titulo"]); ?></td>
                <td><?php echo ($fila["autor"]); ?></td>
                <td><?php echo ($fila["edicion"]); ?></td>
                <td><?php echo ($fila["nombre"]); ?></td>
                <td><?php if($fila["premiun"] == 1){
                    echo ("Si");
                    }
                    else{
                        echo ("No");
                    }

                  ?></td>
                <td>
                <a href="masin.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Ver libro"><i class="material-icons" style="color:black;  padding: 5% 1% 5% 7%;">remove_red_eye</i></a>
                    <a href="edi_li.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Editar"><i class="material-icons" style="color:blue;  padding: 5% 1% 5% 7%;">edit</i></a>
                    <a href="eli_li.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Eliminar"><i class="material-icons" style="color:red;  padding: 5% 1% 5% 7%;">delete</i></a>

                </td>
              </tr>
            </tbody>


            <?php
                    }
                } else{
                    print('No se han ingresado datos aun');
                }
            ?>



          </table>
    </div><br><br>

    <script>
      $('.tooltipped').tooltip({delay: 50})

    </script>


<?php else: 
        header('Location: /biblioteca/php/privado/login.php');
        ?>

    <?php endif; ?>




</body>
</html>