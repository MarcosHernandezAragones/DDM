<?php
    include_once "functions.php";
    session_start();
    
    //$_SESSION['id_prof']=4;//test only 
    //$_SESSION['id_prof']=3;//test only 
    $_SESSION['id_prof']=1;//test only 

    $chek_chek=check_doc_rol($_SESSION['id_prof']);
    
    

    
  

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
        <!-- -->
    <?php 
        if ($chek_chek[0] || $chek_chek[1]) {
                
            
            
    ?>
        <form action='add_docentess_to_cursoss.php' method='post'>
        <input type="hidden" name="confir" value="<?php  echo $chek_chek[2][0]  ?>">
            <input type="hidden" name="centre" value="<?php  echo $chek_chek[2][7]  ?>">
            <input type='submit' value='AÑADIR Docente A curso'>
        </form>
           
    <?php
        } else {  
    ?>

        <form action='add_docente_to_curso.php' method='post'>
            <input type="hidden" name="confir" value="<?php  echo $chek_chek[2][0]  ?>">
            <input type="hidden" name="centre" value="<?php  echo $chek_chek[2][7]  ?>">
            <input type='submit' value='Unirse a curso'>
        </form>
        
         
        
         
         
    <?php
        }

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
                    if ($h1_content != $cursos[$k][0]) {
                        $h1_content=$cursos[$k][0];
                        echo "<h1>".$cursos[$k][0]."</h1>";
                    }
                    # [$id_prof,$nombre,$apellidos,$DNI,$correo,$passwrd,$rol,$centro]code...[$nombre_curs,$id_curso,$id_centro]   [$id_doof,$id_curso,$id_centro]  [$id_prof,$nombre,$apellidos,$DNI,$correo,$passwrd,$rol,$centro]
                    
                    $docente=read_docente($cursos_has_docentes[$i][0]);
                    
                    echo "___________".$docente[1]."---".$docente[2];
                    
                    
    ?>
                    <form action="delete_docente_from_curso.php" method="post">
                        <input type="hidden" name="doc_doc" value="<?php  echo $cursos_has_docentes[$i][0]  ?>">
                        <input type="hidden" name="curse" value="<?php  echo $cursos_has_docentes[$i][1]  ?>">
                        <input type="hidden" name="centre" value="<?php  echo $cursos_has_docentes[$i][2]  ?>">

                        <input type="submit" value="DELETE">
                    </form>





    <?php

                }
            }

        }
    ?>
    
</body>
</html>


