<?php session_start(); 
    include "funciones_BBDD.php";
    $idAlumno=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=centroAlumno($idAlumno);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo_alumno.css">
    <title>Preguntas Alumno</title>
</head>
<body>
    <section>
        <img class="gob" src="" alt="">
        <img class="centro" src="" alt="">
        <img class="abajo" src="logo_login.png" alt="" srcset="">
        <p class="usuario_contro"><?php echo $nombre?></p>
        <p class="nombre_centro"><?php echo $centro?></p>
    </section>
    
    <main>
        <div class="pregunta"><h1>En este dia de hoy te sientes feliz?</h1></div>
        <form action="" id="form_respuestas">
            <input class="resp_gigante" type="radio" name="respuesta" id="1" value=0 required >
            <input class="resp_grande" type="radio" name="respuesta" id="2" value=17>
            <input class="resp_mediano" type="radio" name="respuesta" id="3" value=34>
            <input class="resp" type="radio" name="respuesta" id="4" value=51>
            <input class="resp_mediano" type="radio" name="respuesta" id="5" value=68>
            <input class="resp_grande" type="radio" name="respuesta" id="6" value=85>
            <input class="resp_gigante" type="radio" name="respuesta" id="7" value=100>
            <label for="1">Extremadamente en desacuerdo</label>
            <label for="2">En desacuerdo</label>
            <label for="3">Parcialmente en desacuerdo</label>
            <label for="4">Neutro</label>
            <label for="5">Parcialmente de acuerdo</label>
            <label for="6">De acuerdo</label>
            <label for="7">Extremadamente de acuerdo</label>
        </form>
        <input type="submit" value="Siguiente" id="siguiente" form="form_respuestas">
        
    </main>
</body>
</html>
