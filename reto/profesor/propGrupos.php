<?php session_start();
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_propGrupos.css">
    <title>Propones Grupos</title>
</head>
<body>
    <section>
        <img class="gob" src="" alt="">
        <img class="centro" src="" alt="">
        <img class="abajo" src="../logo_login.png" alt="" srcset="">
        <p class="usuario_contro"><?php echo $nombre?></p>
        <p class="nombre_centro"><?php echo $centro?></p>
    </section>

</body>
</html>