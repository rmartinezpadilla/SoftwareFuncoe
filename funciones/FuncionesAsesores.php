<?php 

    

function asesorExiste($cedula){

    //llamamos y declaramos a la variable que contiene la conexion
    // a la base de datos que la tenemos en el archivo connect.php

        global $mysqli;

        //declaramos una variable la cual contiene el argumento enviado por el metodo actual
		$ced_usuario = $cedula;

        //realizamos la consulta con un nuevo sql
        //usando sentencias preparadas

		$sql= "SELECT id_asesor FROM asesores WHERE cedula = ?";

		//preparamos la consulra
        $statement = $mysqli->prepare($sql);

		$statement->bind_param("s", $ced_usuario);

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


function esVaciaAsesores($cedula, $nombre, $cel){

    //la funcion trim verifica q no vengan con espacios al principio y al final
    //la funcion trim pertenece a php

    if (!empty(trim($cedula)) && !empty(trim($nombre)) && !empty(trim($cel))) {
        return FALSE;
    }else{
        return TRUE;
    }
}

function registrarAsesor($cedula, $nombres, $tel){
	date_default_timezone_set("America/Bogota");
    global $mysqli;

		$ced = $cedula;
        $nom = strtoupper($nombres);  		
		$cel =  strtoupper($tel);		
		$id = null;
		$ultima_conexion = null;
		$fecha = date("Y-m-d");

		

		//aqui la password ya debe venir encriptada

		$sql = "INSERT INTO asesores (cedula, nombre_asesor, telefono, fecha_registro) VALUES (?,?,?,?)";

		$statement = $mysqli->prepare($sql);

			//vincular los parametros

			$statement->bind_param("ssss", $ced, $nom, $cel, $fecha );

		if ($statement->execute()) {
			$statement->close();
			return true;
		}else{
			$statement->close();
			return false;
		}
}

function idAsesor($nombre){
	global $mysqli;
	$sql = "SELECT id_asesor FROM asesores WHERE nombre_asesor = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$nombre_ass = $nombre;
		$nueva_consulta ->bind_param("s", $nombre_ass);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['id_asesor'];
	  }else{
		echo "error";
	  }
	}
}


function nombreAsesor($id){
	global $mysqli;
	$sql = "SELECT nombre_asesor FROM asesores WHERE id_asesor = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_ass = $id;
		$nueva_consulta ->bind_param("i", $id_ass);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nombre_asesor'];
	  }else{
		echo "error";
	  }
	}
}

?>
