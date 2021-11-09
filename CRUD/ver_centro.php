<?php
    include_once "functions.php";
    session_start();
    
    //$_SESSION['id_prof']=3;//test only 
    $_SESSION['id_prof']=1;//test only 


    $centros=read_centross();

    
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="crear_centro.php" method="post">
            <input type="hidden" name="confir" value="a">
            <input type="submit" value="Añadir Centro">
        </form>


    <?php
        for ($i=0; $i < count($centros); $i++) { 
            $id_cent=$centros[$i][0];
            $nombre_centro=$centros[$i][1];
            $loc_centro=$centros[$i][2];

        //[,,]
            echo  "<div id='cent_$id_cent'>";
            echo "<div >$nombre_centro: </div>  <div >$loc_centro</div> 
                <div><form action='editar_centro.php' method='post'><input type='hidden' name='id_cent' value='$id_cent'><input type='submit' value='Edit'></form></div> 
                <div><form action='delete_centro.php' method='post'><input type='hidden' name='id_cent' value='$id_cent'><input type='submit' value='DELETE'></form></div><br>";
            echo "</div>";
        }



?>
</body>
</html>