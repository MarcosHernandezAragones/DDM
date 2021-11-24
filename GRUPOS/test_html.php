<?php

    include_once "../CRUD/functions.php";
    include_once "test_grupos.php";

    $alumnoss=read_alumnoss(1,1);
    

    ///////////////////test
    $num_grupos=2;
    $miembros_grupo=4;
    $orden=[4,3,1,2];


    $alumnoss_aux=group_maker($alumnoss,$num_grupos,$miembros_grupo,$orden);

    $alumnoss_gru=$alumnoss_aux[0];
    $alumnoss_nokat=$alumnoss_aux[1];
    $alumnoss_nokat=array_values($alumnoss_nokat);

    
    $al_nokat_jso=json_encode($alumnoss_nokat);

    $al_gru_jso=json_encode($alumnoss_gru);
?>



<!DOCTYPE html>
<html lang="en">
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

<script>

    
    show_jso_nokat(<?php echo $al_nokat_jso ?>)
    show_jso_gru(<?php echo $al_gru_jso ?>)
</script>



