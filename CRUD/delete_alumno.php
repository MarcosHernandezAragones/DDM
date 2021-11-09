<?php
    include_once "functions.php";
    session_start();

    if (isset($_POST['id_alumn'])) {
        try {
            delete_alumnos($_POST['id_alumn']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_alumno.php");
        }
        header("Location: ver_alumno.php");
    } else {
        header("Location: ver_alumno.php");
    }

?>