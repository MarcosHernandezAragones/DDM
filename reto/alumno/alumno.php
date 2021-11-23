<?php session_start(); 
    include "../funciones_BBDD.php";

    if (isset($_SESSION['rol'])) {
        session_destroy();
        header("refresh:0;url=../index.php");
    }

    if (isset($_SESSION['completado']) && $_SESSION['completado']==true ) {
        session_destroy();
        header("refresh:0;url=../index.php");
    }

    if (!isset($_SESSION['primera_vez'])) {
        $_SESSION['primera_vez']=true;
    }else{
        $_SESSION['primera_vez']=false;
    }


    if(isset($_POST['enviar'])){

        header("refresh:0;url=adios.php");

    }

    $idAlumno=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $_SESSION['centro']=centroAlumno($idAlumno);
    $centro = $_SESSION['centro'];

    $conexion=conectarBD();
    

    if ($_SESSION['primera_vez']) {
//selecciona preguntas sin responder por el alumno
        $sql="SELECT * FROM preguntas WHERE idPreguntas NOT IN (SELECT preguntas_idPreguntas FROM alumno_has_preguntas WHERE alumno_usuario_idUsuario=$idAlumno)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $preguntasPorResponder = $consulta->fetchAll();
        
//si todas las preguntas estan respondidas redirige a revisar.php
        if ($consulta->rowCount()==0) {
            $_SESSION['completado']=true;
            header("Location: revisar.php");
        }
        
//mezcla array de preguntas
        shuffle($preguntasPorResponder);
        $_SESSION['preguntasPorResponder'] =$preguntasPorResponder;
        
        //iniciar contador de preguntas
        $_SESSION['i']=0;
        $i=$_SESSION['i'];
//iniciar array de preguntas respondidas
        $preguntasRespondidas=[];
        $_SESSION['preguntasRespondidas']=$preguntasRespondidas;


    }else {
//cargar array de preguntas por responder, preguntas respondidas y contador 
        $preguntasPorResponder = $_SESSION['preguntasPorResponder'];
        $i=$_SESSION['i'];
        
        $preguntasRespondidas = $_SESSION['preguntasRespondidas'];
    }

//Contolamos si el usuario da a F5 o recarga la pagina que la pregunta no cambie
    if (isset($_POST['siguiente']) && $_POST['siguiente']==$i) {
        $preguntasRespondidas[$i]=$preguntasPorResponder[$i];
        $_SESSION['preguntasRespondidas']=$preguntasRespondidas;
        
        $idPregunta=$preguntasPorResponder[$i]->idPreguntas;
        $respuesta=$_POST['respuesta'];

        echo "i = ".$i."<br>";
        echo "ID: ".$idPregunta."<br>";
        echo "Nombre: ".$preguntasPorResponder[$i]->enunciado."<br>";
        echo "Respuesta ".$respuesta."%<br>";
        $i++;
        $_SESSION['i']=$i;  
        

// insertar respuesta en base de datos  
        $sql="INSERT INTO alumno_has_preguntas VALUES($idAlumno,$idPregunta,$respuesta)";
        echo $sql;

        $consulta = $conexion->prepare($sql);
        $consulta->execute();


    } 


    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_alumno.css">
    <title>Preguntas Alumno</title>
</head>
<body>
    <?php include_once "../menu_fijo.php"?>
    
    <main>
        <div class="pregunta"><h1><?php echo $preguntasPorResponder[$i]->enunciado; ?></h1></div>
        <div class="explicacion"><h3><?php echo $preguntasPorResponder[$i]->explicacion; ?></h3></div>
        <?php 
            echo "Pregunta ".($i+1)." de ".count($preguntasPorResponder);
        ?>
        <form action="" method="POST" id="form_respuestas">
            <input class="resp_gigante" type="radio" name="respuesta" id="1" value=0 required >
            <input class="resp_grande" type="radio" name="respuesta" id="2" value=17>
            <input class="resp_mediano" type="radio" name="respuesta" id="3" value=34>
            <input class="resp" type="radio" name="respuesta" id="4" value=51>
            <input class="resp_mediano" type="radio" name="respuesta" id="5" value=68>
            <input class="resp_grande" type="radio" name="respuesta" id="6" value=85>
            <input class="resp_gigante" type="radio" name="respuesta" id="7" value=100>
            <label for="1">Extremadamente en desacuerdo</label>
            <label for="2">En desacuerdo</label>
            <label for="3">Parcialmente en desacuerdo</label>
            <label for="4">Neutro</label>
            <label for="5">Parcialmente de acuerdo</label>
            <label for="6">De acuerdo</label>
            <label for="7">Extremadamente de acuerdo</label>
            <input type="hidden" name="siguiente" value="<?php echo $i?>" id="siguiente">
        </form>
        <?php 
            if ($i!=count($preguntasPorResponder)-1) {
                echo "<input type=\"submit\" name=\"boton\" value=\"Siguiente\" id=\"next\" form=\"form_respuestas\">";
            }else echo "<input type=\"submit\" name=\"enviar\" value=\"Enviar Respuestas\" onclick=\"redirigir('adios.php')\" id=\"finish\" form=\"form_respuestas\">";
        ?>
        
        
        <button class="salir" onclick="salir('../cerrarSesion.php')">Salir</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>
