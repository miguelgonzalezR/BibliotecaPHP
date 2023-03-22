<?php
    require '../../database.php';
    require '../helpers/menu.php';

    $id = $_GET['id'];

    $message = "";

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id,nombre, descrip FROM categorias WHERE id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['btnLogA'])){
        $sentencia = $conn->prepare('UPDATE categorias set estado = 0 where id = :id');
        $sentencia->bindParam(':id', $id);
        $resultado = $sentencia->execute();
        if($resultado === TRUE) header('Location: /biblioteca/php/privado/crud_cate/categorias.php');
        else $message =  "Algo salio mal.";
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

<?php if(isset($_SESSION['user_id']) ): ?>
    <?php if(is_array($results) > 0): ?>


<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <h1>Eliminar Libro</h1>
                    <div class="col-sm-4">
                        
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
				<form method="post">
				<h5>Esta seguro que desea eliminar la categoria <b><?php echo $results['nombre']?></b></b></h5>

				
				<div class="col-md-12 pull-right">
				<hr>
                    <a href="categorias.php" class="btn btn-info deep-purple accent-4deep-purple accent-4 add-new"> Cancelar</a>
                    <input id="btnLogA" name="btnLogA" type="submit" class="btn red darken-4 " value="Eliminar"> 
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
?>

<h1>No ay ningun categoria con estos parametros :(</h1>

<?php endif; ?>

<?php else: 
    header('Location: /biblioteca/php/privado/login.php');
    ?>
<?php endif; ?>


</body>


</html>