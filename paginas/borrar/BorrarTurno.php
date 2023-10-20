<?php 
	session_start();

    require('../../funciones/connect.php');
    require('../../funciones/funciones.php');
    
    
    
        if (!isset($_SESSION['user'])) {
        // si o existe la session de user, significa que no esta logueado
    
        header('Location:../index.php');
    }

	$errors = array();


	if (isset($_GET['id'])) {
		
		//verificar que nos han enviado el id

		$id_turno =$mysqli->real_escape_string($_GET['id']);

		if (empty($id_turno)) {			
			$errors[]="El ID  esta vacio";
		
        }else{

			$sql = "DELETE FROM turnos WHERE id_turno= $id_turno";

			$resultado=$mysqli->query($sql);
		}
	}else{
		$errors[]="No puedes estar en esta página.";
	}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BORRAR - FUNCOE</title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="../../imagenes/ico.jpg" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
            <a class="navbar-brand" href="index.php">Usuario: <?php echo $_SESSION['user'];?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="../Principal.php">Inicio</a>
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerDocentes.php" >Docentes</a></li> 
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerProgramas.php">Programas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerTurnos.php">Turnos</a></li>
                        <li class="nav-item"><a class="nav-link " style="color:#fffb00;" aria-current="page" href="../../funciones/logout.php">¿Cerrar Sesión?</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-1 bg-light border-bottom mb-4">
          
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                       <!-- <a href="#!"><img class="card-img-top" src="" alt="..." /></a>-->
                        <div class="card-body">
                        
                       <!--  <h4>Estás logueado como: <?php echo  $_SESSION['user'];?> </h4> -->
                       <?php 
                       //LAMAMOS AL METODO mensajeBienvenida para obtener la informacion de la persona logueada
                       mensajeBienvenida();

                       ?>
                   <?php 
						//veificamos que haya sido definida
							if (isset($resultado)) {
								//verificamos si la variable fue true
								if ($resultado) {

									if ($mysqli->affected_rows > 0) {
										
                                        echo "<div class='success'><i class='fas fa-check-circle'></i>Turno Borrado Correctamente.</div>";
                                        sleep(2);

                                      
									}else{
										echo "<div class='success'><i class='fas fa-check-circle'></i>Turno Borrado Correctamente.</div>";                                                                             
                                        echo '<script language="javascript">alert("Turno Borrado correctamente.");</script>';
                                        
										//echo "No fue borrado, no existe";
									}
									
								}
							}

						 ?>

                         <a href="../vistas/VerTurnos.php">Volver</a>
                            <?php 

                            include('../../funciones/errores.php');
                            
                            $mysqli->close();

                            ?>
                        </div>
                    </div>
                </div>
                <!-- Side widgets-->
          
            </div>
        </div>
        <!-- Footer-->
        <?php 
     /* por medio de este include llamo al footer que se va a usar en los agregar*/
        include ('../../templates/footeradd.php');
    
     ?>