
<?php
  require '../../database.php';

  require '../helpers/menu.php';


  $message = '';

  $consultaSQL = "SELECT * FROM categorias where estado = 1";
  $sentencia = $conn->prepare($consultaSQL);
  $sentencia->execute();

  $cat = $sentencia->fetchAll();

  //$dataTime = date("Y-m-d H:i:s");

  $ti;


  if(isset($_POST['tipo'])){
        $ti = 1;
    } else{
        $ti = 0;    
    }


    if (isset($_POST['subir'])){

        $nombrel = $_FILES['pdfl']['name'];
        $rutal = $_FILES['pdfl']['tmp_name'];
        $destinol = "../../../libros/pdf/" . $nombrel;
        
        $nombrei = $_FILES['imgl']['name'];
        $rutai = $_FILES['imgl']['tmp_name'];
        $destinoi = "../../../libros/imagenes/" . $nombrei;

        if ((!empty($_POST['autor'])) || (!empty($_POST['titu'])) && (!empty($_POST['pdfl'])) && (!empty($_POST['sino'])) && (!empty($_POST['pagi'])) && (!empty($_POST['imgl'])) && (!empty($_POST['idi'])) && (!empty($_POST['edi'])) && (!empty($_POST['fe'])) ){

            $exis = $conn->prepare('SELECT * FROM libros WHERE titulo = :nombre');
            $exis->bindParam(':nombre', $_POST['titu']);
            $exis->execute();
            $exi = $exis->fetch(PDO::FETCH_ASSOC);
        
            if (is_array($exi) ==  0 ){
                if($_FILES['pdfl']['type'] =='application/pdf'){    
                    
        
                    if(($_FILES['imgl']['type'] == "image/jpg") || ($_FILES['imgl']['type'] == "image/png") || ($_FILES['imgl']['type'] == "image/jpeg") ){
                        $sql = "INSERT INTO libros (idcategoria, autor, titulo, nomar, sinopsis, numpa, imagen, premiun, idiomas, edicion, fechala, estado) VALUES (:idc, :autor, :titu, :noma, :sino, :nup, :img, :pre, :idi, :edi, :fec, 1)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':idc', $_POST['cars']);
                        $stmt->bindParam(':autor', $_POST['autor']);
                        $stmt->bindParam(':titu', $_POST['titu']);
                        $stmt->bindParam(':noma', $nombrel);
                        $stmt->bindParam(':sino', $_POST['sino']);
                        $stmt->bindParam(':nup', $_POST['pagi']);
                        $stmt->bindParam(':img', $nombrei);
                        $stmt->bindParam(':pre', $ti);
                        $stmt->bindParam(':idi', $_POST['idi']);
                        $stmt->bindParam(':edi', $_POST['edi']);
                        $stmt->bindParam(':fec', $_POST['fe']);

                        if (copy($rutal, $destinol)){
                            if(copy($rutai, $destinoi)){

                                if ($stmt->execute()) {

                                    $recordslt = $conn->prepare('SELECT id FROM libros ORDER BY id DESC LIMIT 1');
                                    $recordslt->execute();
                                    $resultslt = $recordslt->fetch(PDO::FETCH_ASSOC);

                                    $ids = implode("", $resultslt);

                                    $sqlp = "INSERT INTO promedio (id_libro, pro) VALUES (:idl, 0.00)";
                                    $stmtp = $conn->prepare($sqlp);
                                    $stmtp->bindParam(':idl', $ids);

                                    $stmtp->execute();

                                    if (copy($rutal, $destinol)) {
                                        if (copy($rutai, $destinoi)){
                                            $message = 'Libro creado con exito';
                                        } else {
                                            $message = 'Error';
                                        }
        
                                    } else{
                                        $message = 'Error al guardar el libro';
                                    }
        
                                } else {
                                    $message = 'error al crear el libro';
                                }

                            } else {
                                $message = "Error al subir la portada";
                            }
                        } else {
                            $message = "Error al subir el libro";
                        }
        
                        
                        
                        
                    } else{
                        $message = "La imagen tiene que ser en formato PNG o JPG";
                    }
        
                } else{
                    $message = "El libro tiene que ser en formato PDF";
                }
                
        
            } else{
                $message = "Ya existe un libro con este Titulo";
            }
          } else {
              $message = "Campos vacios";
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

</style>

    <?php if(isset($_SESSION['user_id']) && $_SESSION['lopri'] == 1): ?>


    <div class="container">    
        <h1>Agregar Libro</h1>

        <br>

            

        

        

        <?php if(!empty($message)): ?>

            <div class="container men">

                <?php

                    if($message == "Libro creado con exito"){



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


        <div class="row">
            <form class="col s12" method="post" enctype="multipart/form-data" >
              
              <div class="row">
                <div class="input-field col s10">
                    <input name="titu" id="nombres" type="text" class="validate" require>
                    <label for="password">Titulo</label>
                  </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                  <input name="autor" id="nombres" type="text" class="validate" require>
                  <label for="password">Autor</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                    <textarea name="sino" id="direccion" class="materialize-textarea" require></textarea>
                    <label for="textarea1">Sinopsis</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                    <textarea name="idi" id="nombres" class="materialize-textarea" require></textarea>
                    <label for="textarea1">Idioma</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                    <input type="number" name="pagi" id="nombres" class="validate" require>
                    <label for="textarea1">Numero de paginas</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                    <textarea id="textarea1" name="edi" id="nombres" class="materialize-textarea" require></textarea>
                    <label for="textarea1">Edicion</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                    <input type="date" name="fe" id="nombres" class="datepicker " require>
                    <label for="textarea1">Fecha del libro</label>
                </div>
              </div>
              <div class="row">
					<label>Premiun:</label><br><br>

					<label>
                    <input type="checkbox" name="tipo" />
                        <span>Si</span>
                    </label>


				</div><br>

                
              
              <div class="row">
                <div class="input-field col s10">
                <select class="browser-default" name="cars" id="cars">

                        <?php    
                            foreach ($cat as $fila){
                                echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
                            }    
                        ?>

                </select>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s10">
                    <div class="file-field input-field">
                        <div class="black btn">
                          <span>Subir libro</span>
                          <input type="file" name="pdfl" require>
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text">
                        </div>
                      </div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                    <div class="file-field input-field">
                        <div class="black btn">
                          <span>Subir Imagen</span>
                          <input type="file" name="imgl" required>
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text">
                        </div>
                      </div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s10">
                <button type="submit" class="btn btn-success deep-purple accent-4deep-purple accent-4" name="subir">Guardar datos</button>
                    <a href="libros.php" class="waves-effect deep-purple accent-4 btn right">regresar</a>
                
                </div>
              </div>
              </div>    
            </form>
            
          </div>
                
    </div>



    <?php else: 
        header('Location: /biblioteca/php/privado/login.php');
        ?>

    <?php endif; ?>

    <script>
// Get all elements with class="closebtn"
var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
  // When someone clicks on a close button
  close[i].onclick = function(){

    // Get the parent of <span class="closebtn"> (<div class="alert">)
    var div = this.parentElement;

    // Set the opacity of div to 0 (transparent)
    div.style.opacity = "0";

    // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>

</body>
</html>