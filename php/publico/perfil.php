<?php
session_start();
  require '../database.php';

  $id = $_GET['id'];

  $message = "";

  $mencon = "";

  if (isset($_SESSION['user_id'])) {
    
    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    if(isset($_POST['per'])){
        if (!empty($_POST['user']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) ) {

            $nombrei = $_FILES['archivosubido']['name'];
            $rutai = $_FILES['archivosubido']['tmp_name'];
            $destinoi = "../../libros/clientes/" . $nombrei;
            
            $exis = $conn->prepare('SELECT * FROM clientes WHERE username = :user');
            $exis->bindParam(':user', $_POST['user']);
            $exis->execute();
            $exi = $exis->fetch(PDO::FETCH_ASSOC);
    
            if (is_array($exi) <=  1){
    
                if( $exi == 0){
    
                    $cor = $conn->prepare('SELECT * FROM clientes WHERE correo = :correo');
                    $cor->bindParam(':correo', $_POST['correo']);
                    $cor->execute();
                    $co = $cor->fetch(PDO::FETCH_ASSOC);
    
                    if (is_array($co) <=  1 ){
    
                        if($co == 0){
                            if($_FILES['archivosubido']['name'] != null){
                                $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, imagen = :img where id = :id');
                                $sentencia->bindParam(':id', $id);
                                $sentencia->bindParam(':user', $_POST['user']);
                                $sentencia->bindParam(':nombre', $_POST['nombre']);
                                $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                                $sentencia->bindParam(':emal', $_POST['correo']);
                                $sentencia->bindParam(':img', $nombrei);
                                if(copy($rutai, $destinoi)){
                                    $resultado = $sentencia->execute();
                                    if($resultado === TRUE){
                                        $message = "Cambios guardados";
    
                                        $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                        $records->bindParam(':id', $id);
                                        $records->execute();
                                        $results = $records->fetch(PDO::FETCH_ASSOC);
    
                                        $_SESSION['user_id'] = $results['id'];
                                        $_SESSION['user_name'] = $results['username'];
                                        $_SESSION['correo'] = $results['correo'];
                                        $_SESSION['img'] = $results['imagen'];
                                    } else{
                                        $message =  "Algo salio mal.";
                                    } 
                                } else{
                                    $message = "Error al subir la imagen";
                                }
                                
    
                            } else{
                                $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal where id = :id');
                                $sentencia->bindParam(':id', $id);
                                $sentencia->bindParam(':user', $_POST['user']);
                                $sentencia->bindParam(':nombre', $_POST['nombre']);
                                $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                                $sentencia->bindParam(':emal', $_POST['correo']);
                                $resultado = $sentencia->execute();
                                if($resultado === TRUE){
                                    $message = "Cambios guardados";
    
                                    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                    $records->bindParam(':id', $id);
                                    $records->execute();
                                    $results = $records->fetch(PDO::FETCH_ASSOC);
    
                                    $_SESSION['user_id'] = $results['id'];
                                    $_SESSION['user_name'] = $results['username'];
                                    $_SESSION['correo'] = $results['correo'];
                                    $_SESSION['img'] = $results['imagen'];
                                } else{
                                    $message =  "Algo salio mal.";
                                }
                            }
                            
    
                        } elseif($results['id'] == $co['id']){
                            if($_FILES['archivosubido']['name'] != null){
                                $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, imagen = :img where id = :id');
                                $sentencia->bindParam(':id', $id);
                                $sentencia->bindParam(':user', $_POST['user']);
                                $sentencia->bindParam(':nombre', $_POST['nombre']);
                                $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                                $sentencia->bindParam(':emal', $_POST['correo']);
                                $sentencia->bindParam(':img', $nombrei);
                                if(copy($rutai, $destinoi)){
                                    $resultado = $sentencia->execute();
                                    if($resultado === TRUE){
                                        $message = "Cambios guardados";
    
                                        $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                        $records->bindParam(':id', $id);
                                        $records->execute();
                                        $results = $records->fetch(PDO::FETCH_ASSOC);
    
                                        $_SESSION['user_id'] = $results['id'];
                                        $_SESSION['user_name'] = $results['username'];
                                        $_SESSION['correo'] = $results['correo'];
                                        $_SESSION['img'] = $results['imagen'];
                                    } else{
                                        $message =  "Algo salio mal.";
                                    }
                                } else{
                                    $message = "Error al subir la imagen";
                                }
                                
    
    
                            } else{
                                $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal where id = :id');
                                $sentencia->bindParam(':id', $id);
                                $sentencia->bindParam(':user', $_POST['user']);
                                $sentencia->bindParam(':nombre', $_POST['nombre']);
                                $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                                $sentencia->bindParam(':emal', $_POST['correo']);
                                $resultado = $sentencia->execute();
                                if($resultado === TRUE){
                                    $message = "Cambios guardados";
    
                                    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                    $records->bindParam(':id', $id);
                                    $records->execute();
                                    $results = $records->fetch(PDO::FETCH_ASSOC);
    
                                    $_SESSION['user_id'] = $results['id'];
                                    $_SESSION['user_name'] = $results['username'];
                                    $_SESSION['correo'] = $results['correo'];
                                    $_SESSION['img'] = $results['imagen'];
                                } else{
                                    $message =  "Algo salio mal.";
                                }
                            }
                            
    
                        }else{
                            $message = "Ya existe una cuente con este correo";
                        }
                        
                        
                    
                    } else {
                        $message = "Ya existe una cuente con este correo";
                    }
    
    
    
    
                } elseif($results['id'] == $exi['id']){
                    $cor = $conn->prepare('SELECT * FROM clientes WHERE correo = :correo');
                    $cor->bindParam(':correo', $_POST['correo']);
                    $cor->execute();
                    $co = $cor->fetch(PDO::FETCH_ASSOC);
    
                    if (is_array($co) <=  1 ){
    
                        if($co == 0){
                            if($_FILES['archivosubido']['name'] != null){
                                $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, imagen = :img where id = :id');
                                $sentencia->bindParam(':id', $id);
                                $sentencia->bindParam(':user', $_POST['user']);
                                $sentencia->bindParam(':nombre', $_POST['nombre']);
                                $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                                $sentencia->bindParam(':emal', $_POST['correo']);
                                $sentencia->bindParam(':img', $nombrei);
                                if(copy($rutai, $destinoi)){
                                    $resultado = $sentencia->execute();
                                    if($resultado === TRUE){
                                        $message = "Cambios guardados";
    
                                        $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                        $records->bindParam(':id', $id);
                                        $records->execute();
                                        $results = $records->fetch(PDO::FETCH_ASSOC);
    
                                        $_SESSION['user_id'] = $results['id'];
                                        $_SESSION['user_name'] = $results['username'];
                                        $_SESSION['correo'] = $results['correo'];
                                        $_SESSION['img'] = $results['imagen'];
                                    } else{
                                        $message =  "Algo salio mal.";
                                    }
                                } else{
                                    $message = "Error al subir la imagen";
                                }
                                
                            } else{
                                $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal where id = :id');
                                $sentencia->bindParam(':id', $id);
                                $sentencia->bindParam(':user', $_POST['user']);
                                $sentencia->bindParam(':nombre', $_POST['nombre']);
                                $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                                $sentencia->bindParam(':emal', $_POST['correo']);
                                $resultado = $sentencia->execute();
                                if($resultado === TRUE){
                                    $message = "Cambios guardados";
    
                                    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                    $records->bindParam(':id', $id);
                                    $records->execute();
                                    $results = $records->fetch(PDO::FETCH_ASSOC);
    
                                    $_SESSION['user_id'] = $results['id'];
                                    $_SESSION['user_name'] = $results['username'];
                                    $_SESSION['correo'] = $results['correo'];
                                    $_SESSION['img'] = $results['imagen'];
                                } else{
                                    $message =  "Algo salio mal.";
                                }
                            }
                            
    
                        } elseif($results['id'] == $co['id']){
    
                            if($_FILES['archivosubido']['name'] != null){
                                $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal, imagen = :img where id = :id');
                                $sentencia->bindParam(':id', $id);
                                $sentencia->bindParam(':user', $_POST['user']);
                                $sentencia->bindParam(':nombre', $_POST['nombre']);
                                $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                                $sentencia->bindParam(':emal', $_POST['correo']);
                                $sentencia->bindParam(':img', $nombrei);
    
                                if(copy($rutai, $destinoi)){
                                    $resultado = $sentencia->execute();
                                    if($resultado === TRUE){
                                        $message = "Cambios guardados";
    
                                        $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                        $records->bindParam(':id', $id);
                                        $records->execute();
                                        $results = $records->fetch(PDO::FETCH_ASSOC);
    
                                        $_SESSION['user_id'] = $results['id'];
                                        $_SESSION['user_name'] = $results['username'];
                                        $_SESSION['correo'] = $results['correo'];
                                        $_SESSION['img'] = $results['imagen'];
                                    } else{
                                        $message =  "Algo salio mal.";
                                    }
                                }
    
                                
                            } else{
                                $sentencia = $conn->prepare('UPDATE clientes set username = :user, nombre = :nombre, apellidos = :apellidos, correo = :emal where id = :id');
                                $sentencia->bindParam(':id', $id);
                                $sentencia->bindParam(':user', $_POST['user']);
                                $sentencia->bindParam(':nombre', $_POST['nombre']);
                                $sentencia->bindParam(':apellidos', $_POST['apellidos']);
                                $sentencia->bindParam(':emal', $_POST['correo']);
                                $resultado = $sentencia->execute();
                                if($resultado === TRUE){
                                    $message = "Cambios guardados";
    
                                    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
                                    $records->bindParam(':id', $id);
                                    $records->execute();
                                    $results = $records->fetch(PDO::FETCH_ASSOC);
    
                                    $_SESSION['user_id'] = $results['id'];
                                    $_SESSION['user_name'] = $results['username'];
                                    $_SESSION['correo'] = $results['correo'];
                                    $_SESSION['img'] = $results['imagen'];
                                } else{
                                    $message =  "Algo salio mal.";
                                }
                            }
    
                            
    
                        }else{
                            $message = "Ya existe una cuente con este correo";
                        }
                        
                        
                    
                    } else {
                        $message = "Ya existe una cuente con este correo";
                    }
    
    
    
                }else{
                    $message = "Ya existe una cuente con este nombre de usuario";
                }
                
    
            } else{
                $message = "Ya existe una cuente con este nombre de usuario";
            }
    
            
        }
    }

    
        
    
    if($message != ''){
        $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
        $records->bindParam(':id', $id);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
    }



  }


  if(isset($_POST['contra'])){
    $recordsc = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
    $recordsc->bindParam(':id', $id);
    $recordsc->execute();
    $resultsc = $recordsc->fetch(PDO::FETCH_ASSOC);

    if (!empty($_POST['contraan']) && !empty($_POST['contra1']) && !empty($_POST['contra2']) ) {

        if(password_verify($_POST['contraan'], $resultsc['contra'])){
            if($_POST['contra1'] == $_POST['contra2']){
                if($_POST['contraan'] != $_POST['contra1']){
                    $sentencia = $conn->prepare('UPDATE clientes set contra = :contra where id = :id');
                    $sentencia->bindParam(':id', $id);
                    $password = password_hash($_POST['contra1'], PASSWORD_BCRYPT);
                    $sentencia->bindParam(':contra', $password);
                    $resultado = $sentencia->execute();
                    if($resultado === TRUE) $mencon = "Contraseña actualizada correctamente";
                    else $mencon =  "Algo salio mal.";
                } else{
                    $mencon = "La nueva contraseña es igual que la anterior";
                }
            } else{
                $mencon = "Las contraseñas no son iguales";
            }
        } else{
            $mencon = "La contraseña es incorrecta";
        }



        
    } 
  }

  if($mencon != ''){
    $records = $conn->prepare('SELECT * FROM clientes WHERE id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

}

if(isset($_POST['enviar'])){
    $nom = $_POST['buscador'];
    header('Location: /biblioteca/php/publico/buscar.php?nombre='.urlencode($nom));
  }

    
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="helpers/css/perfil.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Perfil</title>
</head>
<body>

<?php if(isset($_SESSION['user_id'])): ?>
<?php if($_SESSION['user_id'] == $id): ?>

<style>
.headerMenu{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}
.Header{
    font-weight: bolder;
    width:100%;
    padding: 30px;
    color:#ffffff;
    display:flex;
    flex-wrap:wrap;
    justify-content:space-evenly;
    position:fixed;
    top:0;
    left:0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #fff;
}
a{
    color: #18191f;
}
.active{
    background: #ffffff;
}

.Header a{
    padding: 20px 20px;
    text-decoration:none;
}

.Header input{
    border:none;
    padding:5px;
    border-bottom:2px solid #18191f;
    margin-left:0px;

}

.Header input:focus{
    outline: none;
    border-bottom:2px solid #8c30f5;
}


  /*=================================================*/

#headerMenu{
    padding-top: 10px;
    margin-left: -80px;
}
.headerMenu a{
    color: #000;
}


