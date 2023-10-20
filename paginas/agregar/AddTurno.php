<?php 
	
    session_start();
    require('../../funciones/connect.php');
    require('../../funciones/funciones.php');
    
    
if (!isset($_SESSION['user'])) {
        // si o existe la session de user, significa que no esta logueado
    
        header('Location:../index.php');
}

$errors= array();

if (isset($_POST['enviar'])) {
    # code...
    
    $horas = $_POST['horas'];
    $docente = $_POST['docente'];
    $id_modulo = $_POST['modulo_id'];
    $id_docente = idDocente($docente);    

/* echo "<pre>";
var_dump($_POST);
echo "</pre>"; */

     if (guardarTurno($id_modulo, $horas, $id_docente)) {
                    $resultado = "El TURNO fué registrado correctamente";
                }else{
                    $errors[] ="Hubo un error al registrar el TURNO.";
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
        <title>AGREGAR TURNO - FUNCOE</title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="../../imagenes/ico.jpg" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        
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
                        <h2 align="center" class="text-danger"> <strong>  FORMULARIO REGISTRO TURNOS</strong></h2>
                        
                        <label for="" class="text-danger">Programa:</label>
                                    <?php
                                    /* consulta SELECT */
                                    if ($resultado = $mysqli->query("SELECT id_programa, nombre_programa FROM programa ORDER by id_programa DESC")) {
                                        /* recorrer los resultados  */                                       
                                    ?>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <select class="form-select" aria-label="Default select example" name="lista1" id="lista1">
                                        <?php  while ( $fila = $resultado->fetch_assoc() ) {
                                            
                                        ?>
                                            <option  value="<?php echo $fila['id_programa'];?>"><?php echo $fila['nombre_programa'];?></option>
                                        <?php
                                        
                                        }
                                    }                                    
                                    ?>
                                        </select>
                                        </div>
                                       

                                        <div>
                                        <label for="" class="text-danger">Módulo:</label> 
                                            <select class="form-select" aria-label="Default select example"  name="modulo_id" id="select2lista"></select>
                                        </div>                                   
                                    
                                    <label for="" class="text-danger">Nombre  del docente:</label>
                                    <?php
                                    /* consulta SELECT */
                                    if ($resultado = $mysqli->query("SELECT nombre_comp_docente FROM docente ORDER by id_docente DESC")) {
                                        /* recorrer los resultados  */                                       
                                    ?>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <select class="form-select" aria-label="Default select example" name="docente">
                                        <?php  while ( $fila = $resultado->fetch_assoc() ) {
                                            
                                        ?>
                                            <option  value="<?php echo $fila['nombre_comp_docente'];?>"><?php echo $fila['nombre_comp_docente'];?></option>
                                        <?php
                                        
                                        }

                                    } 
                                   
                                    ?>
                                        </select>
                                        </div>
                                        <label for="" class="text-danger">Horas:</label>                                                                      
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <select name="horas" class="form-control">
                                                <option value="3">3</option>  
                                                <option value="4">4</option>                                                
                                                <option value="5">5</option>  
                                                <option value="6">6</option>                                                
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
          

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#lista1').val(1);
                        recargarLista();

                        $('#lista1').change(function(){
                            recargarLista();
                        });
                    })
                </script>
                <script type="text/javascript">
                    function recargarLista(){
                        $.ajax({
                            type:"POST",
                            url:"DatosPrograma.php",
                            data:"continente=" + $('#lista1').val(),
                            success:function(r){
                                $('#select2lista').html(r);
                            }
                        });
                    }
                </script>



            </div>
        </div>
     <?php 
     /* por medio de este include llamo al footer que se va a usar en los agregar*/
        include ('../../templates/footeradd.php');
    
     ?>