<?php

  session_start();

  require '../database.php';

  $id = $_GET['id'];

  $message = "";

  
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    


    if (!empty($_POST['user']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) ) {

        $nombrei = $_FILES['imgl']['name'];
        $rutai = $_FILES['imgl']['tmp_name'];
        $destinoi = "../../libros/clientes/" . $nombrei;
        
        $exis = $conn->prepare('SELECT * FROM clientes WHERE username = :user');
        $exis->bindParam(':user', $_POST['user']);
        $exis->execute();
        $exi = $exis->fetch(PDO::FETCH_ASSOC);

        if (is_array($exi) <=  1){

            if( $exi == 0){

                $cor = $conn->prepare('SELECT * FROM clientes WHERE correo = :correo');
                $cor->bindParam(':correo', $_POST['correo']);
                $cor->execute();
                $co = $cor->fetch(PDO::FETCH_ASSOC);

                if (is_array($co) <=  1 ){

                    if($co == 0){
                        if($_FILES['imgl']['name'] != null){
                            $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, imagen = :img where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':user', $_POST['user']);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                            $sentencia->bindParam(':emal', $_POST['correo']);
                            $sentencia->bindParam(':img', $nombrei);
                            if(copy($rutai, $destinoi)){
                                $resultado = $sentencia->execute();
                                if($resultado === TRUE){
                                    $message = "Cambios guardados";

                                    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                    $records->bindParam(':id', $id);
                                    $records->execute();
                                    $results = $records->fetch(PDO::FETCH_ASSOC);

                                    $_SESSION['user_id'] = $results['id'];
		                            $_SESSION['user_name'] = $results['username'];
		                            $_SESSION['correo'] = $results['correo'];
		                            $_SESSION['img'] = $results['imagen'];
                                } else{
                                    $message =  "Algo salio mal.";
                                } 
                            } else{
                                $message = "Error al subir la imagen";
                            }
                            

                        } else{
                            $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':user', $_POST['user']);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                            $sentencia->bindParam(':emal', $_POST['correo']);
                            $resultado = $sentencia->execute();
                            if($resultado === TRUE){
                                $message = "Cambios guardados";

                                $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                $records->bindParam(':id', $id);
                                $records->execute();
                                $results = $records->fetch(PDO::FETCH_ASSOC);

                                $_SESSION['user_id'] = $results['id'];
                                $_SESSION['user_name'] = $results['username'];
                                $_SESSION['correo'] = $results['correo'];
                                $_SESSION['img'] = $results['imagen'];
                            } else{
                                $message =  "Algo salio mal.";
                            }
                        }
                        

                    } elseif($results['id'] == $co['id']){
                        if($_FILES['imgl']['name'] != null){
                            $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, imagen = :img where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':user', $_POST['user']);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                            $sentencia->bindParam(':emal', $_POST['correo']);
                            $sentencia->bindParam(':img', $nombrei);
                            if(copy($rutai, $destinoi)){
                                $resultado = $sentencia->execute();
                                if($resultado === TRUE){
                                    $message = "Cambios guardados";

                                    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                    $records->bindParam(':id', $id);
                                    $records->execute();
                                    $results = $records->fetch(PDO::FETCH_ASSOC);

                                    $_SESSION['user_id'] = $results['id'];
		                            $_SESSION['user_name'] = $results['username'];
		                            $_SESSION['correo'] = $results['correo'];
		                            $_SESSION['img'] = $results['imagen'];
                                } else{
                                    $message =  "Algo salio mal.";
                                }
                            } else{
                                $message = "Error al subir la imagen";
                            }
                            


                        } else{
                            $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':user', $_POST['user']);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                            $sentencia->bindParam(':emal', $_POST['correo']);
                            $resultado = $sentencia->execute();
                            if($resultado === TRUE){
                                $message = "Cambios guardados";

                                $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                $records->bindParam(':id', $id);
                                $records->execute();
                                $results = $records->fetch(PDO::FETCH_ASSOC);

                                $_SESSION['user_id'] = $results['id'];
                                $_SESSION['user_name'] = $results['username'];
                                $_SESSION['correo'] = $results['correo'];
                                $_SESSION['img'] = $results['imagen'];
                            } else{
                                $message =  "Algo salio mal.";
                            }
                        }
                        

                    }else{
                        $message = "Ya existe una cuente con este correo";
                    }
                    
                    
                
                } else {
                    $message = "Ya existe una cuente con este correo";
                }




            } elseif($results['id'] == $exi['id']){
                $cor = $conn->prepare('SELECT * FROM clientes WHERE correo = :correo');
                $cor->bindParam(':correo', $_POST['correo']);
                $cor->execute();
                $co = $cor->fetch(PDO::FETCH_ASSOC);

                if (is_array($co) <=  1 ){

                    if($co == 0){
                        if($_FILES['imgl']['name'] != null){
                            $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, imagen = :img where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':user', $_POST['user']);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                            $sentencia->bindParam(':emal', $_POST['correo']);
                            $sentencia->bindParam(':img', $nombrei);
                            if(copy($rutai, $destinoi)){
                                $resultado = $sentencia->execute();
                                if($resultado === TRUE){
                                    $message = "Cambios guardados";

                                    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                    $records->bindParam(':id', $id);
                                    $records->execute();
                                    $results = $records->fetch(PDO::FETCH_ASSOC);

                                    $_SESSION['user_id'] = $results['id'];
		                            $_SESSION['user_name'] = $results['username'];
		                            $_SESSION['correo'] = $results['correo'];
		                            $_SESSION['img'] = $results['imagen'];
                                } else{
                                    $message =  "Algo salio mal.";
                                }
                            } else{
                                $message = "Error al subir la imagen";
                            }
                            
                        } else{
                            $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':user', $_POST['user']);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                            $sentencia->bindParam(':emal', $_POST['correo']);
                            $resultado = $sentencia->execute();
                            if($resultado === TRUE){
                                $message = "Cambios guardados";

                                $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                $records->bindParam(':id', $id);
                                $records->execute();
                                $results = $records->fetch(PDO::FETCH_ASSOC);

                                $_SESSION['user_id'] = $results['id'];
                                $_SESSION['user_name'] = $results['username'];
                                $_SESSION['correo'] = $results['correo'];
                                $_SESSION['img'] = $results['imagen'];
                            } else{
                                $message =  "Algo salio mal.";
                            }
                        }
                        

                    } elseif($results['id'] == $co['id']){

                        if($_FILES['imgl']['name'] != null){
                            $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, imagen = :img where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':user', $_POST['user']);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                            $sentencia->bindParam(':emal', $_POST['correo']);
                            $sentencia->bindParam(':img', $nombrei);

                            if(copy($rutai, $destinoi)){
                                $resultado = $sentencia->execute();
                                if($resultado === TRUE){
                                    $message = "Cambios guardados";

                                    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                    $records->bindParam(':id', $id);
                                    $records->execute();
                                    $results = $records->fetch(PDO::FETCH_ASSOC);

                                    $_SESSION['user_id'] = $results['id'];
		                            $_SESSION['user_name'] = $results['username'];
		                            $_SESSION['correo'] = $results['correo'];
		                            $_SESSION['img'] = $results['imagen'];
                                } else{
                                    $message =  "Algo salio mal.";
                                }
                            }

                            
                        } else{
                            $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal where id = :id');
                            $sentencia->bindParam(':id', $id);
                            $sentencia->bindParam(':user', $_POST['user']);
                            $sentencia->bindParam(':nombre', $_POST['nombre']);
                            $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                            $sentencia->bindParam(':emal', $_POST['correo']);
                            $resultado = $sentencia->execute();
                            if($resultado === TRUE){
                                $message = "Cambios guardados";

                                $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                $records->bindParam(':id', $id);
                                $records->execute();
                                $results = $records->fetch(PDO::FETCH_ASSOC);

                                $_SESSION['user_id'] = $results['id'];
                                $_SESSION['user_name'] = $results['username'];
                                $_SESSION['correo'] = $results['correo'];
                                $_SESSION['img'] = $results['imagen'];
                            } else{
                                $message =  "Algo salio mal.";
                            }
                        }

                        

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
        $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
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
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>

