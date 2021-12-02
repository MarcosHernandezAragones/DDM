<?php
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    if (!isset($_SESSION['rol'])) {
        header("refresh:0;url=inicio");
        echo "Usted no puede estar aqui, en 3 segundos sera redireccionado";

    }elseif ($_SESSION['rol']<3) {
        header("refresh:0;url=inicio");
        echo "Usted no puede estar aqui, en 3 segundos sera redireccionado";
    }else{
        $rol=$_SESSION['rol'];
    }

    if (isset($_SESSION['mensaje'])) {
        echo "<script>alert('".$_SESSION['mensaje']."')</script>";
        unset($_SESSION['mensaje']);
    }

    if (isset($_SESSION['mensajeFich'])) {
        echo "<script>alert('".$_SESSION['mensajeFich']."')</script>";
        unset($_SESSION['mensajeFich']);

    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_CRUDPreguntas.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>CRUD Preguntas</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

    <main>
        <div id="unaPre">
            <form action="add-pregunta" id="una" method="post" onsubmit="return comprobarPregunta()">  
                <h1>Introducir una sola pregunta</h1>

                <div id="primero">
                    <label for="pregunta">Pregunta:</label>
                </div>
                <div id="segundo">
                    <textarea name="pregunta" id="pregunta" cols="30" rows="10" placeholder="Escriba aquí la nueva pregunta"></textarea>
                </div>
                <div id="primero">
                    <label for="explicacion">Explicación:</label>
                </div>
                <div id="segundo">
                    <textarea name="explicacion" id="explicacion" cols="30" rows="10" placeholder="Escriba aquí alguna explicacion necesaria(definicion de alguna palabra, etc.)"></textarea>
                </div>
                <div id="primero">
                    <label for="color">Color:</label>
                </div>
                <div id="segundo">
                    <select name="color" id="color">
                        <option value="null">Elige un color</option>
                        <option value="rojo">Rojo</option>
                        <option value="amarillo">Amarillo</option>
                        <option value="verde">Verde</option>
                        <option value="azul">Azul</option>
                    </select>
                </div>
                
                <input type="submit" value="Añadir Pregunta" name="enviar">

            </form>
        
        


    
        <form action="insertar-fichero-preguntas" id="varias" method="post" enctype="multipart/form-data">  
        
            <h1>INTRODUCIR VARIAS PREGUNTAS</h1>

            <label for="archivo">Selecciona un archivo CSV:</label>
            <input type="file" name="archivo" id="archivo">
            <input type="submit" value="Subir Archivo" name="subir">
        </form>
    </div>
       
    <button class="atras" onclick="redirigir('profesor')">Atras</button>
    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>



