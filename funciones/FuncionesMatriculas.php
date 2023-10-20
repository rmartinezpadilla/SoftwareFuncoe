<?php 


function matriculaExiste($id_estudiante, $id_programa, $semestre){

    //llamamos y declaramos a la variable que contiene la conexion
    // a la base de datos que la tenemos en el archivo connect.php

        global $mysqli;

        //declaramos una variable la cual contiene el argumento enviado por el metodo actual
		$id_est = $id_estudiante;
        $programa_id = $id_programa;
        $sem = $semestre;

        //realizamos la consulta con un nuevo sql
        //usando sentencias preparadas

		$sql= "SELECT estudiante_id, programa_id, semestre FROM matricula WHERE estudiante_id = ? AND programa_id = ? AND semestre = ?";

		//preparamos la consulra
        $statement = $mysqli->prepare($sql);

		$statement->bind_param("iii", $id_est, $programa_id, $sem);

		$statement->execute();

		$statement->store_result();

		$num_rows = $statement->num_rows;

		$statement->close();

		if ($num_rows > 0) {
			return true;
		}else{
			return false;
		}
}

function guardarMatricula($estudiante_id, $programa_id, $semestre, $valor, $cuotas, $valorporcuotas){
	global $mysqli;
	date_default_timezone_set("America/Bogota");
	$id_est = $estudiante_id;
	$id_prog = $programa_id;	
	$sem = $semestre;
	$vlr = $valor;
	
	$ctas = $cuotas;
	$vlrxcuotas = $valorporcuotas;
	/* $sueldo = $horas * 12000; */
	$fecha = date('Y-m-d');
	$turno_id =null;


	$sql = "INSERT INTO matricula (estudiante_id, programa_id, semestre, valor, pendiente,cuotas, valorxcuotas, fecha_registro ) VALUES (?,?,?,?,?,?,?,?)";
	$statement = $mysqli->prepare($sql);

			//vincular los parametros

	$statement->bind_param("iiiiiiis", $id_est, $id_prog, $sem, $vlr, $vlr, $ctas, $vlrxcuotas, $fecha);

		if ($statement->execute()) {
			$statement->close();
			return 	true;
			
			
		}else{
			$statement->close();
			return false;
		}
}


function idMatricula($id_estudiante, $id_programa, $id_semestre){
	global $mysqli;

	$sql = "SELECT id_matricula FROM matricula WHERE estudiante_id = ? AND programa_id = ? AND semestre_id = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$est_id =$id_estudiante;
		$prog_id = $id_programa;
		$sem_id = $id_semestre;		
		$nueva_consulta ->bind_param("iii", $est_id, $prog_id, $sem_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['id_matricula'];
	  }else{
		echo "error";
	  }
	}
}



function valorMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT FORMAT(valor, 0) AS valor2 FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['valor2'];
	  }else{
		echo "error";
	  }
	}
}

function cuotasMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT cuotas FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['cuotas'];
	  }else{
		echo "error";
	  }
	}
}




function valorCuotasMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT valorxcuotas FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['valorxcuotas'];
	  }else{
		echo "error";
	  }
	}
}
function idProgramaMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT programa_id FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
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

function fechaMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT fecha_registro FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['fecha_registro'];
	  }else{
		echo "error";
	  }
	}
}

function semestreMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT semestre FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['semestre'];
	  }else{
		echo "error";
	  }
	}
}

function idEstudianteMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT estudiante_id FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['estudiante_id'];
	  }else{
		echo "error";
	  }
	}
}


function pendienteMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT pendiente FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['pendiente'];
	  }else{
		echo "error";
	  }
	}
}

function saldoFavorMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT saldo_favor FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['saldo_favor'];
	  }else{
		echo "error";
	  }
	}
}


function pendienteConFormatoMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT FORMAT(pendiente, 0) AS pendiente2 FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['pendiente2'];
	  }else{
		echo "error";
	  }
	}
}


function actualizarPendiente($idmatricula, $valor){
	global $mysqli;	
	$vlr =$valor;
	$pendiente = pendienteMatricula($idmatricula);
	$valorainsertar = $pendiente - $vlr; 	
		$sql = "UPDATE matricula SET pendiente='$valorainsertar' WHERE id_matricula = '$idmatricula'";
			if ($mysqli->query($sql) == TRUE) {
			return true;   
			}else {
			return false;
			}
			mysqli_close($mysqli);

}

function actualizarSaldoAFavor($idmatricula, $valor){
	global $mysqli;	
	$vlr =$valor;	
		$sql = "UPDATE matricula SET saldo_favor='$vlr' WHERE id_matricula = '$idmatricula'";
			if ($mysqli->query($sql) == TRUE) {
			return true;   
			}else {
			return false;
			}
			mysqli_close($mysqli);

}




function actualizarNroCuota($idmatricula, $valor=1){
	global $mysqli;			

		$sql = "UPDATE matricula SET nro_cuota=nro_cuota + $valor WHERE id_matricula = '$idmatricula'";
			if ($mysqli->query($sql) == TRUE) {
			return true;   
			}else {
			return false;
			}
			mysqli_close($mysqli);

}


function programaMatricula($idmatricula){
	global $mysqli;

	$sql = "SELECT programa_id FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
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

function numeroCuotaClase($idmatricula){
	global $mysqli;

	$sql = "SELECT nro_cuota FROM matricula WHERE id_matricula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		
		$mat_id = $idmatricula;		
		$nueva_consulta ->bind_param("i", $mat_id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nro_cuota'];
	  }else{
		echo "error";
	  }
	}
}

?>