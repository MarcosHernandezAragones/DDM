<?php
function conectar_BD(){
    $servidor = "192.168.4.171";
    $usuario = "DDM";
    $password = "Admin1234!";
    $baseDatos="reto";
    $opciones = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    );

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $password, $opciones);      
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexión realizada Satisfactoriamente";
        return $conexion;
    }catch(PDOException $e){
        echo "La conexión ha fallado: " . $e->getMessage();
        die();
    }
}



//obtiene el nombre del curso
function select_name_curso($id_curso,$id_centro){
    $conexx=conectar_BD();
    $sql="SELECT * FROM curso WHERE centro_idCentro=\"$id_centro\" and idCurso=\"$id_centro\""; 

    $consulta = $conexx->prepare($sql);
    $consulta->execute();

    $fila = $consulta->fetch();
    return $fila->nombre;
    $conexx = null;
}


//obtiene los cursos que imparte el profesor y los devuelve en un array
function select_cursos_prof($id_prof){
    $conexx=conectar_BD();
    $sql="SELECT * FROM curso_has_docente WHERE docente_usuario_idUsuario=\"$id_prof\""; 

    $consulta = $conexx->prepare($sql);
    $consulta->execute();

    $nfilas=$consulta->rowCount();
    echo "El número de filas devuelto es: $nfilas";//solo test

    $cursos=[];
    $cont=0;
    while ($fila = $consulta->fetch()) {
        $cursos[$cont]["id_centro"]=$fila->curso_centro_idCentro;
        $cursos[$cont]["id_curso"]=$fila->curso_idCurso;
        $cursos[$cont]["name"]=select_name_curso($fila->curso_idCurso,$fila->curso_centro_idCentro);
        $cont++;
    }
    print_r($cursos);//solo test
    $conexx = null;
    return $cursos;

}


////////////////////////////////////////////////////////////////////////
/////////////////////////////CRUD_ALUMNO////////////////////////////////
////////////////////////////////////////////////////////////////////////


function delete_alumnos($id_alumno){
    $conexx=conectar_BD();
    $sql1="DELETE FROM alumno_has_preguntas WHERE alumno_usuario_idUsuario=\"$id_alumno\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $sql2="DELETE FROM alumno WHERE usuario_idUsuario=\"$id_alumno\"";

    $consulta2 = $conexx->prepare($sql2);
    $consulta2->execute();

    $sql3="DELETE FROM usuario WHERE idUsuario=\"$id_alumno\"";

    $consulta3 = $conexx->prepare($sql3);
    $consulta3->execute();

    $conexx = null;
}

function create_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso){
    $conexx=conectar_BD();
    $sql1="INSERT INTO  usuario (\"apellidos\",\"correo\",\"DNI\",\"nombre\",\"'password'\") VALUES (\"$apellidos\",\"$correo\",\"$DNI\",\"$nombre\",\"$passwrd\")";//REVISAR ESTO

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();


    $sql2="SELECT * FROM usuario WHERE DNI=\"$DNI\"";

    $consulta2 = $conexx->prepare($sql2);
    $consulta2->execute();


    $fila = $consulta2->fetch();
    $id_alumno_aux=$fila->DNI;

    $sql3="INSERT INTO  alumno (\"usuario_idUsuario\",\"curso_centro_idCentro\",\"curso_idCurso\") VALUES (\"$id_alumno_aux\",\"$idCentro\",\"$idCurso\")";//REVISAR ESTO

    $consulta3 = $conexx->prepare($sql3);
    $consulta3->execute();


    $conexx = null;
}

function update_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso,$idGrupo,$id_alumno){
    $conexx=conectar_BD();
    $sql1="UPDATE usuario SET apellidos=\"$apellidos\"  , correo=\"$correo\" ,DNI=\"$DNI\" , nombre=\"$nombre\" , 'password'=\"$passwrd\" WHERE idUsuario=\"$id_alumno\"";//REVISAR ESTO

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $sql3="UPDATE usuario SET curso_idCurso=\"$idCurso\"  , curso_centro_idCentro=\"$idCentro\" , grupo_idGrupo=\"$idGrupo\" WHERE usuario_idUsuario=\"$id_alumno\"";//REVISAR ESTO

    $consulta3 = $conexx->prepare($sql3);
    $consulta3->execute();


    $conexx = null;
}

function read_alumno($id_alumno){
    

    $conexx=conectar_BD();
    $sql1="SELECT * FROM usuario WHERE idUsuario=\"$id_alumno\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $fila1=$consulta1->fetch();
    $apellidos=$fila1->apellidos;
    $correo=$fila1->correo;
    $DNI=$fila1->DNI;
    $nombre=$fila1->nombre;
    $passwrd=$fila1->password;


    $sql2="SELECT * FROM alumno WHERE usuario_idUsuario=\"$id_alumno\"";

    $consulta2 = $conexx->prepare($sql2);
    $consulta2->execute();

    $fila2=$consulta2->fetch();
    $curso=$fila2->curso_idCurso;
    $centro=$fila2->curso_centro_idCentro;
    $grupo=$fila2->grupo_idGrupo;
    $amarillo=$fila2->amarillo;
    $rojo=$fila2->rojo;
    $verde=$fila2->verde;
    $azul=$fila2->azul;
    
    $conexx=null;

    $datos_alumno=[$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul];
    return $datos_alumno;
}

function read_alumnoss($curso,$centro){
    $conexx=conectar_BD();
    $sql1="SELECT * FROM usuario ";

    $consulta1=$conexx->prepare($sql1);
    $consulta1->execute();

    $cont=0;
    $datos_all=[];
    while ($fila1=$consulta1->fetch()){
        $apellidos=$fila1->apellidos;
        $correo=$fila1->correo;
        $DNI=$fila1->DNI;
        $nombre=$fila1->nombre;
        $passwrd=$fila1->password;
        $id_alumno=$fila1->idUsuario;


            $sql2="SELECT * FROM alumno WHERE usuario_idUsuario=\"$id_alumno\" and (curso_idCurso=\"$curso\" and curso_centro_idCentro=\"$centro\")";

            $consulta2 = $conexx->prepare($sql2);
            $consulta2->execute();
            $nfilas=$consulta->rowCount();
            if ($nfilas == 1) {
                $fila2=$consulta2->fetch();
            
                $grupo=$fila2->grupo_idGrupo;
                $amarillo=$fila2->amarillo;
                $rojo=$fila2->rojo;
                $verde=$fila2->verde;
                $azul=$fila2->azul;

                $datos_alumno=[$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul];
                $datos_all[$cont]=$datos_alumno;
            }  

    }


    $conexx = null;
    return $datos_all;
}














?>