<?php 
session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');
require('../../funciones/FuncionesProgramas.php');
require('../../funciones/FuncionesPensum.php');

$errors = array();


$bandera = 0;

if (isset($_GET['id'])) {
    
    $mi_id= $mysqli->real_escape_string($_GET['id']);
    $id_programa =  idProgramaPensum($mi_id);
    $id_semestre = idSemestrePensum($mi_id);
    $nombreprograma =nombrePrograma($id_programa);

    if (!empty($mi_id)) {
        
        $sql = "SELECT * FROM pensum WHERE id_pensum='$mi_id'";

        $resultado = $mysqli->query($sql);

        if ($resultado->num_rows > 0 ) {
            //si hay registros activamos la bandera y listamos los datos.
            $bandera = 1;
            $datos = $resultado->fetch_assoc();
        }else{

            $errors[]="NO ha ningun PROGRAMA con ese ID";

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
        <title>Detalle Matricula - <?php echo $_SESSION['user'];?></title>
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
        <div class="row justify-content-md-center text-center">
                                <div class="col">
                                <a>Bienvenido <strong><?php echo  mensajeBienvenida(); ?></strong></a>
                                </div>
                                <div class="col">
                                <a href="../agregar/AgregarPrograma.php" style="color:#FF0000;">Agregar Programa</a>
                                </div>
                                <div class="col">
                                <a href="../vistas/VerProgramas.php" style="color:#FF0000;">Volver</a>
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
					

						if (count($errors) > 0 ) {
							echo "<div class='error'>";
							foreach($errors as $error){
								echo "<i class='fas fa-exclamation-circle'></i>" .$error."<br>";
							}
							echo "</div>";
						}
						

						if ($bandera == 1) {
							// code...
						


					 ?>

                            <form action="ModificarValorPrograma.php"  method="POST" >
                            <h2 align="center" class="text-danger"><strong>EDITAR PROGRAMA</strong></h2>
                            
                            <label for="" class="text-danger">Nombre  del progama:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        <input type="text" placeholder="Programa" autocomplete="off" name="nombre" class="form-control" value="<?php echo $nombreprograma; ?>" required disabled>
                                    </div>

                            <label for="" class="text-danger">Semestre:</label>
                                    <div class="input-group mb-1">                                    
                                        <!-- Input para el usuario -->
                                        
                                                <select name="semestre" class="form-control" disabled>
                                                    <?php if ($id_semestre == 1) {?>
                                                        <option value="1">1</option>
                                                        <?php
                                                    }?>
                                                  <?php if ($id_semestre == 2) {?>
                                                        <option value="2">2</option>  
                                                        <?php
                                                    }?>
                                                       <?php if ($id_semestre == 3) {?>
                                                        <option value="3">3</option>
                                                        <?php
                                                    }?>                                       
                                                
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
                                            <input type="number" placeholder="valor" autocomplete="off" name="valor" class="form-control"  required>
                                        </div>
								
                                <div class="input-group mb-1">                         
                                <input type="hidden" name="mi_id" value="<?php echo $datos['id_pensum'] ?>">
                                <input type="submit" class="form-control btn btn-danger" name="enviar" value="Actualizar">

                            </div>

                            <div >                            
                            <a href="../vistas/VerProgramas.php"><button type="button" class="btn btn-outline-danger">Cancelar</button></a>
                            </div>
							</form>

						</div>
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