<?php
session_start();
include "funciones_BBDD.php";



if(!isset($_POST['entrar']) && !isset($_SESSION['user'])){
    session_destroy();
    header("refresh:0;url=login_reto.php");
    die();
}



$conexion=conectarBD();



$user=$_POST['user'];
$pass=$_POST['pass'];

//echo "Usuario(post): ".$user."<br>";
//echo "Contraseña(post): ".$pass."<br>";

//preparamos la query
$query = "SELECT * FROM usuario WHERE nombre=\"$user\" AND ".'password'."=\"$pass\"";

//Ejecutamos la query y miramos si nos devuelve un solo valor
$consulta = $conexion->prepare($query);
$consulta->execute();
$nfilas=$consulta->rowCount();


//Si solo devuelve una fila, es que el usuario existe
if ($nfilas==1) {
    //hacemos una nueva query para comprobar si el usuario pertenece a docente(si no lo hace, es que es un alumno)
    $query = "SELECT docente.usuario_idUsuario as idUsuario,centro.nombre as nombreCentro, usuario.nombre as nombre,docente.rol_idRol as rol FROM centro,docente,usuario WHERE usuario.idUsuario=usuario_idUsuario AND usuario.nombre=\"$user\" and docente.centro_idCentro=centro.idCentro";

    $consultaProf = $conexion->prepare($query);
    $consultaProf->execute();
    $nfilas=$consultaProf->rowCount();

    if ($nfilas==1) {
        //Si el usuario es un profesor entramos aqui
        $fila = $consultaProf->fetch();
        $_SESSION['user']=$fila->idUsuario;
        $_SESSION['nombre']=$fila->nombre;
        $_SESSION['centro']=$fila->nombreCentro;
        $_SESSION['rol']=$fila->rol;
        //REDIRECCIONAR A PROFESOR
        header("refresh:0;url=profesor.php");
    }else{
        //Si el usuario es un profesor entramos aqui
        $fila = $consulta->fetch();
        $_SESSION['user']=$fila->idUsuario;
        $_SESSION['nombre']=$fila->nombre;
        $_SESSION['centro']=$fila->nombreCentro;
        //REDIRECCIONAR A ALUMNO
        header("refresh:0;url=alumno.php");
    }

}else{
    session_destroy();
    header("refresh:0;url=index.php");
}
?>