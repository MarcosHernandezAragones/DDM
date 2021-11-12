
<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 
    






    if (isset($_POST["aux_cursed"])) {
        $id_grupo=$_POST["aux_cursed"];
        
        $nombre_grupo=$_POST["nombre"];

        try {
            update_grupo($nombre_grupo,$id_grupo);
        } catch (Exception $th) {
            echo $th;
            header("refresh:15;url=ver_grupos.php");
        }
        //header("Location: ver_grupos.php");
        header("refresh:15;url=ver_grupos.php");
       

    } else if ( isset($_POST["group"])){
        $grupo=read_grupo($_POST["group"])
        //[$id_grupo,$nombre,$id_curs,$id_centre]
        


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

    <form action="editar_grupo.php" method="post">
        <input type="hidden" name="aux_cursed" value="<?php echo $grupo[0] ?>">
        
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $grupo[1] ?>">
        

        <input type="submit" value="Enviar">
    </form>





</body>
</html>


<?php
    }else {
        echo "Acceso denegado por..... motivos?";
        header("refresh:5;url=ver_grupos.php");
    }




?>