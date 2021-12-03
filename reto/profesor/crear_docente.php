<?php 
    include_once "functions.php";
    session_start();
    //select_cursos_prof(1);


    if (isset($_POST['nombre'])) {
        $flag=true;
        if ($_POST["centro"] == "nil") {
            echo "centro no seleccionado";
            header("refresh:5;url=ver_cursoss.php");
            $flag=false;
        }
        if ($_POST["rol"] == "nil") {
            echo "rol no seleccionado";
            header("refresh:5;url=ver_cursoss.php");
            $flag=false;
        }

        $apellidos=$_POST['apellido'];
        $correo=$_POST['correo'];
        $DNI=$_POST['dni'];
        $nombre=$_POST['nombre'];
        $passwrd=$_POST['contrasena'];

        

        $idCentro=$_POST['centro'];
        
        $idRol=$_POST['rol'];
        
        






        if ($flag) {
            try {
                create_docente($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idRol);
            
            } catch (Exception $th) {
                echo $th;
                header("refresh:5;url=ver_docente.php");
            }
            header("Location: ver_docente.php");
        }
        
        //header("refresh:15;url=ver_docente.php");
    }elseif (isset($_POST['confir'])){
        $centros=read_centross();
        $rolarr=read_rolss();

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
        <h1>docente</h1>
        <form action="ver_docente.php" method="post">
            <input type="submit" value="volver">
        </form>
    <form action="crear_docente.php" method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <label for="apellido">Apellidos: </label>
        <input type="text" name="apellido" id="apellido"><br>
        <label for="dni">DNI: </label>
        <input type="text" name="dni" id="dni"><br>
        <label for="correo">E-mail: </label>
        <input type="email" name="correo" id="correo"><br>
        <label for="contrasena">Contraseña del profesor: </label>
        <input type="text" name="contrasena" id="contrasena"><!-- contraseña visible solo al crear --><br>

        <label for="centro">Centro: </label>
        <select name="centro" id="centro">
            <option value="nil" selected>-----------------</option>
            <?php 
            for ($i=0; $i < count($centros); $i++) { 
                
                echo" <option value=\"".$centros[$i][0]."\" >".$centros[$i][1]."</option>";
            }

            ?>
        </select><br><br>


        <label for="rol">Rol: </label>
        <select name="rol" id="rol">
            <option value="nil" selected>-----------------</option>
            <?php 
            for ($i=0; $i < count($rolarr); $i++) { 
                
                echo" <option value=\"".$rolarr[$i][0]."\" >".$rolarr[$i][1]."</option>";
            }

            ?>
        </select><br><br><br>

        <input type="submit" value="Enviar">

       

    </form>
</body>
</html>

<?php

        }else{
            echo "Acceso denegado por motivos random";
            header("refresh:2;url=ver_docente.php");
        }
?>