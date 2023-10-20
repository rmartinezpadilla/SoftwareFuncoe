<?php 
date_default_timezone_set("America/Bogota");
session_start();

require('../funciones/connect.php');
require('../funciones/funciones.php');



    if (!isset($_SESSION['user'])) {
    // si o existe la session de user, significa que no esta logueado

    header('Location:../index.php');
}

    $errors = array();
    $usuario = selccionIdUser();
	/* $sql = "SELECT id_usuario, nombre_modulo, cant_horas, FORMAT(sueldo, 0) AS moneda, fecha_registro FROM turnos WHERE id_usuario = $usuario";

	$resultado = $mysqli->query($sql) */;

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Principal - <?php echo $_SESSION['user'];?></title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="../imagenes/ico.jpg" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <!-- fontawesome icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
            <a class="navbar-brand" href="index.php">Usuario: <?php echo $_SESSION['user'];?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="./vistas/VerMatriculas.php">Pagos y Matriculas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="./vistas/VerTurnos.php">Turnos</a></li>
                        <li class="nav-item"><a class="nav-link active" href="./vistas/VerProgramas.php">Programas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="./vistas/VerDocentes.php" >Docentes</a></li>                     
                        <li class="nav-item"><a class="nav-link active" href="./vistas/VerEstudiantes.php">Estudiantes</a></li>                        
                        <li class="nav-item"><a class="nav-link active" href="./vistas/VerAsesores.php">Asesores</a></li>                       
                        <li class="nav-item"><a class="nav-link active" style="color:#fffb00;" aria-current="page" href="../funciones/logout.php">¿Cerrar Sesión?</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-1 bg-light border-bottom mb-4">
        <div class="row justify-content-md-center  text-center">
                <div class="col">
                            <p class="card-text">Hola <strong><?php echo  mensajeBienvenida(); ?></strong>.</p>
                            </div>                    
                            <div class="col">
                            <p class="card-text"><strong><?php  echo "Hoy: " . date("Y-m-d"); ?></strong></p>
                            </div>
                            
                </div>
        </header>
        <!-- Page content-->
        <div class="container">
               <!-- Featured blog post-->
               <div class="card card-body mb-2">                                             
                <div class="row">
                    <!-- Blog entries-->                
                    <h4>¿Que deseas hacer?</h4>
                            <div class="list-group">                            
                            <a href="./vistas/VerMatriculas.php" class="list-group-item list-group-item-action list-group-item-primary" aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">REGISTRAR PAGO</h5>
                                    <!-- <small>3 days ago</small> -->
                                    </div>
                                    <p class="mb-1"></p>
                                    <small>Haz clic aqui para ir al formulario de registro de pagos.</small>
                                </a>
                                <a href="./vistas/VerPagos.php" class="list-group-item list-group-item-action list-group-item-warning">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">CONSULTAR PAGOS</h5>
                                    <!-- <small class="text-muted">3 days ago</small> -->
                                    </div>
                                    <p class="mb-1"></p>
                                    <small class="text-muted">Haz clic aqui para ir a consulta pagos.</small>
                                </a>

                                <a href="./agregar/AddTurno.php" class="list-group-item list-group-item-action list-group-item-danger" aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">REGISTRAR TURNO</h5>
                                    <!-- <small>3 days ago</small> -->
                                    </div>
                                    <p class="mb-1"></p>
                                    <small>Haz clic aqui para ir al formulario de registro de turnos.</small>
                                </a>
                              
                                <a href="./agregar/AgregarMatricula.php" class="list-group-item list-group-item-action list-group-item-primary">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">REGISTRAR MATRICULA</h5>
                                    <!-- <small class="text-muted">3 days ago</small> -->
                                    </div>
                                    <p class="mb-1"></p>
                                    <small class="text-muted">Haz clic aqui para ir al formulario de registro del matriculas.</small>
                                </a>
                                <a href="../funciones/backup.php" class="list-group-item list-group-item-action list-group-item-warning">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">GENERAR COPIA DE SEGURIDAD</h5>
                                    <!-- <small class="text-muted">3 days ago</small> -->
                                    </div>
                                    <p class="mb-1"></p>
                                    <small class="text-muted">Haz clic aqui para generar el archico de copia de la base de datos.</small>
                                </a>
                            </div>
                        
                    </div>

                        </div>
                        <div class="row">

                                <!-- <div class="card text-center">
                                <div class="card-header">
                                    Featured
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                                <div class="card-footer text-muted">
                                    2 days ago
                                </div>
                                </div> -->
                        </div>
                        
                    </div>
                   
                </div>
                <!-- Side widgets-->
          
            </div>
        </div>

        <!-- Footer-->
        <footer class="bg-danger text-center text-lg-start">
          
  <!-- Copyright -->
  <div class="py-3 text-center p-0">
    <!-- Grid container -->
  <div class="container p-0 pb-0">
    <!-- Section: Social media -->
    <section class="mb-1">
      <!-- Facebook -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: #3b5998;"
        href="#!"
        role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: #55acee;"
        href="#!"
        role="button"
        ><i class="fab fa-twitter"></i
      ></a>
      <!-- Instagram -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: #ac2bac;"
        href="#!"
        role="button"
        ><i class="fab fa-instagram"></i
      ></a>

    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->
  <p class="text-white">FUNCOE MONTERÍA © <?php echo date("Y");?> Copyright:    
   <strong>Ing. Rubén Darío Martinez Padilla</strong></p>
  </div>
  <!-- Copyright -->
</footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
