<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');


    if (!isset($_SESSION['user'])) {
    // si o existe la session de user, significa que no esta logueado

    header('Location:../index.php');
}

    $errors = array();
        $usuario = selccionIdUser();
        
	 $sql = "SELECT * FROM docente";

	$resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Docentes Registrados - <?php echo $_SESSION['user'];?></title>
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
            <a class="navbar-brand" href="index.php">Usuario: <?php echo $_SESSION['user'];?></a>
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
        <div class="row justify-content-md-center  text-center">
                                <div class="col">
                                <a>Bienvenido <strong><?php echo  mensajeBienvenida(); ?></strong></a>
                                </div>
                                <div class="col">
                                <p class="card-text"> <a href="../agregar/AgregarDocente.php"style="color:#FF0000;">Agregar Docente</a></strong></p>
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
                        <div class="card-body mb-2">
                           
                      <div class="table-responsive">                         
                      <a href="../../reportes/imprimirDocentes.php"><button class="btn btn-danger" name="enviar">Generar PDF</button></a>
                       <p></p>                               
                        <input class="form-control" id="myInput" type="text" placeholder="Filtrar..">                    
                       <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th> 
                                <th>CÉDULA</th>
                                <th>NOMBRE COMPLETO</th>
                                <th>PROGRAMA</th>
                                <th>USUARIO</th>
                                <th>FECHA REGISTRO</th>
                                <!-- <th>ULTIMA CONEXIÓN</th> -->                                
                                <th>EDITAR</th>
                               <!--  <th>TURNO</th> -->
                                
                            </tr>
                        </thead>
                        <tbody  id="myTable">
                    <?php 

                    if ($resultado) {
                                                
                        if ($resultado->num_rows > 0) {
                            $contador = 1;
                            while ($turno = $resultado->fetch_assoc()) {
                              
                            
                            ?>     
                             <tr>                           
                        
                                <td> <?php echo htmlspecialchars ($contador);?> </td> 
                                <td> <?php echo htmlspecialchars($turno['cedula']);?> </td>
                                <td> <?php echo htmlspecialchars($turno['nombre_comp_docente']);?> </td>
                                <td> <?php echo htmlspecialchars(nombrePrograma($turno['programa_id']));?> </td>
                                <td> <?php echo htmlspecialchars($turno['usuario']);?> </td>
                                <td> <?php echo htmlspecialchars($turno['fecha_registro']);?> </td>                                    
                                <!-- <td> <?php echo htmlspecialchars($turno['ultima_conexion']);?> </td> -->
                                
                                <td><a href="../edits/EditarDocente.php?id=<?php echo htmlspecialchars($turno['id_docente']); ?>"><button class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Editar</button></a></td>
                                <!-- <td><a href="AddTurno.php?id=<?php echo htmlspecialchars($turno['id_docente']); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Turno</button></a></td>  -->
                                    
                                </tr>
                                    <?php 
                                       $contador++; }
                                    ?>
                            
                                
                            </tbody>
                            <?php 

							
                                    }else{
                                        $errors[] = "No hay ningún DOCENTE registrado.";
                                    }
                                    }else{

                                    $errors[]= "Hubo error en la consulta";
                                    }

                                    include('../../funciones/errores.php');
                                    ?>
                        </table>
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