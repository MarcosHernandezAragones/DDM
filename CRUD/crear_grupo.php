


<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 

    

   
   





    if (isset($_POST["aux_curse"])) {
        $nombre_grupo=$_POST["nombre"];
        $id_curso=$_POST["aux_curse"];
        $id_centro=$_POST["aux_centre"];

        try {
            create_grupo($nombre_grupo, $id_centro, $id_curso);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:15;url=ver_grupos.php");
        }
        //header("Location: ver_grupos.php");
        header("refresh:15;url=ver_grupos.php");

    } else if ($_POST['curse']){



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
    <form action="ver_grupos.php" method="post">
        <input type="submit" value="volver">
    </form>

    <form action="crear_grupo.php" method="post">
        <input type="hidden" name="aux_centre" value="<?php echo $_POST['centre'] ?>">
        <input type="hidden" name="aux_curse" value="<?php echo $_POST['curse'] ?>">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        

        <input type="submit" value="Enviar">
    </form>





</body>
</html>


<?php
    }else {
        echo "Acceso denegado por motivos random";
        header("refresh:2;url=ver_grupos.php");
    }




?>