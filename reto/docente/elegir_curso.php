<?php
    include_once "../functions.php";
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
     

    $curso_proof=select_cursos_prof($id);
        
  
   function write_redirect_form($id_curso,$name){
       
       echo "
            <form action='proponerGrupos' method='post'>
                <input type='hidden' name='id_curso' value='$id_curso'>
                
                <input type='submit' value='$name'>
            </form>";
            
   }

//    $cursos[$cont]["id_centro"]=$fila->curso_centro_idCentro;
//    $cursos[$cont]["id_curso"]=$fila->curso_idCurso;
//    $cursos[$cont]["name"]=select_name_curso($fila->curso_idCurso,$fila->curso_centro_idCentro);   

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_verCursos.css">
    <title>ver clases</title>
</head>
<body>
    
   <?php include_once "../menu_fijo.php"?>

    <main>
        <h1>Elegir curso</h1>
        

    <div id="cursos">
        <?php
            for ($i=0; $i < count($curso_proof); $i++) { 
                
                
                write_redirect_form($curso_proof[$i]["id_curso"],$curso_proof[$i]["name"]);


            }
        ?>
    </div>
        

    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>
