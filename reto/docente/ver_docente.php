<?php 
    include_once "../functions.php";
    session_start();
    
    //$_SESSION['id_prof']=1;//test only 

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
    $chek_chek=check_doc_rol($_SESSION['user']);// $check_check = [es_admin, es_superadmin, [datos profesor]]
    

    function mostrar_docentes_centro_admin($identif_centro){//muestra los docentes de un centro  con las opciones de editar y borrar
        $datos_doc_all=read_docentess($identif_centro);
        $centro_aux="";
        echo "<div id='contenido'>";
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
                echo "<h1>$centro</h1>";
            }
            echo  "<div id='docentes'>";
            echo "<div >$nombre </div>  <div >$apellidos</div> <div >$correo</div>";
            
            echo "<div >$rol</div> <div >$centro</div> 
            <form action='editar_docente.php' method='post'>
                <input type='hidden' name='id_doof' value='$id_prof'>
                <input type='submit' value='Edit'>
            </form>" 
            ;
            echo  "<form action='delete_docente.php' method='post'><input type='hidden' name='id_doof' value='$id_prof'><input type='submit' value='DELETE'></form></div><br>";

        }
        echo "<div>";
    }

    function mostrar_docentes_centro($identif_centro){//muestra los docentes de un centro 
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
            echo  "<div>";
            echo "<div >$nombre </div>  <div >$apellidos</div> <div >$correo</div>";
            
            echo "<div >$rol</div> <div >$centro</div> </div>";
        }
    }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_verDocentes.css">
    <title>Ver Docentes</title>
</head>
<body>
    <section>
        <img class="gob" src="" alt="">
        <img class="centro" src="" alt="">
        <img class="abajo" src="../logo_login.png" alt="" srcset="">
        <p class="usuario_contro"><?php echo $nombre?></p>
        <p class="nombre_centro"><?php echo $centro?></p>
        
    </section>
    
    <main>
        <h1>Ver Docentes</h1>
        <form action="crear_docente.php" id="addDocente" method="post">
            <input type="hidden" name="confir" value="a">
            <input type="submit" value="Añadir Docente">
            <input type="button"  onclick="salir('docente_to/add_docente_to_curso.php')" value="Añadir a un curso">
        </form>



    <?php

        //dependiendo del rengo del profesor muestra los profesores del centro con/sin las opciones de andimistrador
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

    <button class="atras" onclick="salir('profesor.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>