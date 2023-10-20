<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/FuncionesAsesores.php');
require('../../funciones/FuncionesPagos.php');
require('../../funciones/FuncionesConceptos.php');
require('../../funciones/FuncionesMatriculas.php');

$errors= array();

if (isset($_POST['enviar'])) {

    $id_matricula = trim($_POST['idmatricula']); 
    $id_concepto = trim($_POST['concepto']);  
   
    //este es el valor que va a pagar el usuario  
    $valor = trim($_POST['valor']); 

    $nombreconcepto = nombreConcepto($id_concepto);
    
    //comprobamos si tiene saldo a favor y lo guardamos en esta variable
    $saldo_a_favor= saldoFavorMatricula($id_matricula);
   
   //verificamos si tiene pendiente de clases
    $pendiente = pendienteMatricula($id_matricula);
    
    $valor_x_cuotas =valorCuotasMatricula($id_matricula);
    
  

    if ($nombreconcepto == "Clase") {

        
        if ($pendiente > 0 && $pendiente>= $valor) {


            //obtenemos el saldo a favor
            $a_favor = $valor - ($valor_x_cuotas + ($saldo_a_favor * (-1)));                                  
            

            if (registrarPago($id_matricula, $id_concepto, $valor)) {            
                if (actualizarPendiente($id_matricula, $valor)){
                    $resultado = "PAGO DE CLASE REGISTRADO CORRECTAMENTE"; 
                    actualizarNroCuota($id_matricula);
                    actualizarSaldoAFavor($id_matricula, $a_favor);
                }
              
            }else{
                $errors[]= "Hubo un error al guardar el pago";
            }
           
        }else{
            $errors[]= "No tienes pendientes por clase o tu saldo es menor a tu depósito.";
        }
        ?>

        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="" />
                <meta name="author" content="" />
                <title>Pagos : FUNCOE</title>
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
                            <li class="nav-item"><a class="nav-link active" href="../Principal.php">Inicio</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" href="registrarme.php">Registrarme</a></li> -->
                               <li class="nav-item"><a class="nav-link active" href="../vistas/VerMatriculas.php">Matriculas</a></li>
                               <li class="nav-item"><a class="nav-link active" style="color:#fffb00;" aria-current="page" href="../../funciones/logout.php">¿Cerrar Sesión?</a></li>
                                <!-- <li class="nav-item"><a class="nav-link " aria-current="page" href="#">¿Quienes somos?</a></li> -->
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
        
        
                                <div class="alert alert-success text-center">
                                        <div class="col">
                                            <h4>
                                        <?php 
        
                                        if (isset($resultado)) {
                                        
                                            
                                            ?>   
                                            <div class="row justify-content-md-center text-center ">
                                        
                                        <div class="col">
                                        <a href="../../reportes/ImprimirPago.php"><button class="btn btn-primary" name="enviar">Imprimir Recibo</button></a>
                                        </div>
                                        <div class="col">
                                        <a href="../vistas/VerMatriculas.php"><button class="btn btn-primary" name="enviar">Volver</button></a>
                                        </div>
                                        
                                    </div>
                                                
                                            <?php echo strtoupper($resultado);
                                            }
                                             ?>
                                           
                                            </h4>
                                        </div>
                                        
                                    </div>
        
                                        
                                        
                                        <?php 
                                    
                                        
                                    
                                    include('../../funciones/errores.php');
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
        
        
<?php        
    }else{
        
        if (registrarPago($id_matricula, $id_concepto, $valor)) {
            $resultado = "PAGO DE OTRO CONCEPTO REGISTRADO CORRECTAMENTE";
            ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pagos : FUNCOE</title>
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
                    <li class="nav-item"><a class="nav-link active" href="../Principal.php">Inicio</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="registrarme.php">Registrarme</a></li> -->
                       <li class="nav-item"><a class="nav-link active" href="../vistas/VerMatriculas.php">Matriculas</a></li>
                       <li class="nav-item"><a class="nav-link active" style="color:#fffb00;" aria-current="page" href="../../funciones/logout.php">¿Cerrar Sesión?</a></li>
                        <!-- <li class="nav-item"><a class="nav-link " aria-current="page" href="#">¿Quienes somos?</a></li> -->
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


                        <div class="alert alert-success text-center">
                                <div class="col">
                                    <h4>
                                <?php 

                                if (isset($resultado)) {
                                
                                    
                                    ?>   
                                    <div class="row justify-content-md-center text-center ">
                                
                                <div class="col">
                                <a href="../../reportes/ImprimirPagoOtroConcepto.php"><button class="btn btn-primary" name="enviar">Imprimir Recibo</button></a>
                                </div>
                                <div class="col">
                                <a href="../vistas/VerMatriculas.php"><button class="btn btn-primary" name="enviar">Volver</button></a>
                                </div>
                                
                            </div>
                                        
                                    <?php echo strtoupper($resultado);
                                    }
                                     ?>
                                   
                                    </h4>
                                </div>
                                
                            </div>

                                
                                
                                <?php 
                            
                                
                            
                            include('../../funciones/errores.php');
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


<?php
            
        }
    }
    
    
}
