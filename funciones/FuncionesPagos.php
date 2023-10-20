<?php 


include_once('FuncionesEstudiante.php');


function registrarPago($idmatricula, $concepto, $valor){

	date_default_timezone_set("America/Bogota");
    global $mysqli;

        $matricula_id = $idmatricula ;		
        $concep = $concepto;
        $val =$valor;               
		$id = null;		
		$fecha = date("Y-m-d H:i:s");

		//aqui la password ya debe venir encriptada

		$sql = "INSERT INTO pagos (matricula_id, concepto_id, valor, fecha_pago) VALUES (?,?,?,?)";

		$statement = $mysqli->prepare($sql);

			//vincular los parametros

			$statement->bind_param("iiis", $matricula_id, $concep, $val, $fecha);

		if ($statement->execute()) {
			$statement->close();
			return true;
		}else{
			$statement->close();
			return false;
		}
}

function valorPago($idpago){
	global $mysqli;
	$sql = "SELECT valor FROM pagos WHERE id_pago = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$nombre_ass = $idpago;
		$nueva_consulta ->bind_param("i", $nombre_ass);
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

function idMatriculaEnPago($idpago){
	global $mysqli;
	$sql = "SELECT matricula_id FROM pagos WHERE id_pago = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$nombre_ass = $idpago;
		$nueva_consulta ->bind_param("i", $nombre_ass);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['matricula_id'];
	  }else{
		echo "error";
	  }
	}
}

function idConceptoPago($idpago){
	global $mysqli;
	$sql = "SELECT concepto_id FROM pagos WHERE id_pago = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$nombre_ass = $idpago;
		$nueva_consulta ->bind_param("i", $nombre_ass);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['concepto_id'];
	  }else{
		echo "error";
	  }
	}
}


?>