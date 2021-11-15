function  redirigir(ruta) {
    console.log(ruta);
    location.href=ruta;
}

function salir(ruta) {
    location.href=ruta;
}

function comprobarPregunta(){
    var pregunta = document.getElementById("pregunta").value;
    var explicacion = document.getElementById("explicacion").value;
    var color = document.getElementById("color").value;

    console.log(pregunta);
    console.log(explicacion);
    console.log(color);

    if (pregunta.trim()=="") {
        alert("La pregunta no puede estar vacia");
        return false;
    }

    if (explicacion.trim()=="") {
        alert("La explicación no puede estar vacia");
        return false;
    }

    if (color=="null") {
        alert("Elige una opcion de color");
        return false;
    }

    
}

function actualizarRespAlumno(idPregunta, idForm, idAlum){
    
    //definimos el formulario
    var formulario =document.getElementById(idForm);  
    
    

    //nombre formulario
    console.log("id pregunta: "+idPregunta);
    console.log("nombre formulario: "+idForm);
    console.log("id alumno: "+idAlum);


    //respuesta que da el usuario
    var respuesta = 0;
    respuesta = document.forms[idForm]['respuesta'].value;
    console.log("respuesta "+respuesta+"%");




    fetch("update_respuesta.php?idAlumno="+idAlum+"&idPregunta="+idPregunta+"&respuesta="+respuesta);

}

