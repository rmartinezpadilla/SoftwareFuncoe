<?php 
session_start();
require('funciones/session2.php');
date_default_timezone_set("America/Bogota");

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FuncoeSoft</title>
        <!-- Favicon-->
        <!--<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />-->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" href="./imagenes/ico.jpg" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
                <a class="navbar-brand" href="index.php">FUNCOE MONTERÍA - WEB</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        
                        <li class="nav-item"><a class="nav-link active" href="./paginas/login.php">Iniciar Sesión</a></li>
                        
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
                         <div class="card-body">
                            
                            <div class="text-center"><h2 class="card-title">FUNDACIÓN COLOMBIA ESTUDIA</h2></div>
                            <div class="text-center"><h4 class="card-title">FUNCOE SOFT - WEB</h4></div>
                            <div class="alert alert-danger" role="alert">Debes <a href="./paginas/login.php" class="alert-link">iniciar sesión</a> para acceder al sistema.
</div>
                            <div class="small text-muted"><?php  echo "Hoy: " . date("Y-m-d"); ?></div>
                            
                            
                        </div>
                    </div>
                  
                    
                </div>
                <!-- Side widgets-->
            
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-3  bg-danger">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; FUNCOE <?php echo date("Y");?></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
