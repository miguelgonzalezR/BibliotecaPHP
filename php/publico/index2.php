<?php
require '../database.php';
require 'helpers/menu.php';



    if(isset($_SESSION['user_id'])){
        $consultaSQL = "SELECT libros.id as idl, promedio.pro as prom, libros.titulo, libros.autor, libros.premiun, libros.imagen as imgl FROM promedio INNER JOIN libros ON libros.id = promedio.id_libro ORDER BY pro DESC limit 4";
        $sentencia = $conn->prepare($consultaSQL);
        $sentencia->execute();
        
        $libros = $sentencia->fetchAll();
        
        
        $nue = "SELECT libros.id as idl, libros.titulo, libros.autor , libros.imagen as imgl, libros.premiun, libros.fechala, categorias.nombre FROM libros INNER JOIN categorias ON categorias.id = libros.idcategoria ORDER BY fechala DESC limit 4";
        $nuel = $conn->prepare($nue);
        $nuel->execute();
        
        $librosnew = $nuel->fetchAll();
        
        $fav = "SELECT  libros.id as idl, libros.titulo, libros.autor, libros.imagen as imgl, libros.premiun,  clientes.id, clientes.username FROM favoritos INNER JOIN clientes on clientes.id = favoritos.idcliente INNER JOIN libros ON libros.id = favoritos.idlibro WHERE idcliente = :idc limit 4";
        $favo = $conn->prepare($fav);
        $favo->bindParam(':idc', $_SESSION['user_id']);
        $favo->execute();
        
        $librosfa = $favo->fetchAll();

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




<div class="contenedorFondo"></div>

<div class="contenedorLinks">
    <br><br><h1>Los mejores calificados</h1><br><br>


                </div>
</div>

<div class="contenedorLinks">
    <div class="contenedorPremium">
                        



    <center>

    <div class ="row">

                    <?php
                        if ($libros && $sentencia->rowCount() > 0) {
                        foreach ($libros as $fila) {
                    ?>
        <main>
            <div class='card' style="background-image: url(../../libros/imagenes/<?php echo ($fila["imgl"]);?>);">
                <div class='info'>
                    <h1 class='title'><b> <?php echo ($fila["titulo"]);?></b></h1><br><br>
                    <span><?php echo ($fila["autor"]);?></span><br><br><br><br>

                        <?php if ($fila['prom'] == null): ?>
                            <span style="font-size: 17px;" ><b>Aun no hay calificaciones</b> </span><br><br><br><br><br><br><br>
                        <?php else: ?>
                            <span style="font-size: 17px;" > <b>Calificacion: </b> <?php echo $fila['prom'] ?> de 5</span><br><br><br><br><br><br>
                        <?php endif; ?>

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





    </div>
</div>




<br><br>
<div class="contenedorLinks">
    <h1>Nuevos lanzamientos</h1>

    <div class="contenedorPremium">


                </div>

</div>






<div class="contenedorLinks">
    <div class="contenedorPremium">
                        



    <center>

    <div class ="row">

                    <?php
                        if ($librosnew && $nuel->rowCount() > 0) {
                        foreach ($librosnew as $fila) {
                    ?>
        <main>
            <div class='card' style="background-image: url(../../libros/imagenes/<?php echo ($fila["imgl"]);?>);">
                <div class='info'>
                    <h1 class='title'><b> <?php echo ($fila["titulo"]);?></b></h1><br><br>
                    <span><?php echo ($fila["autor"]);?></span><br><br><br><br>
                    <span style="font-size: 17px;"><b>Fecha:</b> <?php echo ($fila["fechala"]);?></span><br><br><br><br><br><br><br>

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





    </div>
</div>


<br><br>
<div class="contenedorLinks">
    <h1>Tu repositorio</h1>

    <div class="contenedorPremium">

                </div>

</div>








<div class="contenedorLinks">
    <div class="contenedorPremium">
                        



    <center>

    <div class ="row">

                    <?php
                        if ($librosfa && $favo->rowCount() > 0) {
                        foreach ($librosfa as $fila) {
                    ?>
        <main>
            <div class='card' style="background-image: url(../../libros/imagenes/<?php echo ($fila["imgl"]);?>);">
                <div class='info'>
                    <h1 class='title'><b> <?php echo ($fila["titulo"]);?></b></h1><br><br>
                    <span><?php echo ($fila["autor"]);?></span><br><br><br><br><br><br><br>

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
                    print('Aun no as agregado libros a tus favoritos');
                }
        ?> 
    </div>

    

     
    </center>





    </div>
</div>







</body>
</html>

<?php

require 'helpers/footer.php';

?>
    
