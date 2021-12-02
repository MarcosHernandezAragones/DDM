
<?php 
    include_once "../../functions.php";
    session_start();



    $chek_chek=check_doc_rol($_SESSION['user']);// $check_check = [es_admin, es_superadmin, [datos profesor]]

   
   





    if (isset($_POST["add_doc"])) {// entra tras enviar los datos del formulario de la misma pagina
        if ($_POST["curso"] == "nil" || $_POST["add_doc"] == "nil" ) {
            echo "curso no seleccionado";
            header("refresh:0;url=ver-cursos-docente");
        }
        
        $id_doof=$_POST["add_doc"];
        $val_curs=$_POST["curso"];
        $vals_curss=explode("!!!",$val_curs);
        $id_cent=$vals_curss[0];
        
        $id_curso=$vals_curss[1];

        
        try {
            create_curso_has_docente($id_doof, $id_cent, $id_curso);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:15;url=ver-cursos-docente");
        }
        //header("Location: ver-cursos-docente");
        header("refresh:0;url=ver-cursos-docente");

    } else if (isset($_POST['confir'])){//entra desde el formulario de la pagina ver_

        $docentes=read_docentess($_POST['centre']);

        $cursos=read_cursoss();
        $cont=0;
        $cursos_mostrar;
        for ($i=0; $i < count($cursos); $i++) { 
            if ($cursos[$i][2] == $_POST['centre']) {
                
                $cursos_mostrar[$cont]=$cursos[$i];
                $cont++;
            }
        }
        

?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/estilo_addDocentetoCurso.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Añadir docente a curso</title>
</head>
<body>
    <?php include_once "../../menu_fijo.php" ?>
    <main>
        <h1>Añadir Docente a un Curso</h1>

        <form action="ver-cursos-docente" id="volver" method="post">
            <input type="submit" value="volver">
        </form>

            <br><br>
        <form action="add-docente-a-curso" id="funcion" method="post">

            <select name="add_doc" id="add_doc">
                <option value="nil" selected>-----------------</option>
                <?php 
                for ($i=0; $i < count($docentes); $i++) { //muestra los docentes del centro como opcion

                    echo" <option value=\"".$docentes[$i][0]."\" >".$docentes[$i][1]." ".$docentes[$i][2]."</option>";
                
                }

                ?>
            </select>

            <select name="curso" id="curso">
                <option value="nil" selected>-----------------</option>
                <?php 
                for ($i=0; $i < count($cursos_mostrar); $i++) { //muestra los cursos que se imparten en el centro como opcion
                    $value_curso=$cursos_mostrar[$i][2]."!!!".$cursos_mostrar[$i][1];
                    echo" <option value=\"".$value_curso."\" >".$cursos_mostrar[$i][0]."</option>";
                
                }

                ?>
            </select>

            <input type="submit" value="Enviar">
        </form>
    </main>
</body>
</html>


<?php
    }else {
        echo "Access denied: only protoss or zerg allowed";
        header("refresh:0;url=ver-cursos-docente");
    }




?>

