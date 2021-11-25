<?php
    include_once "../functions.php";
    session_start();


    if (isset($_POST['id_cent'])) {
        try {
            delete_curso($_POST['id_curso'], $_POST['id_cent']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=curso");
        }
        header("Location: curso");
        //header("refresh:5;url=curso");
    }
    header("Location: curso");










?>