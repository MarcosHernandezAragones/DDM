<?php
    include_once "../functions.php";
    session_start();


    $centros=read_centross();

    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
   

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_verCentro.css">
    <title>Document</title>
</head>
<body>
        
<?php include_once "../menu_fijo.php"?>


    <main>
        <h1>Ver centro</h1>
        <form action="crear_centro.php" class="addCentro" method="post">
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
                        <form action='editar_centro.php' id='edit' method='post'>
                            <input type='hidden' name='id_cent' value='$id_cent'>
                            <input type='submit' value='Edit'>
                        </form>
                        <form action='delete_centro.php' id='del' method='post'>
                            <input type='hidden' name='id_cent' value='$id_cent'>
                            <input type='submit' value='DELETE'>
                        </form>";
                echo "</div>";
            }



        ?>
    <button class="atras" onclick="salir('../profesor/profesor.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>