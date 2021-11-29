<?php
   
    function conectarBD(){
        $servidor = "localhost";
        $usuario = "DDM";
        $password = "Admin1234!";
        $baseDatos="reto";
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );

        try {
            $conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$baseDatos", $usuario, $password, $opciones);      
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
            }
        
        catch(PDOException $e)
            {
            echo "La conexión ha fallado: " . $e->getMessage();
            die();
            }
    }

    function centroAlumno($idAlumno){
        $conexion=conectarBD();

        $query = "SELECT centro.nombre as nombreCentro FROM alumno, centro WHERE centro.idCentro=alumno.curso_centro_idCentro AND alumno.usuario_idUsuario=\"$idAlumno\"";

        
        $consulta = $conexion->prepare($query);
        $consulta->execute();
        $fila=$consulta->fetch();
        
        $nombreCentro=$fila->nombreCentro;
       

        return $nombreCentro;


    }

    

?>

