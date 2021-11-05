<?php 
    include_once "functions.php";
    session_start();
    //select_cursos_prof(1);
    $_SESSION['id_prof']=3;//test only
    $cursos = select_cursos_prof($_SESSION['id_prof']);


    
    if (isset($_POST['id_al_upd'])) {
        $apellidos=$_POST['apellido'];
        $correo=$_POST['correo'];
        $DNI=$_POST['dni'];
        $nombre=$_POST['nombre'];
        $passwrd=$_POST['contraseña'];

        $vars_curso=explode('!!!',$_POST['curso']);

        $idCentro=$vars_curso[0];
        $idCurso=$vars_curso[1];

        $idGrupo=null;
        $id_alumno=$_POST['id_al_upd'];


        try {
            update_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso,$idGrupo,$id_alumno);
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_alumno.php");
        }
        

        header("Location: ver_alumno.php");
    }else if (isset($_POST['id_alumn'])) {
    
        $datos_alumno=read_alumno($_POST['id_alumn']);
        print_r($datos_alumno);
        echo $datos_alumno[1];
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
        <form action="ver_alumno.php" method="post">
            <input type="submit" value="volver">
        </form>
    <form action="editar_alumno.php" method="post">
        <input type="hidden" name="id_al_upd" value="<?php echo $datos_alumno[0] ?>">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value = "<?php echo $datos_alumno[1] ?>">
        <label for="apellido">Apellidos: </label>
        <input type="text" name="apellido" id="apellido" value = "<?php echo $datos_alumno[2] ?>"><br>
        <label for="dni">DNI: </label>
        <input type="text" name="dni" id="dni" value = "<?php echo $datos_alumno[3] ?>"><br>
        <label for="correo">E-mail: </label>
        <input type="email" name="correo" id="correo" value = "<?php echo $datos_alumno[4] ?>"><br>
        <label for="contraseña">Contraseña nueva del alumno: </label>
        <input type="text" name="contraseña" id="contraseña" value = "<?php echo $datos_alumno[5] ?>"><!-- contraseña visible solo al crear --><br>
        <label for="curso">Curso: </label>
        <select name="curso" id="curso">
            <option value="nil" selected>-----------------</option>
            <?php 
            for ($i=0; $i < count($cursos); $i++) { 
                if ($datos_alumno[7] == $cursos[$i]["id_centro"]  && $datos_alumno[7] == $cursos[$i]["id_curso"] ) {
                    $value_curso=$cursos[$i]["id_centro"]."!!!".$cursos[$i]["id_curso"];
                    echo" <option value=\"$value_curso\" selected>".$cursos[$i]["name"]."</option>";
                }

                $value_curso=$cursos[$i]["id_centro"]."!!!".$cursos[$i]["id_curso"];
                echo" <option value=\"$value_curso\" >".$cursos[$i]["name"]."</option>";
            }

            ?>
        </select><br><br>

        <input type="submit" value="Enviar">



    </form>
</body>
</html>
<?php

}else {
    header("Location: ver_alumno.php");
}



//print_r($datos_alumno);
//[$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul]
?>