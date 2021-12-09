<?php session_start();
    include_once "../funciones_BBDD.php";
    include_once "../functions.php";
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    
    

    if (isset($_POST['id_curso'])) {
        $id_curso=$_POST['id_curso'];
        $_SESSION["id_curse"]=$_POST['id_curso'];
    }
    





    $chek_chek=check_doc_rol($_SESSION['user']);//$datos_doc_all[$i][7]

    $grupos_clase=read_grupo_curso_t($id_curso);
    
    //print_r($grupos_clase);
  
    if (count($grupos_clase)> 0) {
        header("Location: mostrar-grupos");

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
            <form action="mostrar-grupos" method="post"  onsubmit="return verificar()">
                <input type="hidden" name="orden" id="orden" value="4,3,1,2">
                <input type="hidden" name="curso" id="curso" value="<?php echo $id_curso;?>">
                <div id="parametros">
                    <div>Numero de grupos:</div> <input type="number" name="grupos" id="grupos" style="width:5vh" onchange="calcAlumnos()" min="2" required>
                    <div>Alumnos por grupo:</div> <input type="number" name="alumnos" id="alumnos" style="width:5vh" onchange="calcGrupos()" min="2" required>
                </div>
            </div>
            </div>
            
            <br><br>
            

            <input type="submit" value="Enviar" >
        </form>
        <button onclick="limpiar()" id="limpiar">Reiniciar orden</button>
    </main>


    <script>
        var ORDEN = ['azul','verde','amarillo','rojo'];
        
        <?php echo "const alumnosCurso=$numAlumnos;
        "?>
        
        var rojo = 2;
        var azul = 4;
        var verde = 3;
        var amarillo = 1;

        var devolver = [azul,verde,amarillo,rojo];

        function limpiar() {
            //vaciamos array
            for (let i = 0; i <= 4; i++) {
                ORDEN.shift();
            }
            //mostramos el array
            for (let i = 0; i < 4; i++) {
                document.getElementById("id"+(i+1)).innerHTML = "";   
            }

            devolver=[];
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
                devolver.splice(pos,1);
            }else{
                ORDEN.push(color);

                switch (ORDEN.at(-1)) {
                        case "rojo":
                            devolver.push(rojo);
                            break;
                        case "azul":
                            devolver.push(azul);
                            break;
                        case "amarillo":
                            devolver.push(amarillo);
                            break;
                        case "verde":
                            devolver.push(verde);
                            break;
                    }
            }

            var orden_jso=JSON.stringify(ORDEN);
            document.getElementById("orden").value = orden_jso;

            //mostramos el array
            for (let i=0; i < 4; i++) { 
                if (ORDEN[i]!=null && ORDEN[i]!=""){
                    document.getElementById("id"+(i+1)).innerHTML = ORDEN[i];
                }else{document.getElementById("id"+(i+1)).innerHTML = "";}      
            }  
            
            

            

            document.getElementById("orden").value = devolver;

        }




        function calcAlumnos(){
            var numGrupos = document.getElementById("grupos").value;
            
            var alumRecomendados = (alumnosCurso/numGrupos);

            if (document.getElementById("alumnos")>=alumnosCurso){
                document.getElementById("alumnos").value = 2;
            }

            if (Number.parseInt(alumRecomendados)==1) {
                document.getElementById("grupos").setAttribute("max", (numGrupos-1));
                document.getElementById("grupos").value = (numGrupos-1);
                document.getElementById("alumnos").value = Number.parseInt(alumRecomendados+1);
            }else{document.getElementById("alumnos").value = Number.parseInt(alumRecomendados);}            
        }



        function calcGrupos(){
            var numAlumnos = document.getElementById("alumnos").value;

            if (document.getElementById("grupos")>=alumnosCurso){
                document.getElementById("grupos").value = 2;
            }

            var gruposRecomendados = (alumnosCurso/numAlumnos);

            if (Number.parseInt(gruposRecomendados)==1) {
                document.getElementById("alumnos").setAttribute("max", numAlumnos);
                document.getElementById("alumnos").value = (numAlumnos-1);
                document.getElementById("grupos").value = Number.parseInt(gruposRecomendados+1);
            }else{document.getElementById("grupos").value = Number.parseInt(gruposRecomendados);}


        }

        function verificar(){

            if(document.getElementById("grupos").value<2 || document.getElementById("alumnos").value<2){
                return false;
            }

            console.log(devolver.length);

            if(devolver.length < 4){
                alert("En el orden de los colores deben aparecer todos")
                return false;
            }


            return true;
            
        }

    </script>
</body>
</html>