<?php 

function programaExisteConValor($id_programa, $semestre){

    //llamamos y declaramos a la variable que contiene la conexion
    // a la base de datos que la tenemos en el archivo connect.php

        global $mysqli;

        //declaramos una variable la cual contiene el argumento enviado por el metodo actual
		$nombre_programa = $id_programa;
        $semestres_2 = $semestre;

        //realizamos la consulta con un nuevo sql
        //usando sentencias preparadas

		$sql= "SELECT programa_id, semestre_id FROM pensum WHERE programa_id = ? AND semestre_id = ? ";

		//preparamos la consulra
        $statement = $mysqli->prepare($sql);

		$statement->bind_param("ii", $nombre_programa, $semestres_2);

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


function guardarProgramaConValor($nombre, $semestre, $numero_clases, $valor){
	global $mysqli;

	$nom_programa = $nombre;
    $sem = $semestre;
	$numero_de_clases = $numero_clases;
    $vlr = $valor;

	$sql = "INSERT INTO pensum (programa_id, semestre_id, cantidad_clases, valor) VALUES (?,?,?,?)";
	$statement = $mysqli->prepare($sql);

			//vincular los parametros

			$statement->bind_param("iiii", $nom_programa, $sem,$numero_de_clases, $vlr);

		if ($statement->execute()) {
			$statement->close();
			return 	true;
		}else{
			$statement->close();
			return false;
		}



}


function idProgramaConvalor($nombre){
	global $mysqli;
	$sql = "SELECT id_programa FROM programa WHERE nombre_programa = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$nombre_prog = $nombre;
		$nueva_consulta ->bind_param("s", $nombre_prog);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['id_programa'];
	  }else{
		echo "error";
	  }
	}
}



function valorProgramaConSemestre($programa, $semestre){
	global $mysqli;
	$sql = "SELECT valor FROM pensum WHERE programa_id = ? AND semestre_id = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{

		$prog = $programa;
		$sem = $semestre;

		$nueva_consulta ->bind_param("ii", $prog, $sem);
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


?>