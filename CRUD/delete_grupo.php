<?php
    include_once "functions.php";
    session_start();


    if (isset($_POST['group'])) {
        try {
            delete_grupo($_POST['group']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_grupos.php");
        }
        header("Location: ver_grupos.php");
    }
    header("Location: ver_grupos.php");










?>