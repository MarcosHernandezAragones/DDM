<?php 
    include_once "../functions.php";
    session_start();

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];


    $chek_chek=check_doc_rol($_SESSION['user']);// entra tras enviar los datos del formulario de la misma pagina


    if (isset($_POST["aux_centre"])) {//inserta los datos del centro
        $nombre_cent=$_POST["nombre"];
        $loc_cent=$_POST["Localizacion"];

        try {
            create_centro($nombre_cent, $loc_cent);
            
        } catch (Exception $th) {
            echo $th;
            echo "si esta viendo, esto contacte con soporte tecnico lo antes posible";
            header("refresh:5;url=ver_centro.php");
        }
        header("Location: ver_centro.php");

    } else if ($chek_chek[1] && isset($_POST['confir'])){



?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_crearCentro.css">
    <title>Crear Centro</title>
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
        <h1>Crear Centro</h1>
        <form action="ver_centro.php" id="atras" method="post">
            <input type="submit" value="volver">
        </form>

        <form action="crear_centro.php" id="formulario" method="post">
            <div id="primero">
                <input type="hidden" name="aux_centre" value="a">
                <label for="nombre">Nombre: </label>
            </div>
            <div id="segundo">
                <input type="text" name="nombre" id="nombre">
            </div>
            <div id="primero">
                <label for="Localizacion">Localizacion: </label>
            </div>
            <div id="segundo">
                <input type="text" name="Localizacion" id="Localizacion"><br>
            </div>

            <input type="submit" value="Enviar">
        </form>




    </main>
</body>
</html>


<?php
    }else {
        echo "DPS are the meta showoff";
        header("refresh:2;url=ver_centro.php");
    }




?>

