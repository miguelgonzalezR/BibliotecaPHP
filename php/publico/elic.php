<?php
    require '../database.php';

    $id = $_GET['id'];

    $message = "";

        $records = $conn->prepare('SELECT clientes.username, libros.titulo, comentarios.comen, comentarios.fecha 
        FROM comentarios
        INNER JOIN clientes on clientes.id = comentarios.idcliente 
        INNER JOIN libros ON libros.id = comentarios.idlibro
        WHERE comentarios.id = :id');
        $records->bindParam(':id', $id);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);


        $sentencia = $conn->prepare('DELETE FROM comentarios WHERE id = :id');
        $sentencia->bindParam(':id', $id);
        $resultado = $sentencia->execute();
        if($resultado === TRUE) header('Location: /biblioteca/php/publico/libro?id=3');
        else $message =  "Algo salio mal.";




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



<br><br>
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Eliminar <b>categorias</b></h2></div>
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
				<h3>Esta seguro que desea eliminar el comentario <b><?php echo $results['comen'] ?></b> </h3>

				
				<div class="col-md-12 pull-right">
				<hr>
                    <a href="comen.php" class="btn btn-info add-new"> Cancelar</a>
                    <input type="submit" class="btn btn-danger" value="Eliminar"> 
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
    

</body>
</html>