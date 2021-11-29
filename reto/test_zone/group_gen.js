

//$orden=[4,3,1,2];//TEST ONLY 

//$num_grupos=3;//TEST ONLY
//$miembros_grupo=6;//TEST ONLY
// var $alumnoss=[]                         VALORES TEST AQUI RASCAESQUINAS
// $alumnoss[0]=[1,"y1","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];//YRGB
// $alumnoss[1]=[2,"y2","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];
// $alumnoss[2]=[3,"y3","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];

// $alumnoss[3]=[4,"g1","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];
// $alumnoss[4]=[5,"g2","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];
// $alumnoss[5]=[6,"g3","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];

// $alumnoss[6]=[7,"b1","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];
// $alumnoss[7]=[8,"b2","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];
// $alumnoss[8]=[9,"b3","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];

// $alumnoss[9]=[10,"r1","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];
// $alumnoss[10]=[11,"r2","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];
// $alumnoss[11]=[12,"r3","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];

// $alumnoss[12]=[13,"mult1","aaaa","sdfg","adf","passwrd",null,1,1,80,80,25,80];
// $alumnoss[13]=[14,"mult2","aaaa","sdfg","adf","passwrd",null,1,1,80,25,80,25];

// $alumnoss[14]=[15,"oooooooo","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
// $alumnoss[15]=[16,"00000000000","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];

// $alumnoss[16]=[17,"sdfgsdf","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
// $alumnoss[17]=[18,"mudfsdflt2","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
// $alumnoss[18]=[19,"musdfsdfsdfsdflt1","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
// $alumnoss[19]=[20,"sdfsdfsdfsd","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];


function sortByColumn(a, colIndex){

    a.sort(sortFunction);

    function sortFunction(a, b) {
        if (a[colIndex] === b[colIndex]) {
            return 0;
        }
        else {
            return (a[colIndex] > b[colIndex]) ? -1 : 1;
        }
    }

    return a;
}






function order_by_color(jso) {
    var alu_aux = jso
    
    var red=[]
    var green=[]
    var yellow=[]
    var blue=[]

    //YRGB   9  10  11  12
    for (let al = 0; al < alu_aux.length; al++) {

        if (alu_aux[al][12] == alu_aux[al][11] && alu_aux[al][12] == alu_aux[al][10] && alu_aux[al][12] == alu_aux[al][9]) {
            green.push(alu_aux[al])
        }else if (alu_aux[al][12] == alu_aux[al][11] && alu_aux[al][12] == alu_aux[al][10]) {
            if (alu_aux[al][12] < alu_aux[al][9]) {
                yellow.push(alu_aux[al])
            }else{
                blue.push(alu_aux[al])
            }
        }else if (alu_aux[al][12] == alu_aux[al][11] && alu_aux[al][12] == alu_aux[al][9]) {
            if (alu_aux[al][12] < alu_aux[al][10]) {
                red.push(alu_aux[al])
            }else{
                green.push(alu_aux[al])
            }
        }else if (alu_aux[al][12] == alu_aux[al][9] && alu_aux[al][12] == alu_aux[al][10]) {//las triad
            if (alu_aux[al][12] < alu_aux[al][11]) {
                green.push(alu_aux[al])
            }else{
                red.push(alu_aux[al])
            }
        }else if (alu_aux[al][12] == alu_aux[al][9] ) {//12 ---- 9
            if (alu_aux[al][12] < alu_aux[al][11]) {
                green.push(alu_aux[al])
            }else if (alu_aux[al][12] < alu_aux[al][10]) {
                red.push(alu_aux[al])
            }else{
                yellow.push(alu_aux[al])
            }
        }else if (alu_aux[al][12] == alu_aux[al][9] ) {//12 ---- 10
            if (alu_aux[al][12] < alu_aux[al][11]) {
                green.push(alu_aux[al])
            }else if (alu_aux[al][12] < alu_aux[al][9]) {
                yellow.push(alu_aux[al])
            }else{
                blue.push(alu_aux[al])
            }
        }else if (alu_aux[al][12] == alu_aux[al][9] ) {//12 ---- 11     //YRGB   9  10  11  12
            if (alu_aux[al][12] < alu_aux[al][10]) {
                red.push(alu_aux[al])
            }else if (alu_aux[al][12] < alu_aux[al][9]) {
                yellow.push(alu_aux[al])
            }else{
                blue.push(alu_aux[al])
            }
        }else if (alu_aux[al][9] == alu_aux[al][10] ) {//9 ---- 10
            if (alu_aux[al][9] < alu_aux[al][11]) {
                green.push(alu_aux[al])
            }else if (alu_aux[al][9] < alu_aux[al][12]) {
                blue.push(alu_aux[al])
            }else{
                red.push(alu_aux[al])
            }
        }else if (alu_aux[al][9] == alu_aux[al][11] ) {//9 ---- 10
            if (alu_aux[al][9] < alu_aux[al][10]) {
                red.push(alu_aux[al])
            }else if (alu_aux[al][9] < alu_aux[al][12]) {
                blue.push(alu_aux[al])
            }else{
                yellow.push(alu_aux[al])
            }
        }else if (alu_aux[al][11] == alu_aux[al][10] ) {//11 ---- 10
            if (alu_aux[al][11] < alu_aux[al][9]) {
                yellow.push(alu_aux[al])
            }else if (alu_aux[al][11] < alu_aux[al][12]) {
                blue.push(alu_aux[al])
            }else{
                green.push(alu_aux[al])
            }
        }else if (alu_aux[al][11] < alu_aux[al][12]) {
            blue.push(alu_aux[al])
        }else if (alu_aux[al][10] < alu_aux[al][12]) {
            blue.push(alu_aux[al])
        }else if (alu_aux[al][9] < alu_aux[al][12]) {
            blue.push(alu_aux[al])
        }else if (alu_aux[al][10] < alu_aux[al][9]) {
            yellow.push(alu_aux[al])
        }else if (alu_aux[al][11] < alu_aux[al][9]) {
            yellow.push(alu_aux[al])
        }else if (alu_aux[al][10] < alu_aux[al][11]) {
            green.push(alu_aux[al])
        }


        
    }

    // document.write(red)
    // document.write("<br>")
    // document.write(green)
    // document.write("<br>")
    // document.write(yellow)
    // document.write("<br>")
    // document.write(blue)
    // document.write("<br>") 
    for (let reeee = 0; reeee < green.length; reeee++) {
        document.write(blue[reeee]+"---")
        
    }
        
}























































































