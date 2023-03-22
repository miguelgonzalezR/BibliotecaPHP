<?php
  require '../../database.php';
  require '../helpers/menu.php';

  $message = '';

  if (isset($_SESSION['user_id'])) { 
    if (!empty($_POST['nombre']) && !empty($_POST['desc'])) {

        if (isset($_POST['subir'])){

            $exis = $conn->prepare('SELECT * FROM categorias WHERE 	nombre = :nombre');
            $exis->bindParam(':nombre', $_POST['nombre']);
            $exis->execute();
            $exi = $exis->fetch(PDO::FETCH_ASSOC);

            $nombrei = $_FILES['imgl']['name'];
            $rutai = $_FILES['imgl']['tmp_name'];
            $destinoi = "../../../libros/categorias/" . $nombrei;

            if (is_array($exi) ==  0 ){

                if(($_FILES['imgl']['type'] == "image/jpg") || ($_FILES['imgl']['type'] == "image/png") || ($_FILES['imgl']['type'] == "image/jpeg") ){
                    $sql = "INSERT INTO categorias (nombre, descrip, imagen,estado) VALUES (:nombre, :desc, :img,1)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':nombre', $_POST['nombre']);
                    $stmt->bindParam(':desc', $_POST['desc']);
                    $stmt->bindParam(':img', $nombrei);

                    if(copy($rutai, $destinoi)){

                        if ($stmt->execute()) {


                            if (copy($rutai, $destinoi)){
                                $message = 'Categoria creado con exito';
                            } else {
                                $message = 'Error';
                            }

                        } else {
                            $message = 'error al crear al categoria';
                        }
                    } else {
                        $message = "Error al subir la imagen";
                    }
    
                    



                } else{
                    $message = "La imagen tiene que ser en formato PNG o JPG";
                }

            

            } else{
                $message = 'Ya existe una categoria con este nombre';
            }

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

<?php if(isset($_SESSION['user_id']) && $_SESSION['lopri'] == 1): ?>


    <div class="container">    
        <h1>Agregar categoria</h1>

        <br>

            

        

        

        <?php if(!empty($message)): ?>

            <div class="container men">

                <?php

                    if($message == "Categoria creado con exito"){



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
                    <input name="nombre" id="nombres" type="text" class="validate" require>
                    <label for="password">Nombre</label>
                  </div>
              </div>
    
              <div class="row">
                <div class="input-field col s10">
                    <textarea name="desc" id="direccion" class="materialize-textarea" require></textarea>
                    <label for="textarea1">Descripcion</label>
                </div>
              </div>
              


              <div class="row">
                <div class="input-field col s10">
                    <div class="file-field input-field">
                        <div class="black btn">
                          <span>Subir Imagen</span>
                          <input type="file" name="imgl" required>
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
    header('Location: /biblioteca/php/privado/login.php');
    ?>
<?php endif; ?>
    
</body>
</html>