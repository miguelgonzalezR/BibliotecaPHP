<?php

  require '../../database.php';
  require '../helpers/menu.php';

  $id = $_GET['id'];

  $message = "";

  
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['tipo'])){
        $ti = 1;
    } else{
        $ti = 0;
    }


    if (!empty($_POST['user']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) ) {
        
        $exis = $conn->prepare('SELECT * FROM usuarios WHERE username = :user');
        $exis->bindParam(':user', $_POST['user']);
        $exis->execute();
        $exi = $exis->fetch(PDO::FETCH_ASSOC);

        if (is_array($exi) <=  1){

            if( $exi == 0){

                $cor = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo');
                $cor->bindParam(':correo', $_POST['correo']);
                $cor->execute();
                $co = $cor->fetch(PDO::FETCH_ASSOC);

                if (is_array($co) <=  1 ){

                    if($co == 0){
                        $sentencia = $conn->prepare('UPDATE usuarios set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, tipo = :tip where id = :id');
                        $sentencia->bindParam(':id', $id);
                        $sentencia->bindParam(':user', $_POST['user']);
                        $sentencia->bindParam(':nombre', $_POST['nombre']);
                        $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                        $sentencia->bindParam(':emal', $_POST['correo']);
                        $sentencia->bindParam(':tip', $ti);
                        $resultado = $sentencia->execute();
                        if($resultado === TRUE) $message = "Cambios guardados";
                        else $message =  "Algo salio mal.";

                    } elseif($results['id'] == $co['id']){
                        $sentencia = $conn->prepare('UPDATE usuarios set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, tipo = :tip where id = :id');
                        $sentencia->bindParam(':id', $id);
                        $sentencia->bindParam(':user', $_POST['user']);
                        $sentencia->bindParam(':nombre', $_POST['nombre']);
                        $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                        $sentencia->bindParam(':emal', $_POST['correo']);
                        $sentencia->bindParam(':tip', $ti);
                        $resultado = $sentencia->execute();
                        if($resultado === TRUE) $message = "Cambios guardados";
                        else $message =  "Algo salio mal.";

                    }else{
                        $message = "Ya existe una cuente con este correo";
                    }
                    
                    
                
                } else {
                    $message = "Ya existe una cuente con este correo";
                }




            } elseif($results['id'] == $exi['id']){
                $cor = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo');
                $cor->bindParam(':correo', $_POST['correo']);
                $cor->execute();
                $co = $cor->fetch(PDO::FETCH_ASSOC);

                if (is_array($co) <=  1 ){

                    if($co == 0){
                        $sentencia = $conn->prepare('UPDATE usuarios set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, tipo = :tip where id = :id');
                        $sentencia->bindParam(':id', $id);
                        $sentencia->bindParam(':user', $_POST['user']);
                        $sentencia->bindParam(':nombre', $_POST['nombre']);
                        $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                        $sentencia->bindParam(':emal', $_POST['correo']);
                        $sentencia->bindParam(':tip', $ti);
                        $resultado = $sentencia->execute();
                        if($resultado === TRUE) $message = "Cambios guardados";
                        else $message =  "Algo salio mal.";

                    } elseif($results['id'] == $co['id']){
                        $sentencia = $conn->prepare('UPDATE usuarios set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, tipo = :tip where id = :id');
                        $sentencia->bindParam(':id', $id);
                        $sentencia->bindParam(':user', $_POST['user']);
                        $sentencia->bindParam(':nombre', $_POST['nombre']);
                        $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                        $sentencia->bindParam(':emal', $_POST['correo']);
                        $sentencia->bindParam(':tip', $ti);
                        $resultado = $sentencia->execute();
                        if($resultado === TRUE) $message = "Cambios guardados";
                        else $message =  "Algo salio mal.";

                    }else{
                        $message = "Ya existe una cuente con este correo";
                    }
                    
                    
                
                } else {
                    $message = "Ya existe una cuente con este correo";
                }



            }else{
                $message = "Ya existe una cuente con este nombre de usuario";
            }
            

        } else{
            $message = "Ya existe una cuente con este nombre de usuario";
        }

        
    }
        

    
    if($message != ''){
        $records = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
        $records->bindParam(':id', $id);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
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

<?php if(isset($_SESSION['user_id']) && $_SESSION['lopri'] == 1 && $_SESSION['tipo'] == 1): ?>
    <?php if(is_array($results) > 0): ?>


    <div class="container">    
        <h1>Editar usuario</h1>

        <br>

            

        

        

        <?php if(!empty($message)): ?>

            <div class="container men">

                <?php

                    if($message == 'Cambios guardados'){



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
                    <label>Nombre de usuario:</label>
					<input type="text" name="user"  class='form-control' maxlength="100" value="<?php echo $results['username'] ?>" required >
                  </div>
              </div>
    
              <div class="row">
                <div class="input-field col s10">
                    <label>Nombres:</label>
					<input type="text" name="nombre"  class='form-control' maxlength="100" value="<?php echo $results['nombre'] ?>" required >
                </div>
              </div>


              <div class="row">
                <div class="input-field col s10">
                    <label>Apellidos:</label>
					<input type="text" name="apellidos"  class='form-control' maxlength="100" value="<?php echo $results['apellidos'] ?>" required >
                </div>
              </div>


              <div class="row">
                <div class="input-field col s10">
                    <label>Correo:</label>
					<input type="email" name="correo" class='form-control' maxlength="100" value="<?php echo $results['correo'] ?>" required >
                </div>
              </div>


              <div class="row">
                <div class="input-field col s10">



                    <?php
                        if($results['tipo'] == 1){

                    ?>

					<label>
                        <input type="checkbox" name="tipo" checked="checked" />
                        <span>Administrador</span>
                    </label>

                    <?php
                        } else{
                    ?>

                    <label>
                        <input type="checkbox" name="tipo"  />
                        <span>Administrador</span>
                    </label>

                    <?php
                        }
                    ?>
                        
                    </label><br><br>
                </div>
              </div>

              


              
              <div class="row">
                <div class="input-field col s10">
                    <button type="submit" class="btn btn-success deep-purple accent-4deep-purple accent-4" name="subir">Guardar datos</button>
                    <a href="usuarios.php" class="waves-effect deep-purple accent-4 btn right">regresar</a>
                
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
?>

<h1>No ay ningun usuario con estos parametros :(</h1>

<?php endif; ?>



<?php else: 
    header('Location: /biblioteca/php/privado/login.php');
    ?>
<?php endif; ?>