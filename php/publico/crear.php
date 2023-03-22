<?php
session_start();
require '../database.php';


if (isset($_SESSION['user_id'])){

    if($_SESSION['tipo'] == 0){
        $dataTime = date("Y-m-d");



$json = file_get_contents('php://input');
$datos = json_decode($json, true);

print_r($datos);



if( is_array($datos) ){
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $fecha = $dataTime;
    $fe = date('Y-m-d', strtotime($fecha."+1 month"));
    $h= 1;

    $sqlp = "INSERT INTO pagos (monto, idcliente, fecha, vence) VALUES (:mon, :cli, :fe, :ve)";
    $pa = $conn->prepare($sqlp);
    $pa->bindParam(':mon', $monto);
    $pa->bindParam(':cli', $_SESSION['user_id']);
    $pa->bindParam(':fe', $fecha);
    $pa->bindParam(':ve', $fe);

    if ($pa->execute()) {
        $message = 'Su pago a sido creado con exito';
        $ace = $conn->prepare('UPDATE clientes set tipo = 1 where id = :id');
        $ace->bindParam(':id', $_SESSION['user_id']);
        $resultado = $ace->execute();
        if($resultado === TRUE) $_SESSION['tipo'] = 1;
        else $message =  "Algo salio mal.";

    } else {
        $message = 'error al crear el pago';
    }

}
    }

    

}



?>


