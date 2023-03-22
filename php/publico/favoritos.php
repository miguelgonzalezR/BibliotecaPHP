<?php

require '../database.php';
require 'helpers/menu.php';


if(isset($_SESSION['user_id'])){
    $fav = "SELECT  libros.id as idl, libros.titulo, libros.autor, libros.sinopsis, libros.imagen as imgl, clientes.id, clientes.username FROM favoritos INNER JOIN clientes on clientes.id = favoritos.idcliente INNER JOIN libros ON libros.id = favoritos.idlibro WHERE idcliente = :idc  limit 5";
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
    <title>Favorito</title>
</head>

<style>
    .ListaFavoritos{
    background: fixed no-repeat 50% 50%;
    background-size: cover;
    background:#D8D8D8 ;
    width: 100%;
}
.ListaFavoritos h1{
    padding:9% 5% 50px 15% ;
    font-style: normal;
    font-weight: 800;
    font-size: 25px;
    line-height: 25px;
    font-feature-settings: 'salt' on, 'liga' off;
    font-family: Arial, Helvetica, sans-serif;
}

    /*===================Primer Libro==========================*/

.Libro1{
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
    margin-right: 10%;
    margin-left: 10%;
    margin-bottom: 1%;
    display:flex;
    text-align: left;
    flex-wrap: wrap;
    background: #ffffff;
    padding:2% 5% 50px 15% ;
    color: #000000
}

.Libro1 img{
    height: 200px;
    width: 130px;

}

.Informacion1{
    width: 70%;
    margin-left: 50px;
}
.Informacion1 h2{
    font-style: normal;
    font-weight: 800;
    font-size: 25px;
    line-height: 50px;
    font-feature-settings: 'salt' on, 'liga' off;
    color: #000000;
    font-family: Arial, Helvetica, sans-serif;
}

.Informacion1 p{
    margin-right: 5%;
    font-style: normal;
    font-weight: normal;
    text-align: justify;
    font-size: 13px;
    line-height: 20px;
    padding: 20px 0;
    font-family: Arial, Helvetica, sans-serif;

}





    h3{
    font-size:30px;
    padding:9% 5% 50px 15% ;
    color: #000;
}

</style>




<body>
    <main>
        <div class="ListaFavoritos">
            <center>
            <h1>Estanterías</h1>
            </center>
            

            <?php
                        if ($librosfa && $favo->rowCount() > 0) {
                        foreach ($librosfa as $fila) {
                    ?>

            <div class="Libro1">

            
                <img src="../../libros/imagenes/<?php echo ($fila["imgl"]);?>" alt="Primerlibro">
                <div class="Informacion1">
                    <h2><?php echo ($fila["titulo"]);?></h2>
                    <p><?php echo ($fila["sinopsis"]);?></p>
                    <a href="verli.php?id=<?php echo $fila['idl'];?>" class="vermas">Comezar a leer</a><br><br>
                </div>


                

            </div><br><br><br><br>

            <?php
                            }
                        }

                        else{
                        
                    ?>
                <center>
                    <h3>No has agregado ningun libro a tus favoritos</h3>
                </center>
            <?php
                }
            ?>


            

        </div>
    </main>
</body>
</html>


<?php

require 'helpers/footer.php';

?>