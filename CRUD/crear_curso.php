<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 
    $chek_chek=check_doc_rol($_SESSION['id_prof']);

   
   





    if (isset($_POST["aux_cursed"])) {
        $nombre_curso=$_POST["nombre"];
        
        $id_centro=$_POST["centro"];

        try {
            create_curso($nombre_curso, $id_centro);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_cursoss.php");
        }
        header("Location: ver_cursoss.php");
        

    } else if (($chek_chek[1] || $chek_chek[0]) && isset($_POST['confir'])){
        $centros=read_centross();


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

    <form action="crear_curso.php" method="post">
        <input type="hidden" name="aux_cursed" value="a">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <label for="centro">Centro: </label>
        <select name="centro" id="centro">
            <option value="nil" selected>-----------------</option>
            <?php 
            for ($i=0; $i < count($centros); $i++) { 
                
                echo" <option value=\"".$centros[$i][0]."\" >".$centros[$i][1]."</option>";
            }

            ?>
        </select>

        <!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

        <input type="submit" value="Enviar">
    </form>





</body>
</html>


<?php
    }else {
        echo "Acceso denegado por motivos random";
        header("refresh:2;url=ver_cursoss.php");
    }




?>

