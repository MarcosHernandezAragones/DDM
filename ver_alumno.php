<?php 
    include_once "functions.php";
    session_start();

    $_SESSION['id_prof']=3;//test only
    //$_SESSION['id_alumn']=2;//test only

    $cursos=select_cursos_prof($_SESSION['id_prof']);
    //$datos_alumno=read_alumno($_SESSION['id_alumn']);
    
    


   
    



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .alumno{
            display: inline-block;
        }
    </style>
</head>
<body>
     <!-- 
        clase
            alumno 1....................editar,borrar

            [nombre,apellidos] [color1] [color2] [color3] [color4] [preguntas_respondidas] [edit,delete] [hidden_sh...]
            [nombre,apellidos] [color1] [color2] [color3] [color4] [preguntas_respondidas] [edit,delete] [hidden_sh...]
            [nombre,apellidos] [color1] [color2] [color3] [color4] [preguntas_respondidas] [edit,delete] [hidden_sh...]
            [$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul]
      -->

    <?php
    
            for ($i=0; $i < count($cursos); $i++) { 

    ?>       
        <div id="<?php echo $cursos[$i]['name']; ?>">
        <h2><?php echo $cursos[$i]['name']; ?></h2>
        <form action="crear_alumno.php" method="post">
            <input type="submit" value="Añadir alumno">
        </form>
    <?php
                
                echo "<br>/////////////////////////////////////////<br>";
                echo "/////////////////////////////////////////<br>";
                echo "/////////////////////////////////////////<br>";

                $datos_alumnos_clase=read_alumnoss($cursos[$i]['id_curso'],$cursos[$i]['id_centro']);
                
                if (count($datos_alumnos_clase) == 0) {
                    echo "No hay alumnos en esta clase";
                }else{
                    for ($gg=0; $gg < count($datos_alumnos_clase); $gg++) { 

                        //print_r($datos_alumnos_clase[$gg]);
                        $nombre=$datos_alumnos_clase[$gg][1];
                        $apell=$datos_alumnos_clase[$gg][2];

                        $rojo=$datos_alumnos_clase[$gg][10];
                        $verde=$datos_alumnos_clase[$gg][11];
                        $azul=$datos_alumnos_clase[$gg][12];
                        $amarillo=$datos_alumnos_clase[$gg][9];

                        $id_alumno=$datos_alumnos_clase[$gg][0];

                        echo "<div class='alumno'>$nombre $apell: </div> <div class='alumno'>$rojo</div> <div class='alumno'>$azul</div> <div class='alumno'>$amarillo</div> <div class='alumno'>$verde</div>  <div class='alumno'>N/A</div> <div class='alumno'><form action='editar_alumno.php' method='post'><input type='hidden' name='id_alumn' value='$id_alumno'><input type='submit' value='Edit'></form></div> <div class='alumno'><form action='delete_alumno.php' method='post'><input type='hidden' name='id_alumn' value='$id_alumno'><input type='submit' value='DELETE'></form></div><br>";
                        
                    
                        //print_r($datos_alumnos_clase);
                    }
                }



    ?>
        </div>
    <?php


            }
        
    
    
    
    
    
    
    
    
    
    
    
    ?>


</body>
</html>