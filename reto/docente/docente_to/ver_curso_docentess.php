<?php
    include_once "../../functions.php";
    session_start();
    
    //$_SESSION['id_prof']=4;//test only 
    //$_SESSION['id_prof']=3;//test only 
    $_SESSION['id_prof']=1;//test only 

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];

    $chek_chek=check_doc_rol($_SESSION['id_prof']);// $check_check = [es_admin, es_superadmin, [datos profesor]]
    

    
  

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/estilo_verCursoDocene.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Ver Docentes de curso</title>
</head>
<body>
        
<?php include_once "../../menu_fijo.php"?>

    
    <main>
        <h1>Ver curso con docentes</h1>

        <?php 
            if ($chek_chek[0] || $chek_chek[1]) { //si es admin o superadmin permite añadir otros profesores a un curso
                       
                
        ?>
        <form action='add-docente-a-curso' class="addDocente" method='post'>
            <input type="hidden" name="confir" value="<?php  echo $chek_chek[2][0]  ?>">
            <input type="hidden" name="centre" value="<?php  echo $chek_chek[2][7]  ?>">
            <input type='submit' value='Añadir Docente a curso'>
        </form>
    
            <?php
                } else {  // si no es admin o superadmin permite al profesor añadirse a un curso 
            ?>

                <form action='add_docente_to_curso.php' class="addDocente" method='post'>
                    <input type="hidden" name="confir" value="<?php  echo $chek_chek[2][0]  ?>">
                    <input type="hidden" name="centre" value="<?php  echo $chek_chek[2][7]  ?>">
                    <input type='submit' value='Unirse a curso'>
                </form>
                
                
                
                
                   
                <?php
                    }
                    echo " <div id='contenido'>";
                    $cursos=read_cursoss();
 
                    if ($chek_chek[1]) {
                        $cursos_has_docentes=read_curso_has_docentess();
                    } else {
                        $cursos_has_docentes=read_curso_has_docente($chek_chek[2][7]);
                    }
                    
                    $h1_content="";
                    for ($i=0; $i < count($cursos_has_docentes); $i++) { 
                        
                        for ($k=0; $k < count($cursos); $k++) { 
                            if ($cursos_has_docentes[$i][1] == $cursos[$k][1]) {
                                echo "<div class='cursos'>";
                                if ($h1_content != $cursos[$k][0]) {
                                    $h1_content=$cursos[$k][0];
                                    echo "<h2>".$cursos[$k][0]."</h2>";
                                }   
                                $docente=read_docente($cursos_has_docentes[$i][0]);
                                
                                echo "<span>".$docente[1]." ".$docente[2]."</span>";//muestra nombre y apellidos
                                
                                
                ?>

                <form action="eliminar-docente-de-curso" class="delDocente" method="post">
                    <input type="hidden" name="doc_doc" value="<?php  echo $cursos_has_docentes[$i][0] //id profesor ?>">
                    <input type="hidden" name="curse" value="<?php  echo $cursos_has_docentes[$i][1] //id curso ?>">
                    <input type="hidden" name="centre" value="<?php  echo $cursos_has_docentes[$i][2] //id centro ?>">

                    <input type="submit" value="DELETE">
                </form>

                <?php
                echo "</div>";
                            }
                            
                        }

                    }
                ?>
            </div>
    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>


