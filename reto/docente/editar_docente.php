<?php 
    include_once "../functions.php";
    session_start();

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    //select_cursos_prof(1);
    //$_SESSION['id_prof']=3;//test only
    $centros = read_centross();
    
    $rolarr=read_rolss();


    
    if (isset($_POST['id_al_upd'])) {
        $apellidos=$_POST['apellido'];
        $correo=$_POST['correo'];
        $DNI=$_POST['dni'];
        $nombre=$_POST['nombre'];
        $passwrd=$_POST['contraseña'];
        $id_prof=$_POST['id_al_upd'];
        

        $idCentro=$_POST['centro'];
        $idRol=$_POST['rol'];

        


        try {
            update_docente($apellidos,$correo,$DNI,$nombre,$passwrd,$id_prof,$idCentro,$idRol);
        } catch (Exception $th) {
            echo $th;
            header("refresh:5;url=ver_docente.php");
        }
        
        //header("refresh:5;url=ver_docente.php");
        header("Location: ver_docente.php");
    }else if (isset($_POST['id_doof'])) {
    
        $datos_docente=read_docente($_POST['id_doof']);
        
        
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_editarDocente.css">
    <title>Editar Docente</title>
</head>

<body>
        
<?php include_once "../menu_fijo.php"?>

    
    <main>
        <h1>Editar Docente</h1>
        <form action="editar_docente.php" id="formulario" method="post">
            <div id="primero">
            <input type="hidden" name="id_al_upd" value="<?php echo $datos_docente[0] ?>">
            <label for="nombre">Nombre: </label>
            </div>
            <div>
            <input type="text" name="nombre" id="nombre" value = "<?php echo $datos_docente[1] ?>">
            </div>
            <div id="primero">
            <label for="apellido">Apellidos: </label>
            </div>
            <div>
            <input type="text" name="apellido" id="apellido" value = "<?php echo $datos_docente[2] ?>"><br>
            </div>
            <div id="primero">
            <label for="dni">DNI: </label>
            </div>
            <div>
            <input type="text" name="dni" id="dni" value = "<?php echo $datos_docente[3] ?>"><br>
            </div>
            <div id="primero">
            <label for="correo">E-mail: </label>
            </div>
            <div>
            <input type="email" name="correo" id="correo" value = "<?php echo $datos_docente[4] ?>"><br>
            </div>
            <div id="primero">
            <label for="contraseña">Contraseña nueva del docente: </label>
            </div>
            <div>
            <input type="text" name="contraseña" id="contraseña" value = "<?php echo $datos_docente[5] ?>"><!-- contraseña visible solo al crear --><br>
            </div>
            <div id="primero">
            <label for="centro">Centro: </label>
            </div>
            <div>
            <select name="centro" id="centro">
                <option value="nil" selected>-----------------</option>
                <?php 
                    
                    for ($i=0; $i < count($centros); $i++) { 

                        if ($datos_docente[7] == $centros[$i][0]) {
                            print_r($centros[$i]);
                            $value_centro=$centros[$i][0];
                            echo" <option value=\"$value_centro\" selected>".$centros[$i][1]."</option>";
                        }else {
                            $value_centro=$centros[$i][0];
                            echo" <option value=\"$value_centro\">".$centros[$i][1]."</option>";
                        }

                        
                        
                    }
                //[$id_prof,$nombre,$apellidos,$DNI,$correo,$passwrd,$rol,$centro]
                ?>
            </select>
            </div>
            <div id="primero">
            <label for="rol">Rol: </label>
            </div>
            <div>
            <select name="rol" id="rol">
                <option value="nil" selected>-----------------</option>
                <?php 
                    for ($i=0; $i < count($rolarr); $i++) { 
                        if ($datos_docente[6] == $rolarr[$i][0]) {
                            $value_rol=$rolarr[$i][0];
                            echo" <option value=\"$value_rol\" selected>".$rolarr[$i][1]."</option>";
                        }else {
                            $value_rol=$rolarr[$i][0];
                            echo" <option value=\"$value_rol\">".$rolarr[$i][1]."</option>";
                        }

                        
                    }
                ?>
            </select>
            </div>
            <input type="submit" value="Enviar">



        </form>

    <button class="atras" onclick="salir('ver_docente.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>
<?php

}else {
    header("Location: ver_docente.php");
}

?>