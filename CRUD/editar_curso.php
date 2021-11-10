
<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 
    $chek_chek=check_doc_rol($_SESSION['id_prof']);






    if (isset($_POST["aux_cursed"])) {
        $id_cent=$_POST["id_cent"];
        $id_curso=$_POST["id_curso"];
        $nombre_curso=$_POST["nombre"];

        try {
            update_curso($nombre_curso,$id_curso,$id_cent);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:15;url=ver_cursoss.php");
        }
        header("Location: ver_cursoss.php");
       

    } else if ($chek_chek[1] && (isset($_POST["id_cent"]) && isset($_POST["id_curso"]))){
        $datos_curso_edit=read_curso($_POST["id_curso"],$_POST["id_cent"]);

        


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
    <form action="ver_cursoss.php" method="post">
        <input type="submit" value="volver">
    </form>

    <form action="editar_curso.php" method="post">
        <input type="hidden" name="aux_cursed" value="a">
        <input type="hidden" name="id_cent" value="<?php echo $datos_curso_edit[2] ?>">
        <input type="hidden" name="id_curso" value="<?php echo $datos_curso_edit[1] ?>">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $datos_curso_edit[0] ?>">
        

        <input type="submit" value="Enviar">
    </form>





</body>
</html>


<?php
    }else {
        echo "Acceso denegado por..... motivos?";
        header("refresh:5;url=ver_cursoss.php");
    }




?>
