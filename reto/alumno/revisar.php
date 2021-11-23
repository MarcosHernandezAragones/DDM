<?php
    session_start();
    include "../funciones_BBDD.php";

    $idAlumno=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $_SESSION['centro']=centroAlumno($idAlumno);
    $centro = $_SESSION['centro'];

    $conexion=conectarBD();

    $sql="SELECT ap.respuesta as respuesta, preguntas.idPreguntas as idPregunta, preguntas.enunciado as enunciado  FROM preguntas, alumno_has_preguntas as ap WHERE preguntas.idPreguntas=ap.preguntas_idPreguntas AND alumno_usuario_idUsuario=$idAlumno";

    $consulta = $conexion->prepare($sql);
    $consulta->execute();

    $preguntas = $consulta->fetchAll();
    shuffle($preguntas);
       
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_revisarPregunta.css">
    <title>Revisar Preguntas</title>
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
    
    <?php
    for ($i=0; $i < count($preguntas); $i++) {

        echo "<div class=\"pregunta\"><h1>".$preguntas[$i]->enunciado."</h1></div>";
        
        //empezamos el formulario
        echo "<form action=\"\" method=\"POST\" id=\"formulario".$i."\" onchange=\"actualizarRespAlumno(".$preguntas[$i]->idPregunta.", 'formulario".$i."', '".$idAlumno."')\">\n";
        echo "<input type=\"hidden\" name=\"idPregunta\" value=\"".$preguntas[$i]->idPregunta."\" id=\"idPregunta\">";
        
            //inputs checkeds
            echo "<input class=\"resp_gigante\" type=\"radio\" name=\"respuesta\" id=\"1\" value=0 required ";
            if ($preguntas[$i]->respuesta==0){
                echo "checked>";
            }else{
                echo ">";
            }

            echo "<input class=\"resp_grande\" type=\"radio\" name=\"respuesta\" id=\"2\" value=17 ";
            if ($preguntas[$i]->respuesta==17){
                echo "checked>";
            }else{
                echo ">";
            }

            echo "<input class=\"resp_mediano\" type=\"radio\" name=\"respuesta\" id=\"3\" value=34 ";
            if ($preguntas[$i]->respuesta==34) {
                echo "checked>";
            }else{
                echo ">";
            }

            echo "<input class=\"resp\" type=\"radio\" name=\"respuesta\" id=\"4\" value=51 ";
            if ($preguntas[$i]->respuesta==51) {
                echo "checked>";
            }else{
                echo ">";
            }

            echo "<input class=\"resp_mediano\" type=\"radio\" name=\"respuesta\" id=\"5\" value=68 ";
            if ($preguntas[$i]->respuesta==68) {
                echo "checked>";
            }else{
                echo ">";
            }

            echo "<input class=\"resp_grande\" type=\"radio\" name=\"respuesta\" id=\"6\" value=85 ";
            if ($preguntas[$i]->respuesta==85) {
                echo "checked>";
            }else{
                echo ">";
            }

            echo "<input class=\"resp_gigante\" type=\"radio\" name=\"respuesta\" id=\"7\" value=100 ";
            if ($preguntas[$i]->respuesta==100) {
                echo "checked>";
            }else{
                echo ">";
            }

        //labels de los radiobuttons
        echo "  <label for=\"1\">Extremadamente en desacuerdo</label>
                    <label for=\"2\">En desacuerdo</label>
                    <label for=\"3\">Parcialmente en desacuerdo</label>
                    <label for=\"4\">Neutro</label>
                    <label for=\"5\">Parcialmente de acuerdo</label>
                    <label for=\"6\">De acuerdo</label>
                    <label for=\"7\">Extremadamente de acuerdo</label>
                    <input type=\"hidden\" name=\"siguiente\" value=\"$i\" id=\"siguiente\">
                </form>\n";       
    }
    ?>
    <button class="salir" onclick="salir('../cerrarSesion.php')">Salir</button>
    <script src="../funciones.js"></script>
    </main>
</body>
</html>