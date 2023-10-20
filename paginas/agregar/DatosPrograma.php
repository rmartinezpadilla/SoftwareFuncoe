<?php 
include('../../funciones/connect.php');

$continente=$_POST['continente'];

	$sql="SELECT id_modulo, nombre_modulo, programa_id from modulo where programa_id='$continente' ORDER BY semestre DESC";

	$result=mysqli_query($mysqli,$sql);

	$cadena="
			<select id='lista2' name='lista2'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena."</select>";

    echo $ver[0];
	

?>