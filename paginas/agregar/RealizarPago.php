<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesEstudiante.php');
require('../../funciones/FuncionesMatriculas.php');



    $errors = array();


    if (isset($_GET['id'])) {
        //obtengo el identificador de la matricula    
    $id_matricula= $mysqli->real_escape_string($_GET['id']);
    //obtengo el id del estudiante en dicha matricula
    $id_estudiante =idEstudianteMatricula($id_matricula);
    //obtengo el nombre del estudiante con el metodo en su clase
    $nombre_estudiante = nombreEstudiante($id_estudiante);
    $semestre = semestreMatricula($id_matricula);
    $id_programa= idProgramaMatricula($id_matricula);
    $nombre_programa = nombrePrograma($id_programa);
    $valorcuota = valorCuotasMatricula($id_matricula);
    $saldo_a_favor = saldoFavorMatricula($id_matricula);
    $pendiente = pendienteMatricula($id_matricula);

   
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detalle Pago - <?php echo $_SESSION['user'];?></title>
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

                        include('../../funciones/errores.php');                                              
                            
                        ?>
                    <!-- <a href="../../reportes/imprimirPrograma.php">Generar PDF</a> -->
                                       
                    <div class="row justify-content-md-center text-center">
                    <h2 align="center" class="text-danger"> <strong>  PAGOS </strong></h2>
                                <div class="col">
                                <p>ESTUDIANTE: </p>
                                <p><STROng> <?php echo $nombre_estudiante;?> </STROng></p>
                                </div>
                                <div class="col">
                                <p>PROGRAMA: </p>
                                <p></p><STROng> <?php echo $nombre_programa;?> </STROng></p>
                                </div>
                                <div class="col">
                                <p>SEMESTRE: </p>
                                <p><STROng> <?php echo $semestre;?> </STROng></p>
                                </div>
                                <div class="col">
                                <p>PENDIENTE (SEMESTRE)</p>
                                <p><STROng> <?php echo number_format($pendiente, 0, '.', ',');?> </STROng></p>
                                </div>
                                <div class="col">
                                <p>VALOR CLASE <?php echo numeroCuotaClase($id_matricula) + 1  ; ?>: </p>
                                <p><STROng> <?php echo number_format($valorcuota, 0, '.', ',');?> </STROng></p>
                                </div>
                                <div class="col">
                                <p>ABONO A CLASE: <?php echo numeroCuotaClase($id_matricula) + 1 ; ?> </p>
                                <p><STROng> <?php echo number_format( $saldo_a_favor, 0, '.', ',');?> </STROng></p>
                                </div>
                                <div class="col">
                                <p>TOTAL A PAGAR CLASE: 
                                    <?php 
                                echo numeroCuotaClase($id_matricula) + 1 ; ?> 
                                </p>
                                <?php 
                                
                                if ($saldo_a_favor > 0 && $saldo_a_favor > $valorcuota) { ?>
                                    <p><STROng> <?php echo "$ 0";?> </STROng></p>
                                <?php 
                                }else{
                                    ?>

                                    <p><STROng> <?php echo number_format($valorcuota - $saldo_a_favor, 0, '.', ',');?> </STROng></p>
                                    </div>
                                    <?php
                                }

                                ?>
                                
                                
                            </div>

                        <form action="FinalizarPago.php" method="POST">
                        <label for="" class="text-danger">CONCEPTO:</label>
                                    <?php
                                    /* consulta SELECT */
                                    $resultado = $mysqli->query("SELECT id_concepto, nombre_concepto FROM conceptos ORDER by id_concepto ASC");
                                        /* recorrer los resultados  */                                       
                                    ?>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <select class="form-select" aria-label="Default select example" name="concepto" id="">
                                        <?php  while ( $fila = $resultado->fetch_assoc() ) {
                                            
                                        ?>
                                            <option  value="<?php echo $fila['id_concepto'];?>"><?php echo $fila['nombre_concepto'];?></option>
                                        <?php
                                        
                                        }
                                                                        
                                    ?>
                                        </select>
                                        </div>

                                        <label for="" class="text-danger">VALOR ($):</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="number" placeholder="valor" autocomplete="off" name="valor" class="form-control" min="0" pattern="^[0-9]+" required>
                                        </div>
                                        <div class="input-group mb-1">                                    
                                       
                                        </div>
                                        
                                    <div class="input-group mb-1">
                                    <input id="" name="idmatricula" type="hidden" value="<?php echo $id_matricula;?>">
                                    <input type="submit" class="form-control btn btn-danger" name="enviar" value="Guardar">
                            </div>
                            <div >                            
                            <a onclick="window.history.back()"><button type="button" class="btn btn-outline-danger">Cancelar</button></a>
                            </div>
                </form>
                       
                      
                
                    <?php
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



