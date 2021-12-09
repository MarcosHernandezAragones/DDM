<?php 



session_start();

    include_once "../functions.php";
    include_once "test_grupos.php";

    
    $id=$_SESSION['user'];
    $nombre=$_SESSION['nombre'];
    $centro=$_SESSION['centro'];
    $rol=$_SESSION['rol'];
    $first_time=true;
    
///////////////////test
    $chek_chek=check_doc_rol($_SESSION['user']);//$datos_doc_all[$i][7]

    

    $num_grupos=$_POST["grupos"];
    $miembros_grupo=$_POST["alumnos"];
    $orden=[4,3,1,2];

    if (isset($_POST['orden'])) {
      $orden_raw=$_POST['orden'];
      $ord_arr=explode(",",$orden_raw);
      for ($ord=0; $ord < count($ord_arr); $ord++) { 
        $orden[$ord]=intval($ord_arr[$ord]);
      }
      

    }
    


    $id_curso=$_SESSION["id_curse"];
    
    $id_centro=$chek_chek[2][7];
    


    $alumnoss=read_alumnoss($id_curso,$id_centro);
    
    $grupos_clase=read_grupo_curso($id_curso,$id_centro);
    
    //print_r($grupos_clase);
  
    if (count($grupos_clase) != 0) {
      $_SESSION["borrar_grupo"]=false;
      $first_time=false;

      $al_sort=alumno_has_group($alumnoss);
      
      $al_nokat=$al_sort[0];
      $al_nokat=array_values($al_nokat);

      $al_cat=$al_sort[1];
      
      $al_cat=array_values($al_cat);
      

      //$grup_BD=sort_group_BBDD($grupos_clase,$al_cat);


      $grupos_w=json_encode($grupos_clase);

      $al_nokat_jso=json_encode($al_nokat);

      $al_gru_jso=json_encode($al_cat);

    }else {
      if ($_SESSION["borrar_grupo"]) {
        $_SESSION["borrar_grupo"]=false;
        header("Location: elegir");
      }
      
      $alumnoss_aux=group_maker($alumnoss,$num_grupos,$miembros_grupo,$orden);
      //print_r($alumnoss_aux);
      $alumnoss_gru=$alumnoss_aux[0];
      $alumnoss_nokat=$alumnoss_aux[1];
      //print_r($alumnoss_nokat);
      if (is_array($alumnoss_nokat)) {
        $alumnoss_nokat=array_values($alumnoss_nokat);
      }
      

      
      $al_nokat_jso=json_encode($alumnoss_nokat);
      //echo $al_nokat_jso;
      $al_gru_jso=json_encode($alumnoss_gru);
    }
    
   
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_mostrarGrupos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Mostrar grupos</title>

    <style>
        
    </style>

</head>
<body>
  <?php include_once "../menu_fijo.php";?>
      <main>
    <form action="asignar-grupos" id="guardar" method="post">
      <input id="devolver" type="hidden" name="gru2" value="">
      <input id="devolver" type="hidden" name="cent" value="<?php echo $id_centro; ?>">
      <input id="devolver" type="hidden" name="curse" value="<?php echo $id_curso; ?>">
      <input type="submit" onclick="return get_group()" name="gru" value="GUARDAR">
    </form>
    <button onclick="creat_empty_gru()">+ GRUP</button>
    <div id="test">
    </div>
    </main>
</body>
</html>

<script src="java-script"></script>
<script>    
    show_jso_nokat(<?php echo $al_nokat_jso ?>)
</script>

<?php 
    if ($first_time) {
      
?>

<script>
        show_jso_gru(<?php echo $al_gru_jso ?>)
</script>

<?php
    }else{
?>

<script>
        show_jso_gru_BD(<?php echo $grupos_w ?>,<?php echo $al_gru_jso ?>)
</script>

<?php
    }
?>


