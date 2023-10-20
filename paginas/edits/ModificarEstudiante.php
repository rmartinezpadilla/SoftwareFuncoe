<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
$errors = array();

if (isset($_POST['enviar'])) {
    
    $cedula = trim($_POST['cedula']);
    $f_nacimiento = trim($_POST['fecha_nacimineto']);
    $nombres = strtoupper(trim($_POST['nombres'])); 
    $apellidos =strtoupper( trim($_POST['apellidos']));    
    $direccion = strtoupper(trim($_POST['direccion'])); 
    $municipio = strtoupper(trim($_POST['municipio']));
    $celular = trim($_POST['cel']);
    $genero = trim($_POST['gen']);
    $recomendacion = trim($_POST['recomendacion']);
    $medio = trim($_POST['mediopublicitario']);
    $dia = trim($_POST['dia']);
    $jornada = strtoupper( trim($_POST['jornada']));
    $nro_registro = trim($_POST['registronro']);
    $asesor = trim($_POST['asesor']);  
    $mi_id =  $mysqli->real_escape_string($_POST['mi_id']);
    

    $sql = "UPDATE estudiantes SET cedula='$cedula', fecha_nacimiento = '$f_nacimiento', nombres='$nombres', apellidos = '$apellidos', municipio = '$municipio', direccion = '$direccion', celular = '$celular', genero = '$genero', recomendacion = '$recomendacion', medio_publicitario = '$medio', dia_id =$dia, jornada = '$jornada', numero_registro = '$nro_registro', asesor_id = $asesor WHERE id_estudiante='$mi_id'";        
        $resultado = $mysqli->query($sql);

}else{

$errors[]="No has enviado el formulario.";
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Editar Estudiante : FUNCOE</title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="../../imagenes/ico.jpg" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
            <a class="navbar-brand" href="#">Usuario: <?php echo $_SESSION['user'];?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="../Principal.php">Inicio</a>  
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerMatriculas.php" >Pagos y Matriculas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerTurnos.php">Turnos</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerProgramas.php">Programas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerDocentes.php" >Docentes</a></li>                     
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerEstudiantes.php">Estudiantes</a></li>                        
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerAsesores.php">Asesores</a></li> 
                        <li class="nav-item"><a class="nav-link active " style="color:#fffb00;"  aria-current="page" href="../../funciones/logout.php">¿Cerrar Sesión?</a></li>
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

                        <?php 
						//veificamos que haya sido definida
							if (isset($resultado)) {
								//verificamos si la variable fue true
								if ($resultado) {
                                
									?>
                                    <div class="alert alert-warning alert-dismissable">                                    
                                    <strong>Estudiante! <?php echo $cedula . ' = ' . $nombres . ' ' . $apellidos;?></strong>  Actualizado Correctamente.
                                    <a href="../vistas/VerEstudiantes.php">Volver</a>
                                    </div>
                                    <?php
									
								}
							}

						 ?>


				
					<?php 
						
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

