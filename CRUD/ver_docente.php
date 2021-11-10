<?php 
    include_once "functions.php";
    session_start();
    
    $_SESSION['id_prof']=1;//test only 

    
    $chek_chek=check_doc_rol($_SESSION['id_prof']);
    

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
        if ($chek_chek[1]) {
            $centros=read_centross();
            for ($i=0; $i < count($centros); $i++) { 
                mostrar_docentes_centro_admin($centros[$i][0]);
            }
        } elseif ($$chek_chek[0]){
            mostrar_docentes_centro_admin($chek_chek[2][7]);
        }else {
            mostrar_docentes_centro($chek_chek[2][7]);
        }
        
        
    ?>
</body>
</html>