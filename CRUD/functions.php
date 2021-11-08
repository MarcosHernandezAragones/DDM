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
        //echo "Conexión realizada Satisfactoriamente";
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
    

    $cursos=[];
    $cont=0;
    

    try {
        while ($fila = $consulta->fetch()) {
            $cursos[$cont]["id_centro"]=$fila->curso_centro_idCentro;
            $cursos[$cont]["id_curso"]=$fila->curso_idCurso;
            $cursos[$cont]["name"]=select_name_curso($fila->curso_idCurso,$fila->curso_centro_idCentro);
            $cont++;
        }
    } catch (Exception $e) {
        echo $e;   
    }
    
    $conexx = null;
    return $cursos;

}



////////////////////////////////////////////////////////////////////////
/////////////////////////////GEST_USUARIO///////////////////////////////
////////////////////////////////////////////////////////////////////////
function delete_usuario($id_user){
    $conexx=conectar_BD();

    $sql3="DELETE FROM usuario WHERE idUsuario=\"$id_user\"";

    $consulta3 = $conexx->prepare($sql3);
    $consulta3->execute();

    $conexx = null;
}

function create_usuario($apellidos,$correo,$DNI,$nombre,$passwrd){
    $conexx=conectar_BD();
    $sql1="INSERT INTO  usuario (idUsuario,apellidos,correo,DNI,nombre,password) VALUES (0,\"$apellidos\",\"$correo\",\"$DNI\",\"$nombre\",\"$passwrd\")";//REVISAR ESTO
    
    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $conexx = null;
}

function update_usuario($apellidos,$correo,$DNI,$nombre,$passwrd,$id_user){
    $conexx=conectar_BD();
    $sql1="UPDATE usuario SET apellidos=\"$apellidos\"  , correo=\"$correo\" ,DNI=\"$DNI\" , nombre=\"$nombre\" , password=\"$passwrd\" WHERE idUsuario=\"$id_user\"";//REVISAR ESTO
    
    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $conexx = null;
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

    delete_usuario($id_alumno);

    $conexx = null;
}

function create_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso){
    $conexx=conectar_BD();
    
    create_usuario($apellidos,$correo,$DNI,$nombre,$passwrd);

    $sql2="SELECT * FROM usuario WHERE DNI=\"$DNI\"";

    $consulta2 = $conexx->prepare($sql2);
    $consulta2->execute();


    $fila = $consulta2->fetch();
    $id_alumno_aux=$fila->idUsuario;

    $sql3="INSERT INTO  alumno (usuario_idUsuario,curso_centro_idCentro,curso_idCurso) VALUES (\"$id_alumno_aux\",\"$idCentro\",\"$idCurso\")";//REVISAR ESTO

    $consulta3 = $conexx->prepare($sql3);
    $consulta3->execute();


    $conexx = null;
}

function update_alumnos($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idCurso,$idGrupo,$id_alumno){
    $conexx=conectar_BD();
    
    update_usuario($apellidos,$correo,$DNI,$nombre,$passwrd,$id_alumno);

    if ($idGrupo == "") {
        $idGrupo="null";
        $sql3="UPDATE alumno SET curso_idCurso=\"$idCurso\"  , curso_centro_idCentro=\"$idCentro\" , grupo_idGrupo=$idGrupo WHERE usuario_idUsuario=\"$id_alumno\"";//REVISAR ESTO
  
    }else{
        $sql3="UPDATE alumno SET curso_idCurso=\"$idCurso\"  , curso_centro_idCentro=\"$idCentro\" , grupo_idGrupo=\"$idGrupo\" WHERE usuario_idUsuario=\"$id_alumno\"";//REVISAR ESTO
  
    }

    echo $sql3;
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

    
    try {

        $fila2=$consulta2->fetch();
        $curso=$fila2->curso_idCurso;
        $centro=$fila2->curso_centro_idCentro;
        $grupo=$fila2->grupo_idGrupo;
        $amarillo=$fila2->amarillo;
        $rojo=$fila2->rojo;
        $verde=$fila2->verde;
        $azul=$fila2->azul;
    
    } catch (Exception $th) {
        echo $th;
    }
    
    $conexx=null;

    $datos_alumno=[$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul];
    return $datos_alumno;
}


