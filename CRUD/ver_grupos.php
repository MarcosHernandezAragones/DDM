<?php
    include_once "functions.php";
    session_start();
    
    //$_SESSION['id_prof']=4;//test only 
    $_SESSION['id_prof']=1;//test only 

    $chek_chek=check_doc_rol($_SESSION['id_prof']);

    
    $grupos=read_gruposs();
    $cursos=read_cursoss();
   

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
        

<?php 
    $h1_content="";


    
    for ($i=0; $i < count($grupos); $i++) { 
        for ($kk=0; $kk < count($cursos); $kk++) { 
            if ($grupos[$i][2] == $cursos[$kk][1] && $grupos[$i][3] == $cursos[$kk][2]) {
            # code...[$id_grupo,$nombre,$id_curs,$id_centre]
            //[$nombre_curs,$id_curso,$id_centro]
                if ($h1_content != $cursos[$kk][0]) {
                    $h1_content=$cursos[$kk][0];
                    echo "<h1>".$cursos[$kk][0];
?>
                    <form action='crear_grupo.php' method='post'>
                        <input type="hidden" name="curse" value="<?php echo $grupos[$i][2] ?>">
                        <input type="hidden" name="centre" value="<?php echo $grupos[$i][3] ?>">
                        <input type='submit' value='AÑADIR Grupo'>
                    </form>



<?php
                    echo "</h1><br><br><br>";



                }
?>
                <div><?php echo $grupos[$i][1] ?>
                    <form action='editar_grupo.php' method='post'>
                        <input type="hidden" name="group" value="<?php echo $grupos[$i][0] ?>">
                        <input type='submit' value='Editar Grupo'>
                    </form>

                    <form action='delete_grupo.php' method='post'>
                        <input type="hidden" name="group" value="<?php echo $grupos[$i][0] ?>">
                        
                        <input type='submit' value='Borrar Grupo'>
                    </form>
            
                </div>


<?php
                

            }


        }
  
    }



?>
      

</body>
</html>



<?php
  
?>