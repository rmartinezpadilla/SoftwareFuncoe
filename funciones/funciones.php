<?php 

function esVacia($cedula, $nombre, $area, $usuario, $contrasena){

    //la funcion trim verifica q no vengan con espacios al principio y al final
    //la funcion trim pertenece a php

    if (!empty(trim($cedula)) && !empty(trim($nombre)) && !empty(trim($area))  && !empty(trim($usuario)) && !empty(trim($contrasena))) {
        return FALSE;
    }else{
        return TRUE;
    }
}

function validaLargo($usuario){

    if (strlen($usuario) > 5 && strlen($usuario) < 20) {
        return TRUE;
    }else{
        return FALSE;
    }

}

function usuarioExiste($cedula){

    //llamamos y declaramos a la variable que contiene la conexion
    // a la base de datos que la tenemos en el archivo connect.php

        global $mysqli;

        //declaramos una variable la cual contiene el argumento enviado por el metodo actual
		$ced_usuario = $cedula;

        //realizamos la consulta con un nuevo sql
        //usando sentencias preparadas

		$sql= "SELECT id_docente FROM docente WHERE cedula = ?";

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



function programaExiste($nombre){

    //llamamos y declaramos a la variable que contiene la conexion
    // a la base de datos que la tenemos en el archivo connect.php

        global $mysqli;

        //declaramos una variable la cual contiene el argumento enviado por el metodo actual
		$nombre_programa = $nombre;

        //realizamos la consulta con un nuevo sql
        //usando sentencias preparadas

		$sql= "SELECT id_programa FROM programa WHERE nombre_programa = ?";

		//preparamos la consulra
        $statement = $mysqli->prepare($sql);

		$statement->bind_param("s", $nombre_programa);

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




function contraseñasIguales($contrasena, $repcontrasena){

    //strcmp nos devuelve 0 si son iguales
		 if (strcmp($contrasena, $repcontrasena) == 0) {
            return true;
       }else{
           return false;
       }
}

function hashContrasena($contrasena){

    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    return $hash;

}

function registrarDocente($cedula, $nombres, $area, $usuario, $contrasena){
	date_default_timezone_set("America/Bogota");
    global $mysqli;

		$ced = $cedula;
        $nom = strtoupper($nombres);  		
		$ar =  strtoupper($area);
		$usr = $usuario;
		$contra = $contrasena;     
		$id = null;
		$ultima_conexion = null;
		$fecha = date("Y-m-d");

		

		//aqui la password ya debe venir encriptada

		$sql = "INSERT INTO docente (cedula, nombre_comp_docente, usuario, contrasena, fecha_registro, ultima_conexion, programa_id) VALUES (?,?,?,?,?,?,?)";

		$statement = $mysqli->prepare($sql);

			//vincular los parametros

			$statement->bind_param("ssssssi", $ced, $nom, $usr, $contra, $fecha, $ultima_conexion, $ar );

		if ($statement->execute()) {
			$statement->close();
			return true;
		}else{
			$statement->close();
			return false;
		}
}



function loginVacio($usuario, $contrasena){

    if (!empty(trim($usuario)) && !empty(trim($contrasena))) {
        return false;
    }else{
        return true;
    }
}

function login($usuario, $contrasena){

    global $mysqli;

		$sql = "SELECT cedula, contrasena FROM usuarios WHERE usuario = ?";

		$statement = $mysqli->prepare($sql);

		$statement->bind_param("s", $usuario);

		$statement->execute();

		$statement->store_result();

		//verificar que si existe el usuario

		$numrows = $statement->num_rows;

		if ($numrows > 0) {
			//significa que el usuario existe

			$statement->bind_result($cedula, $contra);

			$statement->fetch();

			/* $contravalidada = password_verify($contrasena, $contra); */

			if (strcmp($contrasena, $contra) == 0) {
				// en ese caso la contraseña es valida
				$_SESSION['user'] = $usuario;
				//la funcion last session actualiza la ultima conexion del usuario
				//$lastSession = lastSession($cedula);
				//redirigimoa a la pagina de inicio
				header('Location:../paginas/Principal.php');
			}else{

					return "Las contraseñas no coinciden.";

				}
			}else{

					return "Este usuario no existe.";
			}

    
}

function lastSession($cedula){

    global $mysqli;

    $statement = $mysqli->prepare("UPDATE usuarios SET ultima_conexion=NOW() WHERE id_usuario = ?");

    $statement->bind_param("i",$cedula);

    if ($statement->execute()) {
        if ($statement->affected_rows > 0) {
            // si las filas afectadas son mayores a 0 signidica que todo se actualizo correctamente
            $statement->close();
            return true;
        }else{
            $statement->close();
            return false;
        }
    }else{
        $statement->close();
        return false;
    }
}

function mensajeBienvenida(){
	global $mysqli;
	$sql = "SELECT nombre_completo, ultima_conexion FROM usuarios WHERE usuario = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$usuario = $_SESSION['user'];                                    
		$nueva_consulta ->bind_param("s", $usuario);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		$_SESSION['usuario'] = $datos;
		/* echo $datos['nombres'] . " " .$datos['apellidos'] . "<p>, tu ultima conexión, fué: " . $datos['ultima_conexion']  . "</p>"; */

		return $datos['nombre_completo']/*  . " " .  $datos['apellidos'] */;
	  }else{
		echo "error";
	  }
	}
}


