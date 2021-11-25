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
            <button onclick="comprobar('rojo')" name="Dominante" class="cuarto-rojo cuarto"></button>
            <button onclick="comprobar('amarillo')" class="cuarto-amarillo cuarto"></button>
            <button onclick="comprobar('verde')" class="cuarto-verde cuarto"></button>
            <button onclick="comprobar('azul')" class="cuarto-azul cuarto"></button>

            <div id="lista">
                <div id="id1"></div>
                <div id="id2"></div>
                <div id="id3"></div>
                <div id="id4">
            </div>
        </div>
        </div>
        
        <br><br>
        <button onclick="limpiar()">Reiniciar orden</button>


        <br><br>
        <div id="devolver"></div>
        <br><br>
        <div>Numero de grupos: <input type="number" name="grupos" id="grupos" style="width:5vh" onchange="calcAlumnos()" min="0"></div>
        <div>Alumnos por grupo: <input type="number" name="alumnos" id="alumnos" style="width:5vh" onchange="calcGrupos()" min="0"></div>
        
        

    </main>


    <script>
        const orden = new Array();
        <?php echo "const alumnosCurso=$numAlumnos;"?>
        
        
        function limpiar() {
            //vaciamos array
            for (let i = 0; i <= 4; i++) {
                orden.shift();
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
            for (let i = 0; i < orden.length; i++) {
                if(orden[i]==color){
                    esta=true;
                    pos=i;
                    break;
                }
                
            }


            //si el color ya esta en el array lo eliminara y si no esta lo añadira en la ultima posicion
            if (esta==true){
                orden.splice(pos,1);
            }else{
                orden.push(color);
            }

            //mostramos el array
            for (let i=0; i < 4; i++) { 
                if (orden[i]!=null && orden[i]!=""){
                    document.getElementById("id"+(i+1)).innerHTML = orden[i];
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