<?php 
session_start();
include_once "../funciones_BBDD.php";

define('rojo',1);
define('amarillo',2);
define('verde',3);
define('azul',4);

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

    try {
        foreach ($lineas as $num_linea => $linea) {
            if ($linea!=0) {
                $datos=explode(";",$linea);
            

                $pregunta=$datos[0];
                $explicacion=$datos[1];
                $color=strtolower($datos[2]);
                
                
    
                switch (trim($color)) {
                    case 'rojo':
                        $color=1;
                        break;
            
                    case 'amarillo':
                        $color=2;
                        break;
            
                    case 'verde':
                        $color=3;
                        break;
            
                    case 'azul':
                        $color=4;
                        break;
                                            
                    default:
                        $color="";
                        break;
                }
    
                
    
                $query = "INSERT INTO preguntas('enunciado', explicacion, tipo_idTipo) VALUES (\"$pregunta\",\"$explicacion\",$color)";
                // echo $query."<br>";
                $conexion->query($query);
               
                       
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
        header("refresh:0;url=crear-preguntas");
    }
    

}