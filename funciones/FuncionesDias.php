<?php 
function nombreDia($id){
	global $mysqli;
	$sql = "SELECT nombre FROM dias WHERE id_dia = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_dia= $id;
		$nueva_consulta ->bind_param("i", $id_dia);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nombre'];
	  }else{
		echo "error";
	  }
	}
}

?>