//recibe id curso e id centro 
//devuelve los alumnos de un curso
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
            $nfilas=$consulta2->rowCount();
            if ($nfilas == 1) {
                $fila2=$consulta2->fetch();
            
                $grupo=$fila2->grupo_idGrupo;
                $amarillo=$fila2->amarillo;
                $rojo=$fila2->rojo;
                $verde=$fila2->verde;
                $azul=$fila2->azul;

                $datos_alumno=[$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul];
                $datos_all[$cont]=$datos_alumno;
                $cont++;
            }  

    }


    $conexx = null;
    return $datos_all;
}



////////////////////////////////////////////////////////////////////////
////////////////////////////////CRUD_ROL////////////////////////////////
////////////////////////////////////////////////////////////////////////

function delete_rol($id_rol){
    $conexx=conectar_BD();

    $sql1="DELETE FROM rol WHERE idRol=\"$id_rol\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $conexx = null;
}

function create_rol($nombre_rol){
    $conexx=conectar_BD();

    $sql1="INSERT INTO rol VALUES (\"$nombre_rol\")";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $conexx = null;
}

function update_rol($idRol,$nombre_rol){
    $conexx=conectar_BD();

    $sql1="UPDATE rol SET rol=\"$nombre_rol\" WHERE idRol=\"$idRol\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $conexx = null;
}

function read_rol($idRol){
    $conexx=conectar_BD();

    $sql1="SELECT * FROM rol WHERE idRol=\"$idRol\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();
    $fila1=$consulta1->fetch();
    $nombre_rol=$fila1->rol;


    $datos_rol=[$idRol,$nombre_rol];

    $conexx = null;
    return $datos_rol;
}

function read_rolss(){
    $conexx=conectar_BD();

    $sql1="SELECT * FROM rol";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $datos_todos=[];
    $cont=0;

    while ( $fila1=$consulta1->fetch()) {
        $idRol=$fila1->idRol;
        $nombre_rol=$fila1->rol;
        $datos_rol=[$idRol,$nombre_rol];

        $datos_todos[$cont]=$datos_rol;
        $cont++;
    }

    $conexx = null;
    return $datos_todos;
}



////////////////////////////////////////////////////////////////////////
////////////////////////////CRUD_PROFESOR///////////////////////////////
////////////////////////////////////////////////////////////////////////

function delete_docente($id_prof){
    $conexx=conectar_BD();
    $sql1="DELETE FROM curso_has_docente WHERE docente_usuario_idUsuario=\"$id_prof\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $sql2="DELETE FROM docente WHERE usuario_idUsuario=\"$id_prof\"";

    $consulta2 = $conexx->prepare($sql2);
    $consulta2->execute();

    delete_usuario($id_prof);

    $conexx = null;
}

function create_docente($apellidos,$correo,$DNI,$nombre,$passwrd,$idCentro,$idRol){
    $conexx=conectar_BD();
    
    create_usuario($apellidos,$correo,$DNI,$nombre,$passwrd);

    $sql2="SELECT * FROM usuario WHERE DNI=\"$DNI\"";

    $consulta2 = $conexx->prepare($sql2);
    $consulta2->execute();


    $fila = $consulta2->fetch();
    $id_docente_aux=$fila->idUsuario;

    $sql3="INSERT INTO  docente (usuario_idUsuario,centro_idCentro,rol_idRol) VALUES (\"$id_docente_aux\",\"$idCentro\",\"$idRol\")";//REVISAR ESTO

    $consulta3 = $conexx->prepare($sql3);
    $consulta3->execute();


    $conexx = null;
}

function update_docente($apellidos,$correo,$DNI,$nombre,$passwrd,$id_prof,$idCentro,$idRol){
    $conexx=conectar_BD();
    
    update_usuario($apellidos,$correo,$DNI,$nombre,$passwrd,$id_prof);

    
    $sql3="UPDATE docente SET rol_idRol=\"$idRol\" , centro_idCentro=\"$idCentro\" WHERE usuario_idUsuario=\"$id_prof\"";
  

    echo $sql3;
    $consulta3 = $conexx->prepare($sql3);
    $consulta3->execute();


    $conexx = null;
}

