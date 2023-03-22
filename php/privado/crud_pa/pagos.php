<?php 

require '../../database.php';
require '../helpers/menu.php';


    $consultaSQL = "SELECT pagos.id, pagos.monto, clientes.username, pagos.fecha
    FROM pagos
    INNER JOIN clientes on clientes.id = pagos.idcliente
    ORDER BY pagos.id ASC";
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
        <h1>pagos</h1>
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
            <a href="sus.php" class="btn btn-info add-new bus"> editar costo de la suscrupcion</a>
        </div>
      </div>
      
    </form>
  </div>
</div>


<div class="container">

        <table>
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Monto</th>
                <th>Cliente</th>
                <th>fecha</th>
              </tr>
            </thead>
    
            <tbody>
            
            
            <?php

                    if(isset($_GET['enviar'])){
                        $buscar = $_GET['buscador'];    

                        $consultaSQL = "SELECT pagos.id, pagos.monto, clientes.username, pagos.fecha
                        FROM pagos
                        INNER JOIN clientes on clientes.id = pagos.idcliente
                        WHERE clientes.username LIKE '%$buscar%'
                        ORDER BY pagos.id ASC ";
                        $sentencia = $conn->prepare($consultaSQL);
                        $sentencia->execute();

                        $come = $sentencia->fetchAll();

                    }

                    if ($come && $sentencia->rowCount() > 0) {
                        foreach ($come as $fila) {
                ?>

              <tr>
                <td><?php echo ($fila["id"]); ?></td>
                <td><?php echo ($fila["monto"]); ?> $</td>
                <td><?php echo ($fila["username"]); ?></td>
                <td><?php echo ($fila["fecha"]); ?></td>
              </tr>
              <?php
            }
          }

          else{
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