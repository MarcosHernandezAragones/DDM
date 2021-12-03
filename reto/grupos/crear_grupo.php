


<?php 
    include_once "../functions.php";
    session_start();

    
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];


    if (isset($_POST["aux_curse"])) {//inserta los datosdel grupo
        $nombre_grupo=$_POST["nombre"];
        $id_curso=$_POST["aux_curse"];
        $id_centro=$_POST["aux_centre"];

        try {
            create_grupo($nombre_grupo, $id_centro, $id_curso);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=grupo");
        }
        header("Location: grupo");
        //header("refresh:15;url=grupo");

    } else if ($_POST['curse']){



?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_crearGrupo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Crear Grupo</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

    <main> 
        <h1>Crear Grupo</h1>

        <form action="add-grupo" id="formulario" method="post">
            <input type="hidden" name="aux_centre" value="<?php echo $_POST['centre'] ?>">
            <input type="hidden" name="aux_curse" value="<?php echo $_POST['curse'] ?>">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" required>
            

            <input type="submit" value="Enviar">
        </form>




        <button class="atras" onclick="redirigir('profesor')">Atras</button>
    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>


<?php
    }else {
        echo "Access denied: karen alert";
        header("refresh:0;url=grupo");
    }




?>