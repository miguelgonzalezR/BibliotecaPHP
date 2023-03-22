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

    $records = $conn->prepare('SELECT id, username, correo, contra, tipo, inten, ban FROM usuarios WHERE correo = :correo');
    $records->bindParam(':correo', $_POST['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if(is_array($results) > 0){

        $sentencia = $conn->prepare('UPDATE usuarios set contra = :contra where correo = :correo');
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
                $message = "Contraseña actualizada correctamente, Se ha enviado un correo con su nueva contraseña";
            } else{
                $message = "Error al enviar el correo";
            }

            

        } else{
            $message =  "Algo salio mal.";
        } 


        

    } else{
        $message ="No ay ningun usuario con este correo";
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
<body>

<style>
@import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;	
	font-family: Raleway, sans-serif;
}

body {
	background: linear-gradient(90deg, #7A7B87, #fff);		
}

.container {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
}

.screen {		
	background: linear-gradient(90deg, #D5D5E7	, #DBDFFD);		
	position: relative;	
	height: 600px;
	width: 360px;	
	box-shadow: 0px 0px 24px #5C5696;
}

.screen__content {
	z-index: 1;
	position: relative;	
	height: 100%;
}

.screen__background {		
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 0;
	-webkit-clip-path: inset(0 0 0 0);
	clip-path: inset(0 0 0 0);	
}

.screen__background__shape {
	transform: rotate(45deg);
	position: absolute;
}

.screen__background__shape1 {
	height: 520px;
	width: 520px;
	background: #FFF;	
	top: -50px;
	right: 120px;	
	border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
	height: 220px;
	width: 220px;
	background: #515ABF	;	
	top: -172px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape3 {
	height: 540px;
	width: 190px;
	background: linear-gradient(270deg, #515ABF, #D5D5E7);
	top: -24px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape4 {
	height: 400px;
	width: 200px;
	background: #E9EAF3;	
	top: 420px;
	right: 50px;	
	border-radius: 60px;
}

.login {
	width: 320px;
	padding: 30px;
	padding-top: 156px;
}

.login__field {
	padding: 20px 0px;	
	position: relative;	
}

.login__icon {
	position: absolute;
	top: 30px;
	color: #7875B5;
}

.login__input {
	border: none;
	border-bottom: 2px solid #D1D1D4;
	background: none;
	padding: 10px;
	padding-left: 24px;
	font-weight: 700;
	width: 75%;
	transition: .2s;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
	outline: none;
	border-bottom-color: #6A679E;
}

.login__submit {
	background: #fff;
	font-size: 14px;
	margin-top: 30px;
	padding: 16px 20px;
	border-radius: 26px;
	border: 1px solid #D4D3E8;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	width: 100%;
	color: #4C489D;
	box-shadow: 0px 2px 2px #5C5696;
	cursor: pointer;
	transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
	border-color: #6A679E;
	outline: none;
}

.button__icon {
	font-size: 24px;
	margin-left: auto;
	color: #7875B5;
}

.social-login {	
	position: absolute;
	height: 140px;
	width: 160px;
	text-align: center;
	bottom: 0px;
	right: 0px;
	color: #fff;
}

.social-icons {
	display: flex;
	align-items: center;
	justify-content: center;
}

.social-login__icon {
	padding: 20px 10px;
	color: #fff;
	text-decoration: none;	
	text-shadow: 0px 0px 8px #7875B5;
}

.social-login__icon:hover {
	transform: scale(1.5);	
}




.alerte {
  padding: 20px;
  background-color: #000 ; /* Red */
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
  color: white;
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
    margin-right:23%;
	display: flex;
	align-items: center;
	justify-content: center;
}

p{
    color: #fff;
    padding-top: 10%;
}

a{
    color: #000;
	font-weight: bold;
}
</style>

<?php if(!empty($_SESSION)): 
header('Location: /biblioteca/php/privado/index.php');
?>

<?php endif; ?>


<center>
	<?php if(!empty($message)): ?>

            <div class="men">


                <div class="alerte">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?= $message ?>
                </div>





                
            </div>

        <?php endif; ?>
</center>



<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" method="POST">
                <center><h2 >Recuperar contraseña</h2></center><br><br>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input name="correo" type="text" class="login__input" placeholder="Correo" required>
				</div>
				<button class="button login__submit" name="btnEn">
					<span class="button__text">Enviar correo</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>

            <center>
			<br><br><br><br><p><a href="login.php">Iniciar Sesion</a></p>
			</center>
			
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>




</body>
</html>