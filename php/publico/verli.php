<?php

require '../database.php';
require 'helpers/menu.php';

if(isset($_SESSION['user_id'])){
    $id = $_GET['id'];
    $dataTime = date("Y-m-d");
    $link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $records = $conn->prepare('SELECT libros.id as idli, categorias.nombre, autor, titulo, nomar, sinopsis, numpa, libros.imagen as imgl, premiun, idiomas, edicion, fechala, libros.estado
    FROM libros
    INNER JOIN categorias ON categorias.id = libros.idcategoria
    WHERE libros.id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);


    $com = $conn->prepare('SELECT comentarios.id as coid, clientes.username, clientes.imagen as imgc, libros.id,libros.titulo,comentarios.comen, comentarios.fecha
    FROM comentarios
    INNER JOIN clientes on clientes.id = comentarios.idcliente
    INNER JOIN libros on libros.id = comentarios.idlibro
    WHERE comentarios.idlibro = :id
    ORDER by fecha DESC');
    $com->bindParam(':id', $id);
    $com->execute();
    $come = $com->fetchAll();

    if(isset($_POST['btnLogA'])){
        if (!empty($_POST['comen']) ) {
            $sql = "INSERT INTO comentarios (idcliente, idlibro , comen, fecha) VALUES (:idc, :idl, :com, :fe)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idc', $_SESSION['user_id']);
            $stmt->bindParam(':idl', $id);
            $stmt->bindParam(':com', $_POST['comen']);
            $stmt->bindParam(':fe', $dataTime);
    
            if ($stmt->execute()) {
                header($link);
                $com = $conn->prepare('SELECT comentarios.id as coid, clientes.username, libros.id,libros.titulo,comentarios.comen, comentarios.fecha, clientes.imagen as imgc
                FROM comentarios
                INNER JOIN clientes on clientes.id = comentarios.idcliente
                INNER JOIN libros on libros.id = comentarios.idlibro
                WHERE comentarios.idlibro = :id
                ORDER by fecha DESC');
                $com->bindParam(':id', $id);
                $com->execute();
                $come = $com->fetchAll();
            } else {
                $message = 'error';
            }

        }
        
    }

    if(isset($_POST['btnel'])){
        $sentencia = $conn->prepare('DELETE FROM comentarios WHERE id = :id');
        $sentencia->bindParam(':id', $_POST['idc']);
        $resultado = $sentencia->execute();
        if($resultado === TRUE) {
            $com = $conn->prepare('SELECT comentarios.id as coid, clientes.username, libros.id,libros.titulo,comentarios.comen, comentarios.fecha, clientes.imagen as imgc
                FROM comentarios
                INNER JOIN clientes on clientes.id = comentarios.idcliente
                INNER JOIN libros on libros.id = comentarios.idlibro
                WHERE comentarios.idlibro = :id
                ORDER by fecha DESC');
                $com->bindParam(':id', $id);
                $com->execute();
                $come = $com->fetchAll();
        }else $message =  "Algo salio mal.";
    }


    $fav = $conn->prepare('SELECT * FROM favoritos WHERE idcliente = :idc and idlibro = :idl');
    $fav->bindParam(':idc', $_SESSION['user_id']);
    $fav->bindParam(':idl', $id);
    $fav->execute();
    $favo = $fav->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['btnef'])){
        $af = $conn->prepare('DELETE FROM favoritos WHERE idcliente = :idc and idlibro = :idl');
        $af->bindParam(':idl', $id);
        $af->bindParam(':idc', $_SESSION['user_id']);
        $afr = $af->execute();
        if($afr === TRUE){
            header($link);
            $fav = $conn->prepare('SELECT * FROM favoritos WHERE idcliente = :idc and idlibro = :idl');
            $fav->bindParam(':idc', $_SESSION['user_id']);
            $fav->bindParam(':idl', $id);
            $fav->execute();
            $favo = $fav->fetch(PDO::FETCH_ASSOC);

        }else $message =  "Algo salio mal al elimar de favoritos";
    }


    if(isset($_POST['btnaf'])){
        $sqlf = "INSERT INTO favoritos (idlibro, idcliente) VALUES (:idl,:idc)";
        $afa = $conn->prepare($sqlf);
        $afa->bindParam(':idl', $id);
        $afa->bindParam(':idc', $_SESSION['user_id']);

        if ($afa->execute()){
            header($link);
            $fav = $conn->prepare('SELECT * FROM favoritos WHERE idcliente = :idc and idlibro = :idl');
            $fav->bindParam(':idc', $_SESSION['user_id']);
            $fav->bindParam(':idl', $id);
            $fav->execute();
            $favo = $fav->fetch(PDO::FETCH_ASSOC);
        } else $message =  "Algo salio mal al agregar a favoritos";

    }

    $cal = $conn->prepare('SELECT * FROM calificaciones WHERE idcliente = :idc and idlibro = :idl');
    $cal->bindParam(':idc', $_SESSION['user_id']);
    $cal->bindParam(':idl', $id);
    $cal->execute();
    $cali = $cal->fetch(PDO::FETCH_ASSOC);

    


    if(isset($_POST['calif'])){
        if($_POST['estrellas'] == 1){
            $canu = 1;
        } elseif($_POST['estrellas'] == 2){
            $canu = 2;    
        } elseif($_POST['estrellas'] == 3){
            $canu = 3;    
        } elseif($_POST['estrellas'] == 4){
            $canu = 4;    
        }  elseif($_POST['estrellas'] == 5){
            $canu = 5;    
        } else{
            $canu = 0; 
        }
        $sqlc = "INSERT INTO calificaciones (idlibro, idcliente, cali) VALUES (:idl,:idc, :cal)";
        $ecal = $conn->prepare($sqlc);
        $ecal->bindParam(':idl', $id);
        $ecal->bindParam(':idc', $_SESSION['user_id']);
        $ecal->bindParam(':cal', $canu);

        if ($ecal->execute()){

            $calipro = $conn->prepare('SELECT round((AVG(cali)),2 ) as pro  FROM calificaciones WHERE idlibro = :idl');
            $calipro->bindParam(':idl', $id);
            $calipro->execute();
            $caliprom = $calipro->fetch(PDO::FETCH_ASSOC);

            $profs = implode("", $caliprom);

            $acpro = $conn->prepare('UPDATE promedio set pro = :pro where id_libro = :idl');
            $acpro->bindParam(':idl', $id);
            $acpro->bindParam(':pro', $profs);
            $respro = $acpro->execute();

            header($link);
            $cal = $conn->prepare('SELECT * FROM calificaciones WHERE idcliente = :idc and idlibro = :idl');
            $cal->bindParam(':idc', $_SESSION['user_id']);
            $cal->bindParam(':idl', $id);
            $cal->execute();
            $cali = $cal->fetch(PDO::FETCH_ASSOC);
        } else $message =  "Algo salio mal al cargar los datos";
    }


    if(isset($_POST['edca'])){
        if($_POST['edies'] == 1){
            $canue = 1;
        } elseif($_POST['edies'] == 2){
            $canue = 2;    
        } elseif($_POST['edies'] == 3){
            $canue = 3;    
        } elseif($_POST['edies'] == 4){
            $canue = 4;    
        }  elseif($_POST['edies'] == 5){
            $canue = 5;    
        } else{
            $canue = 0; 
        }

        $edic = $conn->prepare('UPDATE calificaciones set cali = :cal  where idcliente = :idc and idlibro = :idl');
        $edic->bindParam(':idl', $id);
        $edic->bindParam(':idc', $_SESSION['user_id']);
        $edic->bindParam(':cal', $canue);
        $resultado = $edic->execute();
        if($resultado === TRUE){
            $calipro = $conn->prepare('SELECT round((AVG(cali)),2 ) as pro  FROM calificaciones WHERE idlibro = :idl');
            $calipro->bindParam(':idl', $id);
            $calipro->execute();
            $caliprom = $calipro->fetch(PDO::FETCH_ASSOC);

            $profs = implode("", $caliprom);

            $acpro = $conn->prepare('UPDATE promedio set pro = :pro where id_libro = :idl');
            $acpro->bindParam(':idl', $id);
            $acpro->bindParam(':pro', $profs);
            $respro = $acpro->execute();
            header($link);
            $cal = $conn->prepare('SELECT * FROM calificaciones WHERE idcliente = :idc and idlibro = :idl');
            $cal->bindParam(':idc', $_SESSION['user_id']);
            $cal->bindParam(':idl', $id);
            $cal->execute();
            $cali = $cal->fetch(PDO::FETCH_ASSOC);
            $message = "Cambios guardados";
        } 
        else $message =  "Algo salio mal.";

    }

    $calip = $conn->prepare('SELECT round((AVG(cali)),2 ) as pro  FROM calificaciones WHERE idlibro = :idl');
    $calip->bindParam(':idl', $id);
    $calip->execute();
    $calipr = $calip->fetch(PDO::FETCH_ASSOC);


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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>libros</title>
</head>
<body>

<style>
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
       background: #2273A3;
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

       width: 40%;
   }

   /*****************COMENTARIOS*******************/

.seccionComent{
    border-top: 2px solid #18191F;
    padding-top: 80px;
    text-align: center;
}
.entrada{
    width: 50%;
    margin: 0 auto;
}

.entrada img{
    border-radius: 50%;
    width: 50px;
    height: 55px;
    top: 20px;
}

.entrada input{
    background: #FFFFFF;
    padding: 30px;
    width: 80%;
    border: 1px solid #18191F;
    box-sizing: border-box;
    box-shadow: 0px 4px 11px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    margin-left: 20px;
}
.entrada input:focus{
    outline: none;
    border:2px solid #8c30f5;
}
.entrada button{
    float: right;
    margin-right: 45px;
    background-color: #2273A3;
    color: #FFFFFF;
    border: none;
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 10px 20px;
    margin: 30px;
    box-shadow: 0px 4px 11px rgba(0, 0, 0, 0.25);
    cursor: pointer;
}


.comentariosGlobal{
    margin-top: 50px;
    width: 60%;
    margin: 0 auto;
}

.comentarios{
    margin-top: 100px;
    border-bottom: 1px solid #18191F;
    display:flex;
    flex-direction: row;
    flex-wrap: wrap;
    padding: 30px;
    margin-bottom: 40px;
}
.comentarios img{
    border-radius: 50%;
    width: 50px;
    height: 55px;
    top: 0px;
   
}
.comentarios h3{
    margin-left: 20px;
}

.comentarios p{
    margin-left: 40px;
    display: block;
    font-style: normal;
font-weight: 500;
font-size: 18px;
line-height: 196.19%;
/* or 35px */

display: flex;
align-items: center;

/* Text / Gray 900 */

color: #18191F;
}

.comentarios span{
    margin-left: 20px;
    font-style: normal;
    font-weight: 300;
    font-size: 14px;
    line-height: 196.19%;
    display: flex;
    align-items: center;
    color: #18191F;
}

.infoComentarios{
    margin-top: 40px;
    margin-left: -80px;
}

.cali > label{ color:grey;}
    .cali > input[type = "radio"]{ display:none;}
    .cali > .clasificacion{
      direction: rtl;/* right to left */
      unicode-bidi: bidi-override;/* bidi de bidireccional */
      }
      
    .cali > label:hover{color:orange;}

    .cali > #form {
        width: 250px;
        margin: 0 auto;
        height: 50px;
    }

    #form p {
        text-align: center;
    }

    #form label {
        font-size: 20px;
    }

    input[type="radio"] {
        display: none;
    }

    .cali > label {
        color: grey;
    }

    .clasificacion {
        direction: rtl;
        unicode-bidi: bidi-override;
    }

    label:hover,
    label:hover ~ label {
        color: orange;
    }

    input[type="radio"]:checked ~ label {
        color: orange;
    }

    .btnel{
        display: flex;
       flex-direction: row;
       align-items: center;
       padding: 7px 20px;
       background: #d50000;
       border-radius: 6px;
       border: none;
       color: #FFFFFF;
       cursor: pointer;
       margin-top: 20px;
    }