.btnMenuHeader{
    color: #18191f;
}

.btnMenuHeader:hover{
    border-bottom:1px solid #8c30f5;
    transition: 0.5s all ease;
}



  /*=================================================*/

#header_menu-btn{
    border-radius: 10px;
    padding-top: 200px;
    border: #000;
    padding-top: 15px;
}
.header_menu-btn a{ 
    margin-left:10px;
    padding:0px 0px;
}

.btnPremium{
    background-color: #fff;
    color: #2273A3;
    border-radius: 10px;
    border:solid 1px #2273A3;
  }

.btnCerrar{
    background-color: #2273A3;
    color: #fff;
    border-radius: 0px;
  }


/*===================MAIN==========================*/
.contenedorFondo{
    background: fixed no-repeat 50% 50%;
    background-size:cover; 
    background-image:url('../completoFondo.png');
    width: 100%;
    height: 900px;
  }
  
  .contenedorFondo img{
      display: none;
      
  }

  .contenedorPremium{
    width:100%;
    display: flex;
    justify-content:center ;
    align-items: center;
    
    padding:20px 0;
    flex-wrap:wrap;
  }


.contenedorPremium img{
    padding-top: 20px;
    width: 200px;
}

.contenedorCard{
    background: #FFFFFF;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
    margin-right: 20px;
    margin: 10px;
    text-align: center;
    width: 400px;
    padding-bottom: 20px;
}

