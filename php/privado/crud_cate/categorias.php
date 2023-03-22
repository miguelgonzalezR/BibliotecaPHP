<?php 
require '../../database.php';
require '../helpers/menu.php';

if (isset($_SESSION['user_id'])) {
    
    $consultaSQL = "SELECT * FROM categorias where estado = 1";
    $sentencia = $conn->prepare($consultaSQL);
    $sentencia->execute();

    $categorias = $sentencia->fetchAll();
}

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
        <h1>Categorias</h1>
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
          <a href="crear_ca.php" class="waves-effect deep-purple accent-4 btn"><i class="material-icons left">add</i>Agregar categoria</a>
        </div>
  </div>
</div>


    <div class="container">

        <table>
            <thead>
              <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
              </tr>
            </thead>
    
            <tbody>

            <?php
                    if(isset($_GET['enviar'])){
                        $buscar = $_GET['buscador'];    

                        $consultaSQL = "SELECT * FROM categorias WHERE nombre LIKE '%$buscar%' and estado = 1";
                        $sentencia = $conn->prepare($consultaSQL);
                        $sentencia->execute();

                        $categorias = $sentencia->fetchAll();

                    }

                    if ($categorias && $sentencia->rowCount() > 0) {
                        foreach ($categorias as $fila) {
                ?>

              <tr>
                <td><?php echo ($fila["id"]); ?></td>
                <td><?php echo ($fila["nombre"]); ?></td>
                <td><?php echo ($fila["descrip"]); ?></td>
                <td><img src="../../../libros/categorias/<?php echo ($fila["imagen"]);?>" class="li"></td>

                <td>
                    <a href="editar_ca.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Editar"><i class="material-icons" style="color:blue;  padding: 5% 7% 5% 7%;">edit</i></a>
                    <a href="eli_cate.php?id=<?php echo $fila['id'];?>" class="tooltipped" data-tooltip="Eliminar"><i class="material-icons" style="color:red;  padding: 5% 7% 5% 7%;">delete</i></a>

                </td>

                <?php
                        }
                    } else{
                    print('No se han ingresado categorias aun');
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


