

$orden=[4,3,1,2];//TEST ONLY

$num_grupos=3;//TEST ONLY
$miembros_grupo=6;//TEST ONLY
var $alumnoss=[]
$alumnoss[0]=[1,"y1","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];
$alumnoss[1]=[2,"y2","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];
$alumnoss[2]=[3,"y3","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];

$alumnoss[3]=[4,"g1","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];
$alumnoss[4]=[5,"g2","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];
$alumnoss[5]=[6,"g3","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];

$alumnoss[6]=[7,"b1","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];
$alumnoss[7]=[8,"b2","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];
$alumnoss[8]=[9,"b3","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];

$alumnoss[9]=[10,"r1","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];
$alumnoss[10]=[11,"r2","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];
$alumnoss[11]=[12,"r3","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];

$alumnoss[12]=[13,"mult1","aaaa","sdfg","adf","passwrd",null,1,1,80,80,25,80];
$alumnoss[13]=[14,"mult2","aaaa","sdfg","adf","passwrd",null,1,1,80,25,80,25];

$alumnoss[14]=[15,"oooooooo","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
$alumnoss[15]=[16,"00000000000","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];

$alumnoss[16]=[17,"sdfgsdf","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
$alumnoss[17]=[18,"mudfsdflt2","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
$alumnoss[18]=[19,"musdfsdfsdfsdflt1","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
$alumnoss[19]=[20,"sdfsdfsdfsd","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];


//if (!$groups_not_set) {
    

        function order_color_select($orden,$miembros){
            var $order_selector=[];
            var $cont=0;
            for ($k=0; $k < $miembros; $k++) { 
                if ($cont == 4) {
                    $cont=0;
                }

                $order_selector[$k]=$orden[$cont]+8;

                $cont++;
            }

            return $order_selector;
        }



        
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }


        function group_inserter_randomizer($num_grupos){
            $cont=0;
            var $values=[]
            for ($i=0; $i < $num_grupos; $i++) { 
                $values[$i]=$cont;
                $cont++;
            }
            shuffle($values);
            return $values;
        }











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





        function group_select_col($alumnoss,$pos_color,$grupos){//$pos_color now int
            var $alu_aux=$alumnoss;

            var sorted_a = sortByColumn($alu_aux, $pos_color);

            //document.write(sorted_a);
            //document.write("<br>")

            var gru=[];
            
            for (let i = 0; i < sorted_a.length; i++) {
                if (i == $grupos) {
                    break;
                }
                gru[i]=sorted_a[i]

                sorted_a.splice(0,1);


                
            }
            
            //document.write(gru);
            
            
            var resultado=[sorted_a,gru];


        
            return resultado;
        }


        group_select_col($alumnoss,11,3)

        function group_naker($alumnoss,$num_grupos,$miembros_grupo,$orden){
            var $grupos;

            var $alu_aux=$alumnoss;

            var $color_selector=order_color_select($orden,$miembros_grupo);
            
            for ($alal=0; $alal < $miembros_grupo; $alal++) { //posicion alumno
                var $orden_asignacion_grupo=group_inserter_randomizer($num_grupos);
                

                var $varex=group_select_col($alu_aux,$color_selector[$alal],$num_grupos);

                $alu_aux=$varex[0];
                
                var $choosen=$varex[1];
                

                for ($gg=0; $gg < $num_grupos; $gg++) { //para cada posicion del alumno selecciona grupo
                    var $asignado=$orden_asignacion_grupo[$gg];
                    $grupos[$gg][$alal]=$choosen[$asignado];



                }
            }
            if (count($alu_aux) == 0) {
                var $result=[$grupos,"nil"];
            }else {
                var $result=[$grupos,$alu_aux];
            }


            return $result;
        }



        function group_show($alumnoss,$num_grupos,$miembros_grupo,$orden){
            $estragrupos=group_naker($alumnoss,$num_grupos,$miembros_grupo,$orden);

            $grupos_show=$estragrupos[0];

            $no_cat=array_values($estragrupos[1]);

            if ($no_cat == "nil") {
                
            } else {
                var cont_nokat=document.createElement("div")



                
                

                var title=document.createElement("h1")
                title.innerHTML="NO KAT"
                cont_nokat.appendChild(title)

                for ($al=0; $al < $no_cat.lenght(); $al++) { 
                    
                    
                    var nokat_childe=document.createElement("div")
                    nokat_childe.innerHTML=$no_cat[$al];
                    cont_nokat.appendChild(nokat_childe)
                }
                
            }
            

            

            


            
            for ($gg=0; $gg < count($grupos_show); $gg++) { 
                var cont_kat=document.createElement("div")
                var title=document.createElement("h1")
                title.innerHTML="Grupo_"+$gg
                cont_kat.appendChild(title)

                for ($al=0; $al < count($grupos_show[$gg]); $al++) { 
                    var alumno=document.createElement("div")
                    alumno.innerHTML=$grupos_show[$gg][$al]
                    var br=document.createElement("div").innerHTML
                    br.innerHTML="<br>"
                    cont_kat.appendChild(alumno)
                    cont_kat.appendChild(br)
                }
                
            }


        }





       group_show($alumnoss,$num_grupos,$miembros_grupo,$orden)