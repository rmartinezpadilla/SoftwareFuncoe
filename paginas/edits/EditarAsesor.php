<?php 
session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');

$errors = array();


$bandera = 0;

if (isset($_GET['id'])) {
    
    $mi_id= $mysqli->real_escape_string($_GET['id']);

    if (!empty($mi_id)) {
        
        $sql = "SELECT * FROM asesores WHERE id_asesor='$mi_id'";

        $resultado = $mysqli->query($sql);

        if ($resultado->num_rows > 0 ) {
            //si hay registros activamos la bandera y listamos los datos.
            $bandera = 1;
            $datos = $resultado->fetch_assoc();
        }else{

            $errors[]="NO ha ningun DOCENTE con ese ID";

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
        <title>Editar Asesor : FUNCOE</title>
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



                        <form action="ModificarAsesor.php" method="POST">
                        <h2 align="center" class="text-danger"> <strong>EDITAR ASESOR</strong></h2>
                        
                        <label for="" class="text-danger">Cédula:</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="number" placeholder="Número documento" autocomplete="off" name="cedula" class="form-control" value="<?php echo $datos['cedula'] ?>" required>
                                        </div>
                       
                        <label for="" class="text-danger">Nombre  Completo:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Nombre completo" autocomplete="off" name="nombre" class="form-control" value="<?php echo $datos['nombre_asesor'] ?>" required>
                                    </div>
    
                           
                                    <label for="" class="text-danger">Télefono:</label>
                                        <div class="input-group mb-1">                                    
                                            <!-- Input para el usuario -->
                                            <input type="number" placeholder="Número de Celular" autocomplete="off" name="telefono" class="form-control" value="<?php echo $datos['telefono'] ?>" required>
                                        </div>
                            
                            
                                    <div class="input-group mb-1">
                                    <!-- Input del botón para enviar el formulario -->
                                    <input type="hidden" name="mi_id" value="<?php echo $datos['id_asesor'] ?>">
                                    <input type="submit" class="form-control btn btn-danger" name="enviar" value="Actualizar">
                            </div>
                            <div >                            
                            <a href="../vistas/VerAsesores.php"><button type="button" class="btn btn-outline-danger">Cancelar</button></a>
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
