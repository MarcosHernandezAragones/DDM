<?php 
    include_once "../functions.php";
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
    $cursos = select_cursos_prof($_SESSION['user']);
     
// Insesetar el usuario en la base de datos
    if (isset($_POST['nombre'])) {

        $apellidos=$_POST['apellido'];
        $correo=$_POST['correo'];
        $DNI=$_POST['dni'];
        $nombre=$_POST['nombre'];
        $passwrd=$_POST['contrasena'];

        $vars_curso=explode('!!!',$_POST['curso']);

        $idCentro=$vars_curso[0];
        $idCurso=$vars_curso[1];


        try {
            create_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_alumno.php");
        }
        header("Location: ver_alumno.php");
    }else{
    


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_addAlumno.css">
    <title>Añadir Alumno</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>


        <main>
            <h1>Añadir Alumno</h1>
            <button class="atras" onclick="redirigir('ver_alumno.php')">Atras</button>

            <div id="formulario">
                
                <form action="crear_alumno.php" method="post">
                    <div class="primeros">
                        <label class="Texto" for="nombre">Nombre: </label>
                        <input  type="text" name="nombre" id="nombre">
                    </div>

                    <div class="segundos" >
                        <label class="Texto" for="apellido">Apellidos: </label>
                        <input class="input" type="text" name="apellido" id="apellido"><br>
                    </div>
                    <div class="primeros">
                        <label class="Texto" for="dni">DNI: </label>
                        <input  type="text" name="dni" id="dni">
                    </div>

                    <div class="segundos" >
                        <label class="Texto" for="correo">E-mail: </label>
                        <input class="input" type="email" name="correo" id="correo"><br>
                    </div>
                    <div class="primeros">
                        <label class="Texto" for="contrasena">Contraseña: </label>
                        <input  type="text" name="contrasena" id="contrasena"><br>
                    </div>

                    <div class="segundos" >
                        <label class="Texto" for="curso">Curso: </label>
                        <select class="input" name="curso" id="curso">
                            <option value="nil" selected>-----------------</option>
                            <?php 
                            for ($i=0; $i < count($cursos); $i++) { 
                                $value_curso=$cursos[$i]["id_centro"]."!!!".$cursos[$i]["id_curso"];

                                echo" <option value=\"".$value_curso."\" >".$cursos[$i]["name"]."</option>";
                            }

                            ?>
                        </select><br>
                        </div>
                    <input type="submit" value="Enviar">



            </form>
            </div>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>

<?php

        }
?>