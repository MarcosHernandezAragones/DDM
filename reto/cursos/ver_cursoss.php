<?php
    include_once "../functions.php";
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
    //$_SESSION['id_prof']=4;//test only 
    $_SESSION['id_prof']=1;//test only 

    $chek_chek=check_doc_rol($_SESSION['id_prof']);

    if (!$chek_chek[0] && !$chek_chek[1]) {
        echo "Acceso denegado por motivos random";
        //header("refresh:2;url=ver_.php");
    }else {
        
  
   function write_admin_forms($id_curso,$id_cent){
       echo "
            <form action='editar_curso.php' method='post'>
                <input type='hidden' name='id_curso' value='$id_curso'>
                <input type='hidden' name='id_cent' value='$id_cent'>
                <input type='submit' value='Edit'>
            </form>
            <form action='delete_curso.php' method='post'>
            <input type='hidden' name='id_curso' value='$id_curso'>
                <input type='hidden' name='id_cent' value='$id_cent'>
                <input type='submit' value='DELETE'>
            </form>";
   }
        
    function mostrar_curso_todo(){
        $cursos = read_cursoss();

        for ($i=0; $i < count($cursos) ; $i++) { 
            $nombre_curso=$cursos[$i][0];
            $id_curso=$cursos[$i][1];
            $id_cent=$cursos[$i][2];
            
            $read_centro=read_centro($id_cent);
            $nombre_centro=$read_centro[1];
            echo "<div id='curso'>
                <div>$nombre_curso------------$nombre_centro </div>";

            write_admin_forms($id_curso,$id_cent);
                
            echo "</div>";
        }
    }

    function mostrar_curso_prof_admin($id_centro_comp){//$chek_chek[2][7]
        $cursos = read_cursoss();

        for ($i=0; $i < count($cursos) ; $i++) { 
            $nombre_curso=$cursos[$i][0];
            $id_curso=$cursos[$i][1];
            $id_cent=$cursos[$i][2];
            if ($id_cent == $id_centro_comp) {
                $read_centro=read_centro($id_cent);
                $nombre_centro=$read_centro[1];
                echo "<div>
                    <div>$nombre_curso------------$nombre_centro </div>";
                
                write_admin_forms($id_curso,$id_cent);
          
                echo "</div><br>";
            }
        }
    }

    function mostrar_curso_prof($id_centro_comp){//$chek_chek[2][7]
        $cursos = read_cursoss();

        for ($i=0; $i < count($cursos) ; $i++) { 
            $nombre_curso=$cursos[$i][0];
            $id_curso=$cursos[$i][1];
            $id_cent=$cursos[$i][2];
            if ($id_cent == $id_centro_comp) {
                $read_centro=read_centro($id_cent);
                $nombre_centro=$read_centro[1];
                echo "<div>
                    <div>$nombre_curso------------$nombre_centro </div>
                </div>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_verCursos.css">
    <title>ver clases</title>
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
        <h1>Ver Clases</h1>
        <?php 
            if ($chek_chek[1] || $chek_chek[0]) {
                
            

        ?>
                <form action='crear_curso.php' id='addCentro' method='post'>
                    <input type="hidden" name="confir" value="a">
                    <input type='submit' value='AÑADIR CURSO'>
                </form>
        <?php 
            }

        ?>

    <div id="cursos">
        <?php
            if ($chek_chek[1]) {
                mostrar_curso_todo();
            }elseif ($chek_chek[0]) {
            mostrar_curso_prof_admin($chek_chek[2][7]);
            }else {
                mostrar_curso_prof($chek_chek[2][7]);
            }
        ?>
    </div>
        
        <button class="atras" onclick="salir('../profesor/profesor.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>



<?php
  }
?>