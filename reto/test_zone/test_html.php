<?php

    include_once "../CRUD/functions.php";
    include_once "test_grupos.php";
    $first_time=true;
    
///////////////////test
    $num_grupos=2;
    $miembros_grupo=4;
    $orden=[4,3,1,2];

    $id_curso=1;
    $id_centro=1;


    $alumnoss=read_alumnoss($id_curso,$id_centro);
    
    $grupos_clase=read_grupo_curso($id_curso,$id_centro);
    //print_r($grupos_clase);

    if (count($grupos_clase) != 0) {
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
      $alumnoss_aux=group_maker($alumnoss,$num_grupos,$miembros_grupo,$orden);

      $alumnoss_gru=$alumnoss_aux[0];
      $alumnoss_nokat=$alumnoss_aux[1];
      //$alumnoss_nokat=array_values($alumnoss_nokat);

      
      $al_nokat_jso=json_encode($alumnoss_nokat);

      $al_gru_jso=json_encode($alumnoss_gru);
    }
    
    
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        #test > div{
            width: 30vw;
            height: 30vh;
            background-color: #ddd;
            border: 3px solid blue;
            display: inline-block;
        }
        .alumno{
            width:80%;
            height: 15%;
            background-color: aqua;
        }

    </style>

</head>
<body>


    <div id="test"></div>
    
    <form action="asignar_grupos.php" method="post">
      <input id="devolver" type="hidden" name="gru2" value="">
    <input type="submit" onclick="return get_group()" name="gru" value="GUARDAR">
    </form>
    <button onclick="creat_empty_gru()">+ GRUP</button>





</body>
</html>
<script>
/* Events fired on the drag target */

document.addEventListener("dragstart", function(event) {
  // The dataTransfer.setData() method sets the data type and the value of the dragged data
  event.dataTransfer.setData("Text", event.target.id);
  
  // Output some text when starting to drag the p element
  //document.getElementById("demo").innerHTML = "Started to drag the p element.";
  
  // Change the opacity of the draggable element
  event.target.style.opacity = "0.4";
});

// While dragging the p element, change the color of the output text
document.addEventListener("drag", function(event) {
  //document.getElementById("demo").style.color = "red";
});

// Output some text when finished dragging the p element and reset the opacity
document.addEventListener("dragend", function(event) {
  //document.getElementById("demo").innerHTML = "Finished dragging the p element.";
  event.target.style.opacity = "1";
});

/* Events fired on the drop target */

// When the draggable p element enters the droptarget, change the DIVS's border style
document.addEventListener("dragenter", function(event) {
  if ( event.target.className == "droptarget" ) {
    event.target.style.border = "3px solid red";
  }
});

// By default, data/elements cannot be dropped in other elements. To allow a drop, we must prevent the default handling of the element
document.addEventListener("dragover", function(event) {
  event.preventDefault();
});

// When the draggable p element leaves the droptarget, reset the DIVS's border style
document.addEventListener("dragleave", function(event) {
  if ( event.target.className == "droptarget" ) {
    event.target.style.border = "";
  }
});

/* On drop - Prevent the browser default handling of the data (default is open as link on drop)
   Reset the color of the output text and DIV's border color
   Get the dragged data with the dataTransfer.getData() method
   The dragged data is the id of the dragged element ("drag1")
   Append the dragged element into the drop element
*/
document.addEventListener("drop", function(event) {
  event.preventDefault();
  if ( event.target.className == "droptarget" ) {
    //document.getElementById("demo").style.color = "";
    event.target.style.border = "";
    var data = event.dataTransfer.getData("Text");
    event.target.appendChild(document.getElementById(data));
  }
});
</script>
<script src="group_gen.js"></script>

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


<script>    
    show_jso_nokat(<?php echo $al_nokat_jso ?>)
</script>