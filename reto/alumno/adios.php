<?php 
session_start();
$id=$_SESSION['user'];
$nombre=$_SESSION['nombre'];
$centro=$_SESSION['centro'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_alumno.css">
    <title>Preguntas Alumno</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

    
    <main>

        <h1>Todas las preguntas han sido respondidas muchas gracias</h1>

        <button id="revisar" onclick="redirigir('revisar-respuestas')">Revisar Preguntas</button>
        <button class="salir" onclick="salir('cerrar-sesion')">Salir</button>

    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>