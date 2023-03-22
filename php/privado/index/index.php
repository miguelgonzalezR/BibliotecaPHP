<?php 
require '../../database.php';
require '../helpers/menu.php';
require_once '../helpers/graficos/cone.php';


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

<style type="text/css">
    img.li{width: 200px; height: 150px;}

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

    <center><h1>Bienvenido <?php echo $_SESSION['nameu'];?></h1></center>

<!DOCTYPE html>
<html>
<head>
	<title>Graficos con plotly</title>
	<link rel="stylesheet" type="text/css" href="../helpers/graficos/librerias/bootstrap/css/bootstrap.css">
	<script src="../helpers/graficos/librerias/jquery-3.3.1.min.js"></script>
	<script src="../helpers/graficos/librerias/plotly-latest.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading">
                        Los recursos bibliograficos mas agregados al repositorio
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div id="cargaLineal"></div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading">
						Los recursos bibliograficos mejor calificados 
					</div>
					<div class="panel panel-body">
						<div class="row">

							<div class="col-sm-12">
								<div id="cargaBarras"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cargaBarras').load('../helpers/graficos/barras.php');
		$('#cargaLineal').load('../helpers/graficos/lineal.php');
	});
</script>




    <script>
      $('.tooltipped').tooltip({delay: 50})

    </script>



<?php else: 
    header('Location: /biblioteca/php/privado/login.php');
    ?>
<?php endif; ?>

    
</body>
</html>


