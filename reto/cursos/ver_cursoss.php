<?php
    include_once "../functions.php";
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
 

    $chek_chek=check_doc_rol($_SESSION['user']);// entra tras enviar los datos del formulario de la misma pagina
    
    
    if (!($chek_chek[0] || $chek_chek[1])) {
        header("Location: profesor");
    }
    if (!$chek_chek[0] && !$chek_chek[1]) {
        echo "Acceso denegado por motivos random";
        //redirect a landpage pendiente
    }else {
        
  
   function write_admin_forms($id_curso,$id_cent){
       echo "
            <form action='editar-curso' method='post'>
                <input type='hidden' name='id_curso' value='$id_curso'>
                <input type='hidden' name='id_cent' value='$id_cent'>
                <input type='submit' value='Edit'>
            </form>
            <form action='eliminar-curso' method='post'>
            <input type='hidden' name='id_curso' value='$id_curso'>
                <input type='hidden' name='id_cent' value='$id_cent'>
                <input type='submit' value='DELETE' onclick='return confirm(\"Estas seguro de que quieres eliminar el curso\")'>
            </form>";
   }
        
    function mostrar_curso_todo(){//muestra los cursos de los distintos centros y las opciones editar y borrar
        $cursos = read_cursoss();
        for ($i=0; $i < count($cursos) ; $i++) { 
            $nombre_curso=$cursos[$i][0];
            $id_curso=$cursos[$i][1];
            $id_cent=$cursos[$i][2];
            
            $read_centro=read_centro($id_cent);
            $nombre_centro=$read_centro[1];
            echo "<div id='curso'>
                <h2>$nombre_curso $nombre_centro </h2>";

            write_admin_forms($id_curso,$id_cent);
                
            echo "</div>";
        }
    }

    function mostrar_curso_prof_admin($id_centro_comp){//muestra los cursos que imparte el profesor y las opciones editar y borrar
        $cursos = read_cursoss();

        for ($i=0; $i < count($cursos) ; $i++) { 
            $nombre_curso=$cursos[$i][0];
            $id_curso=$cursos[$i][1];
            $id_cent=$cursos[$i][2];
            if ($id_cent == $id_centro_comp) {
                $read_centro=read_centro($id_cent);
                $nombre_centro=$read_centro[1];
                echo "<div id='curso'>
                    <h2>$nombre_curso</h2>";
                
                write_admin_forms($id_curso,$id_cent);
          
                echo "</div><br>";
            }
        }
    }

    function mostrar_curso_prof($id_centro_comp){//muestra los cursos que imparte el profesor
        $cursos = read_cursoss();

        for ($i=0; $i < count($cursos) ; $i++) { 
            $nombre_curso=$cursos[$i][0];
            $id_curso=$cursos[$i][1];
            $id_cent=$cursos[$i][2];
            if ($id_cent == $id_centro_comp) {
                $read_centro=read_centro($id_cent);
                $nombre_centro=$read_centro[1];
                echo "<div id='curso'>
                    <h2>$nombre_curso</h2>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>ver clases</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

    <main>
        <h1>Ver Clases</h1>
        <?php 
            if ($chek_chek[1] || $chek_chek[0]) {
                
            

        ?>
                <form action='add-curso' id='addCentro' method='post'>
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
        

    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>



<?php
  }
?>