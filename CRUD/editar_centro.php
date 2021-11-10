
<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 
    $chek_chek=check_doc_rol($_SESSION['id_prof']);






    if (isset($_POST["aux_centre"])) {
        $id_cent=$_POST["aux_centre"];
        $nombre_cent=$_POST["nombre"];
        $loc_cent=$_POST["Localizacion"];

        try {
            update_centro($id_cent,$nombre_cent,$loc_cent);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:15;url=ver_centro.php");
        }
        header("Location: ver_centro.php");
       

    } else if ($chek_chek[1] && isset($_POST["id_cent"])){
        $datos_centro_edit=read_centro($_POST["id_cent"]);

        //[$id_cent,$nombre_centro,$loc_centro]


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

    <form action="editar_centro.php" method="post">
        <input type="hidden" name="aux_centre" value="<?php echo $datos_centro_edit[0] ?>">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $datos_centro_edit[1] ?>">
        <label for="Localizacion">Localizacion: </label>
        <input type="text" name="Localizacion" id="Localizacion" value="<?php echo $datos_centro_edit[2] ?>"><br>

        <input type="submit" value="Enviar">
    </form>





</body>
</html>


<?php
    }else {
        echo "Acceso denegado por..... motivos";
        header("refresh:5;url=ver_centro.php");
    }




?>

