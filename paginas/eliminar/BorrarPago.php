<?php 
session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesProgramas.php');
require('../../funciones/FuncionesPensum.php');
require('../../funciones/FuncionesConceptos.php');
require('../../funciones/FuncionesPagos.php');
require('../../funciones/FuncionesMatriculas.php');

$errors = array();

if (isset($_GET['id'])) {
		  
    
    $id_pago =$mysqli->real_escape_string($_GET['id']);
    $id_concepto = idConceptoPago($id_pago);
    $id_matricula = idMatriculaEnPago($id_pago);    
    $saldo_a_favor = saldoFavorMatricula($id_matricula);
    $pendiente = pendienteMatricula($id_matricula);
    $cuota_anterior = valorPago($id_pago);

    if (empty($id_pago)) {
        
        $errors[]="El ID  esta vacio";

    }else{


        if ($id_concepto == 18) {
            actualizarPendiente($id_matricula, ($cuota_anterior *(-1)));
            actualizarSaldoAFavor($id_matricula, $saldo_a_favor -  $cuota_anterior); 
            actualizarNroCuota($id_matricula, -1);
        }

        $sql = "DELETE FROM pagos WHERE id_pago= $id_pago";

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
        <title>Ediar Pago - <?php echo $_SESSION['user'];?></title>
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
            <a class="navbar-brand" href="#">Usuario: <?php echo $_SESSION['user'];?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                     <!-- <li class="nav-item"><a class="nav-link active" href="./agregarTurno.php" >Agregar turno</a></li> -->
                        <li class="nav-item"><a class="nav-link active" href="../Principal.php">Inicio</a>
                        <li class="nav-item"><a class="nav-link active" href="./VerPagos.php">Pagos</a></li>
                        <li class="nav-item"><a class="nav-link active "  style="color:#fffb00;" aria-current="page" href="../../funciones/logout.php">¿Cerrar Sesión?</a></li>
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
                                
                             
                                
                            </div>
        </header>
        <!-- Page content-->
        <div class="container">
        <div class="row">

            <div class="row">
                
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        
                       <!-- <a href="#!"><img class="card-img-top" src="" alt="..." /></a>-->
                        <div class="card-body"> 

                        <?php 
                                                        include  ('../../funciones/errores.php');
                                                        //veificamos que haya sido definida
                                                            if (isset($resultado)) {
                                                                //verificamos si la variable fue true
                                                                if ($resultado) {
                                                                
                                                                    ?>
                                                                    <div class="alert alert-warning alert-dismissable">                                    
                                                                    <strong>Pago!:  <?php echo $id_pago;?></strong>  Eliminado Correctamente. <br>
                                                                   
                                                                    
                                                                    </div>
                                                                    <?php
                                                                    
                                                                            }
                                                                        }

                                                                    ?>

                        </div>
                       
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