function read_docente($id_prof){
    

    $conexx=conectar_BD();
    $sql1="SELECT * FROM usuario WHERE idUsuario=\"$id_prof\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $fila1=$consulta1->fetch();
    $apellidos=$fila1->apellidos;
    $correo=$fila1->correo;
    $DNI=$fila1->DNI;
    $nombre=$fila1->nombre;
    $passwrd=$fila1->password;


    $sql2="SELECT * FROM docente WHERE usuario_idUsuario=\"$id_prof\"";

    $consulta2 = $conexx->prepare($sql2);
    $consulta2->execute();

    
    try {

        $fila2=$consulta2->fetch();
        $rol=$fila2->rol_idRol;
        $centro=$fila2->centro_idCentro;
    
    } catch (Exception $th) {
        echo $th;
    }
    
    $conexx=null;

    $datos_docente=[$id_prof,$nombre,$apellidos,$DNI,$correo,$passwrd,$rol,$centro];
    return $datos_docente;
}

function read_docentess($centro){
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
        $id_prof=$fila1->idUsuario;

            if ($centro == "nil") {
                $sql2="SELECT * FROM docente WHERE usuario_idUsuario=\"$id_prof\"";
            }else{
                $sql2="SELECT * FROM docente WHERE usuario_idUsuario=\"$id_prof\" and centro_idCentro=\"$centro\"";
            }
            $consulta2 = $conexx->prepare($sql2);
            $consulta2->execute();
            $nfilas=$consulta2->rowCount();
            if ($nfilas == 1) {
                $fila2=$consulta2->fetch();
                $id_rol=$fila2->rol_idRol;

                $datos_docente=[$id_prof,$nombre,$apellidos,$DNI,$correo,$passwrd,$id_rol,$centro];
                $datos_all[$cont]=$datos_docente;
                $cont++;
            }  

    }


    $conexx = null;
    return $datos_all;
}



////////////////////////////////////////////////////////////////////////
////////////////////////////CRUD_CENTRO///////////////////////////////
////////////////////////////////////////////////////////////////////////

function delete_centro($id_cent){
    $conexx=conectar_BD();

    $sql1="DELETE FROM centro WHERE idCentro=\"$id_cent\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $conexx = null;
}

function create_centro($nombre_cent, $loc_cent){
    $conexx=conectar_BD();

    $sql1="INSERT INTO centro (idCentro, nombre, ubicacion) VALUES (0, \"$nombre_cent\", \"$loc_cent\")";
    echo $sql1;
    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $conexx = null;
}

function update_centro($id_cent,$nombre_cent,$loc_cent){
    $conexx=conectar_BD();

    $sql1="UPDATE centro SET nombre=\"$nombre_cent\", ubicacion=\"$loc_cent\" WHERE idRol=\"$id_cent\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $conexx = null;
}

function read_centro($id_cent){
    $conexx=conectar_BD();

    $sql1="SELECT * FROM centro WHERE idCentro=\"$id_cent\"";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();
    $fila1=$consulta1->fetch();
    $nombre_centro=$fila1->nombre;
    $loc_centro=$fila1->ubicacion;

    $datos_rol=[$id_cent,$nombre_centro,$loc_centro];

    $conexx = null;
    return $datos_rol;
}

function read_centross(){
    $conexx=conectar_BD();

    $sql1="SELECT * FROM centro";

    $consulta1 = $conexx->prepare($sql1);
    $consulta1->execute();

    $datos_todos=[];
    $cont=0;

    while ( $fila1=$consulta1->fetch()) {
        $id_cent=$fila1->idCentro;
        $nombre_centro=$fila1->nombre;
        $loc_centro=$fila1->ubicacion;

        $datos_centro=[$id_cent,$nombre_centro,$loc_centro];
        $datos_todos[$cont]=$datos_centro;
        $cont++;
    }

    $conexx = null;
    return $datos_todos;
}




















?>