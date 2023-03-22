<?php

require '../database.php';
require 'helpers/menu.php';

if(isset($_SESSION['user_id'])){
    $id = $_GET['id'];
    $dataTime = date("Y-m-d");
    $link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $records = $conn->prepare('SELECT libros.id, categorias.nombre, autor, titulo, nomar, sinopsis, numpa, libros.imagen as imgl, premiun, idiomas, edicion, fechala, libros.estado
    FROM libros
    INNER JOIN categorias ON categorias.id = libros.idcategoria
    WHERE libros.id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);


    if( ( ( ($_SESSION['tipo'] == 0) || ($_SESSION['tipo'] == 1)  ) && ($results['premiun'] == 0 )) || ( ( $_SESSION['tipo'] == 1 ) && ( ($results['premiun'] == 0) || ($results['premiun'] == 1) ) ) ){
        $conf = 1;
    } else{
        $conf = 0;
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

<style>
    *{
    /* Eliminar predeterminados */
    margin: 0;
    padding: 0;
}

.title {
    /* Estilos de título h1 */
    text-align: center;
    padding: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

.pdfview {
    /* Centrado */
    margin: auto;
    display: block;
    /* Tamaño */
    width: 90%;
    height: 100vh;
    /* Mejorar aspecto */
    border-radius: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.Header{
        position:absolute;
    }

.no{
    margin-top: 10%;
}    

</style>

<?php if($conf == 1): ?>

<body>
    <br><br><br><br>
    <center>
        <h1><?php echo $results['titulo'] ?></h1>
    </center><br>
    <object class="pdfview" type="application/pdf" data="../../libros/pdf/<?php echo $results['nomar'];?>"></object>
</body>
</html>


<?php else: 
?>
    <center>
        <h1 class="no">Para leer este Libro tienes que ser premium</h1>
    </center>

<?php endif; ?>


<?php

require 'helpers/footer.php';

?>