<?php

  require '../../database.php';
  require '../helpers/menu.php';

  $message = '';
  $ti; 

  if (/*isset($_SESSION['user_id'])*/ 1 == 1) {
    if (!empty($_POST['user']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) && !empty($_POST['contra']) && !empty($_POST['contra2'])) {
        if($_POST['contra'] == $_POST['contra2']){
            if(isset($_POST['tipo'])){
                $ti = 1;
            } else{
                $ti = 0;
            }

            $exis = $conn->prepare('SELECT * FROM usuarios WHERE username = :user');
            $exis->bindParam(':user', $_POST['user']);
            $exis->execute();
            $exi = $exis->fetch(PDO::FETCH_ASSOC);

            if (is_array($exi) ==  0 ){
                
                $cor = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo');
                $cor->bindParam(':correo', $_POST['correo']);
                $cor->execute();
                $co = $cor->fetch(PDO::FETCH_ASSOC);

                if (is_array($co) ==  0 ){
                    $sql = "INSERT INTO usuarios (username, nombre, apellidos, correo, contra, tipo, inten, ban) VALUES (:user, :nombre, :apellidos, :correo, :contra, :tipo, 0, 0)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':user', $_POST['user']);
                    $stmt->bindParam(':nombre', $_POST['nombre']);
                    $stmt->bindParam(':apellidos', $_POST['apellidos']);
                    $stmt->bindParam(':correo', $_POST['correo']);
                    $password = password_hash($_POST['contra'], PASSWORD_BCRYPT);
                    $stmt->bindParam(':contra', $password);
                    $stmt->bindParam(':tipo', $ti);
    
                    if ($stmt->execute()) {
                        $message = 'Usuario creado con exito';
                    } else {
                        $message = 'error al crear al usuario';
                    }
                } else{
                    $message = "Ya existe una cuente con este correo";
                }
            } else{
                $message = "Ya existe una cuente con este nombre de usuario";
            }



            
        }
        else{
            $message = 'La contraseñas no son iguales';
        }
        
      } 
  } 
  else{
      $message = 'Accion denegada';
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


    <div class="container">    
        <h1>Agregar usuario</h1>

        <br>

            

        

        

        <?php if(!empty($message)): ?>

            <div class="container men">

                <?php

                    if($message == 'Usuario creado con exito'){



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
					<input type="text" name="user"  class='form-control' maxlength="100" required >
                  </div>
              </div>
    
              <div class="row">
                <div class="input-field col s10">
                    <label>Nombres:</label>
					<input type="text" name="nombre"  class='form-control' maxlength="100" required >
                </div>
              </div>


              <div class="row">
                <div class="input-field col s10">
                    <label>Apellidos:</label>
					<input type="text" name="apellidos"  class='form-control' maxlength="100" required >
                </div>
              </div>


              <div class="row">
                <div class="input-field col s10">
                    <label>Correo:</label>
					<input type="email" name="correo" class='form-control' maxlength="100" required >
                </div>
              </div>


              <div class="row">
                <div class="input-field col s10">
					<label>
                        <input type="checkbox" name="tipo" />
                        <span>Administrador</span>
                    </label><br>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s10">
                    <label>Contraseña:</label>
					<input type="password"  name="contra"  class='form-control' maxlength="255" required>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s10">
                    <label>Comfirmar Contraseña:</label>
					<input type="password"  name="contra2"  class='form-control' maxlength="255" required>
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
    header('Location: /biblioteca/php/privado/login.php');
    ?>
<?php endif; ?>
    
</body>
</html>