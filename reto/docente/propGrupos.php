<?php session_start();
    include_once "../funciones_BBDD.php";
    include_once "../functions.php";
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    
    

    if (isset($_POST['id_curso'])) {
        $id_curso=$_POST['id_curso'];
    }
    

    $conexion=conectarBD();


    //conseguimos los datos del curso
    $sql="SELECT * FROM curso WHERE idCurso=$id_curso";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();
    $curso=$consulta->fetch();


    $nombreCurso=$curso->nombre;


    //conseguimos el numero de alumnos en el curso
    $sql="SELECT count(alumno.usuario_idUsuario) as numAlumnos FROM alumno, curso WHERE curso.idCurso=alumno.curso_idCurso AND curso.centro_idCentro=alumno.curso_centro_idCentro AND curso.idCurso=$id_curso";    
    $consulta = $conexion->prepare($sql);
    $consulta->execute();
    $resul=$consulta->fetch();
    $numAlumnos=$resul->numAlumnos;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_propGrupos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Propones Grupos</title>
</head>
<body>
    <?php include_once "../menu_fijo.php"?>

    <main>

        <?php
        
            echo "<h1>$nombreCurso</h1>";

        ?>

        <br><br><br><br>
        
            <div id="circulo">
                <button onclick="comprobar('rojo')" name="Dominante" class="cuarto-rojo cuarto">Dominante</button>
                <button onclick="comprobar('amarillo')" class="cuarto-amarillo cuarto">Creativo</button>
                <button onclick="comprobar('verde')" class="cuarto-verde cuarto">Conciliador</button>
                <button onclick="comprobar('azul')" class="cuarto-azul cuarto">Tecnico</button>

                <div id="lista">
                    <div id="id1">Azul</div>
                    <div id="id2">Verde</div>
                    <div id="id3">Amarillo</div>
                    <div id="id4">Rojo</div>
                </div>
            <form action="#" method="post">
                <input type="hidden" name="orden" id="orden" value="">
                <input type="hidden" name="curso" id="curso" value="<?php $id_curso?>">
                <div id="parametros">
                    <div>Numero de grupos:</div> <input type="number" name="grupos" id="grupos" style="width:5vh" onchange="calcAlumnos()" min="0" required>
                    <div>Alumnos por grupo:</div> <input type="number" name="alumnos" id="alumnos" style="width:5vh" onchange="calcGrupos()" min="0" required>
                </div>
            </div>
            </div>
            
            <br><br>
            

            <input type="submit" value="Enviar" >
        </form>
        <button onclick="limpiar()" id="limpiar">Reiniciar orden</button>
    </main>


    <script>
        const ORDEN = ['azul','verde','amarillo','rojo'];
        <?php echo "const alumnosCurso=$numAlumnos;
        "?>
        

        function limpiar() {
            //vaciamos array
            for (let i = 0; i <= 4; i++) {
                ORDEN.shift();
            }
            //mostramos el array
            for (let i = 0; i < 4; i++) {
                document.getElementById("id"+(i+1)).innerHTML = "";   
            }
        }

        function comprobar(color) {
            var esta = false;
            var pos = 0;

            //recorremos el array para ver si el color esta ya puesto y si esta nos devolvera su posicion
            for (let i = 0; i < ORDEN.length; i++) {
                if(ORDEN[i]==color){
                    esta=true;
                    pos=i;
                    break;
                }
                
            }


            //si el color ya esta en el array lo eliminara y si no esta lo añadira en la ultima posicion
            if (esta==true){
                ORDEN.splice(pos,1);
            }else{
                ORDEN.push(color);
            }

            var orden_jso=JSON.stringify(ORDEN);
            document.getElementById("orden").value = orden_jso;

            //mostramos el array
            for (let i=0; i < 4; i++) { 
                if (ORDEN[i]!=null && ORDEN[i]!=""){
                    document.getElementById("id"+(i+1)).innerHTML = ORDEN[i];
                }else{document.getElementById("id"+(i+1)).innerHTML = "";}      
            }            
        }




        function calcAlumnos(){
            var numGrupos = document.getElementById("grupos").value;
            
            var alumRecomendados = (alumnosCurso/numGrupos);

            if (Number.parseInt(alumRecomendados)==1) {
                document.getElementById("grupos").setAttribute("max", (numGrupos-1));
                document.getElementById("grupos").value = (numGrupos-1);
                document.getElementById("alumnos").value = Number.parseInt(alumRecomendados+1);
            }else{document.getElementById("alumnos").value = Number.parseInt(alumRecomendados);}            
        }



        function calcGrupos(){
            var numAlumnos = document.getElementById("alumnos").value;

            var gruposRecomendados = (alumnosCurso/numAlumnos);

            if (Number.parseInt(gruposRecomendados)==1) {
                document.getElementById("alumnos").setAttribute("max", numAlumnos);
                document.getElementById("alumnos").value = (numAlumnos-1);
                document.getElementById("grupos").value = Number.parseInt(gruposRecomendados+1);
            }else{document.getElementById("grupos").value = Number.parseInt(gruposRecomendados);}
        }


    </script>
</body>
</html>