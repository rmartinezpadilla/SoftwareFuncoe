<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesConceptos.php');
require('../../funciones/FuncionesPagos.php');
require('../../funciones/FuncionesMatriculas.php');
$errors = array();

if (isset($_POST['enviar'])) {
    


    $mi_id =  $mysqli->real_escape_string($_POST['id_pago']);

    //valor envido
    $valor = trim($_POST['valor']);   
    $id_concepto  = trim($_POST['id_concepto']); 
    $id_matricula = idMatriculaEnPago($mi_id);
    $valor_cuota = valorCuotasMatricula($id_matricula);
    $saldo_a_favor = saldoFavorMatricula($id_matricula);
    $pendiente = pendienteMatricula($id_matricula);
    $cuota_anterior = valorPago($mi_id);

                    if ($id_concepto == 18) {

                 
          
                    $diferencia_de_cuotas = $valor - $cuota_anterior;                                     
                        
                        if ($diferencia_de_cuotas > 0 && ($diferencia_de_cuotas > $pendiente )) {
                            
                            
                            $errors[] ="El valor de la cuota superó el al saldo pendiente";

                        }else{

                            
                            actualizarPendiente($id_matricula, $diferencia_de_cuotas);

                            actualizarSaldoAFavor($id_matricula, ($diferencia_de_cuotas+$saldo_a_favor));

                            $sql = "UPDATE pagos SET valor='$valor' WHERE id_pago='$mi_id'";
                            $resultado = $mysqli->query($sql);
                            $conceptoclase=1;


                        }


                    }else{
                        $sql = "UPDATE pagos SET valor='$valor' WHERE id_pago='$mi_id'";
                        $otroconcepto =1;

                            $resultado = $mysqli->query($sql);
                    }
    
    
    

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
        <title>Detalle Matricula - <?php echo $_SESSION['user'];?></title>
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
                                <a href="../vistas/DetallePagos.php?id=<?php echo $id_matricula;?>" style="color:#FF0000;">Volver</a>
                                
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
                                                                    <strong>Pago!:  <?php echo $mi_id;?></strong>  Actualizado Correctamente. <br>

                                                                    <?php 
                                                                    
                                                                        if (isset($otroconcepto)) {
                                                                           
                                                                       

                                                                    ?>

                                                                    

                                                                    <strong>Concepto!:  <?php echo  nombreConcepto($id_concepto);?></strong>  Actualizado Correctamente. <br>
                                                                    <a href="../../reportes/ImprimirPagoPorIDOtroConcepto.php?id=<?php echo $mi_id ?>"><button class="btn btn-primary" name="enviar">Imprimir Recibo</button></a>
                                                                    <?php
                                                                            }
                                                                    ?>




                                                        <?php 
                                                                    
                                                                        if (isset($conceptoclase)) {
                                                                           
                                                                       

                                                                    ?>

                                                                    

                                                                    <strong>Concepto!:  <?php echo  nombreConcepto($id_concepto);?></strong>  Actualizado Correctamente. <br>
                                                                    <a href="../../reportes/ImprimirPagoPorIDClase.php?id=<?php echo $mi_id ?>"><button class="btn btn-primary" name="enviar">Imprimir Recibo</button></a>
                                                                    <?php
                                                                            }
                                                                    ?>
                                                                    </div>
                                                                    <?php
                                                                    
                                                                            }
                                                                        }

                                                                    ?>
                                                        </div>
                            

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
