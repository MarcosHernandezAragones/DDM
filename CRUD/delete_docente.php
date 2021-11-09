<?php
    include_once "functions.php";
    session_start();


    if (isset($_POST['id_doof'])) {
        try {
            delete_docente($_POST['id_doof']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_docente.php");
        }
        header("Location: ver_docente.php");
    }
    header("Location: ver_docente.php");










?>