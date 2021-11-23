
<?php 
    include_once "../functions.php";
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];


    $chek_chek=check_doc_rol($_SESSION['user']);// entra tras enviar los datos del formulario de la misma pagina


    if (isset($_POST["aux_centre"])) {//inserta los datos editados del centro
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

        


?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_editarCentro.css">
    <title>Document</title>
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
        <h1>Editar el centro <?php echo $centro?></h1>
        <form class="atras" action="ver_centro.php" method="post">
            <input type="submit" value="volver">
        </form>

        <form action="editar_centro.php" id="editarCentro" method="post">
            <div id="primero">
                <input type="hidden" name="aux_centre" value="<?php echo $datos_centro_edit[0] ?>">
                <label for="nombre">Nombre: </label>
            </div>
            <div id="segundo">
                <input type="text" name="nombre" id="nombre" value="<?php echo $datos_centro_edit[1] ?>">
            </div>
            <div id="primero">
                <label for="Localizacion">Localizacion: </label>
            </div>
            <div  id="segundo">
                <input type="text" name="Localizacion" id="centro" value="<?php echo $datos_centro_edit[2] ?>"><br>
            </div>
            <input type="submit" value="Enviar">
        </form>




    </main>
</body>
</html>


<?php
    }else {
        echo "Access denied due to ........ ";
        header("refresh:5;url=ver_centro.php");
    }




?>

