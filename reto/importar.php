<?php
session_start();
include_once "funciones_BBDD.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html"; charset=utf-8"/> 

		<title>CreaciÃ³n Grupos ....</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body id="top">
	
	


		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="#" class="image avatar"><img src="images/avatar.jpg" alt="" /></a>
					
					
					<?php

                    $conexion=conectarBD();
	

if( isset($_SESSION['rol']) && $_SESSION['rol']>1 )	
{		

		//include "menuLateral.php";
				
?>	
				</div>
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
		<?php
			if (isset($_POST['subir']))
				{
				//obtenemos el archivo .csv
				$tipo = $_FILES['archivo']['type'];
 
				$tamanio = $_FILES['archivo']['size'];
 
				$archivotmp = $_FILES['archivo']['tmp_name'];
				
				//$grupo=$_POST['grupo'];
				
				//$instituto=$_SESSION['instituto'];
				//cargamos el archivo
					$lineas = file($archivotmp);
 
				//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
					$i=0;
 
				//Recorremos el bucle para leer línea por línea
				echo "<table>";
				foreach ($lineas as $linea_num => $linea)
				{ 
					//abrimos bucle
					/*si es diferente a 0 significa que no se encuentra en la primera línea 
					(con los títulos de las columnas) y por lo tanto puede leerla*/
					if($i != 0) 
					{ 
					//abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
					/* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
					leyendo hasta que encuentre un ; */
					$datos = explode(";",$linea);
		
					//Almacenamos los datos que vamos leyendo en una variable
					//usamos la función utf8_encode para leer correctamente los caracteres especiales
					$dni = utf8_encode($datos[0]);
					$clave = $datos[1];
					$nombre = utf8_encode($datos[2]);
					echo "<tr>";
					echo "<td>";
					echo "$dni -- $nombre -- $grupo";
					echo "</td>";
 
					//guardamos en base de datos la línea leida
					
					$sql="INSERT INTO usuarios  (matricula, DNI, password, nombre, instituto, grupo, rol) VALUES (0, \"$dni\",\"$clave\",\"$nombre\",\"$instituto\",\"$grupo\",1)";
					//echo "<td>";
					if(mysqli_query($conexion,$sql))
						{
						echo "<td style=\"color: GREEN;\">";
						echo "INSERCIÃN REALIZADA CON ÃXITO";echo "<br>";
						
						}
					else
						{
						echo "<td style=\"color: RED;\">";
						echo "ERROR AL INSERTAR DATOS--";
						echo mysqli_errno($conexion);
						}
					echo "</td>";
					echo "</tr>";	
 
       //cerramos condición
   }
 
   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   $i++;
   //cerramos bucle
}
echo "</table>";
				
				}
			else
			{
						?>		
					<h1>Importar archivo CSV</h1>
					
					<h3 style="color: RED;">SELECCIONAR UN CSV CON LA SIGUENTE ESTRUCTURA
					<br>
					DNI;PASSWORD;NOMBRE Y APELLIDOS;</h3> 
					<h4style="color: GREEN;">La primera lÃ­nea se reserva para el encabezado de columnas.</H4>
					<h4 style="color: BLUE;">No olvides seleccionar el grupo.</H4>
					<a href="Usuarios.csv" target="_blank"> Descargar fichero de ejemplo</a>
					
					<BR><BR>	
					<?php
					//tomamos el nombre del instituto
					$sql="select * from institutos where Id=".$_SESSION['instituto'];
					$resultado=mysqli_query($conexion,$sql);
					$fila=mysqli_fetch_array($resultado);
					echo "<h3>Centro educativo: ".$fila['Nombre']."</h3>";
					?>
					<form action='importar.php' method='post' enctype="multipart/form-data" >
					Importar Archivo :<br> <input type='file' name='archivo' size='20' required/>
					
					<?php
					$sql="select * from grupos where instituto=".$_SESSION['instituto'];
					$resultado=mysqli_query($conexion,$sql);
					?>
					<br>
					Grupo:
					<select name="grupo" > 
						<?php 
					while($row=mysqli_fetch_array($resultado))
					{
					echo "<option value='".$row['CodGrupo']."'>".$row['CodGrupo']."</option>";
					}
						?>	
					</select>
					<br><br>
					
					<input type='submit' name='importar' value='Importar'>
					</form>
			<?php
			
			
			}
		echo "</div>";			
}
			?>


<?php
include "pie.php";
?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>