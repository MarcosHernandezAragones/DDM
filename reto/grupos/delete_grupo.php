<?php
    include_once "../functions.php";
    session_start();


    if (isset($_POST['group'])) {
        try {
            delete_grupo($_POST['group']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=grupo");
        }
        header("Location: grupo");
    }
    header("Location: grupo");










?>