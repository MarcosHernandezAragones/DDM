<?php session_start();

include_once "../functions.php";


$id_centro=$_POST["cent"];
$id_curso=$_SESSION["id_curse"];






$conexx=conectar_BD();


$datos_gru_raw=$_POST["gru2"];

$datos_gru_arr=json_decode($datos_gru_raw);

$datos_update=$datos_gru_arr[0];
print_r($datos_update);
echo "<br>-------------------------------------------------------------------------<br>";
$datos_create=$datos_gru_arr[1];
//print_r($datos_create);



for ($gbd=0; $gbd < count($datos_update); $gbd++) { 
    

    if ((isset($datos_update[$gbd][1]) && empty($datos_update[$gbd][1]))                            ) {//delete de los grupos que existen en la BBDD sin alumnos
        echo "<br>---------------------sdgnsdngjksdbhgjsdjkgsdjbvgjbgsdfjkbvsdjk------------------------------<br>";
        $idGrupo=$datos_update[$gbd][0];
        echo $idGrupo;
        if ($idGrupo != "nil") {
            $sql_upd_del="UPDATE alumno SET grupo_idGrupo=null WHERE grupo_idGrupo=\"$idGrupo\"";

            $consulta_del = $conexx->prepare($sql_upd_del);
            $consulta_del->execute();
            delete_grupo($idGrupo);
        }
        
            
        echo "<br>---------------------a------------------------------<br>";
    }else{

        for ($al=0; $al < count($datos_update[$gbd][1]); $al++) { //update de los grupos de BBDD
            $id_alumno=$datos_update[$gbd][1][$al];
            $idGrupo=$datos_update[$gbd][0];

            if ($idGrupo == "nil") {
                $sql_upd="UPDATE alumno SET grupo_idGrupo=null WHERE usuario_idUsuario=\"$id_alumno\"";
            } else {
                $sql_upd="UPDATE alumno SET grupo_idGrupo=$idGrupo WHERE usuario_idUsuario=\"$id_alumno\"";
            }

            

            $consulta_up = $conexx->prepare($sql_upd);
            try {
                $consulta_up->execute();
            } catch (Exception $th) {
                echo $th;
            }
            

        }

    }


}

$conexx = null;
$conexx=conectar_BD();
for ($cre=0; $cre < count($datos_create); $cre++) { 
    
    $nombre_curso="autogen_".$cre;


    $sql1="INSERT INTO grupo (nombre, curso_centro_idCentro,curso_idCurso ) VALUES (\"$nombre_curso\", \"$id_centro\", \"$id_curso\")";
    //echo $sql1;
    $consulta_cre1 = $conexx->prepare($sql1);
    $consulta_cre1->execute();

    
    $last_id = $conexx->lastInsertId();
    echo $last_id;
    for ($al=0; $al < count($datos_create[$cre]); $al++) { 
        $id_alumno=$datos_create[$cre][$al];
        $sql_cre2="UPDATE alumno SET grupo_idGrupo=$last_id WHERE usuario_idUsuario=\"$id_alumno\"";
        $consulta_cre2 = $conexx->prepare($sql_cre2);
        $consulta_cre2->execute();

    }

    


}


// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";

// if ($conn->query($sql) === TRUE) {
//   $last_id = $conn->insert_id;
//   echo "New record created successfully. Last inserted ID is: " . $last_id;
//header("refresh:10;url=mostrar-grupos");
//header("Location: mostrar-grupos");
$conexx = null;
header("refresh:0;url=mostrar-grupos");
?>

