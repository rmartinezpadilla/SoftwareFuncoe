<?php 

function cantidadClasesProgramaPensum($idpensum){
	global $mysqli;
	$sql = "SELECT cantidad_clases FROM pensum WHERE id_pensum = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$pensum_id = $idpensum;
		$nueva_consulta ->bind_param("i", $pensum_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['cantidad_clases'];
	  }else{
		echo "error";
	  }
	}
}

function valorProgramaPensum($idpensum){
	global $mysqli;
	$sql = "SELECT valor FROM pensum WHERE id_pensum = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$pensum_id = $idpensum;
		$nueva_consulta ->bind_param("i", $pensum_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['valor'];
	  }else{
		echo "error";
	  }
	}
}

function idProgramaPensum($idpensum){
	global $mysqli;
	$sql = "SELECT programa_id FROM pensum WHERE id_pensum = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$pensum_id = $idpensum;
		$nueva_consulta ->bind_param("i", $pensum_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['programa_id'];
	  }else{
		echo "error";
	  }
	}
}

function idSemestrePensum($idpensum){
	global $mysqli;
	$sql = "SELECT semestre_id FROM pensum WHERE id_pensum = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$pensum_id = $idpensum;
		$nueva_consulta ->bind_param("i", $pensum_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['semestre_id'];
	  }else{
		echo "error";
	  }
	}
}




function idPensum($idprograma, $idsemestre){
	global $mysqli;
	$sql = "SELECT id_pensum FROM pensum WHERE programa_id = ? AND semestre_id = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$programa_id  = $idprograma;
		$semestre_id = $idsemestre;
		$nueva_consulta ->bind_param("ii", $programa_id, $semestre_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['id_pensum'];
	  }else{
		echo "error";
	  }
	}
}


?>
