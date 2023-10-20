<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesEstudiante.php');
require('../../funciones/FuncionesAsesores.php');
require('../../funciones/FuncionesDias.php');

    $errors = array();

    if (isset($_POST['enviar'])) {

    $ced_estudiante= $mysqli->real_escape_string($_POST['cedula']);    
        
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detalle Estudiante - <?php echo $_SESSION['user'];?></title>
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
                                <a href="../agregar/AgregarEstudiante.php" style="color:#FF0000;">Agregar Estudiante</a>
                                </div>
                                <div class="col">
                                <a href="./VerEstudiantes.php" style="color:#FF0000;">Volver</a>
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
                    <div class="card-body">


                    <?php 
                    
                    if (estudianteExiste($ced_estudiante)) {
                        
                        $sql = "SELECT * FROM estudiantes WHERE cedula = $ced_estudiante";
                
                        $resultado = $mysqli->query($sql);
                    ?>
                         <div class="table-responsive">   
                        <br>                                                     
                        <input class="form-control" id="myInput" type="text" placeholder="Filtrar..">                    
                       <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                
                                <th>CÉDULA</th>
                                <th>FECHA NACIMIENTO</th>
                                <th>NOMBRE Y APELLIDO</th>
                                <th>MUNICIPIO</th>
                                <th>DIRECCIÓN</th>
                                <th>CELULAR</th>
                                <th>GENERO</th>                                
                                <th>DIA</th>  
                                <th>JORNADA</th>                                
                                <th>REGISTRO NRO</th> 
                                <th>ASESOR</th>                                
                                <th>FECHA REGISTRO</th>                                
                                <th>EDITAR</th>
                                <th>IMPRIMIR</th>
                                                                                           
                            </tr>
                        </thead>
                    <tbody  id="myTable">
                    <?php 

                    if (isset($resultado)) {
                                                
                        if ($resultado->num_rows > 0) {
                            
                            while ($estudiante = $resultado->fetch_assoc()) {
                              
                            
                            ?>     
                             <tr>                                                   
                                
                                <td> <?php echo htmlspecialchars($estudiante['cedula']);?> </td>
                                <td> <?php echo htmlspecialchars($estudiante['fecha_nacimiento']);?> </td>
                                <td> <?php echo htmlspecialchars($estudiante['nombres'] . ' ' . $estudiante['apellidos']);?> </td>
                                <td> <?php echo htmlspecialchars($estudiante['municipio']);?> </td>
                                <td> <?php echo htmlspecialchars($estudiante['direccion']);?> </td>
                                <td> <?php echo htmlspecialchars($estudiante['celular']);?> </td>
                                <td> <?php echo htmlspecialchars($estudiante['genero']);?> </td> 
                                <td> <?php echo htmlspecialchars( nombreDia( $estudiante['dia_id']));?> </td>                               
                                <td> <?php echo htmlspecialchars($estudiante['jornada']);?> </td>
                                <td> <?php echo htmlspecialchars($estudiante['numero_registro']);?> </td>
                                <td> <?php echo htmlspecialchars( nombreAsesor( $estudiante['asesor_id']));?> </td>
                                <td> <?php echo htmlspecialchars($estudiante['fecha_registro']);?> </td>
                                
                                <td><a href="../edits/EditarEstudiante.php?id=<?php echo htmlspecialchars($estudiante['id_estudiante']); ?>"><button class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Editar</button></a></td>
                                <td><a href="../../reportes/ImprimirEstudiantes.php?id=<?php echo htmlspecialchars($estudiante['id_estudiante']); ?>"><button class="btn btn-success btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button></a></td>
                                    
                                </tr>
                                    <?php 
                                        }
                                    ?>
                            
                                
                            </tbody>
                            <?php 

							
                                    }else{
                                        $errors[] = "No hay ningúna MATRICULA.";
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
                            $errors[] = "ESTUDIANTE . '$ced_estudiante '.  NO EXISTE.";
                            
                            
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