function show_jso_gru(grupos_we) {
    var gen_cont=document.getElementById("test")
    //gen_cont.setAttribute('draggable',"true")
    //gen_cont.setAttribute('ondragstart',"drag(event)")

    for (let gru = 0; gru < grupos_we.length; gru++) {
        var cont_gru=document.createElement("div")
        
        
        

        //cont_gru.appendChild(title)
        cont_gru.className="droptarget"
        id_grup="grupoini_"+gru
        cont_gru.id=id_grup

        

        
        //document.writeln("<h1>grupo_"+gru+"</h1>")
        for (let al = 0; al < grupos_we[gru].length; al++) {
            console.log(grupos_we[gru][al])
            var al_gru=document.createElement("div")
            var id_al="alumno_"+grupos_we[gru][al][0]
            al_gru.setAttribute("id",id_al)
            al_gru.setAttribute("class","alumno")

            al_gru.setAttribute('draggable',"true")
            
            



            
            al_gru.innerHTML=grupos_we[gru][al][1]+" "+grupos_we[gru][al][2]



            
            //console.log(grupos_we[gru][al][1])
            cont_gru.appendChild(al_gru)
        }
        var lbl=document.createElement("label")
        lbl.setAttribute("for",id_grup)
        lbl.innerHTML="grupo_"+(gru+1)

        gen_cont.appendChild(lbl)
        gen_cont.appendChild(cont_gru)
        
    }


}


function show_jso_nokat(nokats) {
        var gen_cont=document.getElementById("test")
        var cont_nok=document.createElement("div")
        
        
        

        //cont_nok.appendChild(title)
        cont_nok.className="droptarget"


        id_grup="nil_1"
        cont_nok.id=id_grup


        
        for (let al = 0; al < nokats.length; al++) {
            var al_gru=document.createElement("div")
            var id_al="alumno_"+nokats[al][0]
            al_gru.setAttribute("id",id_al)
            al_gru.innerHTML=nokats[al][1]+" "+nokats[al][2]
            al_gru.setAttribute("class","alumno")


            al_gru.setAttribute('draggable',"true")

            
            console.log(nokats[al])
            cont_nok.appendChild(al_gru)
        }
        gen_cont.appendChild(cont_nok)
}





