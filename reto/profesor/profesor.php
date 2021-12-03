<?php 
    session_start();

    if (!isset($_SESSION['rol'])) {
        session_destroy();
        header("refresh:0;url=../index.php");
    }


    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_prof.css">

    <title>Profesor</title>
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
        <h1><?php echo $nombre?></h1>
        <button class="propGrupos" onclick="redirigir('propGrupos.php')">Proponer Grupos</button>
        <button class="verGrupos" onclick="redirigir('../verGrupos.php')">Organizar Grupos</button>
        <button class="verAlumno" onclick="redirigir('../alumno/ver_alumno.php')">Organizar Alumnos</button>

        <?php 
        
        if ($rol>1) {
            echo  "<button class=\"verClases\" onclick=\"redirigir('../cursos/ver_cursoss.php')\">Administrar Clases</button>";
            echo "<button class=\"adminProf\" onclick=\"redirigir('../adminProf.php')\">Administrar Profesores</button>";
        }

        if ($rol>2) {   
            echo "<button class=\"adminCentro\" onclick=\"redirigir('../centro/ver_centro.php')\">Administrar Centros</button>";
            echo "<button class=\"addPreguntas\" onclick=\"redirigir('../preguntas/CRUDPreguntas.php')\">Administrar Preguntas</button>";
        }
        ?>
        <button class="salir" onclick="salir('../cerrarSesion.php')">Salir</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>