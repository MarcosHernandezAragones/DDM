<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 
    $rolarr=read_rolss();
    for ($i=0; $i < count($rolarr); $i++) { 
        if ($rolarr[$i][1] == "superadmin") {
            $id_sup=$rolarr[$i][0];
            
        }
    }
    
    
    $datos_doc=read_docente($_SESSION['id_prof']);

    //[$id_prof,$nombre,$apellidos,$DNI,$correo,$passwrd,$rol,$centro]  rol 6
    $is_sup=false;
    
    echo $datos_doc[6]."-----".$id_sup;
    if ($datos_doc[6] ==  $id_sup) {
        
        $is_sup=true;
    }







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

    } else if ($is_sup){





        
    
    



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
        echo "Acceso denegado por puto";
        header("refresh:5;url=ver_centro.php");
    }




?>