function nombrePrograma($id_program){
	global $mysqli;
	$sql = "SELECT nombre_programa FROM programa WHERE id_programa = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id = $id_program;
		$nueva_consulta ->bind_param("s", $id);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nombre_programa']/*  . " " .  $datos['apellidos'] */;
	  }else{
		echo "error";
	  }
	}
}

/* function registraTruno($modulo, $horas, $sueldo, $usuario){

	global $mysqli;
		$modulo = $modulo;
        $horas = $horas;
        $sueldo = $sueldo;        
		$fecha = date('Y-m-d H:i:s');
		
		$id_usuario = $usuario;
		$id = null;
		

		//aqui la password ya debe venir encriptada

		$sql = "INSERT INTO turnos (nombre_modulo, cant_horas, sueldo, fecha_registro, id_usuario) VALUES (?,?,?,?,?)";

		$statement = $mysqli->prepare($sql);

			//vincular los parametros

			$statement->bind_param("sissi", $modulo, $horas, $sueldo, $fecha, $id_usuario);

		if ($statement->execute()) {
			$statement->close();
			return 	true;
		}else{
			$statement->close();
			return false;
		}


}
 */

function registraturno($modulo, $horas, $sueldo, $usuario){
	date_default_timezone_set("America/Bogota");
		global $mysqli;
		$modulo = $modulo;
        $horas = $horas;
        $sueldo = $sueldo;        
		$fecha = date('Y-m-d H:i:s');
		
		$id_usuario = $usuario;
		$id = null;
		

		//aqui la password ya debe venir encriptada

		$sql = "INSERT INTO turnos (nombre_modulo, cant_horas, sueldo, fecha_registro, id_usuario) VALUES (?,?,?,?,?)";

		$statement = $mysqli->prepare($sql);

			//vincular los parametros

			$statement->bind_param("sissi", $modulo, $horas, $sueldo, $fecha, $id_usuario);

		if ($statement->execute()) {
			$statement->close();
			return 	true;
		}else{
			$statement->close();
			return false;
		}


}

function selccionIdUser(){

	global $mysqli;

	$sql = "SELECT id_usuario FROM usuarios WHERE usuario = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$usuario = $_SESSION['user'];                                    
		$nueva_consulta ->bind_param("s", $usuario);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();		
		
		return $datos['id_usuario'];
	
	  }else{

		return $errors[]="NO tiene registros";

	  }
	}
}

function devuelveSueldos(){
	
}

function dameTotalRegistros($usuario_id){

	global $mysqli;


	$sql ="SELECT count(*) FROM turnos WHERE id_usuario = $usuario_id ";

	
	$resultado = $mysqli->query($sql);

	if ($resultado->num_rows > 0 ) {
		//si hay registros activamos la bandera y listamos los datos.
	/* 	$bandera = 1; */
		$datos = $resultado->fetch_assoc();

		foreach ($datos as $info) {
			return $info;
		}
	}else{

		return $errors[]="NO tiene registros";

	}


}

function dameTotalSueldos($id_usuario){

	global $mysqli;

	$id = $id_usuario;

	$sql ="SELECT FORMAT(SUM(sueldo), 0) FROM turnos WHERE id_usuario = $id ";

	$statement = $mysqli->prepare($sql);
	$statement->execute();
	$statement->store_result();

	if ($statement->num_rows > 0) {
               
		$statement->bind_result($sueldo);
		$statement->fetch();
		return $sueldo;
	}
	return "No tiene sueldos guarados";

}

