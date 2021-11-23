<?php
$ruta=$_SESSION['ruta_principio'];
if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
}else{
    $rol = 0;
}

echo "<section>
        <img class=\"gob\" src=\"\" alt=\"\">
        <img class=\"centro\" src=\"\" alt=\"\">
        <img class=\"abajo\" src=\"../logo_login.png\" alt=\"\" srcset=\"\">
        <div id='menu'>";

        if ($rol==0) {
            echo "<p class=\"usuario_contro\"><$nombre</p>";
            echo "<a href=\"\">Revisar respuestas</a>";
        }
        
        if($rol>0){
            echo "<a href=\"\">Proponer Grupos</a>";
            echo "<a href=\"\">Organizar Grupos</a>";
            echo "<a href=\"\">Organizar Alumnos</a>";
        }
        
        if($rol>1){
            echo "<a href=\"\">Administrar Clases</a>";
            echo "<a href=\"\">Administrar Profesores</a>";
        }
        
        if($rol>2){
            echo "<a href=\"\">Administrar Centros</a>";
            echo "<a href=\"\">Administrar Preguntas</a>";
        }
        
        echo "</div>"; 


    echo    "</section>";