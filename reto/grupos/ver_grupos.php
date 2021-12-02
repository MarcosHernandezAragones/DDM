<?php
    include_once "../functions.php";
    session_start();
    
    //$_SESSION['id_prof']=4;//test only 
    

    
    
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    
    $grupos=read_gruposs();
    $cursos=read_cursoss();
   

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_verGrupos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Ver Grupos</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>

    <main> 

        <?php 
            $h1_content="";   
            for ($i=0; $i < count($grupos); $i++) { 
                for ($kk=0; $kk < count($cursos); $kk++) { 
                    if ($grupos[$i][2] == $cursos[$kk][1] && $grupos[$i][3] == $cursos[$kk][2]) {
                        if ($h1_content != $cursos[$kk][0]) {
                            $h1_content=$cursos[$kk][0];
                            echo "<h1>".$cursos[$kk][0];
        ?>
            

        <?php
            echo "</h1>";

        ?>
            <form action='add-grupo' class="addGrupo" method='post'>
                <input type="hidden" name="curse" value="<?php echo $grupos[$i][2] ?>">
                <input type="hidden" name="centre" value="<?php echo $grupos[$i][3] ?>">
                <input type='submit' value='Añadir Grupo'>
            </form>

<?php
                        }
            echo "<div class='Grupos'>";
        ?>
        
            

            <div class="contenido"><?php echo $grupos[$i][1] ?>

                <form action='editar-grupo' method='post'>
                    <input type="hidden" name="group" value="<?php echo $grupos[$i][0] ?>">
                    <input type='submit' value='Editar Grupo'>
                </form>

                <form action='eliminar-grupo' method='post'>
                    <input type="hidden" name="group" value="<?php echo $grupos[$i][0] ?>">
                    
                    <input type='submit' value='Borrar Grupo'>
                </form>
        
            </div>
        

        <?php
        echo "</div>";
                }
            }
        
        }
        ?>
      

    </main>
    <script type="text/javascript" src="funciones-js"></script>
</html>



<?php
  
?>