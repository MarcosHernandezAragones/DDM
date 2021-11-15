<?php

//[$id_alumno,$nombre,$apellidos,$DNI,$correo,$passwrd,$grupo,$centro,$curso,$amarillo,$rojo,$verde,$azul]YRGB [1,2,3,4]
// 0-8 datos alumno 9-12 colores alumno
$orden=[4,1,3,2];
$num_grupos=3;
$miembros_grupo=3;

$alumnoss[0]=[1,"y1","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];
$alumnoss[1]=[2,"y2","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];
$alumnoss[2]=[3,"y3","aaaa","sdfg","adf","passwrd",null,1,1,75,25,25,25];

$alumnoss[3]=[4,"g1","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];
$alumnoss[4]=[5,"g2","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];
$alumnoss[5]=[6,"g3","aaaa","sdfg","adf","passwrd",null,1,1,25,25,75,25];

$alumnoss[6]=[7,"b1","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];
$alumnoss[7]=[8,"b2","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];
$alumnoss[8]=[9,"b3","aaaa","sdfg","adf","passwrd",null,1,1,25,25,25,75];

$alumnoss[6]=[7,"r1","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];
$alumnoss[7]=[8,"r2","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];
$alumnoss[8]=[9,"r3","aaaa","sdfg","adf","passwrd",null,1,1,25,90,25,25];

$alumnoss[9]=[10,"mult1","aaaa","sdfg","adf","passwrd",null,1,1,80,80,25,80];
$alumnoss[10]=[11,"mult2","aaaa","sdfg","adf","passwrd",null,1,1,80,25,80,25];

$alumnoss[11]=[12,"oooooooo","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
$alumnoss[12]=[13,"00000000000","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];

$alumnoss[13]=[14,"sdfgsdf","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
$alumnoss[14]=[15,"mudfsdflt2","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
$alumnoss[15]=[16,"musdfsdfsdfsdflt1","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];
$alumnoss[16]=[17,"sdfsdfsdfsd","aaaa","sdfg","adf","passwrd",null,1,1,0,0,0,0];





function select_col($alumnoss,$pos_color,$grupos){
    $alu_aux=$alumnoss;
    
    foreach ($alu_aux as $key => $row) {
        $aux[$key] = $row[$pos_color];
        print_r($aux[$key]);echo "ppppppppppp";
    }
    
    array_multisort($aux, SORT_DESC, $alu_aux);
    
    $cont=0;
    foreach ($alu_aux as $key => $row) {

        if ($cont < $grupos) {
            //print_r($alu_aux[$key]);
            
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

function get_colores($alumnoss,$orden,$grupos){
    $alumnoss_copy=$alumnoss;
    $colores;



    for ($i=0; $i < count($orden); $i++) { 
        $pos_color=$orden[$i]+8;
        print_r($pos_color);
        $color=select_col($alumnoss_copy,$pos_color,$grupos);

        

        $colores[$i]=$color[1];
        $alumnoss_copy=$color[0];
    }
    return $colores;
}

$varex=get_colores($alumnoss,$orden,$num_grupos);

$grupos;



$count_al=0;



for ($i=0; $i < count($varex); $i++) { //recorre colores
    $count_grup=0;
    for ($op=0; $op < count($varex[$i]); $op++) { //recorre alumnos en cada color (num alumnos color=num grupos)
        
        $varex[$i][$op];//alumno
        
        $grupos[$count_grup][$count_al]=$varex[$i][$op];
        $count_grup++;
        
        print_r($varex[$i][$op]);
        echo "hammertime <br>";
        
       
    }
    $count_al++;
    echo "<br><br><br><br>aaaaaaaaaaaaaaaaa<br><br><br><br>";
}

echo "oooooooOOOOOOOOOOOOOOOOOOOOooooooooooooooooooooooOOOOOOOOOOOOOOOOOOOOOooooooooooooOOOOOOOOOOOOOOOOOOooOOOOOOOOOoooooooooOOOOOO";
for ($i=0; $i < count($grupos); $i++) { //recorre colores
    
    for ($op=0; $op < count($grupos[$i]); $op++) { //recorre alumnos en cada color (num alumnos color=num grupos)
        
        print_r($grupos[$i][$op]);
        echo "hammertime <br>";
        
        
       
    }
   
    echo "<br><br><br><br>knksdnkfmsdkfnmvsd<br><br><br><br>";




}




















// print_r($varex[0]);
// $no_cat=array_diff($alumnoss, $varex[0], $varex[1], $varex[2], $varex[3]);//alumnos no introducidoesen grupo automaticamente



// for ($i=0; $i < count($no_cat); $i++) { 
//     echo "kela de thaym <br>";
//     echo "kela de thaym  <br>";
//     echo "kela de thaym  <br>";
//     echo "kela de thaym  <br>";
    
//     for ($op=0; $op < count($no_cat[$i]); $op++) { 
        
//         //$no_cat[$i][$op];//alumno
        
        

        
//         print_r($no_cat[$i][$op]);
//         echo "stop, hammertime <br>";
//     }
//     echo "kela de thaym  <br>";
//     echo "kela de thaym  <br>";
//     echo "kela de thaym  <br>";
//     echo "kela de thaym  <br>";
// }


// for ($gg=0; $gg < $num_grupos; $gg++) { 
//     for ($op=0; $op < $miembros_grupo; $op++) { 
        
//     }
// }




?>