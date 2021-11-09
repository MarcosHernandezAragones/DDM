<?php 
    include_once "functions.php";
    session_start();
    //$cursos_arr WIP


    $rolarr=read_rolss();
    for ($i=0; $i < count($rolarr); $i++) { 
            
        if ($rolarr[$i][1] == "superadmin") {

            $id_sup=$rolarr[$i][0];
        }elseif ($rolarr[$i][1] == "admin") {
            $id_admog=$rolarr[$i][0];
        }
    }
    
    $_SESSION['id_prof']=1;//test only 
    $datos_doc=read_docente($_SESSION['id_prof']);

    //[$id_prof,$nombre,$apellidos,$DNI,$correo,$passwrd,$rol,$centro]  rol 6
    $is_sup=false;
    $is_admog=false;


    function mostrar_docentes_centro_admin($identif_centro){
        $datos_doc_all=read_docentess($identif_centro);
        $centro_aux="";
        for ($i=0; $i < count($datos_doc_all); $i++) { 
            $id_prof=$datos_doc_all[$i][0];//
            $nombre=$datos_doc_all[$i][1];
            $apellidos=$datos_doc_all[$i][2];//
            //$DNI=$datos_doc_all[3];
            $correo=$datos_doc_all[$i][4];//
            //$passwrd=$datos_doc_all[5];
            $rolarr=read_rol($datos_doc_all[$i][6]);
            $rol=$rolarr[1];
            $centroarr=read_centro($datos_doc_all[$i][7]);
            $centro=$centroarr[1];
            if ($centro_aux != $centro) {
                $centro_aux=$centro;

                echo "<h1>$centro</h1><br>";
            }else{
                echo "<br>";
            }



            
            echo  "<div id='doc_$id_prof'>";
            echo "<div >$nombre </div>  <div >$apellidos</div> <div >$correo</div>";
            
            echo "<div >$rol</div> <div >$centro</div> 
            <div><form action='editar_docente.php' method='post'><input type='hidden' name='id_doof' value='$id_prof'><input type='submit' value='Edit'></form></div>" 
            ;
            echo  "<div><form action='delete_docente.php' method='post'><input type='hidden' name='id_doof' value='$id_prof'><input type='submit' value='DELETE'></form></div><br>";
            echo "</div>";

        }
    }

    function mostrar_docentes_centro($identif_centro){
        $datos_doc_all=read_docentess($identif_centro);
        for ($i=0; $i < count($datos_doc_all); $i++) { 
            $id_prof=$datos_doc_all[$i][0];//
            $nombre=$datos_doc_all[$i][1];
            $apellidos=$datos_doc_all[$i][2];//
            //$DNI=$datos_doc_all[3];
            $correo=$datos_doc_all[$i][4];//
            //$passwrd=$datos_doc_all[5];
            $rolarr=read_rol($datos_doc_all[$i][6]);
            $rol=$rolarr[1];
            $centroarr=read_centro($datos_doc_all[$i][7]);
            $centro=$centroarr[1];
            echo "<h1>$centro</h1><br>";
            echo  "<div id='doc_$id_prof'>";
            echo "<div >$nombre </div>  <div >$apellidos</div> <div >$correo</div>";
            
            echo "<div >$rol</div> <div >$centro</div> </div>";
        }
    }

    if ($datos_doc[6] ==  $id_sup) {
        $is_sup=true;
        
    }elseif ($datos_doc[6] ==  $id_admog) {
        $is_admog=true;
        
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
        <form action="crear_docente.php" method="post">
            <input type="hidden" name="confir" value="a">
            <input type="submit" value="Añadir Docente">
        </form>



    <?php
        if ($is_sup) {
            $centros=read_centross();
            for ($i=0; $i < count($centros); $i++) { 
                mostrar_docentes_centro_admin($centros[$i][0]);
            }
        } elseif ($is_admog){
            mostrar_docentes_centro_admin($datos_doc[7]);
        }else {
            mostrar_docentes_centro($datos_doc[7]);
        }
        
        
    ?>
</body>
</html>