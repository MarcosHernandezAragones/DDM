<?php
    include_once "../functions.php";
    session_start();


    if (isset($_POST['id_cent'])) {
        try {
            delete_curso($_POST['id_curso'], $_POST['id_cent']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_cursoss.php");
        }
        //header("Location: ver_cursoss.php");
        header("refresh:5;url=ver_cursoss.php");
    }
    header("Location: ver_cursoss.php");










?>