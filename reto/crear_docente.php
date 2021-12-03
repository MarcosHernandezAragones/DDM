<?php 
    include_once "../functions.php";
    session_start();
    //select_cursos_prof(1);
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];


    if (isset($_POST['nombre'])) {//entra tras haberse enviado los datos del formulario
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_crearDocente.css">
    <title>Crear Docente</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

    
    <main>
            <h1>Crear Docente</h1>
        <form action="crear_docente.php" id="formulario" method="post">
            <div id="primero">
                <label for="nombre">Nombre: </label>
            </div>
            <div>
            <input type="text" name="nombre" id="nombre">
            </div>
            <div id="primero">
            <label for="apellido">Apellidos: </label>
            </div>
            <div>
            <input type="text" name="apellido" id="apellido">
            </div>
            <div id="primero">
            <label for="dni">DNI: </label>
            </div>
            <div>
            <input type="text" name="dni" id="dni">
            </div>
            <div id="primero">
            <label for="correo">E-mail: </label>
            </div>
            <div>
            <input type="email" name="correo" id="correo">
            </div>
            <div id="primero">
            <label for="contrasena">Contraseña del profesor: </label>
            </div>
            <div>
            <input type="text" name="contrasena" id="contrasena"><!-- contraseña visible solo al crear --><br>
            </div>
            <div id="primero">

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
            <div id="primero">

            <label for="rol">Rol: </label>
            </div>
            <div>
            <select name="rol" id="rol">
                <option value="nil" selected>-----------------</option>
                <?php 
                for ($i=0; $i < count($rolarr); $i++) { 
                    
                    echo" <option value=\"".$rolarr[$i][0]."\" >".$rolarr[$i][1]."</option>";
                }

                ?>
            </select>
            </div>

            <input type="submit" value="Enviar">

        

        </form>
        <button class="atras" onclick="salir('ver_docente.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>

<?php

        }else{
            echo "Tankers are beggers";
            header("refresh:2;url=ver_docente.php");
        }
?>