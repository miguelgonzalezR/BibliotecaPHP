<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <script src="https://kit.fontawesome.com/09ddea1611.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap" rel="stylesheet">
    <link href="helpers/css/index.css" rel="stylesheet">
    <title>Inicio</title>
</head>
<body>

<style>
    
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:'montserrat', sans-serif;
}
body{
    width: 100%;
}
.header{
    width: 100%;
    height: 800px;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    flex-direction: column;
    background-image: linear-gradient(rgb(0 0 0 / 80%), rgb(72 72 72 / 80%)),
    url(helpers/Libros.png);
}
.titulo{
    padding: 20px;
    border-radius: 20px;
    font-size: 50px;
    font-weight: bold;
    color: #f2f2f2;
    cursor: pointer;
}

.desc{
    color: #f2f2f2;
}
.btn{
    margin-top: 10px;
    background-color: #f2f2f2;
    color: #000;
    border: none;
    padding: 10px 20px;
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 10px;
    border: 3px solid #000;
}

.btn:hover{
    background-color: #000;
    color: #f2f2f2;
}
.contenedor{
    width: 100%;
    height: auto;
    display: flex;
    flex-direction: row;
    padding-top: 20px;
    flex-wrap: wrap;
    justify-content: space-around;
}
.options{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.options2{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-right: 50px;
    text-align: center;
}
.titulo2{
    padding: 20px;
    border-radius: 20px;
    font-size: 50px;
    font-weight: bold;
    color: #000;
    cursor: pointer;
    text-align: center;
}
.btn2{
    text-align: center;
    margin-top: 10px;
    background-color: #f2f2f2;
    color: #000;
    border: none;
    padding: 10px 20px;
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 10px;
    border: 3px solid #000;
    margin-bottom: 20px;
    width: 10%;
    margin: 0 auto;
    margin-bottom: 20px;
}


.btn2:hover{
    background-color: #000;
    color: #f2f2f2;
}

.cont{
    height: auto;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    text-align: center;
}

@media screen and (max-width: 600px){
    .contenedor{
        width: 80%;
        height: auto;
        display: flex;
        flex-direction: row;
        padding-top: 20px;
        flex-wrap: wrap;
        justify-content: space-around;
        margin: 0 15%;
        margin-bottom: 30px;
    }
    .options{
        margin-top: 20px;
    }
    .options2{
        margin-top: 20px;
    }
    .cont{
        flex-direction: column;
    }
}


    

</style>

    <div class="header">
        <h1 class="titulo">Geek Tech</h1>
        <h3 class="desc"> Leer libros nunca ha sido tan facil </h3>
        <a class="btn" href="registrar.php">Registrate gratis </a>
    </div>

    <div class="contenedor">
        <div class="options2">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
              </svg>
            <h2>Disfruta tus recursos bibliograficos</h2>
            <p>En cualquier parte donde sea que te encuentres</p>

        </div>

        <div class="options2">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
              </svg>
            <h2>Con tu cuenta premium no existe limites</h2>
            <p>Hazte premium y ten acceso a toda la coleccion de recursos bibliograficos</p>
        </div>
        <div class="options">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-bookmark-heart-fill" viewBox="0 0 16 16">
                <path d="M2 15.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v13.5zM8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
              </svg>
            <h2>Tu repositorio personal</h2>
            <p>Guarda en un repositorio personalizado tus recursos bobliograficos favoritos</p>

        </div>
    </div>

    <div class="cont">
        <h1 class="titulo2">¿Quieres saber mas sobre nosotros?</h1>

        <a class="btn2" href="login.php">Conoce </a>
    </div>


<?php

require 'helpers/footer.php';

?>


</body>
</html>