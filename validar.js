function validar_DNI(dni_str) {
    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

    var dni=dni_str;
    numdni = dni.substr(0,8);
    var letradni=dni.substr(8,9);

    var first_char=dni.substr(0,1);
    if (isNaN(first_char)) {
        
        numdni=numdni.replace('X', 0);
        numdni=numdni.replace('Y', 1);
        numdni=numdni.replace('Z', 2);
    }
  
    var rest=numdni%23;
    if (letradni == letras[rest]) {
        //accion si es correcto
        return true;
    }else{
        //accion si NO es correcto
        return false;
    }

}

function validar_email(email_str) {
    var email=email_str;
    var regex=new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$");
    if (regex.test(email)) {
        //accion si es correcto
        return true;
    } else {
        //accion si NO es correcto
        return false;
    }
}



function vaildar_pass(pass_str){
    //obtencion pass
    var pass=pass_str;

    var arr_pass=pass.split("");
    
    var is_num=false;
    var is_upp=false;
    var is_low=false;
    var is_spec=false;
    if (arr_pass.length >= 8) {
        for (let i = 0; i < arr_pass.length; i++) {
            if (!isNaN(arr_pass[i])) {
                is_num=true;
                continue;
            }else{
                var ascii = arr_pass[i].toUpperCase().charCodeAt(0);
                if (ascii < 65 || ascii > 90) {
                    is_spec=true;
                    continue;
                }
            }
            
            if (arr_pass[i] === arr_pass[i].toLowerCase()) {
                is_low=true;
                
            } else if (arr_pass[i] === arr_pass[i].toUpperCase()) {
                is_upp=true;
            } 
        }
    }

    if (is_num && is_upp && is_low && is_spec) {
        //accion si es correcto
        return true;
    }else{
        //accion si NO es correcto
        return false;
    }
}

//funciones validar formularios


function validar_form_create_profesor() {
    var dni_str=document.forms["nombre_formulario"]["campo_dni"].value;
    var email_str=document.forms["nombre_formulario"]["campo_email"].value;
    var pass_str=document.forms["nombre_formulario"]["campo_padd"].value;

    var dni_ok= validar_DNI(dni_str);
    var email_ok=validar_email(email_str);
    var pass_ok=vaildar_pass(pass_str);

    if (dni_ok && email_ok && pass_ok) {
        return true;
    }else{
        return false;
    }
}

function validar_form_create_alumno( ) {
    var dni_str=document.forms["nombre_formulario"]["campo_dni"].value;
    var email_str=document.forms["nombre_formulario"]["campo_email"].value;

    var dni_ok= validar_DNI(dni_str);
    var email_ok=validar_email(email_str);

    if (dni_ok && email_ok) {
        return true;
    }else{
        return false;
    }
    
}

function validar_form_login_profesor() {
    var dni_str=document.forms["nombre_formulario"]["campo_dni"].value;
    
    var pass_str=document.forms["nombre_formulario"]["campo_pass"].value;

    var dni_ok= validar_DNI(dni_str);
    var pass_ok=vaildar_pass(pass_str);

    if (dni_ok && pass_ok) {
        return true;
    }else{
        return false;
    }

}

function validar_form_login_alumno() {
    var dni_str=document.forms["nombre_formulario"]["campo_dni"].value;
    
    var devolver=validar_DNI(dni_str);
    
    return devolver;
    
}


