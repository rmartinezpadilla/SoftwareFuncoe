<?php 	
	

	if (isset($_SESSION['user'])) {
		// si existe la session que se llama user significa que estamos logueados
		//redirigimos a index.php

		header('Location:Principal.php');
	}
	

 ?>