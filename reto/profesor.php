<?php session_start();
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
    <link rel="stylesheet" href="estilo_prof.css">

    <title>Profesor</title>
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
        <h1>SuperAdmin</h1>
        <button class="propGrupos" onclick="redirigir('propGrupos.php')">Proponer Grupos</button>
        <button class="verGrupos" onclick="redirigir('verGrupos.php')">Ver Grupos</button>
        <button class="verAlumno" onclick="redirigir('verAlumnos.php')">Ver Alumnos</button>
        <button class="verClases" onclick="redirigir('verClases.php')">Ver Clases</button>
        <button class="adminProf" onclick="redirigir('adminProf.php')">Administrar Profesores</button>
        <button class="salir" onclick="salir('index.php')">Salir</button>
    </main>
    <script type="text/javascript" src="funciones.js"></script>
</body>
</html>