<?php 

function nombreConcepto($id){
	global $mysqli;
	$sql = "SELECT nombre_concepto FROM conceptos WHERE id_concepto = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_estudiante= $id;
		$nueva_consulta ->bind_param("i", $id_estudiante);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nombre_concepto'];
	  }else{
		echo "error";
	  }
	}
}

function idConcepto($nombre){
	global $mysqli;
	$sql = "SELECT id_concepto FROM conceptos WHERE nombre_concepto = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_estudiante= $nombre;
		$nueva_consulta ->bind_param("s", $id_estudiante);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['id_concepto'];
	  }else{
		echo "error";
	  }
	}
}


?>