function get_group() {//edit to catch gbd_(existe en BBDD) groupini_ nil_1(NO KAT) spidertron_(new empty group)
    var grupos=document.getElementsByClassName("droptarget")
    var alumnos=document.getElementsByClassName("alumno")
    var grupos_to_BD=[]//gnew=[[grupo1],[grupo2]]// gupd=[[idgru,[alumnoss]],[idgru,[alumnoss]]]

    //gsend=[gupd,gnew]

    gnew=[];
    gupd=[];
    for (let i = 0; i < grupos.length; i++) {
        var g_split=grupos[i].id.split("_")
        var group_type=g_split[0]
        var iden=g_split[1]

        

        console.log(group_type)

        switch (group_type) {
            case "nil":
                
                break;


            case "groupini":
                    var alumnos_to_BD=[]
                    for (let al = 0; al < alumnos.length; al++) {
                        if (alumnos[al].parentNode.id == grupos[i].id) {
                            var al_id_raw=alumnos[al].id
                            var al_id_spl=al_id_raw.split("_")
                            var al_id_dig=al_id_spl[1]
                            alumnos_to_BD.push(al_id_dig)
                        }
                        
                    }

                    gnew.push(alumnos_to_BD)
                break;


            case "gbd":
                    var alumnos_to_BD=[]
                    for (let al = 0; al < alumnos.length; al++) {
                        if (alumnos[al].parentNode.id == grupos[i].id) {
                            var al_id_raw=alumnos[al].id
                            var al_id_spl=al_id_raw.split("_")
                            var al_id_dig=al_id_spl[1]
                            alumnos_to_BD.push(al_id_dig)
                        }
                        
                    }
                    gupd_parts=[iden,alumnos_to_BD]
                    gupd.push(gupd_parts)
                break;


            case "spidertron":
                    var alumnos_to_BD=[]
                    for (let al = 0; al < alumnos.length; al++) {
                        if (alumnos[al].parentNode.id == grupos[i].id) {
                            var al_id_raw=alumnos[al].id
                            var al_id_spl=al_id_raw.split("_")
                            var al_id_dig=al_id_spl[1]
                            alumnos_to_BD.push(al_id_dig)
                        }
                        
                    }

                    gnew.push(alumnos_to_BD)
                break;    
                            
                            
            default:
                break;
        }

        
        
            


        
        

    }

    gsend=[gupd,gnew]
    
    console.log(gsend)

    var aaa=document.getElementById("devolver")

    

    aaa.value=JSON.stringify(gsend)
    
}



var cont=0;
function creat_empty_gru() {

    var gen_cont=document.getElementById("test")


    var cont_new=document.createElement("div")
        
    cont_new.className="droptarget"

    id_grup="spidertron_"+cont
    cont++
    cont_new.id=id_grup

    var lbl=document.createElement("label")
    lbl.setAttribute("for",id_grup)
    lbl.innerHTML="grupo_nuevo_"+cont
        
    gen_cont.appendChild(lbl)
    gen_cont.appendChild(cont_new)

}




function show_jso_gru_BD(grupos_we,alumnoss) {
    var gen_cont=document.getElementById("test")
    

    for (let gru = 0; gru < grupos_we.length; gru++) {
        var cont_gru=document.createElement("div")
        
        
        

        
        cont_gru.className="droptarget"
        

        id_grup="gbd_"+grupos_we[gru][0]
        cont_gru.id=id_grup

        


        
        for (let al = 0; al < alumnoss.length; al++) {

            if (alumnoss[al][6] == grupos_we[gru][0]) {
                console.log(alumnoss[al])
                var al_gru=document.createElement("div")
                var id_al="alumno_"+alumnoss[al][0]
                al_gru.setAttribute("id",id_al)
                al_gru.setAttribute("class","alumno")

                al_gru.setAttribute('draggable',"true")
                
                



                
                al_gru.innerHTML=alumnoss[al][1]+" "+alumnoss[al][2]



                
                
                cont_gru.appendChild(al_gru)
            }


            
        }



        var lbl=document.createElement("label")
        lbl.setAttribute("for",id_grup)
        lbl.innerHTML=grupos_we[gru][1]

        gen_cont.appendChild(lbl)
        gen_cont.appendChild(cont_gru)
        
    }


}