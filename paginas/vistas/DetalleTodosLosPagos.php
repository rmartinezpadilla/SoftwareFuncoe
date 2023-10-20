<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesConceptos.php');
require('../../funciones/FuncionesPagos.php');
require('../../funciones/FuncionesMatriculas.php');

    if (!isset($_SESSION['user'])) {
    // si o existe la session de user, significa que no esta logueado

    header('Location:../index.php');
    }

    $errors = array();
    
if (isset($_POST['consultar'])) {
        
        $concepto = $_POST['concepto'];
        $fecha_inicio = $_POST['fechainicio'];
        $fecha_fin = $_POST['fechafin']; 
         
        
     if ($concepto == 19) {
         
        $sql = "SELECT  id_pago, matricula_id, concepto_id, FORMAT(valor, 0) AS valor2, fecha_pago FROM pagos WHERE fecha_pago BETWEEN '$fecha_inicio' AND '$fecha_fin' order by id_pago";
        
     }else{
       
        $sql = "SELECT  id_pago, matricula_id, concepto_id, FORMAT(valor, 0) AS valor2, fecha_pago FROM pagos WHERE concepto_id = $concepto and fecha_pago between '$fecha_inicio' and '$fecha_fin' order by id_pago";
    }     
    
	$turnos = $mysqli->query($sql);

    // Otra consulta
 
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Turnos Registrados - <?php echo $_SESSION['user'];?></title>
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
                    <li class="nav-item"><a class="nav-link active" href="../Principal.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link active" href="./VerMatriculas.php" >Pagos y Matriculas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="./VerTurnos.php">Turnos</a></li>
                        <li class="nav-item"><a class="nav-link active" href="./VerProgramas.php">Programas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="./VerDocentes.php" >Docentes</a></li>                     
                        <li class="nav-item"><a class="nav-link active" href="./VerEstudiantes.php">Estudiantes</a></li>                        
                        <li class="nav-item"><a class="nav-link active" href="./VerAsesores.php">Asesores</a></li>
                       <li class="nav-item"><a class="nav-link active" style="color:#fffb00;" aria-current="page" href="../../funciones/logout.php">¿Cerrar Sesión?</a></li>
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
                                        <p class="card-text"> <a href="../vistas/VerMatriculas.php"style="color:#FF0000;">Agregar Pago</a></p>
                                        </div>
                                        <div class="col">
                                        <a href="../vistas/VerPagos.php"style="color:#FF0000;">Volver</a>
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
                           
                            
                                        <div class="table-responsive">                         
                                        <!-- <form action="../../reportes/imprimirTurnos.php" method="POST">
                                        <input type="hidden" name="profe" value="<?php  echo $id_docente; ?>">      
                                        <input type="hidden" name="finicio" value="<?php  echo $fecha_inicio; ?>">                                
                                        <input type="hidden" name="ffin" value="<?php echo $fecha_fin; ?>">                                
                                        <input type="hidden" name="nombreprofe" value="<?php echo $profe; ?>">   
                                        <button type="submit" class="btn btn-danger" name="enviar">Generar PDF</button>
                                        </form> -->
                    <p></p>
                        <input class="form-control" id="myInput" type="text" placeholder="Filtrar..">   
                        <br>                 
                       <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>         
                                <th>#</th>
                                <th>CÓDIGO PAGO</th>
                                <!-- <th>MODULO</th> -->
                                <th>MATRICULA</th>
                                <th>CONCEPTO</th>
                                <th>ESTUDIANTE</th>  
                                <th>PROGRAMA</th>                              
                                <th>VALOR</th>
                                <th>FECHA</th>
                                <th>EDITAR</th>
                                <!-- <th>NOMBRE DOCENTE</th> -->
                                
                            </tr>
                        </thead>
                    <tbody  id="myTable">
                    <?php 

                    if (isset($turnos)) {
                                              
                        if ($turnos->num_rows > 0) {
                            $contador = 1; 
                            $totalrecibido=0; 
                            while ($turno = $turnos->fetch_assoc()) {                                                          
                            ?>                                
                            <tr>                                                                                   
                                <td> <?php echo htmlspecialchars($contador);?> </td>  
                                <!-- /* este es otro sql para obtener los datos de los demás*/ -->                              
                                <td> <?php echo htmlspecialchars($turno['id_pago']);?> </td>
                                <td> <?php echo htmlspecialchars($turno['matricula_id']);?> </td>
                                <td> <?php echo htmlspecialchars(nombreConcepto( $turno['concepto_id']));?> </td>
                                <td> <?php echo htmlspecialchars(nombreEstudiante(idEstudianteMatricula( $turno['matricula_id'])));?> </td>
                                <td> <?php echo htmlspecialchars(NombrePrograma(programaMatricula( $turno['matricula_id'])));?> </td>                                
                                <td> <?php echo htmlspecialchars($turno['valor2']);?> </td>
                                <td> <?php echo htmlspecialchars($turno['fecha_pago']);?> </td>
                                <td><a href="../edits/EditarPago.php?id=<?php echo htmlspecialchars($turno['id_pago']); ?>"><button class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Editar</button></a></td>
                                <!--<td><a href="DetallePrograma.php?id=<?php echo htmlspecialchars($turno['id_programa']); ?>"><button class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver Módulos</button></a></td>  -->
                                    
                            </tr>
                                    <?php 
                                       $contador++;
                                       $totalrecibido =$totalrecibido +  valorPago($turno['id_pago']) ;
                                    }
                                }
                    
                                
                                    ?>
                            
                                
                            </tbody>
                            <?php 

                            }
                
                                    else{
                                        $errors[] = "No hay ningún PAGO registrado.";                                        
                                    }
}                                
                                    
                                    ?>
                        </table>

                       </div>
                       <div class="alert alert-success text-center">
                           <?php if(isset($totalrecibido)){ ?>

                           
                                 <p>Total recibido desde <?php echo$fecha_inicio ?> hasta <?php echo $fecha_fin?> </p><h4> <?php echo  number_format($totalrecibido, 0, '.', ',') ; ?></h4>                  
                                 <?php 
                                 }else{
                                     ?>
                                     <div class="alert alert-warning text-center">
                                     <p>No he hecho ningún recaudo.</p>
                                     </div>
                                     <?php
                                 }?>
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
