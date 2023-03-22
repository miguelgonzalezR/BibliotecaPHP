<?php

require '../database.php';
require 'helpers/menu.php';

    $id = $_GET['id'];


    $cate = $conn->prepare('SELECT * FROM categorias where id = :id');
    $cate->bindParam(':id', $id);
    $cate->execute();
    $cat = $cate->fetch(PDO::FETCH_ASSOC);
    

    

    if(is_array($cat) > 0){

        $consultaSQL = "SELECT libros.id as idl, categorias.id,categorias.nombre as cate, autor, titulo, nomar, sinopsis, numpa, libros.imagen as imgl, premiun, idiomas, edicion, fechala, libros.estado
        FROM libros
        INNER JOIN categorias ON categorias.id = libros.idcategoria
        WHERE libros.estado = 1 and categorias.id = :id";
        $sentencia = $conn->prepare($consultaSQL);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();

        $libros = $sentencia->fetchAll();

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



<style>
        .contenedorCard{
        background: #FFFFFF;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
        margin-right: 20px;
        text-align: center;
        width: 300px;
        padding-bottom: 20px;
    }
    .contenedorCard p{
        font-style: normal;
        font-weight: 700;
        font-size: 20px;
        line-height: 100%;
        margin: 10px 0;
    }
    

    .contenedorPremium{
        width:100%;
        display: flex;
        justify-content:center ;
        align-items: center;
        
        padding:20px 0;
        flex-wrap:wrap;
    }



    main {
  padding: 0 64px 64px;
}

.row{
    display: flex;
    justify-content:center;
    flex-direction: row;
    flex-wrap: wrap;

}

.card {
  border-radius: 16px;
  margin: 0 auto;
  width: 400px;
  max-width: 300px;
  min-height: 500px;
  box-shadow: 0px 3px 5px -1px rgba(0, 0, 0, 0.2),
    0px 5px 8px 0px rgba(0, 0, 0, 0.14),
    0px 1px 14px 0px rgba(0, 0, 0, 0.12);
  overflow: hidden;
  
  background-size: cover;
}

.info {
  position: relative;
  width: 100%;
  height: 500px;
  background-color: #fff;
  transform: translateY(100%)
    translateY(-88px)
    translateZ(0);
  transition: transform 0.5s ease-out;
}


.card:hover .info,
.card:hover .info:before {
  transform: translateY(0) translateZ(0);
}

.title {
  margin: 0;
  padding: 24px;
  font-size: 23px;
  line-height: 1;
  color: rgba(0, 0, 0, 0.87);
}

.description {
  margin: 0;
  padding: 0 24px 24px;
  font-size: 18px;
  line-height: 1.5;
}

/* General layout and typography stuff */
@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400");






p {
  margin-bottom: 1.3em;
  line-height: 1.618
}

@media (min-width:800px) {
  p {
    font-size: 1.3em
  }
}



 

</style>


<center>
    <br><br><br><br><br><br><br><br>
    <?php
        if(is_array($cat) > 0):
    ?>
        <div class="contenedorLinks">
            <h1><?php echo($cat['nombre']); ?></h1>
            <br><br>
            


                </div>
            

            
        </div>
    </center>




    <center>

    <div class ="row">

                    <?php
                        if ($libros && $sentencia->rowCount() > 0) {
                        foreach ($libros as $fila) {
                    ?>
        <main>
            <div class='card' style="background-image: url(../../libros/imagenes/<?php echo ($fila["imgl"]);?>);">
                <div class='info'>
                    <h1 class='title'><b> <?php echo ($fila["titulo"]);?></b></h1><br>
                    <p class='description'><?php echo ($fila["sinopsis"]);?></p>

                    <?php

                            if( ( ( ($_SESSION['tipo'] == 0) || ($_SESSION['tipo'] == 1)  ) && ($fila["premiun"] == 0 )) || ( ( $_SESSION['tipo'] == 1 ) && ( ($fila["premiun"] == 0) || ($fila["premiun"] == 1) ) ) ){
                        ?>
                        


                        <a href="verli.php?id=<?php echo $fila['idl'];?>" class="vermas">Leer</a><br><br>


                        <?php

                            } else{

                        ?>

                            <button name="btnef" data-toggle="tooltip" title="Tiene que ser premium para leer este libro"><i class="large material-icons btnbl" style="padding-top: 5px;">lock</i>  </button>


                        <?php

                            }
                        ?>
                </div>
            </div>
        </main>
        
        <?php
            }
                }

                    else{
                        print('No se han ingresado categorias aun');
                    }
        ?> 
    </div>

    

     
    </center>   



    <script>
        window.addEventListener("scroll", function(){
            let header = this.document.querySelector('header');
            header.classList.toggle("active", this.window.scrollY>900);
        })
    </script>

<?php else: 
?>

<h1>No existe ninguna categoria con estos parametros</h1>

<?php endif; ?>


<?php

require 'helpers/footer.php';

?>



</body>
</html>