.contenedorCard img{
    width: 350px;
    height: 250px;
}

.contenedorCard p{
    font-style: normal;
    font-weight: 700;
    font-size: 20px;
    line-height: 100%;
    margin: 10px 0;
}
.contenedorCard button{
    border: none;
    background: #8C30F5;
    color: #ffffff;
    width: 103.18px;
    height: 29px;
    border-radius: 3px;
    cursor: pointer;

}


.contenedorOriginales{
    margin: 0 auto;
    width: 80%;

    padding: 0 10%;
    display: grid;
    grid-template-columns: repeat(4,1fr);
    row-gap: 30px;
}

.contenedorOriginales img{
    width: 250px;
    height: 302px;
}


.ContenedorCategorias{
    width:100%;
    display:inline;
    grid-template-columns: repeat(2, 1fr);
    width:70%;
    margin:40px auto;
}

.contenedorLinks{
    text-align: center;
    display:inline;
    grid-template-rows:  repeat(2, 1fr);
    row-gap: 40px;
}

.contenedorLinks a{
    border: none;
    background: #8C30F5;
    color: #ffffff;
    width: 103.18px;
    height: 29px;
    border-radius: 3px;
}

.contenedorCard button{
    border: none;
    background: #9e9ba2;
    color: #ffffff;
    width: 60px;
    height: 35px;
    border-radius: 3px;
    cursor: context-menu;

}


