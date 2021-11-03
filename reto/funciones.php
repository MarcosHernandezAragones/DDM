<?php
   
    function conectarBD()
        {
            $servidor = "192.168.4.171";
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

?>