<br><br>

<?php if(isset($_SESSION['user_id'])): ?>

    <?php if($_SESSION['user_id'] == $id): ?>


<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Editar <b>Perfil</b></h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>

            <?php if(!empty($message)): ?>

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?= $message ?></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


            <?php endif; ?>


 
			<div class="row">
				<form method="post" enctype="multipart/form-data">

				<div class="col-md-12">
					<label>Nombre de usuario:</label>
					<input type="text" name="user"  class='form-control' maxlength="100" required value="<?php echo $results['username'] ?>">
				</div>


                <div class="col-md-12">
					<label>Nombres:</label>
					<input type="text" name="nombre"  class='form-control' maxlength="100" required value="<?php echo $results['nombre'] ?>">
				</div>


                <div class="col-md-12">
					<label>Apellidos:</label>
					<input type="text" name="apellidos"  class='form-control' maxlength="100" required value="<?php echo $results['apellidos'] ?>">
				</div>

                <div class="col-md-12">
					<label>Correo:</label>
					<input type="email" name="correo" class='form-control' maxlength="100" required value="<?php echo $results['correo'] ?>">
				</div><br>

                <div class="input-field col s12">
                    <div class="file-field input-field">
                        <div class="black btn">
                          <span>Subir Imagen</span>
                          <input type="file" name="imgl">
                        </div>
                      </div>
                </div><br>
				

				
				<div class="col-md-12 pull-right">
				<hr>
					<button type="submit" class="btn btn-success">editar perfil</button>
				</div>
				</form>
			</div>
        </div>
    </div>    


    <script>
        $('.alert').alert()
        $('#myAlert').on('closed.bs.alert', function () {

        })
    </script>


    <?php else: 
        header('Location: /biblioteca/php/publico/index.php');
        ?>

    <?php endif; ?>
    

    <?php else: 
        header('Location: /biblioteca/php/publico/login.php');
        ?>

    <?php endif; ?>


    
</body>
</html>