.ContenedorLinksSec{
    text-align:center;
    display:grid;
    grid-template-rows:  repeat(2, 1fr);
    row-gap: 40px;
}

.ContenedorLinksSec a{
    background: #A5A6F6;
    box-shadow: 0px 4px 11px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    padding:20px;
    width:50%;
    margin: 0 auto; 
    text-decoration:none;
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
    line-height: 196.19%;
    color: #241400;
}


/*******************FOOTER*****************/

.contenedorFooter{
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 96px 35px;
    width: 100%;
    height: auto;
    margin-top:100px;
    justify-content:center;
    max-width: 2833px;
    background: #0B0D17;
}
.contenedorFooter p{
    color:#fff;
}
.contenedorSoporte{
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    padding:0 300px;
    color:#D6B1FF;
}

.contenedorSoporte a{
    color:#EEEFF4;
    text-decoration:none;
    padding:20px 0px;
}
.contenedorSoporte h4{
    color: #D6B1FF;
}

@media screen and (max-width: 414px){
    .contenedorFooter{
        padding: 96px 0;
        flex-direction: column;
    }
    .contenedorSoporte{
        padding: 0px 0px;
        margin-top:40px;
        width: 100%;
    }

  }


.btnren{
    border-radius: 10px;
}

.lupa{
    color: #8c30f5;
    width: 50px;
    height: 50px;
    border-radius: 50%;
}


.vermas{
    border: none;
    background: #8C30F5;
    color: #ffffff;
    height: 29px;
    cursor: pointer;
    
    box-shadow: 0px 4px 11px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    padding:10px;
    width:50%;
    margin: 0 auto; 
    text-decoration:none;
    font-style: normal;
    font-weight: bold;
    font-size: 16px;
    line-height: 196.19%;
}

.contenedorPremium img{
    padding-top: 20px;
    width: 200px;
    height: 300px;
}

.contenedorCardc{
    background: #FFFFFF;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
    margin-right: 20px;
    margin: 10px;
    text-align: center;
    width: 400px;
    padding-bottom: 20px;
}

.contenedorCardc img{
    width: 350px;
    height: 250px;
}

.contenedorCardc p{
    font-style: normal;
    font-weight: 700;
    font-size: 20px;
    line-height: 100%;
    margin: 10px 0;
}
.contenedorCardc button{
    border: none;
    background: #8C30F5;
    color: #ffffff;
    width: 103.18px;
    height: 29px;
    border-radius: 3px;
    cursor: pointer;

}

.contenedorCard{
    background: #FFFFFF;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
    margin-right: 20px;
    text-align: center;
    width: 300px;
    padding-bottom: 20px;
}


.btnpr{
    border: none;
    background: #8C30F5;
    color: #ffffff;
    height: 80px;
    cursor: pointer;
    
    box-shadow: 0px 4px 11px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    padding:10px;
    width:25%;
    margin: 0 auto; 
    text-decoration:none;
    font-style: normal;
    font-weight: bold;
    font-size: 30px;
    line-height: 196.19%;

    margin-right: 0%;
    margin-top: 5%;

    
}





    .icon{
    margin-left: 90%;
}

.alert {
  padding: 20px;
  background-color: #673ab7 ; /* Red */
  color: white;
  margin-bottom: 15px;
}

.alerte {
  padding: 20px;
  background-color: #673ab7 ; /* Red */
  color: white;
  margin-bottom: 15px;
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}

.alert {
  opacity: 1;
  transition: opacity 0.6s; /* 600ms to fade out */
}

.alerte {
  opacity: 1;
  transition: opacity 0.6s; /* 600ms to fade out */
}

