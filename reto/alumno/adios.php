<?php 
session_start();
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
    <section>
        <img class="gob" src="" alt="">
        <img class="centro" src="" alt="">
        <img class="abajo" src="../logo_login.png" alt="" srcset="">
        <p class="usuario_contro"><?php echo $nombre?></p>
        <p class="nombre_centro"><?php echo $centro?></p>
    </section>
    
    <main>

        <h1>Todas las preguntas han sido respondidas muchas gracias</h1>

        <button id="revisar" onclick="redirigir('revisar.php')">Revisar Preguntas</button>
        <button class="salir" onclick="salir('../cerrarSesion.php')">Salir</button>

    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>