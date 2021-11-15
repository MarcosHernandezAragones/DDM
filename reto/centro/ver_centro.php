<?php
    include_once "../functions.php";
    session_start();
    
    //$_SESSION['id_prof']=3;//test only 
    $_SESSION['id_prof']=1;//test only 


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
    <section>
        <img class="gob" src="" alt="">
        <img class="centro" src="" alt="">
        <img class="abajo" src="../logo_login.png" alt="" srcset="">
        <p class="usuario_contro"><?php echo $nombre?></p>
        <p class="nombre_centro"><?php echo $centro?></p>
    </section>

    <main>
        <h1>Ver centro</h1>
        <form action="crear_centro.php" id="addCentro" method="post">
            <input type="hidden" name="confir" value="a">
            <input id="addCentro" type="submit" value="Añadir Centro">
        </form>


        <?php
            for ($i=0; $i < count($centros); $i++) { 
                $id_cent=$centros[$i][0];
                $nombre_centro=$centros[$i][1];
                $loc_centro=$centros[$i][2];

            //[,,]
                echo  "<div class='centro'>";
                    echo "<div id='nombre'>
                            <div >$nombre_centro: </div>
                            <div >$loc_centro</div> 
                          </div>
                        <form action='editar_centro.php' method='post'>
                            <input type='hidden' name='id_cent' value='$id_cent'>
                            <input type='submit' value='Edit'>
                        </form>
                        <form action='delete_centro.php' method='post'>
                            <input type='hidden' name='id_cent' value='$id_cent'>
                            <input type='submit' value='DELETE'>
                        </form><br>";
                echo "</div>";
            }



        ?>
    <button class="atras" onclick="salir('../profesor/profesor.php')">Atras</button>
    </main>
    <script type="text/javascript" src="../funciones.js"></script>
</body>
</html>