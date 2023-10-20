<?php 
	
	$mysqli = new mysqli("localhost", "root", "", "db_funcoe");

	if ($mysqli->connect_errno) {
		echo "Algo salio mal.";
	}


 ?>

