<?php
session_start();

if (isset($_SESSION['user'])) {
//      ENVIAR A LA PAGINA PRINCIPAL
        header("refresh:0;url=iniciarSesion.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DDM</title>
    <link rel="stylesheet" href="css/estilos_log.css">
</head>
<body>
    

    <section>
        <form action="iniciarSesion.php" method="post" id="loginbox">
            <fieldset>
                <legend><img src="logo_login.png" alt="logo de la empresa encargada de esta pagina"></legend>
            
                <h1>LOGIN</h1>

                <input type="text" name="user" id="user" placeholder="Usuario">
                <br>
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
                <br>
                <input type="submit" name="entrar" id="entrar" value="Entrar">
            </fieldset>
        </form>   
    </section>


</body>
</html>