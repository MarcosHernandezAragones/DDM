<?php
if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
}else{
    $rol = 0;
}

echo "<section>
        <script src='https://code.jquery.com/jquery-latest.js'></script>
      <header>
        <div id='imagenes'>
            <img id=\"gob\" src=\"../gobierno_aragon.jpg\" alt=\"\">
            <img id=\"centro\" src=\"../LOGO-CPIFP-PNG.png\" alt=\"\">
            <img id=\"abajo\" src=\"../logo_login.png\" alt=\"\" srcset=\"\">
        </div>
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
        

        echo "<div class='menu_bar'>";
            echo "<a href='#' onclick='incisible()' class='bt-menu' ><span class='icon-list2'></span>Menú</a>";
        echo "</div>";
            echo "<nav id='vas' class='invisible'>";
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
        echo"</header>";
    echo    "</section>";
    echo "
    <script>
        function incisible(){
            if(document.getElementById(\"vas\").classList.contains(\"invisible\")){
                document.getElementById(\"vas\").classList.toggle(\"invisible\")
            }
                
        }

        function desaparecer(){
            aux = document.getElementById('gob');
            aux.classList.toggle('invisible');

            aux = document.getElementById('centro');
            aux.classList.toggle('invisible');

            aux = document.getElementById('abajo');
            aux.classList.toggle('invisible');
            
        }

        $(document).ready(main);

        var contador = 1;

        function main () {

            $('.menu_bar').click(function(){
                if (contador == 1) {
                    $('nav').animate({
                        top: '0'
                    });
                    contador = 0;

                } else if(contador==0) {
                    $('nav').animate({
                        top: '-100%',
                    });
                    contador=1

                }
            });
        }
    </script>
    ";