<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');

    if (!isset($_SESSION['user'])) {
    // si o existe la session de user, significa que no esta logueado

    header('Location:../index.php');
    }
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pagos Registrados - <?php echo $_SESSION['user'];?></title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="../../imagenes/ico.jpg" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        <!-- fontawesome icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
            <a class="navbar-brand" href="./Principal.php">Usuario: <?php echo $_SESSION['user'];?></a>
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
        <div class="row justify-content-md-center text-center">
                                        <div class="col">
                                        <a>Bienvenido <strong><?php echo  mensajeBienvenida(); ?></strong></a>
                                        </div>
                                        <div class="col">
                                        <p class="card-text"> <a href="../agregar/AddTurno.php"style="color:#FF0000;">Agregar Turno</a></p>
                                        </div>
                                        <div class="col">
                                        <a href="../Principal.php"style="color:#FF0000;">Volver</a>
                                        </div>
                                    </div>  
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <div class="card mb-2">
                       <!-- <a href="#!"><img class="card-img-top" src="" alt="..." /></a>-->
                        <div class="card-body">
                        
                       <!--  <h4>Estás logueado como: <?php echo  $_SESSION['user'];?> </h4> -->
                      <!--  <a href="GenerarPDF.php">Generar PDF</a> -->
                       
                      <div class="row">

                            <div class="card text-center">
                            <!--  <div class="card-header">
                            Featured
                            </div> -->
                            <div class="card-body">
                            <!-- h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            
                            <form action="./DetalleTodosLosPagos.php" method="POST">
                            <h2 align="center" class="text-danger"> <strong>CONSULTAR PAGOS POR FECHAS</strong></h2>
                            <label for="" class="text-danger">Concepto:</label>
                                    <?php
                                    /* consulta SELECT */
                                    if ($resultado = $mysqli->query("SELECT id_concepto, nombre_concepto FROM conceptos ORDER by id_concepto ASC")) {
                                        /* recorrer los resultados  */                                       
                                    ?>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <select class="form-select" aria-label="Default select example" name="concepto">
                                            
                                        <?php  while ( $fila = $resultado->fetch_assoc() ) {
                                            
                                        ?>
                                            <option  value="<?php echo $fila['id_concepto'];?>"><?php echo $fila['nombre_concepto'];?></option>
                                        <?php                                        
                                        }
                                    } 
                                   
                                    ?>
                                        </select>
                                        </div>
                                <div class="mb-3">
                                <!-- <label for="" class="text-primary">FECHAS:</label> -->
                                    <br>
                                    <label for="" class="text-danger">FECHA INICIO:</label>                                    
                                    <input type="date" name="fechainicio"  value="<?php echo date("Y-m-d");?>"  required>
                                    <label for="" class="text-danger">FECHA FIN:</label>
                                    <input type="date" name="fechafin"  value="<?php echo date("Y-m-d");?>"  required>
                                </div>           
                                <input type="hidden" name="id_programa" value="<?php echo $nombre_programa ?>">                                
                                <button type="submit" class="btn btn-danger" name="consultar">Consultar</button>
                                </form>
                            </div>
                            <!--   <div class="card-footer text-muted">
                            2 days ago
                            </div> -->
                            </div>
                            </div>
                
                                                   
                        </div>
                        
                    </div>
                    
                   
                </div>
                <!-- Side widgets-->
          
            </div>
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