.men{
    margin-left:5%;
}


    .btnbu{
        border: none;
        background: #fff;
        color: #8C30F5;
        width: 40px;
        height: 29px;
        border-radius: 3px;
        cursor: pointer;
}

.enlace{
    position: absolute;
    padding: 20px 50px;
}

nav ul{
    float: left;
    margin-right: 20px;
}
nav ul li{
    display: inline-block;
    margin: 0 5px;
}
  

.checkbtn{
    font-size: 30px;
    color: #fff;
    float: right;

    cursor: pointer;
    display: none;
}
#check{
    display: none;
}
section{
    background: url(fondo.jpg) no-repeat;
    background-size: cover;
    background-position: center center;
    height: calc(100vh - 80px);
}

@media (max-width: 952px){
    .enlace{
        padding-left: 20px;
    }
    nav ul li a{
        font-size: 16px;
    }
}

@media (max-width: 858px){
    .checkbtn{
        display: block;
    }
    ul{
        position: fixed;
        width: 100%;
        height: 100vh;
        background: #fff;
        top: 155px;
        left: -100%;
        text-align: center;
        transition: all .5s;
    }
    nav ul li{
        display: block;
        margin: 50px 0;
        line-height: 30px;
        text-align: justify;
        border-bottom: 1px solid grey;
        
    }
    nav ul li a{
        font-size: 20px;
        
        
        
    }
    li a:hover, li a.active{
        background: none;
        color: red;
    }
    #check:checked ~ ul{
        left:0;
    }

    .btnbu{
        border: none;
        background: #fff;
        color: #8C30F5;
        width: 40px;
        height: 29px;
        border-radius: 3px;
        cursor: pointer;
}

#header_menu-btn{
    padding-top: 30px;
}

    
}

.material-icons{
  color:blue;
}

</style>
<br><br><br>

