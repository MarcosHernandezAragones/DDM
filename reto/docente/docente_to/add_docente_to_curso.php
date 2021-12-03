
<?php 
    include_once "../../functions.php";
    session_start();

    $_SESSION['id_prof']=1;//test only 

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
    $chek_chek=check_doc_rol($_SESSION['id_prof']);// $check_check = [es_admin, es_superadmin, [datos profesor]]

   
   





    if (isset($_POST["add_doc"])) {// entra tras enviar los datos del formulario de la misma pagina
        if ($_POST["curso"] == "nil") {
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
            header("refresh:0;url=ver-cursos-docente");
        }
        //header("Location: ver-cursos-docente");
        header("refresh:0;url=ver-cursos-docente");

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
        
<?php include_once "../../menu_fijo.php"?>

    
    <main>
        <form action="ver-cursos-docente" method="post">
            <input type="submit" value="volver">
        </form>
            <br><br>
        <form action="#" method="post">
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




        <button class="atras" onclick="salir('profesores')">Atras</button>
    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>


<?php
    }else {
        echo "UNEXPECTED ERROR: DMTT";
        header("refresh:0;url=ver-cursos-docente");
    }




?>

