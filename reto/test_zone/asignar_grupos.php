<?php

include_once "../CRUD/functions.php";

//variables session
$id_centro=1;
$id_curso=1;


//fin variables session



$conexx=conectar_BD();


$datos_gru_raw=$_POST["gru2"];

$datos_gru_arr=json_decode($datos_gru_raw);

$datos_update=$datos_gru_arr[0];

$datos_create=$datos_gru_arr[1];


for ($gbd=0; $gbd < count($datos_update); $gbd++) { 
    

    if (empty($datos_update[$gbd][1])) {
        $idGrupo=$datos_update[$gbd][0];
            $sql_upd_del="UPDATE alumno SET grupo_idGrupo=null WHERE grupo_idGrupo=\"$idGrupo\"";

            $consulta_del = $conexx->prepare($sql_upd_del);
            $consulta_del->execute();
        delete_grupo($idGrupo);
    }else{

        for ($al=0; $al < count($datos_update[$gbd][1]); $al++) { 
            $id_alumno=$datos_update[$gbd][1][$al];
            $idGrupo=$datos_update[$gbd][0];
            $sql_upd="UPDATE alumno SET grupo_idGrupo=$idGrupo WHERE usuario_idUsuario=\"$id_alumno\"";

            $consulta_up = $conexx->prepare($sql_upd);
            $consulta_up->execute();

        }

    }

}

for ($cre=0; $cre < count($datos_create); $cre++) { 
    
    $nombre_curso="autogenerated";


    $sql1="INSERT INTO grupo (nombre, curso_centro_idCentro,curso_idCurso ) VALUES (\"$nombre_curso\", \"$id_centro\", \"$id_curso\")";

    $consulta_cre1 = $conexx->prepare($sql1);
    $consulta_cre1->execute();
    $last_id = $conexx->lastInsertId();
    
    for ($al=0; $al < count($datos_create[$cre]); $al++) { 
        $id_alumno=$datos_create[$cre][$al];
        $sql_cre2="UPDATE alumno SET grupo_idGrupo=$last_id WHERE usuario_idUsuario=\"$id_alumno\"";
        $consulta_cre2 = $conexx->prepare($sql_cre2);
        $consulta_cre2->execute();

    }

    $conexx = null;


}


// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";

// if ($conn->query($sql) === TRUE) {
//   $last_id = $conn->insert_id;
//   echo "New record created successfully. Last inserted ID is: " . $last_id;


?>
