<?php 
session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');

$errors = array();


$bandera = 0;

if (isset($_GET['id'])) {
    
    $mi_id= $mysqli->real_escape_string($_GET['id']);

    if (!empty($mi_id)) {
        
        $sql = "SELECT * FROM estudiantes WHERE id_estudiante='$mi_id'";

        $resultado = $mysqli->query($sql);

        if ($resultado->num_rows > 0 ) {
            //si hay registros activamos la bandera y listamos los datos.
            $bandera = 1;
            $datos = $resultado->fetch_assoc();
        }else{

            $errors[]="NO ha ningun ESTUDIAANTE con ese ID";

        }
    }else{

        $errors[]="Id esta vacio";
    }

}else{
    $errors[]="No estas enviando ningun ID";
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Editar Estudiante : FUNCOE</title>
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


                        if (count($errors) > 0 ) {
                            echo "<div class='error'>";
                            foreach($errors as $error){
                                echo "<i class='fas fa-exclamation-circle'></i>" .$error."<br>";
                            }
                            echo "</div>";
                        }

                        if ($bandera == 1) {
                         
                        ?>

                    <form action="ModificarEstudiante.php" method="POST">
                        <h2 align="center" class="text-danger"> <strong>  EDITAR ESTUDIANTE</strong></h2>
                        
                        <label for="" class="text-danger">Cédula:</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="number" placeholder="Número documento" autocomplete="off" name="cedula" class="form-control" value="<?php echo $datos['cedula']; ?>"  required>
                                        </div>

                                                                                
                        <label for="" class="text-danger">Fecha Nacimiento:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="date" id="" name="fecha_nacimineto" value="<?php echo $datos['fecha_nacimiento']; ?>" required>
                                    </div>
                                        

                        <label for="" class="text-danger">Nombres:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Nombre completo" autocomplete="off" name="nombres" class="form-control" value="<?php echo $datos['nombres']; ?>"  required>
                                    </div>
    
                                    <label for="" class="text-danger">Apellidos:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Apellidos" autocomplete="off" name="apellidos" class="form-control" value="<?php echo $datos['apellidos']; ?>"  required>
                                    </div>

                                    <label for="" class="text-danger">Municipio:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Municipio" autocomplete="off" name="municipio" class="form-control" value="<?php echo $datos['municipio']; ?>"  required>
                                    </div>
                            
                                    <label for="" class="text-danger">Dirección:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Dirección" autocomplete="off" name="direccion" class="form-control" value="<?php echo $datos['direccion']; ?>"  required>
                                    </div>

                                    <label for="" class="text-danger">Celular:</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="number" placeholder="Número de celular" autocomplete="off" name="cel" class="form-control" value="<?php echo $datos['celular']; ?>" required>
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
                                            <input type="text" placeholder="Número registro" autocomplete="off" name="registronro" class="form-control" value="<?php echo $datos['numero_registro']; ?>"  required>
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
                                    <input type="hidden" name="mi_id" value="<?php echo $datos['id_estudiante'] ?>">
                                    <input type="submit" class="form-control btn btn-danger" name="enviar" value="Actualizar">
                            </div>
                            <div >                            
                            <a href="../vistas/VerEstudiantes.php"><button type="button" class="btn btn-outline-danger">Cancelar</button></a>
                            </div>
                </form>






    
                </div>
                <?php 
                                        }
                                ?>
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

