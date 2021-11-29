<?php
    include_once "../functions.php";
    session_start();
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    


    $chek_chek=check_doc_rol($_SESSION['user']);

    if (!$chek_chek[0] && !$chek_chek[1]) {
        echo "Acceso denegado por motivos random";
        //header("refresh:2;url=ver_.php");
    }else {
        
  
   function write_admin_forms($id_curso,$id_cent){
       echo "
            <form action='editar_curso.php' method='post'>
                <input type='hidden' name='id_curso' value='$id_curso'>
                <input type='hidden' name='id_cent' value='$id_cent'>
                <input type='submit' value='Edit'>
            </form>
            <form action='delete_curso.php' method='post'>
            <input type='hidden' name='id_curso' value='$id_curso'>
                <input type='hidden' name='id_cent' value='$id_cent'>
                <input type='submit' value='DELETE'>
            </form>";
   }
   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_elegirCursos.css">
    <title>ver clases</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

    <main>
        <h1>Ver Clases</h1>
        <?php 
            if ($chek_chek[1] || $chek_chek[0]) {
                
            

        ?>
                <form action='crear_curso.php' id='addCentro' method='post'>
                    <input type="hidden" name="confir" value="a">
                    <input type='submit' value='AÑADIR CURSO'>
                </form>
        <?php 
            }

        ?>

    <div id="cursos">
        <?php
            if ($chek_chek[1]) {
                mostrar_curso_todo();
            }elseif ($chek_chek[0]) {
            mostrar_curso_prof_admin($chek_chek[2][7]);
            }else {
                mostrar_curso_prof($chek_chek[2][7]);
            }
        ?>
    </div>
        
        <button class="atras" onclick="salir('../profesor/profesor.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>



<?php
  }
?>