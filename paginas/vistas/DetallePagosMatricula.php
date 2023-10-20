<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesEstudiante.php');
require('../../funciones/FuncionesMatriculas.php');
require('../../funciones/FuncionesConceptos.php');

    $errors = array();

    if (isset($_POST['enviar'])) {

    $id_matricula= $mysqli->real_escape_string($_POST['idmatricula']);
    $id_estudiante = idEstudianteMatricula($id_matricula);
    $nombre_estudiante = nombreEstudiante($id_estudiante);
    $ced_estudiante = cedulaEstudiante($id_estudiante);
    $id_programa = idProgramaMatricula($id_matricula);
    $nombreprograma = nombrePrograma($id_programa);
    $semestre =semestreMatricula($id_matricula);
    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detalle Pagos - <?php echo $_SESSION['user'];?></title>
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
                                <a href="../agregar/AgregarMatricula.php" style="color:#FF0000;">Agregar Matricula</a>
                                </div>
                                <div class="col">
                                <a href="./ConsultarPagos.php" style="color:#FF0000;">Volver</a>
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
                       
                    <!-- <a href="../../reportes/imprimirPrograma.php">Generar PDF</a> -->
                    <div class="card-body">
                    <div class="row justify-content-md-center text-center">
                                <div class="col">
                                <p>ESTUDIANTE</p>
                                <p><strong> <?php echo $nombre_estudiante;?></strong></p>
                                </div>
                                <div class="col">
                                <p>ESTUDIANTE</p>
                                <p><strong> <?php echo $nombreprograma;?></strong></p>
                                </div>
                                <div class="col">
                                <p>SEMESTRE</p>
                                <p><strong> <?php echo $semestre;?></strong></p>
                                </div>
                                
                            </div>
                        
                       
                    <?php 
                    
                    if (estudianteExiste($ced_estudiante)) {
                        
                        
                        $sql = "SELECT * ,  FORMAT(valor, 0) AS valor2 FROM pagos WHERE matricula_id = $id_matricula";
                
                        $resultado = $mysqli->query($sql);
                    ?>
                    
                         <div class="table-responsive">                                                        
                        <input class="form-control" id="myInput" type="text" placeholder="Filtrar..">  
                                            <form action="../../reportes/imprimirDetallePago.php" method="POST">
                                            <br>
                                            <input type="hidden" name="id_matricula" value="<?php  echo $id_matricula; ?>">                                                                                                        
                                            <button type="submit" class="btn btn-danger" name="enviar">Generar PDF</button>
                                            
                                        </form>  
                                        <br>             
                        <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>                                
                                <th>#</th>
                                <th>CÓDIGO PAGO</th>
                                <th>CÓDIGO MATRICULA</th>
                                <th>CONCEPTO</th>
                                <th>VALOR</th>                                
                                <th>FECHA</th>
                                <th>EDITAR</th>
                                
                                                                                           
                            </tr>
                        </thead>
                    <tbody  id="myTable">
                    <?php 

                    if (isset($resultado)) {
                                                
                        if ($resultado->num_rows > 0) {
                            $contador=1;
                            while ($pago = $resultado->fetch_assoc()) {
                              
                            
                            ?>     
                             <tr>                                                   
                                <td> <?php echo htmlspecialchars($contador);?> </td>                                                     
                                <td> <?php echo htmlspecialchars($pago['id_pago']);?> </td>
                                <td> <?php echo htmlspecialchars($pago['matricula_id']);?> </td>
                                <td> <?php echo htmlspecialchars(nombreConcepto( $pago['concepto_id']));?> </td>
                                <td> <?php echo htmlspecialchars($pago['valor2']);?> </td>                            
                                <td> <?php echo htmlspecialchars($pago['fecha_pago']);?> </td>                                
                                <td><a href="../edits/EditarMatricula.php?id=<?php echo htmlspecialchars($pago['id_pago']); ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</button></a></td>    
                                
                                    
                                </tr>
                                    <?php 
                                    $contador++;
                                        }
                                    ?>
                            
                                
                            </tbody>
                            <?php 

                                    }else{
                                        $errors[] = "No hay ningún PAGO realizado.";
                                    }
                                    }else{

                                    $errors[]= "Hubo error en la consulta";
                                    
                                    }

                                    include('../../funciones/errores.php');
                                    ?>
                        </table>

                       </div> 
                      
                       <?php 
                        }else{
                            $errors[] = "NO EXISTE LA MATRICULA";                                                        
                        }
                    }

                    include('../../funciones/errores.php');
                    
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




