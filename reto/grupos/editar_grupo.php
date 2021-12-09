
<?php 
    include_once "../functions.php";
    session_start();

    
    






    if (isset($_POST["aux_cursed"])) {//inserta los datos actualizados del grupo
        $id_grupo=$_POST["aux_cursed"];
        
        $nombre_grupo=$_POST["nombre"];

        try {
            update_grupo($nombre_grupo,$id_grupo);
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=grupo");
        }
        header("Location: grupo");
        //header("refresh:0;url=grupo");
       

    } else if ( isset($_POST["group"])){
        $grupo=read_grupo($_POST["group"])
        
        


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_editarGrupos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Editar Grupo</title>
</head>
<body>
    <?php include_once "../menu_fijo.php" ?>
    <main>
        <h1>Editar grupo</h1>

        <form action="editar-grupo" id="editar" method="post">
            <input type="hidden" name="aux_cursed" value="<?php echo $grupo[0] ?>">
            
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $grupo[1] ?>">
            

            <input type="submit" value="Enviar">
        </form>
    </main>
</body>
</html>
<?php
    }else {
        echo "Acceso denegado por..... motivos?";
        header("refresh:0;url=grupo");
    }




?>