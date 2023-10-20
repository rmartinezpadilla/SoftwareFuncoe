<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesProgramas.php');

$errors= array();

if (isset($_POST['enviar'])) {
    $programa = strtoupper($_POST['programa']);
    $semestre = strtoupper($_POST['semestre']);
    $nroclases = strtoupper($_POST['nroclases']);
    $valor = strtoupper($_POST['valor']);
    

   
  
                
                    if (!programaExisteConValor($programa, $semestre)) {
                        //si el usuario existe nos devolverá true, si no, false

                        //echo "usuario no existe.";
                            
                                //echo $hash;

                                if (guardarProgramaConValor($programa, $semestre, $nroclases, $valor)) {
                                    $resultado = "El PROGRAMA le fué asignado un valor correctamente";
                                    sleep(1);
                                    header('Location:../vistas/VerProgramas.php');
                                }else{
                                    $errors[] ="Hubo un error al registrar el PROGRAMA.";
                                }
                    }else{
                        //echo "El usuario ya existe.";
                        $errors[]="El PROGRAMA ya tiene valor.";
                        
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
        <title>Asignar Valor Programa : FUNCOE</title>
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
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerMatriculas.php" >Pagos y Matriculas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerTurnos.php">Turnos</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerProgramas.php">Programas</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerDocentes.php" >Docentes</a></li>                     
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerEstudiantes.php">Estudiantes</a></li>                        
                        <li class="nav-item"><a class="nav-link active" href="../vistas/VerAsesores.php">Asesores</a></li>
                       <li class="nav-item"><a class="nav-link active" style="color:#fffb00;" aria-current="page" href="../../funciones/logout.php">¿Cerrar Sesión?</a></li>
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
                        
                        <?php 

                            if (isset($resultado)) {
                                ?>

                                <div class="bg-success text-white p-2 mx-5 text-center">
                                    
                                    <?php echo strtoupper($resultado); ?>
                                </div>
                                <?php 
                            }
                            include('../../funciones/errores.php');
                            ?> 
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h2 align="center" class="text-danger"> <strong>  FORMULARIO REGISTRO VALORES PROGRAMA</strong></h2>
                        
                       
                        <label for="" class="text-danger">Programa:</label>
                                    <?php
                                    /* consulta SELECT */
                                    $resultado = $mysqli->query("SELECT id_programa, nombre_programa FROM programa ORDER by id_programa DESC");
                                        /* recorrer los resultados  */                                       
                                    ?>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <select class="form-select" aria-label="Default select example" name="programa" id="">
                                        <?php  while ( $fila = $resultado->fetch_assoc() ) {
                                            
                                        ?>
                                            <option  value="<?php echo $fila['id_programa'];?>"><?php echo $fila['nombre_programa'];?></option>
                                        <?php
                                        
                                        }
                                                                        
                                    ?>
                                        </select>
                                        </div>
    

                                    <label for="" class="text-danger">Semestre:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        
                                                <select name="semestre" class="form-control">
                                                <option value="1">1</option>  
                                                <option value="2">2</option>                                                
                                                <option value="3">3</option>
                                                </select>
                                                
                                    </div>
                                    <label for="" class="text-danger">Cantidad de clases:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        
                                                <select name="nroclases" class="form-control">
                                                <option value="24">24</option>  
                                                <option value="28">28</option>                                                
                                                <option value="16">16</option>
                                                </select>
                                                
                                    </div>

                                    <label for="" class="text-danger">valor ($):</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="number" placeholder="valor" autocomplete="off" name="valor" class="form-control" required>
                                        </div>
                            
                                    <div class="input-group mb-1">   
                                    <!-- Input del botón para enviar el formulario -->
                                    <input type="submit" class="form-control btn btn-danger" name="enviar" value="Guardar">
                                    </div>
                            <div class="input-group mb-1">                         
                            <a href="../Principal.php"><button type="button" class="btn btn-outline-danger">Cancelar</button></a>
                            </div>
                   
                </form>
                            
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