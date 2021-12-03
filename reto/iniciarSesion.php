<?php
session_start();
include "funciones_BBDD.php";

if (!isset($_SESSION['user'])){
    if(!isset($_POST['entrar'])){
        session_destroy();
        header("refresh:0;url=inicio");
        die();
    }
}
    


$conexion=conectarBD();


    if (isset($_SESSION['user'])) {

        $idUsuario=$_SESSION['user'];
        $user=$_SESSION['nombre'];
        $query = "SELECT * FROM usuario WHERE idUsuario=$idUsuario";

    }else if(isset($_POST['entrar'])){
        $user=$_POST['user'];
        $pass=$_POST['pass'];
    
        //echo "Usuario(post): ".$user."<br>";
        //echo "Contraseña(post): ".$pass."<br>";
    
        //preparamos la query
        $query = "SELECT * FROM usuario WHERE nombre=\"$user\" AND ".'password'."=\"$pass\"";
    
    }

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
        //Si el usuario es un profesor entramos aqui e iniciamos todas las variables de sesion
        $fila = $consultaProf->fetch();
        $_SESSION['user']=$fila->idUsuario;
        $_SESSION['nombre']=$fila->nombre;
        $_SESSION['centro']=$fila->nombreCentro;
        $_SESSION['rol']=$fila->rol;
        $ruta = getcwd();
        $_SESSION['ruta_principio']=$ruta;
        //REDIRECCIONAR A PROFESOR
        header("refresh:0;url=profesor");
    }else{
        //Si el usuario es un profesor entramos aqui e iniciamos todas las variables de sesion
        $fila = $consulta->fetch();
        $_SESSION['user']=$fila->idUsuario;
        $_SESSION['nombre']=$fila->nombre;
        $ruta = getcwd();
        $_SESSION['ruta_principio']=$ruta;
        //REDIRECCIONAR A ALUMNO
        header("refresh:0;url=formulario");
    }

}else{
    session_destroy();
    header("refresh:0;url=inicio");
}
?>