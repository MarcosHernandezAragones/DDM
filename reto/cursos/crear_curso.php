<?php 
    include_once "../functions.php";
    session_start();

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];

    $chek_chek=check_doc_rol($_SESSION['user']);// entra tras enviar los datos del formulario de la misma pagina



    if (isset($_POST["aux_cursed"])) {//inserta los datos del curso en base de datos
        $flag=true;
        if ($_POST["centro"] == "nil") {
            echo "centro no seleccionado";
            header("refresh:5;url=ver_cursoss.php");
            $flag=false;
        }

        $nombre_curso=$_POST["nombre"];
        
        $id_centro=$_POST["centro"];
        if ($flag) {
            try {
            create_curso($nombre_curso, $id_centro);
            
            } catch (Exception $th) {
                echo $th;
                header("refresh:5;url=ver_cursoss.php");
            }
            header("Location: ver_cursoss.php");
        }
        
        

    } else if (($chek_chek[1] || $chek_chek[0]) && isset($_POST['confir'])){
        $centros=read_centross();


?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_addCurso.css">
    <title>Añadir Curso</title>
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
        <h1>Crear Curso</h1>


        <form action="crear_curso.php" method="post" id="formulario">
            <div id="uno">
                <input type="hidden" name="aux_cursed" value="a">
                <label for="nombre">Nombre: </label>
            </div>
            <div>
                <input type="text" name="nombre" id="nombre">
            </div>
            <div id="uno">
                <label for="centro">Centro: </label>
            </div>
            <div>
                <select name="centro" id="centro">
                    <option value="nil" selected>-----------------</option>
                    <?php 
                    for ($i=0; $i < count($centros); $i++) { 
                        
                        echo" <option value=\"".$centros[$i][0]."\" >".$centros[$i][1]."</option>";
                    }

                    ?>
                </select>
            </div>
            <input type="submit" value="Enviar">
        </form>


        <button class="atras" onclick="salir('ver_cursoss.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>


</body>
</html>


<?php
    }else {
        echo "Treelaw";
        header("refresh:2;url=ver_cursoss.php");
    }




?>

