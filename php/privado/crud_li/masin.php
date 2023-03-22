<?php 
require '../../database.php';
require '../helpers/menu.php';

    $id = $_GET['id'];

    $records = $conn->prepare('SELECT libros.id, categorias.nombre as cate, autor, titulo, nomar, sinopsis, numpa, libros.imagen as imgl, premiun, idiomas, edicion, fechala, libros.estado
    FROM libros
    INNER JOIN categorias ON categorias.id = libros.idcategoria
    WHERE libros.id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>

<style type="text/css">
    img.li{width: 200px; height: 150px;}

    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

.Contenedor{ 
    width: 100%;
   }
   
   .informacionLibro{
       display:flex;
       text-align: left;
       flex-wrap: wrap;
       background: #18191F;
       padding:5% 5% 50px 15% ;
       color: #FFFFFF;
   }
   .informacionLibro img{
       height: 302px;
   }
   
   .informacionBook{
       width: 70%;
       margin-left: 50px;
   }
   .informacionBook h2{
       font-style: normal;
       font-weight: 800;
       font-size: 40px;
       line-height: 54px;
       font-feature-settings: 'salt' on, 'liga' off;
       color: #FFFFFF;
   }
   
   .informacionBook button{
       display: flex;
       flex-direction: row;
       align-items: center;
       padding: 5px 32px;
       background: #8C30F5;
       border-radius: 6px;
       border: none;
       color: #FFFFFF;
       cursor: pointer;
       margin-top: 20px;
   }
   
   .informacionLibro p{
       margin-right: 20%;
       font-style: normal;
       font-weight: normal;
       font-size: 18px;
       line-height: 32px;
       padding: 20px 0;
   }
   
   .divOriginales{
       background: #75E3EA;
       border: 1px solid #75E3EA;
       text-align: center;
       padding: 30px 0;

   }
   
   .btnComenzarLectura{
       background: #FFFFFF;
       margin: 80px 30%;
       font-style: normal;
       font-weight: 800;
       font-size: 40px;
       line-height: 54px;
       font-feature-settings: 'salt' on, 'liga' off;
       color: #18191F;
       padding: 40px;
       cursor: pointer;
       filter: blur(2px);
       width: 40%;
   }

   .pdfview {

        margin: auto;
        display: block;

        width: 90%;
        height: 100vh;

        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }


    .no{
        margin-top: 10%;
    }
    
    body{
        background: #18191F;
    }


</style>



<body>






<?php if(isset($_SESSION['user_id'])): ?>
      <?php if(is_array($results) > 0): ?>

<div class="informacionLibro">
        <img src="../../../libros/imagenes/<?php echo ($results["imgl"]);?>">
        
        

        <div class="informacionBook">
            <a class="waves-effect waves-light btn-large indigo darken-4" href="libros.php">Regresar</a>
            <h2><?php echo $results['titulo'] ?></h2>
            <h4><?php echo $results['autor'] ?></h4>

            <div class="col-md-12">
		        <br><h5>Categoría:</h5>
                <label style="font-size: 20px;" ><?php echo $results['cate'] ?></label>
	        </div>

            <p><?php echo $results['sinopsis'] ?></p>

            <div class="col-md-12">
		        <br><h5>Premiun:</h5>
                <label style="font-size: 20px;" >
                <?php if($results["premiun"] == 1){
                    echo ("Si");
                    }
                    else{
                        echo ("No");
                    }

                ?></label>
	        </div>

            <div class="col-md-12">
		        <br><h5>Ideoma:</h5>
                <label style="font-size: 20px;" ><?php echo $results['idiomas'] ?></label>
	        </div>

            <div class="col-md-12">
		        <br><h5>Edifion:</h5>
                <label style="font-size: 20px;" ><?php echo $results['edicion'] ?></label>
	        </div>

            <div class="col-md-12">
		        <br><h5>fecha:</h5>
                <label style="font-size: 20px;" ><?php echo $results['fechala'] ?></label>
    	    </div>




        </div>

    </div>

    <br><br><object class="pdfview" type="application/pdf" data="../../../libros/pdf/<?php echo $results['nomar'];?>"></object><br><br>
    







<?php else: 
?>

<h1>No ay ningun libro con estos parametros :(</h1>

<?php endif; ?>


    <?php else: 
        header('Location: /biblioteca/php/privado/login.php');
        ?>

    <?php endif; ?>


</body>
</html>