function guardarPrograma($nombre){
	global $mysqli;

	$nom_programa = $nombre;

	$sql = "INSERT INTO programa (nombre_programa) VALUES (?)";
	$statement = $mysqli->prepare($sql);

			//vincular los parametros

			$statement->bind_param("s", $nom_programa);

		if ($statement->execute()) {
			$statement->close();
			return 	true;
		}else{
			$statement->close();
			return false;
		}



}


function moduloExiste($nombre, $idprograma){

    //llamamos y declaramos a la variable que contiene la conexion
    // a la base de datos que la tenemos en el archivo connect.php

        global $mysqli;

        //declaramos una variable la cual contiene el argumento enviado por el metodo actual
		$nombre_modulo = $nombre;
		$programid = $idprograma;

        //realizamos la consulta con un nuevo sql
        //usando sentencias preparadas

		$sql= "SELECT nombre_modulo, programa_id FROM modulo WHERE nombre_modulo = ? AND programa_id = ?";

		//preparamos la consulra
        $statement = $mysqli->prepare($sql);

		$statement->bind_param("si", $nombre_modulo, $programid);

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

function guardarModulo($nombre, $id_programa, $semestre){
	global $mysqli;

	$nom_modulo = strtoupper($nombre);
	$programa_id = $id_programa;
	$sem = $semestre;

	$sql = "INSERT INTO modulo (nombre_modulo, programa_id, semestre ) VALUES (?,?,?)";
	$statement = $mysqli->prepare($sql);

			//vincular los parametros

	$statement->bind_param("sii", $nom_modulo, $programa_id, $sem);

		if ($statement->execute()) {
			$statement->close();
			return 	true;
		}else{
			$statement->close();
			return false;
		}



}

function idPrograma($nombre){
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


function idModulo($nombre_modulo){
	global $mysqli;
	$sql = "SELECT id_modulo FROM modulo WHERE nombre_modulo = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$nombre_mod = $nombre_modulo;
		$nueva_consulta ->bind_param("s", $nombre_mod);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['id_modulo'];
	  }else{
		echo "error";
	  }
	}
}

function idDocente($nombre_docente){
	global $mysqli;
	$sql = "SELECT id_docente FROM docente WHERE nombre_comp_docente = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$nombre_doc = $nombre_docente;
		$nueva_consulta ->bind_param("s", $nombre_doc);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['id_docente'];
	  }else{
		echo "error";
	  }
	}
}


function guardarTurno($nombre_modulo, $horas, $docente){
	global $mysqli;
	date_default_timezone_set("America/Bogota");
	$id_modulo = $nombre_modulo;
	$horas_laboradas = $horas;	
	$docente_id = $docente;
	$sueldo = $horas * 12000;
	$fecha = date('Y-m-d');
	$turno_id =null;

	$sql = "INSERT INTO turnos (id_turno, modulo_id, cant_horas, sueldo, fecha_registro, docente_id ) VALUES (?,?,?,?,?,?)";
	$statement = $mysqli->prepare($sql);

			//vincular los parametros

	$statement->bind_param("iiissi", $turno_id, $id_modulo, $horas_laboradas, $sueldo, $fecha, $docente_id);

		if ($statement->execute()) {
			$statement->close();
			return 	true;
			
			
		}else{
			$statement->close();
			return false;
		}



}


function nombreModulo($id){
	global $mysqli;
	$sql = "SELECT nombre_modulo FROM modulo WHERE id_modulo = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_mod = $id;
		$nueva_consulta ->bind_param("i", $id_mod);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nombre_modulo'];
	  }else{
		echo "error";
	  }
	}
}

function nombreDocente($id_docente){
	global $mysqli;
	$sql = "SELECT nombre_comp_docente FROM docente WHERE id_docente = ?";
	if($nueva_consulta = $mysqli->prepare($sql));{
		$id_mod = $id_docente;
		$nueva_consulta ->bind_param("i", $id_mod);
		$nueva_consulta ->execute();
		$resultado = $nueva_consulta->get_result();
	  if($resultado ->num_rows > 0){
		$datos = $resultado ->fetch_assoc();
		return $datos['nombre_comp_docente'];
	  }else{
		echo "error";
	  }
	}
}


?>