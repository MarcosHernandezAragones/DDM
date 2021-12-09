<?php 
    include_once "../functions.php";
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
    $cursos = select_cursos_prof($_SESSION['user']);
     
// Insesetar el usuario en la base de datos
    if (isset($_POST['nombre'])) {

        $apellidos=$_POST['apellido'];
        $correo=$_POST['correo'];
        $DNI=$_POST['dni'];
        $nombre=$_POST['nombre'];
        $passwrd=$_POST['dni'];

        $vars_curso=explode('!!!',$_POST['curso_1']);

        $idCentro=$vars_curso[0];
        $idCurso=$vars_curso[1];


        try {
            create_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso);
            
        } catch (Exception $th) {
            echo $th;
            header("refresh:0;url=listar-alumnos");
        }
        //header("Location: listar-alumnos");
        header("refresh:5;url=listar-alumnos");
    }else{
    


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_addAlumno.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Añadir Alumno</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

        <main>
            <h1>Añadir un Alumno</h1>


            <div id="formulario">
                
                <form action="add-alumno" method="post" onsubmit="return valid()">
                    <div class="primeros">
                        <label class="Texto" for="nombre">Nombre: </label>
                        <input  type="text" name="nombre" id="nombre" required>
                    </div>

                    <div class="segundos" >
                        <label class="Texto" for="apellido">Apellidos: </label>
                        <input class="input" type="text" name="apellido" id="apellido" required><br>
                    </div>
                    <div class="primeros">
                        <label class="Texto" for="dni">DNI: </label>
                        <input  type="text" name="dni" id="dni" required>
                    </div>

                    <div class="segundos" >
                        <label class="Texto" for="correo">E-mail: </label>
                        <input class="input" type="email" name="correo" id="correo" required><br>
                    </div>
                    

                    <div class="segundos" >
                        <label class="Texto" for="curso">Curso: </label>
                        <select class="input" name="curso_1" id="curso_1" required>
                            <option value="nil" selected>-----------------</option>
                            <?php 
                            for ($i=0; $i < count($cursos); $i++) { 
                                $value_curso=$cursos[$i]["id_centro"]."!!!".$cursos[$i]["id_curso"];

                                echo" <option value=\"".$value_curso."\" >".$cursos[$i]["name"]."</option>";
                            }

                            ?>
                        </select><br>
                        </div>
                    <input type="submit" value="Enviar">
            </form>
            </div>

            <h2>Añadir varios Alumnos</h2>
                <form action="insertar-fichero-alumno" onsubmit="return validar()" id="varias" method="post" enctype="multipart/form-data">  
                    <label class="Texto" for="curso">Curso: </label>
                        <select class="input" name="curso" id="curso" required>
                            <option value="nil" selected>-----------------</option>
                            <?php 
                            for ($i=0; $i < count($cursos); $i++) { 
                                $value_curso=$cursos[$i]["id_centro"]."!!!".$cursos[$i]["id_curso"];

                                echo" <option value=\"".$value_curso."\" >".$cursos[$i]["name"]."</option>";
                            }

                            ?>
                    </select> 
                <label for="archivo">Selecciona un archivo CSV:</label>
                <input type="file" name="archivo" id="archivo" accept=".csv" required>
                <input type="submit" value="Subir Archivo" name="subir">
            </form>
    </main>
    <script type="text/javascript" src="funciones-js"></script>
    <script>

        function validar(){
            archivo = document.getElementById("archivo").value
            
            if(archivo.endsWith('.csv')==false){
                console.log("esto funciona")
                return false
            }

            if (document.getElementById("curso").value=="nil"){
                alert("Opcion no valida, elija un curso para introducir el fichero.")
                return false
            }
           

        }

        function valid(){
            if (document.getElementById("curso_1").value=="nil"){
                alert("Opcion no valida, elija un curso para introducir un alumno.")
                
                return false
            }
        }

    </script>
</body>
</html>

<?php

        }
?>