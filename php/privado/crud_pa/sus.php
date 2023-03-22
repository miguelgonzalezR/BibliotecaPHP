<?php

require '../../database.php';
require '../helpers/menu.php';

  $link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $sus = $conn->prepare('SELECT costo FROM suscripcion WHERE id = 1');
    $sus->execute();
    $susc = $sus->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['btnes'])){
        $eds = $conn->prepare('UPDATE suscripcion set costo = :costo where id = 1');
        $eds->bindParam(':costo', $_POST['costo']);
        $resultado = $eds->execute();
        if($resultado === TRUE){
            header($link);
            $sus = $conn->prepare('SELECT costo FROM suscripcion WHERE id = 1');
            $sus->execute();
            $susc = $sus->fetch(PDO::FETCH_ASSOC);
            $message = "Cambios guardados";
        } else $message =  "Algo salio mal.";
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

            <center>
                <h1>Editar costo de la suscripcion</h1>
            </center>



            <div class="container">
            <div class="row">
            <form class="col s12" method="post" enctype="multipart/form-data" >
              
              <div class="row">
                <div class="input-field col s10">
                    <label>Cotos de la suscripcion:</label>
					<input type="number" name="costo" id="costo" class='form-control' maxlength="100" required value="<?php echo $susc['costo'] ?>" >
                  </div>
              </div>
    



              <div class="row">
                <div class="input-field col s10">
                    <button type="submit" name="btnes" class="btn btn-success deep-purple accent-4deep-purple accent-4" name="subir">Guardar datos</button>
                    <a href="pagos.php" class="waves-effect deep-purple accent-4 btn right">regresar</a>
                
                </div>
              </div>
              </div>    
            </form>
            
          </div>
            </div>
            



</body>
</html>