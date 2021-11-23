
<?php 
    include_once "../functions.php";
    session_start();

    
    $chek_chek=check_doc_rol($_SESSION['user']);// entra tras enviar los datos del formulario de la misma pagina

    $idAlumno=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
   
    $centro = $_SESSION['centro'];


    if (isset($_POST["aux_cursed"])) {//inserta los datos editados
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_editarCurso.css">
    <title>Document</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

    
    <main>

        <h1>Editar curso</h1>

        <form action="editar_curso.php" id="formulario" method="post">
            <input type="hidden" name="aux_cursed" value="a">
            <input type="hidden" name="id_cent" value="<?php echo $datos_curso_edit[2] ?>">
            <input type="hidden" name="id_curso" value="<?php echo $datos_curso_edit[1] ?>">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $datos_curso_edit[0] ?>">
            

            <input type="submit" value="Enviar">
        </form>



        <button class="atras" onclick="salir('ver_cursoss.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>

</body>
</html>


<?php
    }else {
        echo "Acceso denegado por..... cuestiones de guión?";
        header("refresh:5;url=ver_cursoss.php");
    }




?>
