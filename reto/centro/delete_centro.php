<?php
    include_once "../functions.php";
    session_start();


    if (isset($_POST['id_cent'])) {
        try {
            delete_centro($_POST['id_cent']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=centros");
        }
        header("Location: centros");
    }
    header("Location: centros");










?>