</style>
<?php if(isset($_SESSION['user_id'])): ?>
    <?php if($conf == 1): ?>

<div class="informacionLibro">
    <img src="../../libros/imagenes/<?php echo ($results["imgl"]);?>" width="200" height="50">

        <div class="informacionBook">
            <h2><?php echo $results['titulo'] ?></h2>

            <form method="post">

                <div>
                    <?php if (is_array($favo) != 1): ?>
                        <!-- agregar tooltips en los dos botones --> 
                        <button name="btnaf" class="" ><i class="large material-icons" title="Agregar a favoritos">favorite_border</i></button>
                    <?php else: ?>
                        <button name="btnef"  class="" data-toggle="tooltip" title="Eliminar de favoritos"><i class="large material-icons">favorite</i>  </button>
                    <?php endif; ?>
                </div>
            </form>


                <br><br>
                <div class="col-md-12">
		            <h4>Valoracion del libro:</h4>
                    <?php if ($calipr['pro'] == null): ?>
                        <label style="font-size: 20px;" >Aun no hay calificaciones</label>
                    <?php else: ?>
                        <label style="font-size: 20px;" ><?php echo $calipr['pro'] ?> de 5</label>
                    <?php endif; ?>
                    
	            </div><br>


    <div class="cali">
    <h4>tu calificacion:</h4>
    <form method="post">
        <p class="clasificacion">
        <?php if (is_array($cali) == 0): ?>
            <input id="radio1" type="radio" name="estrellas" value="5">
            <label for="radio1">★</label>
            <input id="radio2" type="radio" name="estrellas" value="4">
            <label for="radio2">★</label>
            <input id="radio3" type="radio" name="estrellas" value="3">
            <label for="radio3">★</label>
            <input id="radio4" type="radio" name="estrellas" value="2">
            <label for="radio4">★</label>
            <input id="radio5" type="radio" name="estrellas" value="1">
            <label for="radio5">★</label>

            <?php else: ?>
                
                <?php if ($cali['cali'] == 1 ): ?>
                    <input id="radio1" type="radio" name="edies" value="5" >
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="edies" value="4" >
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="edies" value="3" >
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="edies" value="2" >
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="edies" value="1" checked >
                    <label for="radio5">★</label>

                <?php elseif($cali['cali'] == 2 ): ?>
                    <input id="radio1" type="radio" name="edies" value="5" >
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="edies" value="4">
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="edies" value="3">
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="edies" value="2" checked >
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="edies" value="1">
                    <label for="radio5">★</label>


                <?php elseif($cali['cali'] == 3 ): ?>
                    <input id="radio1" type="radio" name="edies" value="5" >
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="edies" value="4" >
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="edies" value="3" checked >
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="edies" value="2" >
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="edies" value="1">
                    <label for="radio5">★</label>

                <?php elseif($cali['cali'] == 4 ): ?>
                    <input id="radio1" type="radio" name="edies" value="5" >
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="edies" value="4" checked >
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="edies" value="3"  >
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="edies" value="2">
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="edies" value="1" >
                    <label for="radio5">★</label>

                <?php elseif($cali['cali'] == 5 ): ?>
                    <input id="radio1" type="radio" name="edies" value="5" checked >
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="edies" value="4" >
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="edies" value="3"  >
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="edies" value="2" >
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="edies" value="1" >
                    <label for="radio5">★</label>

                <?php else: ?>
                    <input id="radio1" type="radio" name="edies" value="5" >
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="edies" value="4" >
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="edies" value="3"  >
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="edies" value="2">
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="edies" value="1">
                    <label for="radio5">★</label>

                <?php endif; ?>


            <?php endif; ?>
        </p>
        <?php if (is_array($cali) != 1): ?>
            <button id="calif" name="calif" type="submit" class="btn btn-primary">Enviar</button>
        <?php else: ?>
            <button id="edca" name="edca" type="submit" class="btn btn-primary">Editar</button>
        <?php endif; ?>
    </form>
    </div>

                


            <br><br><p><?php echo $results['sinopsis'] ?></p><br><br>
            <p>Autor: <?php echo $results['autor'] ?></p><br>
            <p>Edición: <?php echo $results['edicion'] ?></p><br>
            <p>Fecha de publicación: <?php echo $results['fechala'] ?></p>
        </div>

    </div>
    <div class="divOriginales">
        <h2><?php echo $results['nombre'] ?></h2>
    </div>

    <button class="btnComenzarLectura"><a href="leer.php?id=<?php echo $results['idli'];?>" style="text-decoration:none">Comenzar Lectura</a></button>
    

    


    <div class="seccionComent">
        <h2>Comentarios</h2>

        <form method="post">

            <div class="entrada">
                <img src="../../libros/clientes/<?php echo ($_SESSION["img"]);?>">
                <input type="text" placeholder="Comentarios" name="comen"><br>
                <button type="submit"class="btnComentarios" name="btnLogA">Enviar</button> 
            </div>

        </form>
        

        <div class="comentariosGlobal">

        <?php

            if ($come && $com->rowCount() > 0) {
                foreach ($come as $fila) {
        ?>

            <form method="post">
                <div class="comentarios">
                    <img src="../../libros/clientes/<?php echo ($fila["imgc"]);?>">
                    <h3><?php echo ($fila["username"]); ?></h3><br>
                    <div class="infoComentarios">
                        <p><?php echo ($fila["comen"]); ?></p><br>
                        <span><?php echo ($fila["fecha"]); ?></span>

                        <?php
                            if($_SESSION['user_name'] == $fila["username"]):
                                
                        ?>
    
                        <button  name="btnel"  class="btnel" data-toggle="tooltip" title="Eliminar comentario"><i class="large material-icons">delete</i>  </button>
                        
                        <?php endif; ?>
                        </div>

                    <input type="hidden" name="idc" value="<?php echo ($fila["coid"]); ?>" readonly>
                    
                </div>

            </form>    

            

            
                <?php


            }

            
        }else{
        ?>

                <br><br><br><br><br><br>
                <h2>Este libro aun no tiene comentario</h2>

        <?php
          }
        ?>
          

    </div><br><br>


<?php else: 
?>
    <center>
        <h1>Para leer este Libro tienes que ser premium</h1>
    </center>

<?php endif; ?>

<?php else: 
    header('Location: /biblioteca/php/publico/login.php');
?>

<?php endif; ?>



</body>
</html>

<?php

require 'helpers/footer.php';

?>