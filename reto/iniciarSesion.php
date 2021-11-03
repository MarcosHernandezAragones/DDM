<?php
session_start();
include "funciones.php";



if(!isset($_POST['entrar']) && !isset($_SESSION['user'])){
    header("refresh:0;url=login_reto.php");
    die();
}



$conexion=conectarBD();



$user=$_POST['user'];
$pass=$_POST['pass'];

echo "Usuario(post): ".$user."<br>";
echo "Contraseña(post): ".$pass."<br>";

//preparamos la query
$query = "SELECT * FROM usuario WHERE nombre=\"$user\" AND ".'password'."=\"$pass\"";

//Ejecutamos la query y miramos si nos devuelve un solo valor
$consulta = $conexion->prepare($query);
$consulta->execute();
$nfilas=$consulta->rowCount();


//Si solo devuelve una fila, es que el usuario existe
if ($nfilas==1) {
    //hacemos una nueva query para comprobar si el usuario pertenece a docente(si no lo hace, es que es un alumno)
    $query = "SELECT usuario_idUsuario, rol_idRol FROM docente, usuario WHERE usuario.idUsuario=usuario_idUsuario AND usuario.nombre=\"$user\"";

    $consultaProf = $conexion->prepare($query);
    $consultaProf->execute();
    $nfilas=$consultaProf->rowCount();

    if ($nfilas==1) {
        //Si el usuario es un profesor entramos aqui
        $fila = $consultaProf->fetch();
        $_SESSION['user']=$fila->usuario_idUsuario;
        $_SESSION['rol']=$fila->rol_idRol;
        header("refresh:0;url=profesor.php");
        //REDIRECCIONAR A PROFESOR
    }else{
        //Si el usuario es un profesor entramos aqui
        $fila = $consulta->fetch();
        $_SESSION['user']=$fila->idUsuario;
        //REDIRECCIONAR A ALUMNO
    }

}
?>