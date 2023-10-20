<?php
session_start();

include('../fpdf/fpdf.php');
require('../funciones/connect.php');
require('../funciones/funciones.php');
require('../funciones/FuncionesAsesores.php');
require('../funciones/FuncionesPagos.php');
require('../funciones/FuncionesConceptos.php');
require('../funciones/FuncionesMatriculas.php');

if (isset($_GET['id'])) {
    
    $mi_id = $_GET['id'];

//Creamos clase PDF que herada de FPDF
	class PDF extends FPDF
	{
		
        
		// Cabecera de página
		function Header()
		{
			// Logo
			$this->Image('../imagenes/logo_monteria.png',22,5,25);
			// Arial bold 15
			$this->SetFont('Times','B',20);
			// Movernos a la derecha
			$this->Cell(80);
			// Título
			$this->Cell(30,5,utf8_decode('FUNDACIÓN COLOMBIA ESTUDIA'),0,0,'C');
			// Salto de línea
            $this->Ln(4);   
            $this->SetFont('Times','BI',8);
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,'Creciendo sin limites...',0,0,'C');
			// Salto de línea
            $this->Ln(3);   
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,'FUNCOE',0,0,'C');
			// Salto de línea
            $this->Ln(3);   
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,'NIT: 900028762-0',0,0,'C');
			// Salto de línea
            $this->Ln(3);   
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Según Resolución N° 4729 y Registro de Programa N° 0516 de 2018'),0,0,'C');
			// Salto de línea
            $this->Ln(3);   
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Secretaria de Educación Municipal'),0,0,'C');
			// Salto de línea
			$this->Ln(8);                
			// Salto de línea                       	
			// Movernos a la derecha
			$this->Cell(80);          
            $this->SetFont('Times','B',14);          
            $this->Cell (30,5,'CONSTANCIA DE PAGO','0','0','C');
            $this->Ln(7);
		}
		
		// Pie de página
		function Footer()
		{
          
			// Posición: a 1,5 cm del final
			$this->SetY(-24);			
			// Número de página
			$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}

    }
    
    $pdf = new PDF();
    #Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(15, 5 , 15);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,25);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',11);
    

    $link = "SELECT *, FORMAT(valor, 0) AS valor2 FROM pagos WHERE id_pago = $mi_id";  	
       $turnos = $mysqli->query($link);     
            
               if ($turnos->num_rows > 0) {
                   $contador = 1;  
                   while ($turno = $turnos->fetch_assoc()) 
                   
   {
           $id_pago=$turno['id_pago'];
           $id_matricula=$turno['matricula_id'];
           $id_programa = idProgramaMatricula($id_matricula);
           $idestudiante = idEstudianteMatricula($id_matricula);
           $nombreestudiante = nombreEstudiante($idestudiante);
           $cedula_estudiante =cedulaEstudiante($idestudiante);
           $semestre = semestreMatricula($id_matricula);
           $pendientematricula = pendienteConFormatoMatricula($id_matricula);
           $id_concepto = $turno['concepto_id'];
           $nombreprograma = nombrePrograma($id_programa);
           $nombreconcepto= nombreConcepto($id_concepto);
           $valor=$turno['valor2'];  
           $saldo_a_favor = saldoFavorMatricula($id_matricula);
           $fecha=$turno['fecha_pago'];
           
           $clasenro = numeroCuotaClase($id_matricula);

           $pdf->SetFont('Helvetica','B', 8);
           // Movernos a la derecha
           $pdf->Cell(8);
           $pdf->Cell(22, 5, 'Recibo Nro.', 1, 0 ,'C', 0);
           $pdf->Cell(150,5,$id_pago,1,1,'C'); 
           $pdf->Cell(8);
           $pdf->Cell(22, 5, 'Programa:', 1, 0 ,'C', 0);
           $pdf->Cell(150,5, utf8_decode( $nombreprograma ),1,1,'C');       
           $pdf->Cell(8);        
           $pdf->Cell(22, 5, 'Semestre:', 1, 0 ,'C', 0);
           $pdf->Cell(150,5, utf8_decode( $semestre),1,1,'C');
           $pdf->Cell(8);
           $pdf->Cell(22, 5, utf8_decode('Cédula:'), 1, 0 ,'C', 0);
           $pdf->Cell(150,5, utf8_decode( $cedula_estudiante),1,1,'C');
           $pdf->Cell(8);
           $pdf->Cell(22, 5, 'Estudiante:', 1, 0 ,'C', 0);
           $pdf->Cell(150,5, utf8_decode( $nombreestudiante),1,1,'C');
           $pdf->Cell(8);
           
           $pdf->Cell(22, 5, 'Matricula #:', 1, 0 ,'C', 0);           
           $pdf->Cell(150,5, utf8_decode( $id_matricula ),1,1,'C');
           $pdf->Cell(8);
           $pdf->Cell(22, 5, 'Concepto', 1, 0 ,'C', 0);
           $pdf->Cell(150,5, utf8_decode( $nombreconcepto) . ' ' . $clasenro ,1,1,'C');
           $pdf->Cell(8);
           $pdf->Cell(22, 5, utf8_decode('Valor'), 1, 0 ,'C', 0);
           $pdf->Cell(150,5, '$ '.$valor,1,1,'C');           
           $pdf->Cell(8);
           $pdf->Cell(22, 5, utf8_decode('Abono Clases'), 1, 0 ,'C', 0);
         
           $pdf->Cell(150,5, '$ '.number_format($saldo_a_favor) . ' Clase ' . ($clasenro+1) ,1,1,'C'); 
           $pdf->Cell(8);
           $pdf->Cell(22, 5, utf8_decode('Fecha'), 1, 0 ,'C', 0);
           $pdf->Cell(150,5,$fecha,1,1,'C');
           $pdf->Cell(8);
           $pdf->Cell(22, 5, utf8_decode('Pendiente'), 1, 0 ,'C', 0);
           $pdf->Cell(150,5, $pendientematricula . ' (Clases)',1,1,'C');
           
   }
               }  				
   $pdf->Output("Pago $id_pago.pdf",'D');
   
    
            }
?>