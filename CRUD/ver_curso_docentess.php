<?php
    include_once "functions.php";
    session_start();
    
    //$_SESSION['id_prof']=3;//test only 
    $_SESSION['id_prof']=1;//test only 

    $chek_chek=check_doc_rol($_SESSION['id_prof']);
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
        
        <form action='add_docentess_to_cursoss.php' method='post'>
            <input type="hidden" name="confir" value="a">
            <input type='submit' value='AÑADIR Docente A curso'>
        </form>


        <form action='add_docente_to_curso.php' method='post'>
            <input type="hidden" name="confir" value="a">
            <input type='submit' value='Unirse a curso'>
        </form>
         
         
        
         
         
    <?php
        
    ?>

</body>
</html>


