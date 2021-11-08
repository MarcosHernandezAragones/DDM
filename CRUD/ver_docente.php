<?php 
    include_once "functions.php";
    session_start();
    //$cursos_arr WIP


    $rolarr=read_rolss();
    for ($i=0; $i < count($rolarr); $i++) { 
        if ($rolar[$i][1] == "superadmin") {
            $id_sup=$rolarr[$i][1];
        }elseif ($rolar[$i][1] == "admin") {
            $id_admog=$rolarr[$i][1];
        }
    }
    
    $_SESSION['id_prof']=3;//test only 
    $datos_doc=read_docente($_SESSION['id_prof']);

    //[$id_prof,$nombre,$apellidos,$DNI,$correo,$passwrd,$rol,$centro]  rol 6
    $is_sup=false;
    $is_admog=false;

    if ($datos_doc[6] ==  $id_sup) {
        $is_sup=true;
    }elseif ($datos_doc[6] ==  $id_admog) {
        $is_admog=true;
    }

    

    


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
    
</body>
</html>