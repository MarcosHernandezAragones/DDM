<?php 
session_start();
include_once "../funciones_BBDD.php";
include_once "../functions.php";

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
    $cursos = select_cursos_prof($_SESSION['user']);

    if (!isset($_POST["subir"])) {
        header("refresh:0;url=inicio");
        echo "Usted no puede estar aqui, en 3 segundos sera redireccionado";
    }elseif (!isset($_SESSION['rol'])) {
        header("refresh:0;url=inicio");
        echo "Usted no puede estar aqui, en 3 segundos sera redireccionado";
    
    }elseif ($_SESSION['rol']<3) {
        header("refresh:0;url=inicio");
        echo "Usted no puede estar aqui, en 3 segundos sera redireccionado";
    }else{ 
        
        $nombre = $_FILES['archivo']['tmp_name'];

        $lineas=file($nombre);
    
        $conexion=conectarBD();
    
        $conexion->beginTransaction();


        $vars_curso=explode('!!!',$_POST['curso']);

        $idCentro=$vars_curso[0];
        $idCurso=$vars_curso[1];
    
        try {   
            for ($i=0; $i < $lineas; $i++) { 
                if ($i!=0) {
                    $datos=explode(";",$lineas[$i]);
                
                    $DNI= $datos[0];
                    $nombre= $datos[1];
                    $apellidos= $datos[2];
                    $correo= $datos[3];
                    $passwrd = $datos[4];    

        
                    create_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso);
                   
                           
                }
            }

            $conexion->commit();
    
        }catch(Exception $e){
            $conexion->rollback();
            echo "Ha habido un error ".$e->getMessage()."<br>";
            $error=true;
        }
    
        if(!$error){
            $_SESSION['mensajeFich'] = "Los datos han sido introducidos correctamente";
            header("refresh:0;url=add-alumno");
        }
        
    
    }