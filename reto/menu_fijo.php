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

        if($rol==0) {
            echo "<p class=\"usuario_contro\"><$nombre</p>";
            echo "<a href=\"revisar-respuestas\">Revisar respuestas</a>";
        }
        
        if($rol>0){
            echo "<a href=\"elegir\">Proponer Grupos</a>";
            echo "<a href=\"grupo\">Organizar Grupos</a>";
            echo "<a href=\"listar-alumnos\">Organizar Alumnos</a>";
        }
        
        if($rol>1){
            echo "<a href=\"curso\">Administrar Clases</a>";
            echo "<a href=\"profesores\">Administrar Profesores</a>";
        }
        
        if($rol>2){
            echo "<a href=\"centros\">Administrar Centros</a>";
            echo "<a href=\"crear-preguntas\">Administrar Preguntas</a>";
        }
        
        echo "</div>"; 


    echo    "</section>";