<?php 
session_start();
include_once "../funciones_BBDD.php";

define('rojo',1);
define('amarillo',2);
define('verde',3);
define('azul',4);

if (!isset($_POST["enviar"])) {
    header("refresh:0;url=inicio");
    echo "Usted no puede estar aqui, en 3 segundos sera redireccionado";
}elseif (!isset($_SESSION['rol'])) {
    header("refresh:0;url=inicio");
    echo "Usted no puede estar aqui, en 3 segundos sera redireccionado";

}elseif ($_SESSION['rol']<3) {
    header("refresh:0;url=inicio");
    echo "Usted no puede estar aqui, en 3 segundos sera redireccionado";
}else{
    $pregunta=$_POST['pregunta'];
    $explicacion=$_POST['explicacion'];
    $color=$_POST['color'];

    switch ($color) {
        case 'rojo':
            $color=rojo;
            break;

        case 'amarillo':
            $color=amarillo;
            break;

        case 'verde':
            $color=verde;
            break;

        case 'azul':
            $color=azul;
            break;
                                
        default:
            $color="";
            break;
    }

    $conexion=conectarBD();
    
    $query = "INSERT INTO preguntas(enunciado, explicacion, tipo_idTipo) VALUES (\"$pregunta\",\"$explicacion\",$color)";

    $consulta = $conexion->prepare($query);
    $consulta->execute();
    $nfilas=$consulta->rowCount();
    
    if ($nfilas==1) {
        header("refresh:0;url=crear-preguntas");
        $_SESSION['mensaje'] = "Los datos han sido introducidos correctamente";
    }else $_SESSION['mensaje'] = "<strong>Ha habido un error al introducir los datos</strong>";
    
}


?>