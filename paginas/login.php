<?php 

    session_start();

    require('../funciones/connect.php');
    require('../funciones/funciones.php');
    require('../funciones/session.php');

    $errors= array();

    if (isset($_POST['enviar'])) {
        $usuario =  $mysqli->real_escape_string($_POST['usuario']);
        $contrasena =  $mysqli->real_escape_string($_POST['contrasena']);

        if (!loginVacio($usuario, $contrasena)) {
               // echo "no esta vacio";
            $errors[] = login($usuario, $contrasena);
        }else{
            $errors[]="No pueden haber campos vacios.";
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
        <title>Login: FUNCOE</title>
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
            <a class="navbar-brand" href="index.php">FUNCOE: INICIAR SESIÓN</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="../index.php">Inicio</a></li>
                        <!-- <li class="nav-item"><a class="nav-link active" href="registrarme.php">Registrarme</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link " aria-current="page" href="#">¿Quienes somos?</a></li> -->
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
                        <?php include('../funciones/errores.php'); ?>
                   
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                                    <label for="" class="text-secondary">Usuario:</label>
                                            <div class="input-group mb-4">                                        
                                                <!-- Input para el usuario -->
                                                <input type="text" placeholder="Nombre de usuario" name="usuario" autcomplete="off" class="form-control" required> 
                                            </div>

                                    
                                    <label for="" class="text-secondary">Contraseña:</label>
                                    <div class="input-group mb-4">
                                                <div class="input-group mb-4">  
                                                <!-- Input para la contraseña -->
                                                <input type="password" placeholder="Contraseña" name="contrasena" class="form-control" required>
                                                </div>
                                    </div>
                                                                
                                    <div class="row">
                                        
                                            <!-- Input del botón para enviar el formulario -->
                                           <!-- <a href=""> <i class="fas fa-user-check"></i> -->
                                            <input type="submit" class="form-control btn btn-danger" name="enviar" value="Ingresar"></a>
                                        
                                    
                                    </div>

                            </form>
                        
                            
                        </div>
                    </div>
                  
               
                </div>
                <!-- Side widgets-->
          
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-3 bg-danger">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; FUNCOE <?php echo date("Y");?></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
