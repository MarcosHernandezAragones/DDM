<?php

    include_once "../CRUD/functions.php";


    $alumnoss=read_alumnoss(1,1);




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
    <div id="test"></div>
</body>
</html>

<script src="group_gen.js"></script>

<?php
    $jso=json_encode($alumnoss);
    echo "<script>
    order_by_color(".$jso.") 
    </script>";

?>


