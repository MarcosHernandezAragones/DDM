<?php
if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
}else{
    $rol = 0;
}

echo "<section>
        <img id=\"gob\" src=\"\" alt=\"\">
        <img id=\"centro\" src=\"\" alt=\"\">
        <img id=\"abajo\" src=\"../logo_login.png\" alt=\"\" srcset=\"\">
        <div id='menu'>";
            if($rol==0) {
                echo "<p class=\"usuario_contro\">$nombre</p>";
                echo "<a href=\"revisar-respuestas\">Revisar respuestas</a>";
                echo "<a href=\"cerrar-sesion\">Salir</a>";
            }
            
            if($rol>0){
                echo "<a href=\"profesor\">Inicio</a>";
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
        

        echo "<div id='menu_movil'>";
            echo "<input type='checkbox' onchange='desaparecer()'>";
            echo "<i class='fas fa-bars'></i>";
            echo "<i class='fas fa-times'></i>";
            echo "<nav>";
                echo "<ul>";
                    if($rol==0) {
                        echo "<li><p class=\"usuario_contro\">$nombre</p></li>";
                        echo "<li><a href=\"revisar-respuestas\">Revisar respuestas</a></li>";
                        echo "<li><a href=\"cerrar-sesion\">Salir</a></li>";
                    }
                    
                    if($rol>0){
                        echo "<li><a href=\"profesor\">Inicio</a></li>";
                        echo "<li><a href=\"elegir\">Proponer Grupos</a></li>";
                        echo "<li><a href=\"grupo\">Organizar Grupos</a></li>";
                        echo "<li><a href=\"listar-alumnos\">Organizar Alumnos</a></li>";
                    }
                    
                    if($rol>1){
                        echo "<li><a href=\"curso\">Administrar Clases</a></li>";
                        echo "<li><a href=\"profesores\">Administrar Profesores</a></li>";
                    }
                    
                    if($rol>2){
                        echo "<li><a href=\"centros\">Administrar Centros</a></li>";
                        echo "<li><a href=\"crear-preguntas\">Administrar Preguntas</a></li>";
                    }
                echo "</ul>";
            echo "</nav>";
        echo "</div>"; 


    echo    "</section>";
    echo "
    <script>
        function desaparecer(){
            aux = document.getElementById('gob');
            aux.classList.toggle('invisible');

            aux = document.getElementById('centro');
            aux.classList.toggle('invisible');

            aux = document.getElementById('abajo');
            aux.classList.toggle('invisible');
            
        }
    </script>
    ";