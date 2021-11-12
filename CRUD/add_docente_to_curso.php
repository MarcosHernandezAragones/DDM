
<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 

    $chek_chek=check_doc_rol($_SESSION['id_prof']);

   
   





    if (isset($_POST["add_doc"])) {
        if ($_POST["curso"] == "nil") {
            echo "curso no seleccionado";
            header("refresh:15;url=ver_curso_docentess.php");
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
            header("refresh:15;url=ver_curso_docentess.php");
        }
        //header("Location: ver_curso_docentess.php");
        header("refresh:15;url=ver_curso_docentess.php");

    } else if (isset($_POST['confir'])){
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ver_curso_docentess.php" method="post">
        <input type="submit" value="volver">
    </form>
        <br><br>
    <form action="add_docente_to_curso.php" method="post">
        <input type="hidden" name="add_doc" value="<?php echo $chek_chek[2][0] ?>">
        <select name="curso" id="curso">
            <option value="nil" selected>-----------------</option>
            <?php 
            for ($i=0; $i < count($cursos_mostrar); $i++) { 
                $value_curso=$cursos_mostrar[$i][2]."!!!".$cursos_mostrar[$i][1];
                echo" <option value=\"".$value_curso."\" >".$cursos_mostrar[$i][0]."</option>";
            
            }

            ?>
        </select><br>
        <br>
        <input type="submit" value="Enviar">
    </form>





</body>
</html>


<?php
    }else {
        echo "Acceso denegado por motivos random";
        header("refresh:2;url=ver_curso_docentess.php");
    }




?>

