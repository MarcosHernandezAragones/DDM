<?php
    include_once "../functions.php";
    session_start();


    $centros=read_centross();

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    $chek_chek=check_doc_rol($_SESSION['user']);// $check_check = [es_admin, es_superadmin, [datos profesor]]
    
    if (!($chek_chek[0] || $chek_chek[1])) {
        header("Location: profesor");
    }
   

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_verCentro.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Centros</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>


    <main>
        <h1>Ver centro</h1>
        <form action="crear-centro" class="addCentro" method="post">
            <input type="hidden" name="confir" value="a">
            <input id="addCentro" type="submit" value="Añadir Centro">
        </form>


        <?php
            for ($i=0; $i < count($centros); $i++) { 
                $id_cent=$centros[$i][0];
                $nombre_centro=$centros[$i][1];
                $loc_centro=$centros[$i][2];

                echo  "<div class='centros'>";
                    echo "<div id='nombre'>
                            <div >$nombre_centro: $loc_centro</div> 
                          </div>
                        <form action='editar-centro' id='edit' method='post'>
                            <input type='hidden' name='id_cent' value='$id_cent'>
                            <input type='submit' value='Edit'>
                        </form>
                        <form action='eliminar-centro' id='del' method='post'>
                            <input type='hidden' name='id_cent' value='$id_cent'>
                            <input type='submit' value='DELETE' onclick='return confirm(\"Estas seguro de que quieres eliminar el centro $nombre_centro\")'>
                        </form>";
                echo "</div>";
            }



        ?>

    </main>
    <script type="text/javascript" src="funciones-js"></script>
</body>
</html>