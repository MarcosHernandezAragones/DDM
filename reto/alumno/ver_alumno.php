<?php 
    include_once "../functions.php";
    include "../funciones_BBDD.php";
    $conexion=conectarBD();

    session_start();

    
    
    $cursos=select_cursos_prof($_SESSION['user']);//seleciona los cursos de un profesor
    
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_veralumno.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Ver Alumnos</title>
    <style>
        .alumno{
            display: inline-block;
        }
    </style>
</head>
<body>


<?php include_once "../menu_fijo.php"?>


    <main>
    <?php
    
            for ($i=0; $i < count($cursos); $i++) { 

    ?>       
            <div id="<?php echo $cursos[$i]['name']; ?>">
                <h2 class="titulo"><?php echo $cursos[$i]['name']; ?> <a onclick="apariencia('<?php echo $cursos[$i]['name']; ?>','flecha<?php echo $i;?>' )"><i  id="flecha<?php echo $i;?>" class="fas fa-caret-right"></i></a></h2>
            <form action="add-alumno" method="post">
                <input id="addAlumno" type="submit" value="Añadir alumno">
            </form>

            <div class="alumnos">
        <?php
            $datos_alumnos_clase=read_alumnoss($cursos[$i]['id_curso'],$cursos[$i]['id_centro']);
                    
                if (count($datos_alumnos_clase) == 0) {
                    echo "No hay alumnos en esta clase";
                }else{
                    for ($gg=0; $gg < count($datos_alumnos_clase); $gg++) { 

                        $idAlumno=$datos_alumnos_clase[$gg][0];
                        $sql1="select count(idPreguntas) as num_preg_total from preguntas";
                        $consulta = $conexion->prepare($sql1);
                        $consulta->execute();
                        $total_preguntas=$consulta->fetch();

                        $sql2="SELECT count(preguntas_idPreguntas) as num_preg_r FROM alumno_has_preguntas WHERE alumno_usuario_idUsuario=\"$idAlumno\"";
                        
                        $consulta = $conexion->prepare($sql2);
                        $consulta->execute();
                        $respondias=$consulta->fetch();
    
                        $nombre=$datos_alumnos_clase[$gg][1];
                        $apell=$datos_alumnos_clase[$gg][2];

                        $rojo=$datos_alumnos_clase[$gg][10];
                        $verde=$datos_alumnos_clase[$gg][11];
                        $azul=$datos_alumnos_clase[$gg][12];
                        $amarillo=$datos_alumnos_clase[$gg][9];

                        $id_alumno=$datos_alumnos_clase[$gg][0];

                        echo "
                            <div id='contenido'>
                                <div class='alumno'>
                                    $nombre $apell:
                                </div> 

                                <div class='rojo'>
                                    $rojo% 
                                </div> 

                                <div class='azul'>
                                    $azul% 
                                </div> 

                                <div class='amarillo'>
                                    $amarillo% 
                                </div> 

                                <div class='verde'>
                                    $verde% 
                                </div>  

                                <div class='preguntas'>
                                    ".$respondias->num_preg_r."/".$total_preguntas->num_preg_total."
                                </div>
                            
                                <div id='form_alumno'>
                                    <form action='editar-alumno' method='post'>
                                        <input type='hidden' name='id_alumn' value='$id_alumno'>
                                        <input type='submit' id='editar'value='Edit'>
                                    </form>
                                </div> 

                                <div id='form_alumno_del'>
                                    <form action='eliminar-alumno' method='post'>
                                        <input type='hidden' name='id_alumn' value='$id_alumno'> 
                                        <input type='submit' id='editar' value='DELETE'>
                                    </form>
                                </div>
                            </div>
                            <br>"
                            ;

                        
                    }
                }
        ?>
            </div></div>
    <?php
            }

    ?>
    </main>
    <script type="text/javascript" src="funciones-js"></script>
    <script>
        function apariencia(curso, idFlecha) {

            //hacemos que aparezca o desaparezca el contenido del curso
            var aux = document.getElementById(curso);
            aux.lastChild.classList.toggle("invisible");
            aux.children[1].classList.toggle("invisible");

            console.log(idFlecha);

            //cambiamos la forma de la flecha
            document.getElementById(idFlecha).classList.toggle("rotar");

            
        }
    </script>
</body>
</html>