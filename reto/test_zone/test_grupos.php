<?php
    include_once "../CRUD/functions.php";
//[$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul]YRGB [1,2,3,4]
// 0-8 datos alumno 9-12 colores alumno


    // $id=$_SESSION['user'];
    // $nombre=$_SESSION['nombre'];
    // $centro=$_SESSION['centro'];
    
    

    // if (isset($_POST['id_curso'])) {
    //     $id_curso=$_POST['id_curso'];
    // }
 
    /////    TEST ONLY
        $id_curso=1;

        $centro=1;

    /////


    $groups_not_set=true;
    $grupos_read=read_gruposs_curso($id_curso,$centro);

    if ($grupos_read) {
        
        $groups_not_set=true;
    }else{
        
        $groups_not_set=false;
    }
































///////////////valores test aqui PELLIZCABOMBILLAS




//$orden=[4,3,1,2];//TEST ONLY

//$num_grupos=3;//TEST ONLY
//$miembros_grupo=6;//TEST ONLY

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
            $order_selector;
            $cont=0;
            for ($k=0; $k < $miembros; $k++) { 
                if ($cont == 4) {
                    $cont=0;
                }

                $order_selector[$k]=$orden[$cont]+8;

                $cont++;
            }

            return $order_selector;
        }



        //print_r(order_color_select($orden,$miembros_grupo));

        function group_inserter_randomizer($num_grupos){
            $cont=0;
            for ($i=0; $i < $num_grupos; $i++) { 
                $values[$i]=$cont;
                $cont++;
            }
            shuffle($values);
            return $values;
        }




        function group_select_col($alumnoss,$pos_color,$grupos){//$pos_color now int
            $alu_aux=$alumnoss;
            
            foreach ($alu_aux as $key => $row) {
                $aux[$key] = $row[$pos_color];
                
            }
            
            array_multisort($aux, SORT_DESC, $alu_aux);
            
            $cont=0;
            
            foreach ($alu_aux as $key => $row) {

                if ($cont < $grupos) {
                    //print_r($alu_aux[$key]);
                    
                    //$pos_rand_al=$rand_order[$cont];

                    $col_r[$cont]=$alu_aux[$key];
                    unset($alu_aux[$key]);
                    $cont++;
                }

                if ($cont == $grupos) {
                    $cont=0;
                    break;
                }  

            }
            
            $resultado=[$alu_aux,$col_r];
            return $resultado;
        }

        function group_maker($alumnoss,$num_grupos,$miembros_grupo,$orden){
            $grupos;

            $alu_aux=$alumnoss;

            $color_selector=order_color_select($orden,$miembros_grupo);
            for ($alal=0; $alal < $miembros_grupo; $alal++) { //posicion alumno
                $orden_asignacion_grupo=group_inserter_randomizer($num_grupos);
                

                $varex=group_select_col($alu_aux,$color_selector[$alal],$num_grupos);

                $alu_aux=$varex[0];
                array_values($alu_aux);
                $choosen=$varex[1];
                

                for ($gg=0; $gg < $num_grupos; $gg++) { //para cada posicion del alumno selecciona grupo
                    $asignado=$orden_asignacion_grupo[$gg];
                    $grupos[$gg][$alal]=$choosen[$asignado];



                }
            }
            if (count($alu_aux) == 0) {
                $result=[$grupos,"nil"];
            }else {
                $result=[$grupos,$alu_aux];
            }


            return $result;
        }



        // function group_show($alumnoss,$num_grupos,$miembros_grupo,$orden){
        //     $estragrupos=group_maker($alumnoss,$num_grupos,$miembros_grupo,$orden);

        //     $grupos_show=$estragrupos[0];

        //     $no_cat=array_values($estragrupos[1]);

        //     if ($no_cat == "nil") {
                
        //     } else {
        //         $nombre_auto="<div>NO_KAT";
        //         echo $nombre_auto."<br>";
        //         for ($al=0; $al < count($no_cat); $al++) { 
        //             echo "<div>";
        //             print_r($no_cat[$al]);
        //             echo "</div>";


        //         }
        //         echo "<br>brrrrrrrrrrrrrrrrrrrrrrrrrrrrrr</div><br><br>";
        //     }
            




            
        //     for ($gg=0; $gg < count($grupos_show); $gg++) { 
        //         $nombre_auto="<div>Grupo_".($gg+1);
        //         echo $nombre_auto."<br>";
        //         for ($al=0; $al < count($grupos_show[$gg]); $al++) { 
        //             echo "<div>";
        //             print_r($grupos_show[$gg][$al]);
        //             echo "</div>";


        //         }
        //         echo "<br>brrrrrrrrrrrrrrrrrrrrrrrrrrrrrr</div><br><br>";
        //     }


        // }





        // group_show($alumnoss,$num_grupos,$miembros_grupo,$orden)

        
        

//}







/////////////////////////////////////////////////////////////mostrar grupos guardados:
/////////////////////////////////////////////////////////////result=[[id_grupo,nombre_grupo,[[al1],[al2],...]],[id_grupo2,nombre_grupo2,[[al3],[al4],...],...]];
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////request: datos alumno curso, datos grupos curso
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////datos alumno curso => read_alumnoss($curso,$centro)
/////////////////////////////////////////////////////////////datos grupos curso => read_grupo_curso($id_grupo,$id_curso,$id_centro)
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////if al[grupo]!=null && al[grupo]==idgrupo 

function alumno_has_group($alumnoss){
    $no_cat=[];
    $yes_cat=[];

    $cont_no_kat=0;
    $cont_yes_kat=0;
    for ($i=0; $i < count($alumnoss); $i++) { 

        if (!is_null($alumnoss[$i][6]) && $alumnoss[$i][6] != "") {
            $yes_cat[$cont_yes_kat]=$alumnoss[$i];
            $cont_yes_kat++;
        }else {
            $no_cat[$cont_no_kat]=$alumnoss[$i];
            $cont_no_kat++;
        }
    }
    $result=[$no_cat,$yes_cat];

    return $result;
}

function sort_group_BBDD($gruposs,$al_cat){
//[$id_grupo,$nombre,$id_curs,$id_centre]
//[$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul]
    $group_res=[];
    $cont=0;
    for ($i=0; $i < count($gruposs); $i++) { 

        for ($al=0; $al < count($al_cat); $al++) { 
            
            if ($al_cat[$al][6] == $gruposs[$i][0]) {
                $group_res[$cont]=[$gruposs[$i],$al_cat[$al]];
            }

        }
        
    }

    return $group_res;
}



?>


