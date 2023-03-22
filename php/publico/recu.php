<?php

require '../database.php';

$comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pass = array(); 
$combLen = strlen($comb) - 1; 
 for ($i = 0; $i < 8; $i++) {
     $n = rand(0, $combLen);
     $pass[] = $comb[$n];
 }
 //print(implode($pass));

$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: GeekTech <miguelgr1019@gmail.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if(isset($_POST['btnEn'])){

    $records = $conn->prepare('SELECT id, username, correo, contra, tipo, inten, ban FROM clientes WHERE correo = :correo');
    $records->bindParam(':correo', $_POST['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if(is_array($results) > 0){

        $sentencia = $conn->prepare('UPDATE clientes set contra = :contra where correo = :correo');
        $sentencia->bindParam(':correo', $_POST['correo']);
        $password = password_hash(implode($pass), PASSWORD_BCRYPT);
        $sentencia->bindParam(':contra', $password);
        $resultado = $sentencia->execute();
        if($resultado === TRUE){
            $corre = $_POST['correo'];
            $con = implode($pass);
            $asu = "Nueva contraseña de GeekTech";

            $res = mail($corre,$asu,$con, $headers);

            if($res){
                $mes2 = "Se ha enviado un correo con su nueva contraseña";
                $message = "Contraseña actualizada correctamente, se ha envia un correo con  la nueva contraseña";
            } else{
                $mes2 = "Error al enviar el correo";
            }

            

        } else{
            $message =  "Algo salio mal.";
        } 


        

    } else{
        $message ="No ay ningun usuario con este correo";
    }
    

}

?>
<?php if(!empty($_SESSION)): 
header('Location: /biblioteca/php/publico/index2.php');
?>

<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- Compiled and minified CSS -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

       <!-- Compiled and minified JavaScript -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Iniciar Sesion</title>
</head>
<body>

<style>
    *{
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
    max-width: 1800px;
    position:fixed;
    top:0;
    left:0;
    font-family: Arial, Helvetica, sans-serif;
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
    margin-left: -150px;
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
    background-color: #f1e4ff;
    color: #8c30f5;
    border-radius: 10px;
  }

.btnCerrar{
    background-color: #8c30f5;
    color: #f1e4ff;
    border-radius: 10px;
  }

/**********************LOGO******************************/
img{
    height: 60px;
}




/*****************************MAIN**************************/
.login{
    margin-top: 5%;
    background-color: black;
    display: inline-table;
    justify-content: center;
    align-items: center;
    padding: 5%;
    border-radius: 10%;
    width: 40%;
}

.input{
    display: flex;
    justify-content: center;
    padding: 10px 5px 10px 5px;
    border-radius: 4px;
    transition: 0.2s ease-out;
    color: darken(#EDEDED, 30%);
    align-items: center;
    width: 100%;
}

.legend{
    background: #8C30F5;
    color:white;
    padding: 4%;
    margin: 10% auto;
    border-radius: 10px;
    width: 100%;
}

.controls{
    width: 100%;
    background: black;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 16px;
    border: 1px solid #8C30F5;
    font-size: 18px;
    color: white;
}

.sumit{
    background: #8C30F5;
    color:white;
    padding: 10px 50px;
    width: 30%;
    border-radius: 10px;
    width: 30%;
    text-decoration: none;
}



p{
    color: #8c30f5;
    padding-top: 10%;
}
a{
    color: #8C30F5;
}

@media (max-width:414px) {
    .login{
        width: 80%;

    }
    .legend{
        text-align: center;
    }
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
  background-color: #2273A3 ; /* Red */
  color: white;
  margin-bottom: 15px;
  margin-left: 30%;
  margin-top: 5%;
  
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


.sumitb{
    background: #8C30F5;
    color:white;
    padding: 10px 50px;
    width: 30%;
    border-radius: 10px;
    width: 30%;
    text-decoration: none;
}

.btnsend{
    border: none;
    background: #2273A3;
    color: #ffffff;
    cursor: pointer;
    
    box-shadow: 0px 4px 11px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    padding:10px;
    width:200px;
    margin: 0 auto; 
    text-decoration:none;
    font-style: normal;
    font-weight: bold;
    font-size: 16px;
    line-height: 196.19%;
    text-align: center;

    line-height: 20px;

    margin-right: 0%;
    margin-top: 5%;

    
}


</style>



<header>
    <nav class="black">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo center logo"><img src="./helpers/logo.png" alt=""></a>
          <center>
          <svg  width="580" height="60" viewBox="0 0 180 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M59.36 22.358H63.05V27.686C62.306 28.202 61.442 28.598 60.458 28.874C59.474 29.15 58.508 29.288 57.56 29.288C56.216 29.288 55.01 29.012 53.942 28.46C52.874 27.896 52.034 27.116 51.422 26.12C50.822 25.112 50.522 23.972 50.522 22.7C50.522 21.428 50.822 20.294 51.422 19.298C52.034 18.29 52.88 17.51 53.96 16.958C55.052 16.394 56.282 16.112 57.65 16.112C58.886 16.112 59.99 16.322 60.962 16.742C61.946 17.15 62.762 17.75 63.41 18.542L60.692 20.936C59.9 20.012 58.958 19.55 57.866 19.55C56.93 19.55 56.186 19.832 55.634 20.396C55.082 20.96 54.806 21.728 54.806 22.7C54.806 23.648 55.076 24.41 55.616 24.986C56.168 25.562 56.9 25.85 57.812 25.85C58.352 25.85 58.868 25.748 59.36 25.544V22.358ZM75.21 24.068C75.21 24.128 75.192 24.446 75.156 25.022H68.316C68.46 25.394 68.7 25.682 69.036 25.886C69.372 26.078 69.792 26.174 70.296 26.174C70.728 26.174 71.088 26.12 71.376 26.012C71.676 25.904 72 25.718 72.348 25.454L74.472 27.596C73.512 28.652 72.078 29.18 70.17 29.18C68.982 29.18 67.938 28.964 67.038 28.532C66.138 28.088 65.442 27.476 64.95 26.696C64.458 25.916 64.212 25.04 64.212 24.068C64.212 23.084 64.452 22.208 64.932 21.44C65.424 20.66 66.09 20.054 66.93 19.622C67.782 19.19 68.736 18.974 69.792 18.974C70.788 18.974 71.694 19.172 72.51 19.568C73.338 19.964 73.992 20.546 74.472 21.314C74.964 22.082 75.21 23 75.21 24.068ZM69.828 21.746C69.408 21.746 69.06 21.86 68.784 22.088C68.508 22.316 68.328 22.64 68.244 23.06H71.412C71.328 22.652 71.148 22.334 70.872 22.106C70.596 21.866 70.248 21.746 69.828 21.746ZM86.9698 24.068C86.9698 24.128 86.9518 24.446 86.9158 25.022H80.0758C80.2198 25.394 80.4598 25.682 80.7958 25.886C81.1318 26.078 81.5518 26.174 82.0558 26.174C82.4878 26.174 82.8478 26.12 83.1358 26.012C83.4358 25.904 83.7598 25.718 84.1078 25.454L86.2318 27.596C85.2718 28.652 83.8378 29.18 81.9298 29.18C80.7418 29.18 79.6978 28.964 78.7978 28.532C77.8978 28.088 77.2018 27.476 76.7098 26.696C76.2178 25.916 75.9718 25.04 75.9718 24.068C75.9718 23.084 76.2118 22.208 76.6918 21.44C77.1838 20.66 77.8498 20.054 78.6898 19.622C79.5418 19.19 80.4958 18.974 81.5518 18.974C82.5478 18.974 83.4538 19.172 84.2698 19.568C85.0978 19.964 85.7518 20.546 86.2318 21.314C86.7238 22.082 86.9698 23 86.9698 24.068ZM81.5878 21.746C81.1678 21.746 80.8198 21.86 80.5438 22.088C80.2678 22.316 80.0878 22.64 80.0038 23.06H83.1718C83.0878 22.652 82.9078 22.334 82.6318 22.106C82.3558 21.866 82.0078 21.746 81.5878 21.746ZM92.9695 25.976L92.3215 26.678V29H88.2535V15.644H92.3215V22.016L95.1475 19.154H99.9535L95.8855 23.42L100.278 29H95.3635L92.9695 25.976ZM104.123 19.694H100.433V16.4H112.061V19.694H108.371V29H104.123V19.694ZM122.53 24.068C122.53 24.128 122.512 24.446 122.476 25.022H115.636C115.78 25.394 116.02 25.682 116.356 25.886C116.692 26.078 117.112 26.174 117.616 26.174C118.048 26.174 118.408 26.12 118.696 26.012C118.996 25.904 119.32 25.718 119.668 25.454L121.792 27.596C120.832 28.652 119.398 29.18 117.49 29.18C116.302 29.18 115.258 28.964 114.358 28.532C113.458 28.088 112.762 27.476 112.27 26.696C111.778 25.916 111.532 25.04 111.532 24.068C111.532 23.084 111.772 22.208 112.252 21.44C112.744 20.66 113.41 20.054 114.25 19.622C115.102 19.19 116.056 18.974 117.112 18.974C118.108 18.974 119.014 19.172 119.83 19.568C120.658 19.964 121.312 20.546 121.792 21.314C122.284 22.082 122.53 23 122.53 24.068ZM117.148 21.746C116.728 21.746 116.38 21.86 116.104 22.088C115.828 22.316 115.648 22.64 115.564 23.06H118.732C118.648 22.652 118.468 22.334 118.192 22.106C117.916 21.866 117.568 21.746 117.148 21.746ZM129.106 29.18C127.99 29.18 126.988 28.964 126.1 28.532C125.224 28.1 124.534 27.494 124.03 26.714C123.538 25.934 123.292 25.052 123.292 24.068C123.292 23.084 123.538 22.208 124.03 21.44C124.534 20.66 125.224 20.054 126.1 19.622C126.988 19.19 127.99 18.974 129.106 18.974C130.306 18.974 131.332 19.232 132.184 19.748C133.036 20.264 133.624 20.978 133.948 21.89L130.798 23.438C130.414 22.574 129.844 22.142 129.088 22.142C128.608 22.142 128.206 22.31 127.882 22.646C127.57 22.982 127.414 23.456 127.414 24.068C127.414 24.692 127.57 25.172 127.882 25.508C128.206 25.844 128.608 26.012 129.088 26.012C129.844 26.012 130.414 25.58 130.798 24.716L133.948 26.264C133.624 27.176 133.036 27.89 132.184 28.406C131.332 28.922 130.306 29.18 129.106 29.18ZM141.728 18.974C142.94 18.974 143.912 19.34 144.644 20.072C145.388 20.804 145.76 21.908 145.76 23.384V29H141.692V24.086C141.692 22.958 141.29 22.394 140.486 22.394C140.03 22.394 139.658 22.556 139.37 22.88C139.094 23.192 138.956 23.69 138.956 24.374V29H134.888V15.644H138.956V19.946C139.712 19.298 140.636 18.974 141.728 18.974Z" fill="#8C30F5"/>
                <g clip-path="url(#clip0_10_173)">
                <path d="M39.0037 15.8451C38.8339 14.556 38.81 12.3356 39.9958 11.59C40.017 11.5763 40.0328 11.5566 40.0514 11.5396C41.0209 11.2265 41.6919 10.7871 41.1652 10.1958L26.8633 5.84467L3.70522 9.09562C3.70522 9.09562 1.05333 9.47834 1.29023 13.6384C1.41883 15.9026 2.12213 17.0145 2.73719 17.5618L0.836863 18.14C0.309419 18.7313 0.980256 19.1709 1.94991 19.4835C1.96834 19.5009 1.98388 19.5205 2.00544 19.5342C3.19056 20.2804 3.16775 22.5005 2.99728 23.7899C-1.26025 25.0106 0.268056 25.4084 0.268056 25.4084L1.20199 25.6366C0.545065 26.236 -0.107347 27.3726 0.0148627 29.5283C0.251887 33.6876 2.4301 33.9746 2.4301 33.9746L17.5846 38.9482L40.4585 33.354C40.4585 33.354 41.9873 32.9556 37.7286 31.7348C37.5574 30.4474 37.5336 28.2275 38.7215 27.4794C38.7433 27.4661 38.7592 27.446 38.7769 27.4293C39.7465 27.1162 40.4169 26.6772 39.89 26.0859L38.8958 25.7828C39.5589 25.379 40.5549 24.3239 40.7109 21.5831C40.8186 19.6979 40.3315 18.5937 39.7677 17.9437L41.7328 17.4636C41.733 17.4643 43.2618 17.0659 39.0037 15.8451ZM19.8711 15.7918L23.7176 14.9936L36.7167 12.2963L38.6534 11.8941C38.0346 13.0377 38.0605 14.6028 38.1629 15.6087C38.1854 15.8362 38.2112 16.0441 38.2363 16.202L36.1165 16.7342L19.7094 20.8554L19.8711 15.7918ZM3.34799 19.8396L5.28442 20.2418L17.7682 22.833L18.8588 23.0585L22.1294 23.7373L22.2907 28.801L5.42781 24.5649L3.76538 24.1477C3.78982 23.9895 3.81565 23.782 3.83908 23.5538C3.94086 22.5486 3.96731 20.9832 3.34799 19.8396ZM2.59568 13.4382C2.57224 12.3317 2.76753 11.5314 3.16223 11.1246C3.41342 10.8649 3.70986 10.8109 3.91316 10.8109C4.02058 10.8109 4.09792 10.826 4.10318 10.826L14.0814 14.1106L19.0596 15.7494L18.8963 20.8484L4.93032 16.8949L4.1933 16.6865C4.16623 16.6787 4.1295 16.6734 4.10118 16.6722C4.04364 16.668 2.66286 16.5397 2.59568 13.4382ZM17.6207 36.7391L2.91806 32.577C2.89086 32.5691 2.85451 32.5637 2.82619 32.5623C2.76765 32.5584 1.38624 32.4302 1.31943 29.3295C1.29562 28.2216 1.49191 27.4221 1.88586 27.0149C2.13768 26.7552 2.43424 26.7012 2.63717 26.7012C2.74484 26.7012 2.82192 26.7158 2.82756 26.7158L17.783 31.64L17.6207 36.7391ZM36.8866 31.4986C36.9098 31.7269 36.9356 31.9344 36.9607 32.0926L18.4334 36.7463L18.5954 31.6826L22.5563 30.8604L23.1413 31.0032L25.3338 30.2838L35.4404 28.1868L37.3778 27.7843C36.7584 28.9278 36.784 30.4935 36.8866 31.4986ZM37.9071 24.6169C37.8734 24.6176 37.8397 24.6222 37.808 24.6323L36.4106 25.0273L23.1057 28.7943L22.943 23.6953L27.3082 22.2577L37.878 18.7771C37.8794 18.7765 38.4341 18.6521 38.8412 19.0701C39.2353 19.4769 39.4308 20.2771 39.4077 21.3836C39.3388 24.4841 37.9574 24.613 37.9071 24.6169Z" fill="#8C30F5"/>
                </g>
                <defs>
                <clipPath id="clip0_10_173">
                <rect width="42" height="42.4078" fill="white" transform="translate(0 0.796112)"/>
                </clipPath>
                </defs>
                
            </svg> 
          </center>
          
        </div>
      </nav>
</header>

<center>

    
    <?php if(!empty($message)): ?>

            <div class="container men">


                <div class="alerte">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?= $message ?>
                </div>

            </div>

        <?php endif; ?>

    <form class="login" method="POST">
        
        
        <h2 style="color:white;">Recuperar contraseña</h2>
        
       
        <label class="input">
        <input class="controls" type="email" name="correo" placeholder="Correo" required/>
        </label>

        
        <button class="btnsend" name="btnEn">Recuperar contraseña</button>
        
        <p><a style="color:#4D85A6;" href="login.php"> <b>Iniciar sesion</b>  </a></p>
    
    </form> 
    
</center>


    <footer>
        <div class="contenedorFooter">
             
  
            <div class="contenedorSoporte">
                <h4 style="color:#0F86CD;">Soporte</h4>
                <a href="*">Centro de ayuda</a>
                <a href="*">WhatsApp</a>
                <a href="*">Facebook</a>
                <a href="*">Instagram</a>
            </div>
  
            <div class="contenedorSoporte">
                <h4 style="color:#0F86CD;">informacion</h4>
                <a href="*">Sobre Nosotros</a>
                <a href="*">Metas</a>
                <a href="*">Mision</a>
                <a href="*">vision</a>
            </div>
          </div>
    </footer>

    <script src="index.js"></script>
</body>