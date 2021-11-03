<?php 
    include_once "functions.php";
    session_start();
    select_cursos_prof(1);
    //$cursos = select_cursos_prof($_SESSION['id']);
    //$cursos=$_SESSION['cursos'];
    $cursos=["eso1"];


    


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
    <form action="crear_alumno.php" method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <label for="apellido">Apellidos: </label>
        <input type="text" name="apellido" id="apellido"><br>
        <label for="dni">DNI: </label>
        <input type="text" name="dni" id="dni"><br>
        <label for="correo">E-mail: </label>
        <input type="email" name="correo" id="correo"><br>
        <label for="contraseña">Contraseña del alumno: </label>
        <input type="text" name="contraseña" id="contraseña"><!-- contraseña visible solo al crear --><br>
        <label for="curso">Curso: </label>
        <select name="curso" id="curso">
            <option value="nil" selected>-----------------</option>
            <?php 
            for ($i=0; $i < count($cursos); $i++) { 
                $value_curso=$cursos[$i]["id_centro"]."!!!".$cursos[$i]["id_curso"];
                echo" <option value=\"".$value_curso."\" >".$cursos[$i]["name"]."</option>";
            }

            ?>
        </select><br><br>

        <input type="submit" value="Enviar">



    </form>
</body>
</html>