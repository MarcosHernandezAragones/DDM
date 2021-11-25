<?php
    include_once "../functions.php";
    session_start();


    if (isset($_POST['id_doof'])) {
        try {
            delete_docente($_POST['id_doof']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=profesores");
        }
        header("Location: profesores");
    }
    header("Location: profesores");

?>