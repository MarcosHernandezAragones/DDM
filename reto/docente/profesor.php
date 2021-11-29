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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <title>Profesor</title>
</head>
<body>

    <?php include_once "../menu_fijo.php"?>
    
    <main>
        <h1><?php echo $nombre?></h1>
        <button class="propGrupos" onclick="redirigir('elegir')">Proponer Grupos</button>
        <button class="verGrupos" onclick="redirigir('grupo')">Organizar Grupos</button>
        <button class="verAlumno" onclick="redirigir('listar-alumnos')">Organizar Alumnos</button>

        <?php 
        
        if ($rol>1) {
            echo  "<button class=\"verClases\" onclick=\"redirigir('curso')\">Administrar Clases</button>";
            echo "<button class=\"adminProf\" onclick=\"redirigir('profesores')\">Administrar Profesores</button>";
        }

        if ($rol>2) {   
            echo "<button class=\"adminCentro\" onclick=\"redirigir('centros')\">Administrar Centros</button>";
            echo "<button class=\"addPreguntas\" onclick=\"redirigir('crear-preguntas')\">Administrar Preguntas</button>";
        }
        ?>
        <button class="salir" onclick="salir('cerrar-sesion')">Salir</button>
    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>