<?php 

session_start();

require('../../funciones/connect.php');
require('../../funciones/funciones.php');

$errors[] = array();

    if (!isset($_SESSION['user'])) {
    // si o existe la session de user, significa que no esta logueado

    header('Location:../index.php');
}

if (isset($_POST['enviar'])) { 
    
    $id_user = selccionIdUser();


    $modulo = trim($_POST['modulo']);
    $horas = trim($_POST['horas']);
    /* $sueldo = trim($_POST['sueldo']); */
    $sueldo = $horas * 12000;

    if (registraTruno($modulo, $horas, $sueldo, $id_user)) {
        $resultado = "turno registrado satisfactoriamente";
    }else{
        $errors[] = "error al registrar";
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
        <title>Agregar - FUNCOE</title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="../imagenes/ico.jpg" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <!-- Bootstrap icons -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
            />
        
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
            <a class="navbar-brand" href="index.php">Usuario: <?php echo $_SESSION['user'];?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                     <li class="nav-item"><a class="nav-link active" href="inicio.php" >Inicio</a></li>
                       <li class="nav-item"><a class="nav-link" href="agregarTurno.php">Agregar turno</a></li>
                        <!--<li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>  -->
                        <li class="nav-item"><a class="nav-link " aria-current="page" href="../funciones/logout.php">¿Cerrar Sesión?</a></li>
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
                        
                       <!--  <h4>Estás logueado como: <?php echo  $_SESSION['user'];?> </h4> -->
                       
                       <?php 

                            if (isset($resultado)) {
                                ?>

                                <div class="bg-success text-white p-2 mx-5 text-center">
                                    
                                    <?php 
                                    
                                     echo strtoupper($resultado); 
                                     /* sleep(2); */
                                     echo "<script>
                                             alert('Registrado Correctamente')
                                                window.location='inicio.php'
                                            </script>";
                                    ?>
                                    
                                </div>
                                <?php 
                            }
                         /*    include('../funciones/errores.php'); */
                                        
                                      
                                        
                            ?> 
                      
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <!-- <h2 align="center">FORMULARIO DE REGISTRO</h2> -->
                        <h2>Agregar Turno</h2>
                        <label for="" class="text-primary">Nombre del Módulo:</label>
                                        <div class="input-group mb-5">                                    
                                            <!-- Input para el usuario -->
                                            <select name="modulo" class="form-control">
                                                <option value="TECNICA DE OFICINA Y SERVICIO AL CLIENTE">TECNICA DE OFICINA Y SERVICIO AL CLIENTE</option>  
                                                <option value="ADMINISTRACION GERENCIAL">ADMINISTRACION GERENCIAL</option>                                                
                                                <option value="SISTEMAS (WORD PARA SECRETARIADO)">SISTEMAS (WORD PARA SECRETARIADO)</option>  
                                                <option value="GRAMATICA Y ORTOGRAFIA">GRAMATICA Y ORTOGRAFIA</option>
						                        <option value="EMPRENDIMIENTO">EMPRENDIMIENTO</option>  
                                                <option value="SISTEMAS (EXCEL PARA SECRETARIADO)">SISTEMAS (EXCEL PARA SECRETARIADO)</option>                                                
                                                <option value="CONTABILIDAD BASICA Y FUNDAMENTOS CONTABLES">CONTABILIDAD BASICA Y FUNDAMENTOS CONTABLES</option>  
                                                <option value="DERECHO LABORAL">DERECHO LABORAL</option>
						                        <option value="REDACCION Y CORRESPONDENCIA">REDACCION Y CORRESPONDENCIA</option>  
                                                <option value="CONTABILIDAD PARA SECRETARIADO">CONTABILIDAD PARA SECRETARIADO</option>                                                
                                                <option value="MATEMATICA FINANCIERA">MATEMATICA FINANCIERA</option>  
                                                <option value="INGLES">INGLES</option>
						                        <option value="ARCHIVO">ARCHIVO </option>  
                                                <option value="RELACIONES INTERPERSONALES Y VALORES">RELACIONES INTERPERSONALES Y VALORES</option>                                                
                                                <option value="LENGUAJE EXPRESIVO">LENGUAJE EXPRESIVO</option>  
                                                <option value="GLAMOUR ETIQUETA Y PROTOCOLO">GLAMOUR ETIQUETA Y PROTOCOLO</option>						                                               
                                            </select>
                                        </div>
                       
                        <label for="" class="text-primary">Horas:</label>
                                    <div class="input-group mb-5">                                    
                                        <!-- Input para el usuario -->
                                        <select name="horas" class="form-control">
                                                <option value="3">3</option>  
                                                <option value="4">4</option>                                                
                                                <option value="5">5</option>  
                                                <option value="6">6</option>                                                
                                                </select>
                                    </div>
    
                           <!--  <label for="" class="text-primary">Sueldo:</label>
                                    <div class="input-group mb-5">   -->                                  
                                        <!-- Input para el usuario -->
                                       <!--  <input type="number" placeholder="Sueldo" autocomplete="off" name="sueldo" class="form-control" required>
                                    </div> -->
                           
                            <div class="row">
                                    <!-- Input del botón para enviar el formulario -->
                                    
                                    <a href=""> <input type="submit" class="form-control btn btn-primary" name="enviar" value="Guardar"></a>
                                    <p></p>
                                   <a href="inicio.php"> <input type="button" class="form-control btn btn-danger" value="Cancelar" ></a>
                            </div>
                   
                </form>
                            
                        
                            
                        </div>
                    </div>
                  
                  
                </div>
                <!-- Side widgets-->
          
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-3 bg-primary">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; FUNCOE <?php echo date("Y");?></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
