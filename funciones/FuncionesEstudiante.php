<?php 
function esVaciaEstudiante($cedula, $nombre, $area, $usuario, $contrasena){

    //la funcion trim verifica q no vengan con espacios al principio y al final
    //la funcion trim pertenece a php

    if (!empty(trim($cedula)) && !empty(trim($nombre)) && !empty(trim($area))  && !empty(trim($usuario)) && !empty(trim($contrasena))) {
        return FALSE;
    }else{
        return TRUE;
    }
}



function estudianteExiste($cedula){

    //llamamos y declaramos a la variable que contiene la conexion
    // a la base de datos que la tenemos en el archivo connect.php

        global $mysqli;

        //declaramos una variable la cual contiene el argumento enviado por el metodo actual
		$ced_usuario = $cedula;

        //realizamos la consulta con un nuevo sql
        //usando sentencias preparadas

		$sql= "SELECT id_estudiante FROM estudiantes WHERE cedula = ?";

		//preparamos la consulra
        $statement = $mysqli->prepare($sql);

		$statement->bind_param("i", $ced_usuario);

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



function registrarEstudiante($cedula, $fecha_nacimiento, $nombres, $apellidos, $direccion, $municipio, $celular, 
$genero, $recomendacion, $medio, $dia, $jornada, $nro_reg, $id_asesor){
	date_default_timezone_set("America/Bogota");
    global $mysqli;

		$ced = $cedula;
		$nacimiento = $fecha_nacimiento;
        $nom = strtoupper($nombres);  		
		$ape =  strtoupper($apellidos);
		$dir = strtoupper($direccion);
        $mun = strtoupper($municipio);
        $cel =$celular;
        $gen = $genero;
        $recom = $recomendacion;
        $medio_1 = $medio;
		$day = $dia;
		$jor = strtoupper($jornada);
		$reg = $nro_reg;
        $ass_id = $id_asesor;        
		$id = null;		
		$fecha = date("Y-m-d");

		


		//aqui la password ya debe venir encriptada

		$sql = "INSERT INTO estudiantes (cedula, fecha_nacimiento, nombres, apellidos, municipio, direccion, celular, genero, 
		recomendacion, medio_publicitario, dia_id, fecha_registro, jornada, numero_registro, asesor_id) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$statement = $mysqli->prepare($sql);

			//vincular los parametros

			$statement->bind_param("ssssssisssisssi", $ced, $nacimiento, $nom, $ape, $mun, $dir, $cel, $gen, $recom, $medio_1, $day, $fecha, $jor, $reg, $ass_id);

		if ($statement->execute()) {
			$statement->close();
			return true;
		}else{
			$statement->close();
			return false;
		}
}


function idEstudiante($cedula){
	global $mysqli;
	$sql = "SELECT id_estudiante FROM estudiantes WHERE cedula = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$ced= $cedula;
		$nueva_consulta ->bind_param("i", $ced);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['id_estudiante'];
	  }else{
		echo "error";
	  }
	}
}

function nombreEstudiante($id){
	global $mysqli;
	$sql = "SELECT nombres, apellidos FROM estudiantes WHERE id_estudiante = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_estudiante= $id;
		$nueva_consulta ->bind_param("i", $id_estudiante);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nombres'] . " " . $datos['apellidos'];
	  }else{
		echo "error";
	  }
	}
}

function soloNombreEstudiante($id){
	global $mysqli;
	$sql = "SELECT nombres FROM estudiantes WHERE id_estudiante = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_estudiante= $id;
		$nueva_consulta ->bind_param("i", $id_estudiante);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nombres'];
	  }else{
		echo "error";
	  }
	}
}

function apellidosEstudiante($id){
	global $mysqli;
	$sql = "SELECT apellidos FROM estudiantes WHERE id_estudiante = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_estudiante= $id;
		$nueva_consulta ->bind_param("i", $id_estudiante);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['apellidos'];
	  }else{
		echo "error";
	  }
	}
}

function cedulaEstudiante($id){
	global $mysqli;
	$sql = "SELECT cedula FROM estudiantes WHERE id_estudiante = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_estudiante= $id;
		$nueva_consulta ->bind_param("i", $id_estudiante);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['cedula'];
	  }else{
		echo "error";
	  }
	}
}

?>