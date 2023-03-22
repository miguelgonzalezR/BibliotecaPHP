<?php

  require '../../database.php';
  
  session_start();

  $id = $_GET['id'];

  $message = "";

  
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (!empty($_POST['contraan']) && !empty($_POST['contra1']) && !empty($_POST['contra2']) ) {

        if(password_verify($_POST['contraan'], $results['contra'])){
            if($_POST['contra1'] == $_POST['contra2']){
                if($_POST['contraan'] != $_POST['contra1']){
                    $sentencia = $conn->prepare('UPDATE usuarios set contra = :contra where id = :id');
                    $sentencia->bindParam(':id', $id);
                    $password = password_hash($_POST['contra1'], PASSWORD_BCRYPT);
                    $sentencia->bindParam(':contra', $password);
                    $resultado = $sentencia->execute();
                    if($resultado === TRUE) $message = "Contraseña actualizada correctamente";
                    else $message =  "Algo salio mal.";
                } else{
                    $message = "La nueva contraseña es igual que la anterior";
                }
            } else{
                $message = "Las contraseñas no son iguales";
            }
        } else{
            $message = "La contraseña es incorrecta";
        }



        
    } else{
        $message = "Campos vacios";
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

<?php if(isset($_SESSION['user_id'])): ?>

<br><br>
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Actualizar <b>Contraseña</b></h2></div>
                    <div class="col-sm-4">
                        <a href="../index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>

            <h4><?= $results['username'] ?></h4>

            <?php if(!empty($message)): ?>

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?= $message ?></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


            <?php endif; ?>


 
			<div class="row">
				<form method="post">
				<div class="col-md-12">
					<label>Contraseña actual:</label>
					<input type="password" name="contraan" class='form-control' maxlength="100" required  >
				</div>

                <div class="col-md-12">
					<label>Nueva contraseña:</label>
					<input type="password"  name="contra1"  class='form-control' maxlength="100" required >
				</div>

                <div class="col-md-12">
					<label>Confirmar contraseña:</label>
					<input type="password" name="contra2"  class='form-control' maxlength="100" required >
				</div>

				
				<div class="col-md-12 pull-right">
				<hr>
					<button type="submit" class="btn btn-success">editar categorias</button>
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
        header('Location: /biblioteca/php/privado/login.php');
        ?>

    <?php endif; ?>
    
</body>
</html>