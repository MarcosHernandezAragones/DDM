<?php
    include_once "functions.php";
    session_start();


    if (isset($_POST['id_cent'])) {
        try {
            delete_centro($_POST['id_cent']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_centro.php");
        }
        header("Location: ver_centro.php");
    }
    header("Location: ver_centro.php");










?>