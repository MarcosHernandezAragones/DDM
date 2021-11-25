<?php
    include_once "../../functions.php";
    session_start();


    if (isset($_POST['doc_doc'])) {
        $id_doof=$_POST['doc_doc'];
        $id_centre=$_POST['centre'];
        $id_curse=$_POST['curse'];




        try {
            //delete_curso($_POST['id_curso'], $_POST['id_cent']);
            delete_curso_has_docente($id_doof, $id_centre, $id_curse);
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=ver-cursos-docente");
        }
        //header("Location: ver_cursoss.php");
        header("refresh:0;url=ver-cursos-docente");
    }
    //header("Location: ver_cursoss.php");
    header("refresh:0;url=ver-cursos-docente");








?>