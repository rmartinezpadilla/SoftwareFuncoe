<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesProgramas.php');
require('../../funciones/FuncionesMatriculas.php');
$errors = array();

if (isset($_POST['enviar'])) {
    
    $mi_id =  $mysqli->real_escape_string($_POST['mi_id']);
    $id_estudiante = idEstudianteMatricula($mi_id);
    $semestre = trim($_POST['semestre']); 
    $programa = trim($_POST['programa']);    
    $modalidad = $_POST['modalidad']; 
    $valor = valorProgramaConSemestre($programa, $semestre);    
    $cuotas;

    if ($modalidad == "semanal") {
                $cuotas = 24;
                $valorporcuotas = $valor / $cuotas;
        }elseif ($modalidad == "quincenal") {
                $cuotas = 12;
                $valorporcuotas = $valor / $cuotas;
        }elseif ($modalidad == "mensual") {
                $cuotas = 6;
                $valorporcuotas = $valor / $cuotas;
    }    

   if (matriculaExiste($id_estudiante, $programa, $semestre)) {
     
    $errors[] ="La matricula ya existe";
   
    }else{

        $sql = "UPDATE matricula SET programa_id='$programa', semestre='$semestre', valor='$valor', modalidad='$modalidad', 
        cuotas='$cuotas', valorxcuotas= '$valorporcuotas' WHERE id_matricula='$mi_id'";

        $resultado = $mysqli->query($sql);

    }

}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MATRICULAS - FUNCOE</title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="../../imagenes/ico.jpg" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
            <a class="navbar-brand" href="index.php">Usuario: <?php echo $_SESSION['user'];?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <!-- <li class="nav-item"><a class="nav-link active" href="./agregarTurno.php" >Agregar turno</a></li> -->
                      <li class="nav-item"><a class="nav-link active" href="../Principal.php">Inicio</a>
                    <li class="nav-item"><a class="nav-link active" href="../vistas/VerMatriculas.php">Matriculas</a></li>
                        <li class="nav-item"><a class="nav-link active " aria-current="page" href="../../funciones/logout.php">¿Cerrar Sesión?</a></li>
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
                           include('../../funciones/errores.php');
						//veificamos que haya sido definida
							if (isset($resultado)) {
								//verificamos si la variable fue true
								if ($resultado) {
                                
									?>
                                    <div class="alert alert-warning alert-dismissable">                                    
                                    <strong>Matricula!</strong>  Actualizada Correctamente.
                                    <a href="../vistas/VerMatriculas.php">Volver</a>
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
                  <!-- Script filter table-->
            <?php include('../../funciones/scriptfilter.php');?>
            <!-- Script filter table-->
            </div>
    
            <!-- Footer-->
            <?php 
         /* por medio de este include llamo al footer que se va a usar en los agregar*/
            include ('../../templates/footeradd.php');
        
         ?>