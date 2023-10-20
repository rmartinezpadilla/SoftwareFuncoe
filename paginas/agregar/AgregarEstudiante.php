<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/FuncionesEstudiante.php');
require('../../funciones/FuncionesAsesores.php');

$errors= array();

if (isset($_POST['enviar'])) {
    $cedula = trim($_POST['cedula']);
    $f_nacimiento = trim($_POST['fecha_nacimineto']);
    $nombres = trim($_POST['nombres']); 
    $apellidos = trim($_POST['apellidos']);    
    $direccion = trim($_POST['direccion']); 
    $municipio = trim($_POST['municipio']);
    $celular = trim($_POST['cel']);
    $genero = trim($_POST['gen']);
    $recomendacion = trim($_POST['recomendacion']);
    $medio = trim($_POST['mediopublicitario']);
    $dia = trim($_POST['dia']);
    $jornada = trim($_POST['jornada']);
    $nro_registro = trim($_POST['registronro']);
    $asesor = trim($_POST['asesor']);
                          
                    
                    if (!estudianteExiste($cedula)) {
                        //si el usuario existe nos devolverá true, si no, false

                        //echo "usuario no existe.";
                            
                                //echo $hash;

                                if (registrarEstudiante($cedula, $f_nacimiento, $nombres, $apellidos, $direccion, $municipio, $celular, 
                                $genero, $recomendacion, $medio, $dia, $jornada, $nro_registro, $asesor)) {
                                    $resultado = "El ESTUDIANTE fué registrado correctamente";
                                    sleep(1);
			                        header('Location:../vistas/VerEstudiantes.php');
                                }else{
                                    $errors[] ="Hubo un error al registrar el Estudiante.";
                                }
                    }else{
                        //echo "El usuario ya existe.";
                        $errors[]="El ESTUDIANTE ya existe.";
                        
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
        <title>Registrar Estudiante : FUNCOE</title>
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
                        <h2 align="center" class="text-danger"> <strong>  FORMULARIO REGISTRO ESTUDIANTE</strong></h2>
                        
                        <label for="" class="text-danger">Cédula:</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="number" placeholder="Número documento" autocomplete="off" name="cedula" class="form-control" required>
                                        </div>

                                        
                                        
                        <label for="" class="text-danger">Fecha Nacimiento:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="date" id="" name="fecha_nacimineto" value="<?php echo date('Y-m-d') ; ?>" required>
                                    </div>
                                        

                        <label for="" class="text-danger">Nombres:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Nombre completo" autocomplete="off" name="nombres" class="form-control" required>
                                    </div>
    
                                    <label for="" class="text-danger">Apellidos:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Apellidos" autocomplete="off" name="apellidos" class="form-control" required>
                                    </div>

                                    <label for="" class="text-danger">Municipio:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Municipio" autocomplete="off" name="municipio" class="form-control" required>
                                    </div>
                            
                                    <label for="" class="text-danger">Dirección:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Dirección" autocomplete="off" name="direccion" class="form-control" required>
                                    </div>

                                    <label for="" class="text-danger">Celular:</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="number" placeholder="Número de celular" autocomplete="off" name="cel" class="form-control" required>
                                        </div>

                            <label for="" class="text-danger">Género:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        
                                                <select name="gen" class="form-control">
                                                <option value="MASCULINO">Maculino</option>  
                                                <option value="FEMENINO">Femenino</option>                                                
                                                <option value="NO DEFINE">No define</option>
                                                </select>
                                                
                                    </div>

                                    <label for="" class="text-danger">Recomendación:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        
                                                <select name="recomendacion" class="form-control">
                                                <option value="Ninguno">Ninguno</option>  
                                                <option value="Asesor">Asesor</option>                                                
                                                <option value="Egresado">Egresado</option>
                                                <option value="Alumno Actual">Alumno Actual</option>
                                                <option value="Familiar Amigo">Familiar, Amigo</option>
                                                </select>
                                                
                                    </div>

                                    <label for="" class="text-danger">Medio Publicitario:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        
                                                <select name="mediopublicitario" class="form-control">
                                                <option value="Visita Barrios">Visita Barrios</option>  
                                                <option value="Facebook">Facebook</option>                                                
                                                <option value="Instagram">Instagram</option>
                                                <option value="Presentación Colegio">Presentación Colegio</option>
                                                <option value="Ninguno">Ninguno</option>
                                                </select>
                                                
                                    </div>

                                    <label for="" class="text-danger">Día:</label>
                                    <?php
                                    /* consulta SELECT */
                                    $resultado = $mysqli->query("SELECT id_dia, nombre FROM dias ORDER by id_dia ASC");
                                        /* recorrer los resultados  */                                       
                                    ?>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <select class="form-select" aria-label="Default select example" name="dia" id="">
                                        <?php  while ( $fila = $resultado->fetch_assoc() ) {
                                            
                                        ?>
                                            <option  value="<?php echo $fila['id_dia'];?>"><?php echo $fila['nombre'];?></option>
                                        <?php
                                        
                                        }
                                                                        
                                    ?>
                                        </select>
                                        </div>

                                    <label for="" class="text-danger">Jornada:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        
                                                <select name="jornada" class="form-control">
                                                <option value="mañana">Mañana</option>  
                                                <option value="tarde">Tarde</option>                                                
                                                <option value="noche">Noche</option>
                                                </select>
                                                
                                    </div>

                                    <label for="" class="text-danger">Número de Registro:</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="text" placeholder="Número registro" autocomplete="off" name="registronro" class="form-control" required>
                                        </div>

                                    <label for="" class="text-danger">Asesor:</label>
                                    <?php
                                    /* consulta SELECT */
                                    $resultado = $mysqli->query("SELECT id_asesor, nombre_asesor FROM asesores ORDER by id_asesor DESC");
                                        /* recorrer los resultados  */                                       
                                    ?>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <select class="form-select" aria-label="Default select example" name="asesor" id="">
                                        <?php  while ( $fila = $resultado->fetch_assoc() ) {
                                            
                                        ?>
                                            <option  value="<?php echo $fila['id_asesor'];?>"><?php echo $fila['nombre_asesor'];?></option>
                                        <?php
                                        
                                        }
                                                                        
                                    ?>
                                        </select>
                                        </div>
                            
                            
                                    <div class="input-group mb-1">
                                    <!-- Input del botón para enviar el formulario -->
                                    <input type="submit" class="form-control btn btn-danger" name="enviar" value="Guardar">
                            </div>
                            <div >                            
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

