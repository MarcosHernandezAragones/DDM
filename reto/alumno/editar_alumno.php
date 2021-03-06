<?php 
    include_once "../functions.php";
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    

    $cursos = select_cursos_prof($_SESSION['user']);

//inserta los cambios en la base de datos    
    if (isset($_POST['id_al_upd'])) {
        $apellidos=$_POST['apellido'];
        $correo=$_POST['correo'];
        $DNI=$_POST['dni'];
        $nombre=$_POST['nombre'];
        $pass_old=$_POST['pass_old'];
        $passwrd=$_POST['contraseña'];

        if ($passwrd == "" || is_null($passwrd)) {
            $passwrd=$pass_old;
        }

        $vars_curso=explode('!!!',$_POST['curso']);

        $idCentro=$vars_curso[0];
        $idCurso=$vars_curso[1];

        $idGrupo=null;
        $id_alumno=$_POST['id_al_upd'];

        try {

            update_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso,$idGrupo,$id_alumno);
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=listar-alumnos");
        }
        header("Location: listar-alumnos");
    }else if (isset($_POST['id_alumn'])) {
    
        $datos_alumno=read_alumno($_POST['id_alumn']);
        
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_editAlumno.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>


    <main>
        <h1>Añadir Alumno</h1>
 
        <div id="formulario">
            <form action="editar-alumno" method="post" onsubmit="return validar()">
                <input type="hidden" name="id_al_upd" value="<?php echo $datos_alumno[0] ?>">

                <div>
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" id="nombre" value = "<?php echo $datos_alumno[1] ?>" required>
                </div>
                <div class="segundos" >
                    <label for="apellido">Apellidos: </label>
                    <input type="text" name="apellido" id="apellido" value = "<?php echo $datos_alumno[2] ?>" required><br>
                </div>
                <div>
                    <label for="dni">DNI: </label>
                    <input type="text" name="dni" id="dni" value = "<?php echo $datos_alumno[3] ?>" required><br>
                </div>
                <div class="segundos" >
                    <label for="correo">E-mail: </label>
                    <input type="email" name="correo" id="correo" value = "<?php echo $datos_alumno[4] ?>" required><br>
                </div>
                <div>
                    <label for="contraseña">Contraseña nueva: </label>
                    <input type="hidden" name="pass_old" value = "<?php echo $datos_alumno[5] ?>">
                    <input type="text" name="contraseña" id="contraseña"><!-- contraseña visible solo al crear --><br>
                </div>
                <div class="segundos" >
                    <label for="curso">Curso: </label>
                    <select name="curso" id="curso">
                        <option value="nil" selected>-----------------</option>
                        <?php 
                        for ($i=0; $i < count($cursos); $i++) { 
                            if ($datos_alumno[7] == $cursos[$i]["id_centro"]  && $datos_alumno[7] == $cursos[$i]["id_curso"] ) {
                                $value_curso=$cursos[$i]["id_centro"]."!!!".$cursos[$i]["id_curso"];
                                echo" <option value=\"$value_curso\" selected>".$cursos[$i]["name"]."</option>";
                            }else{

                                $value_curso=$cursos[$i]["id_centro"]."!!!".$cursos[$i]["id_curso"];
                                echo" <option value=\"$value_curso\" >".$cursos[$i]["name"]."</option>";
                            }
                        }

                        ?>
                    </select><br><br>
                </div>
                <input type="submit" value="Enviar">



            </form>
            </div>
    </main>
    <script type="text/javascript" src="funciones-js"></script>
    <script>
        function validar(){
            if (document.getElementById("curso").value=="nil"){
                alert("Opcion no valida, elija un curso para modificar el alumno.")
                return false
            }
        }
    </script>
</body>
</html>
<?php

}else {
    header("Location: listar-alumnos");
}


?>