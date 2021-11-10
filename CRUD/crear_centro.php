<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 

    $chek_chek=check_doc_rol($_SESSION['id_prof']);

   
   





    if (isset($_POST["aux_centre"])) {
        $nombre_cent=$_POST["nombre"];
        $loc_cent=$_POST["Localizacion"];

        try {
            create_centro($nombre_cent, $loc_cent);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_centro.php");
        }
        header("Location: ver_centro.php");

    } else if ($chek_chek[1] && isset($_POST['confir'])){



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ver_centro.php" method="post">
        <input type="submit" value="volver">
    </form>

    <form action="crear_centro.php" method="post">
        <input type="hidden" name="aux_centre" value="a">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <label for="Localizacion">Localizacion: </label>
        <input type="text" name="Localizacion" id="Localizacion"><br>

        <input type="submit" value="Enviar">
    </form>





</body>
</html>


<?php
    }else {
        echo "Acceso denegado por motivos random";
        header("refresh:2;url=ver_centro.php");
    }




?>

