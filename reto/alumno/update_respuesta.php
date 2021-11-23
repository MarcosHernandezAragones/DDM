<?php


$idAlumno=$_GET['idAlumno'];
$idPregunta=$_GET['idPregunta'];
$respuesta=$_GET['respuesta'];
include_once "../funciones_BBDD.php";

$conexion=conectarBD();

$sql = "UPDATE alumno_has_preguntas SET `respuesta`= \"$respuesta\" WHERE preguntas_idPreguntas=\"$idPregunta\" AND alumno_usuario_idUsuario=\"$idAlumno\" ";

$consulta = $conexion->prepare($sql);
$consulta->execute();





?>