<?php

require '../database.php';
require 'helpers/menu.php';

    $consultaSQL = "SELECT libros.id, categorias.nombre, autor, titulo, nomar, sinopsis, numpa, libros.imagen as iml, premiun, idiomas, edicion, fechala, libros.estado
    FROM libros
    INNER JOIN categorias ON categorias.id = libros.idcategoria
    WHERE libros.estado = 1";
    $sentencia = $conn->prepare($consultaSQL);
    $sentencia->execute();

    $libros = $sentencia->fetchAll();

    if (isset($_SESSION['user_id'])) {
    
        $consultaca = "SELECT * FROM categorias where estado = 1";
        $sentenciaca = $conn->prepare($consultaca);
        $sentenciaca->execute();
    
        $categorias = $sentenciaca->fetchAll();
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


    <center>
    <br><br><br><br><br><br><br><br>
        <div class="contenedorLinks">
            <h1>Categorías</h1>
            <br><br>
            


                <div class="contenedorPremium">
                    <?php
                        if ($categorias && $sentenciaca->rowCount() > 0) {
                        foreach ($categorias as $fila) {
                    ?>
            
                    <div class="contenedorCardc">
                        <img class="imgc" src="../../libros/categorias/<?php echo ($fila["imagen"]);?>">
                        <p><?php echo ($fila["nombre"]);?></p><br>
                        <a href="lica.php?id=<?php echo $fila['id'];?>" class="vermas">Ver libros</a><br><br>
                    </div>

                    <?php
                            }
                        }

                        else{
                            print('No se han ingresado categorias aun');
                        }
                    ?> 

                </div>
            

            
        </div>
    </center>


        <br><br><br><br><br>



    <script>
        window.addEventListener("scroll", function(){
            let header = this.document.querySelector('header');
            header.classList.toggle("active", this.window.scrollY>900);
        })
    </script>

    



</body>
</html>


<?php

require 'helpers/footer.php';

?>
    