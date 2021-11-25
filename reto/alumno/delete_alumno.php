<?php
    include_once "../functions.php";

    if (isset($_POST['id_alumn'])) {
        try {
            delete_alumnos($_POST['id_alumn']);
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=listar-alumnos");
        }
        header("Location: listar-alumnos");
    } else {
        header("Location: listar-alumnos");
    }

?>