<header class="Header">
        <svg width="180" height="44" viewBox="0 0 180 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M57.56 29.288C56.54 29.288 55.598 29.132 54.734 28.82C53.882 28.496 53.138 28.04 52.502 27.452C51.878 26.864 51.392 26.168 51.044 25.364C50.696 24.56 50.522 23.672 50.522 22.7C50.522 21.728 50.696 20.84 51.044 20.036C51.392 19.232 51.884 18.536 52.52 17.948C53.156 17.36 53.906 16.91 54.77 16.598C55.646 16.274 56.606 16.112 57.65 16.112C58.898 16.112 60.008 16.322 60.98 16.742C61.964 17.162 62.774 17.762 63.41 18.542L60.692 20.936C60.296 20.48 59.864 20.138 59.396 19.91C58.94 19.67 58.43 19.55 57.866 19.55C57.398 19.55 56.972 19.622 56.588 19.766C56.216 19.91 55.898 20.12 55.634 20.396C55.37 20.672 55.166 21.002 55.022 21.386C54.878 21.77 54.806 22.208 54.806 22.7C54.806 23.168 54.878 23.6 55.022 23.996C55.166 24.38 55.37 24.71 55.634 24.986C55.898 25.262 56.21 25.478 56.57 25.634C56.942 25.778 57.356 25.85 57.812 25.85C58.292 25.85 58.76 25.772 59.216 25.616C59.672 25.448 60.158 25.166 60.674 24.77L63.05 27.686C62.282 28.202 61.406 28.598 60.422 28.874C59.438 29.15 58.484 29.288 57.56 29.288ZM59.36 27.146V22.358H63.05V27.686L59.36 27.146ZM70.17 29.18C68.97 29.18 67.92 28.958 67.02 28.514C66.132 28.07 65.442 27.464 64.95 26.696C64.458 25.916 64.212 25.04 64.212 24.068C64.212 23.072 64.452 22.19 64.932 21.422C65.424 20.654 66.09 20.054 66.93 19.622C67.782 19.19 68.736 18.974 69.792 18.974C70.764 18.974 71.658 19.166 72.474 19.55C73.302 19.934 73.962 20.504 74.454 21.26C74.958 22.016 75.21 22.952 75.21 24.068C75.21 24.212 75.204 24.374 75.192 24.554C75.18 24.722 75.168 24.878 75.156 25.022H67.578V23.06H72.996L71.466 23.582C71.466 23.198 71.394 22.874 71.25 22.61C71.118 22.334 70.932 22.124 70.692 21.98C70.452 21.824 70.164 21.746 69.828 21.746C69.492 21.746 69.198 21.824 68.946 21.98C68.706 22.124 68.52 22.334 68.388 22.61C68.256 22.874 68.19 23.198 68.19 23.582V24.194C68.19 24.614 68.274 24.974 68.442 25.274C68.61 25.574 68.85 25.802 69.162 25.958C69.474 26.102 69.852 26.174 70.296 26.174C70.752 26.174 71.124 26.114 71.412 25.994C71.712 25.874 72.024 25.694 72.348 25.454L74.472 27.596C73.992 28.112 73.398 28.508 72.69 28.784C71.994 29.048 71.154 29.18 70.17 29.18ZM81.9298 29.18C80.7298 29.18 79.6798 28.958 78.7798 28.514C77.8918 28.07 77.2018 27.464 76.7098 26.696C76.2178 25.916 75.9718 25.04 75.9718 24.068C75.9718 23.072 76.2118 22.19 76.6918 21.422C77.1838 20.654 77.8498 20.054 78.6898 19.622C79.5418 19.19 80.4958 18.974 81.5518 18.974C82.5238 18.974 83.4178 19.166 84.2338 19.55C85.0618 19.934 85.7218 20.504 86.2138 21.26C86.7178 22.016 86.9698 22.952 86.9698 24.068C86.9698 24.212 86.9638 24.374 86.9518 24.554C86.9398 24.722 86.9278 24.878 86.9158 25.022H79.3378V23.06H84.7558L83.2258 23.582C83.2258 23.198 83.1538 22.874 83.0098 22.61C82.8778 22.334 82.6918 22.124 82.4518 21.98C82.2118 21.824 81.9238 21.746 81.5878 21.746C81.2518 21.746 80.9578 21.824 80.7058 21.98C80.4658 22.124 80.2798 22.334 80.1478 22.61C80.0158 22.874 79.9498 23.198 79.9498 23.582V24.194C79.9498 24.614 80.0338 24.974 80.2018 25.274C80.3698 25.574 80.6098 25.802 80.9218 25.958C81.2338 26.102 81.6118 26.174 82.0558 26.174C82.5118 26.174 82.8838 26.114 83.1718 25.994C83.4718 25.874 83.7838 25.694 84.1078 25.454L86.2318 27.596C85.7518 28.112 85.1578 28.508 84.4498 28.784C83.7538 29.048 82.9138 29.18 81.9298 29.18ZM91.6555 27.38L91.7455 22.592L95.1475 19.154H99.9535L95.4535 23.87L93.4195 25.508L91.6555 27.38ZM88.2535 29V15.644H92.3215V29H88.2535ZM95.3635 29L92.6635 25.58L95.1655 22.502L100.278 29H95.3635ZM104.123 29V19.694H100.433V16.4H112.061V19.694H108.371V29H104.123ZM117.49 29.18C116.29 29.18 115.24 28.958 114.34 28.514C113.452 28.07 112.762 27.464 112.27 26.696C111.778 25.916 111.532 25.04 111.532 24.068C111.532 23.072 111.772 22.19 112.252 21.422C112.744 20.654 113.41 20.054 114.25 19.622C115.102 19.19 116.056 18.974 117.112 18.974C118.084 18.974 118.978 19.166 119.794 19.55C120.622 19.934 121.282 20.504 121.774 21.26C122.278 22.016 122.53 22.952 122.53 24.068C122.53 24.212 122.524 24.374 122.512 24.554C122.5 24.722 122.488 24.878 122.476 25.022H114.898V23.06H120.316L118.786 23.582C118.786 23.198 118.714 22.874 118.57 22.61C118.438 22.334 118.252 22.124 118.012 21.98C117.772 21.824 117.484 21.746 117.148 21.746C116.812 21.746 116.518 21.824 116.266 21.98C116.026 22.124 115.84 22.334 115.708 22.61C115.576 22.874 115.51 23.198 115.51 23.582V24.194C115.51 24.614 115.594 24.974 115.762 25.274C115.93 25.574 116.17 25.802 116.482 25.958C116.794 26.102 117.172 26.174 117.616 26.174C118.072 26.174 118.444 26.114 118.732 25.994C119.032 25.874 119.344 25.694 119.668 25.454L121.792 27.596C121.312 28.112 120.718 28.508 120.01 28.784C119.314 29.048 118.474 29.18 117.49 29.18ZM129.106 29.18C127.978 29.18 126.976 28.964 126.1 28.532C125.224 28.1 124.534 27.5 124.03 26.732C123.538 25.952 123.292 25.064 123.292 24.068C123.292 23.072 123.538 22.19 124.03 21.422C124.534 20.654 125.224 20.054 126.1 19.622C126.976 19.19 127.978 18.974 129.106 18.974C130.306 18.974 131.332 19.232 132.184 19.748C133.036 20.264 133.624 20.978 133.948 21.89L130.798 23.438C130.594 22.982 130.342 22.652 130.042 22.448C129.754 22.244 129.436 22.142 129.088 22.142C128.788 22.142 128.506 22.214 128.242 22.358C127.99 22.502 127.786 22.718 127.63 23.006C127.486 23.282 127.414 23.636 127.414 24.068C127.414 24.5 127.486 24.86 127.63 25.148C127.786 25.436 127.99 25.652 128.242 25.796C128.506 25.94 128.788 26.012 129.088 26.012C129.436 26.012 129.754 25.91 130.042 25.706C130.342 25.502 130.594 25.172 130.798 24.716L133.948 26.264C133.624 27.176 133.036 27.89 132.184 28.406C131.332 28.922 130.306 29.18 129.106 29.18ZM141.728 18.974C142.484 18.974 143.168 19.13 143.78 19.442C144.392 19.742 144.872 20.216 145.22 20.864C145.58 21.512 145.76 22.352 145.76 23.384V29H141.692V24.086C141.692 23.474 141.584 23.042 141.368 22.79C141.152 22.526 140.858 22.394 140.486 22.394C140.21 22.394 139.952 22.46 139.712 22.592C139.484 22.712 139.298 22.916 139.154 23.204C139.022 23.492 138.956 23.882 138.956 24.374V29H134.888V15.644H138.956V22.034L137.984 21.206C138.368 20.462 138.884 19.904 139.532 19.532C140.192 19.16 140.924 18.974 141.728 18.974Z" fill="#2273A3"/>
            <g clip-path="url(#clip0_3_195)">
                <path d="M39.0037 15.8451C38.8339 14.556 38.81 12.3356 39.9958 11.59C40.017 11.5763 40.0328 11.5566 40.0514 11.5396C41.0209 11.2265 41.6919 10.7871 41.1652 10.1958L26.8633 5.84467L3.70522 9.09562C3.70522 9.09562 1.05333 9.47834 1.29023 13.6384C1.41883 15.9026 2.12213 17.0145 2.73719 17.5618L0.836863 18.14C0.309419 18.7313 0.980256 19.1709 1.94991 19.4835C1.96834 19.5009 1.98388 19.5205 2.00544 19.5342C3.19056 20.2804 3.16775 22.5005 2.99728 23.7899C-1.26025 25.0106 0.268056 25.4084 0.268056 25.4084L1.20199 25.6366C0.545065 26.236 -0.107347 27.3726 0.0148627 29.5283C0.251887 33.6876 2.4301 33.9746 2.4301 33.9746L17.5846 38.9482L40.4585 33.354C40.4585 33.354 41.9873 32.9556 37.7286 31.7348C37.5574 30.4474 37.5336 28.2275 38.7215 27.4794C38.7433 27.4661 38.7592 27.446 38.7769 27.4293C39.7465 27.1162 40.4169 26.6772 39.89 26.0859L38.8958 25.7828C39.5589 25.379 40.5549 24.3239 40.7109 21.5831C40.8186 19.6979 40.3315 18.5937 39.7677 17.9437L41.7328 17.4636C41.733 17.4643 43.2618 17.0659 39.0037 15.8451ZM19.8711 15.7918L23.7176 14.9936L36.7167 12.2963L38.6534 11.8941C38.0346 13.0377 38.0605 14.6028 38.1629 15.6087C38.1854 15.8362 38.2112 16.0441 38.2363 16.202L36.1165 16.7342L19.7094 20.8554L19.8711 15.7918ZM3.34799 19.8396L5.28442 20.2418L17.7682 22.833L18.8588 23.0585L22.1294 23.7373L22.2907 28.801L5.42781 24.5649L3.76538 24.1477C3.78982 23.9895 3.81565 23.782 3.83908 23.5538C3.94086 22.5486 3.96731 20.9832 3.34799 19.8396ZM2.59568 13.4382C2.57224 12.3317 2.76753 11.5314 3.16223 11.1246C3.41342 10.8649 3.70986 10.8109 3.91316 10.8109C4.02058 10.8109 4.09792 10.826 4.10318 10.826L14.0814 14.1106L19.0596 15.7494L18.8963 20.8484L4.93032 16.8949L4.1933 16.6865C4.16623 16.6787 4.1295 16.6734 4.10118 16.6722C4.04364 16.668 2.66286 16.5397 2.59568 13.4382ZM17.6207 36.7391L2.91806 32.577C2.89086 32.5691 2.85451 32.5637 2.82619 32.5623C2.76765 32.5584 1.38624 32.4302 1.31943 29.3295C1.29562 28.2216 1.49191 27.4221 1.88586 27.0149C2.13768 26.7552 2.43424 26.7012 2.63717 26.7012C2.74484 26.7012 2.82192 26.7158 2.82756 26.7158L17.783 31.64L17.6207 36.7391ZM36.8866 31.4986C36.9098 31.7269 36.9356 31.9344 36.9607 32.0926L18.4334 36.7463L18.5954 31.6826L22.5563 30.8604L23.1413 31.0032L25.3338 30.2838L35.4404 28.1868L37.3778 27.7843C36.7584 28.9278 36.784 30.4935 36.8866 31.4986ZM37.9071 24.6169C37.8734 24.6176 37.8397 24.6222 37.808 24.6323L36.4106 25.0273L23.1057 28.7943L22.943 23.6953L27.3082 22.2577L37.878 18.7771C37.8794 18.7765 38.4341 18.6521 38.8412 19.0701C39.2353 19.4769 39.4308 20.2771 39.4077 21.3836C39.3388 24.4841 37.9574 24.613 37.9071 24.6169Z" fill="#2273A3"/>
            </g>
            <defs>
                <clipPath id="clip0_3_195">
                    <rect width="42" height="42.4078" fill="white" transform="translate(0 0.796112)"/>
                </clipPath>
            </defs>
        </svg>


            


        <form action="" method="get">

          <div id="headerMenu">

            <nav>
              <input type="checkbox" id="check">
              <label for="check" class="checkbtn">
                <i class="material-icons ">menu</i>
              </label>

              <ul>
                <li><a href="index2.php" class="btnMenuHeader" >Inicio</a></li>
                <li><a href="libros.php" class="btnMenuHeader" >Recursos bibliográficos</a></li>
                <li><a href="categorias.php" class="btnMenuHeader">Categorías</a></li>
                <li><a href="favoritos.php" class="btnMenuHeader">Repositorio </a></li>
                <li><a href="premium.php" class="btnMenuHeader">Premium</a></li>
                <input type="text" name="buscador" placeholder='Buscar'>
        
        
                <button class="btnbu" name="enviar" title="Tiene que ser premium para leer este libro"><i class="material-icons ">search</i>  </button>
              </ul>
            </nav>

            
            
            
            
            
        
            

          </div>

        </form>



      <div id="header_menu-btn">

        <?php

          if($_SESSION['tipo'] == 0){

        ?>

          <a href="pagar.php" class="btnPremium">Probar Premium</a>

        <?php
          }
        ?>


        <a href="perfil.php?id=<?php echo $_SESSION['user_id']; ?>" class="btnCerrar btnren">Perfil</a>



        <a href="logout.php" class="btnCerrar btnren">Logout</a><br><br>





      </div>


