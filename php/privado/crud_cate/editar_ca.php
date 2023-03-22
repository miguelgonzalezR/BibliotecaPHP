<?php

  require '../../database.php';
  require '../helpers/menu.php';
  

  $id = $_GET['id'];

  $message = "";

  
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id,nombre, descrip, imagen FROM categorias WHERE id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (!empty($_POST['nombre']) && !empty($_POST['desc']) ){
        $exis = $conn->prepare('SELECT * FROM categorias WHERE nombre = :nombre');
        $exis->bindParam(':nombre', $_POST['nombre']);
        $exis->execute();
        $exi = $exis->fetch(PDO::FETCH_ASSOC);

        $nombrei = $_FILES['imgl']['name'];
        $rutai = $_FILES['imgl']['tmp_name'];
        $destinoi = "../../../libros/categorias/" . $nombrei;

        if (is_array($exi) <=  1){

            if(  $exi == 0 ){

                if (!empty($_POST['nombre']) && !empty($_POST['desc'])) {
                    if($_FILES['imgl']['name'] == null){

                        $sentencia = $conn->prepare('UPDATE categorias set nombre = :nombre, descrip = :desc where id = :id');
                        $sentencia->bindParam(':id', $id);
                        $sentencia->bindParam(':nombre', $_POST['nombre']);
                        $sentencia->bindParam(':desc', $_POST['desc']);
                        $resultado = $sentencia->execute();
                        if($resultado === TRUE) $message = "Cambios guardados";
                        else $message =  "Algo salio mal.";

                    } else{
                        if(($_FILES['imgl']['type'] == "image/jpg") || ($_FILES['imgl']['type'] == "image/png") || ($_FILES['imgl']['type'] == "image/jpeg") ){

                            $sentencia = $conn->prepare('UPDATE categorias set nombre = :nombre, descrip = :desc, imagen = :img where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':desc', $_POST['desc']);
                            $sentencia->bindParam(':img', $nombrei);
                            $resultado = $sentencia->execute();
                            if(copy($rutai, $destinoi)){

                                if ($resultado === TRUE) {
        
        
                                    if (copy($rutai, $destinoi)){
                                        $message = 'Cambios guardados';
                                    } else {
                                        $message = 'Error';
                                    }
        
                                } else {
                                    $message = 'Algo salio mal.';
                                }
                            } else {
                                $message = "Error al subir la imagen";
                            }
                        }
                    }


                    
                }
                
            
                if($message != ''){
                    $records = $conn->prepare('SELECT id,nombre, descrip FROM categorias WHERE id = :id');
                    $records->bindParam(':id', $id);
                    $records->execute();
                    $results = $records->fetch(PDO::FETCH_ASSOC);
            
                }

            } elseif ($results['id'] == $exi['id']){

                if (!empty($_POST['nombre']) && !empty($_POST['desc'])) {
                    if($_FILES['imgl']['name'] == null){

                        $sentencia = $conn->prepare('UPDATE categorias set nombre = :nombre, descrip = :desc where id = :id');
                        $sentencia->bindParam(':id', $id);
                        $sentencia->bindParam(':nombre', $_POST['nombre']);
                        $sentencia->bindParam(':desc', $_POST['desc']);
                        $resultado = $sentencia->execute();
                        if($resultado === TRUE) $message = "Cambios guardados";
                        else $message =  "Algo salio mal.";
                    } else{
                        if(($_FILES['imgl']['type'] == "image/jpg") || ($_FILES['imgl']['type'] == "image/png") || ($_FILES['imgl']['type'] == "image/jpeg") ){

                            $sentencia = $conn->prepare('UPDATE categorias set nombre = :nombre, descrip = :desc, imagen = :img where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':desc', $_POST['desc']);
                            $sentencia->bindParam(':img', $nombrei);
                            $resultado = $sentencia->execute();

                            if(copy($rutai, $destinoi)){

                                if ($resultado === TRUE) {
        
        
                                    if (copy($rutai, $destinoi)){
                                        $message = 'Cambios guardados';
                                    } else {
                                        $message = 'Error';
                                    }
        
                                } else {
                                    $message = 'Algo salio mal.';
                                }
                            } else {
                                $message = "Error al subir la imagen";
                            }
                        }
                    }
                    
                }
            
        
                if($message != ''){
                    $records = $conn->prepare('SELECT id,nombre, descrip FROM categorias WHERE id = :id');
                    $records->bindParam(':id', $id);
                    $records->execute();
                    $results = $records->fetch(PDO::FETCH_ASSOC);
        
                }

            }else{
                $message = "Ya existe una categoria con este nombre";
            }

        } else{
            $message = "Ya existe una categoria con este nombre";
        }
    
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
</head>
<body>

<?php if(isset($_SESSION['user_id'])): ?>
    <?php if(is_array($results) > 0): ?>

    <div class="container">    
        <h1>Editar categoria</h1>

        <br>

            

        

        

        <?php if(!empty($message)): ?>

            <div class="container men">

                <?php

                    if($message == "Cambios guardados"){



                ?>

                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?= $message ?>
                </div>

                <?php
                    } else{

                ?>

                <div class="alerte">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?= $message ?>
                </div>

                <?php } ?>



                
            </div>

        <?php endif; ?>

        <div class="row">
            <form class="col s12" method="post" enctype="multipart/form-data" >
              
              <div class="row">
                <div class="input-field col s10">
                    <input name="nombre" id="nombres" type="text" class="validate" value="<?php echo $results['nombre'] ?>" require>
                    <label for="password">Titulo</label>
                  </div>
              </div>
    
              <div class="row">
                <div class="input-field col s10">
                    <textarea name="desc" id="direccion" class="materialize-textarea" require><?php echo $results['descrip'] ?></textarea>
                    <label for="textarea1">Descripcion</label>
                </div>
              </div>
              


              <div class="row">
                <div class="input-field col s10">
                    <div class="file-field input-field">
                        <div class="black btn">
                          <span>Subir Imagen</span>
                          <input type="file" name="imgl" >
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text">
                        </div>
                      </div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                    <button type="submit" class="btn btn-success deep-purple accent-4deep-purple accent-4" name="subir">Guardar datos</button>
                    <a href="categorias.php" class="waves-effect deep-purple accent-4 btn right">regresar</a>
                
                </div>
              </div>
              </div>    
            </form>
            
          </div>
                


    <script>
// Get all elements with class="closebtn"
var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
  // When someone clicks on a close button
  close[i].onclick = function(){

    // Get the parent of <span class="closebtn"> (<div class="alert">)
    var div = this.parentElement;

    // Set the opacity of div to 0 (transparent)
    div.style.opacity = "0";

    // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>

<?php else: 
?>

<h1>No ay ningun categoria con estos parametros :(</h1>

<?php endif; ?>

<?php else: 
    header('Location: /biblioteca/php/privado/login.php');
    ?>
<?php endif; ?>
    
</body>
</html>