</header>
<br><br><br><br>

    <div class="contenedor">
        <div class="backgroun-profile">

        </div><br><br><br><br><br>

        <?php if(!empty($message)): ?>

<div class="container men">

    <?php

        if($message == 'Cambios guardados'){



    ?>

    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?= $message ?>
    </div>

    <?php
        } else{

    ?>

    <div class="alerte">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?= $message ?>
    </div>

    <?php } ?>



    
</div>






<?php endif; ?>


<?php if(!empty($mencon)): ?>

<div class="container men">

    <?php

        if($mencon == 'Contraseña actualizada correctamente'){



    ?>

    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?= $mencon ?>
    </div>

    <?php
        } else{

    ?>

    <div class="alerte">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?= $mencon ?>
    </div>

    <?php } ?>



    
</div>






<?php endif; ?>

        <div class="profilePicure">
            <img src="../../libros/clientes/<?php echo ($results["imagen"]);?>"><br><br><br><br><br><br><br>
            <h2>Perfil</h2><br>
        </div>
       
        
        <div class="informacion">


        <form method="post" enctype="multipart/form-data">
            <div class="archivo">
                <h3>Editar perfil</h3>
                <div class="entradas">
                    <br><h5>Nombre de usuario</h5>
                    <input type="text" class="entradasTexto" name="user" value="<?php echo $results['username'] ?>" required style="font-size: 25px;">
                    <h5>Nombres</h5>
                    <input type="text" class="entradasTexto" name="nombre" value="<?php echo $results['nombre'] ?>" required required style="font-size: 25px;">
                    <h5>Apellidos</h5>
                    <input type="text" class="entradasTexto" name="apellidos" value="<?php echo $results['apellidos'] ?>" required required style="font-size: 25px;">
                    <h5>Correo</h5>
                    <input type="text" class="entradasTexto" name="correo" value="<?php echo $results['correo'] ?>" required required style="font-size: 25px;">

                    <h5>Foto</h5>
                    <input type="file" class="SubirArchivo" name="archivosubido">
                    <Button type="submit" class="enviarArchivo" name="per">Editar Pefil</Button>
                </div><br><br>
        </form>
            


        <form method="post" enctype="multipart/form-data">
        <div class="archivo">
                <h3>Editar contraseña</h3>
                <div class="entradas">
                    <br><h5>Contraseña actual:</h5>
                    <input type="password" class="entradasTexto" name="contraan" required>
                    <h5>Nueva contraseña:</h5>
                    <input type="password" class="entradasTexto" name="contra1" required>
                    <h5>Confirmar contraseña:</h5>
                    <input type="password" class="entradasTexto" name="contra2" required>

                    <Button type="submit" class="enviarArchivo" name="contra">Editar contraseña</Button>
                </div>

            </div>
        </form>
                

        </div>
    </div>
        </div>



</body>
</html>


<?php else: 
    header('Location: /biblioteca/php/publico/index2.php');
?>
<?php endif; ?>

<?php else: 
    header('Location: /biblioteca/php/publico/login.php');
?>

<?php endif; ?>

<?php

require 'helpers/footer.php';

?>
