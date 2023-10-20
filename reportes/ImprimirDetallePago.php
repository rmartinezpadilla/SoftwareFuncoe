<?php

session_start();

include('../fpdf/fpdf.php');
require('../funciones/connect.php');
require('../funciones/funciones.php');
require('../funciones/FuncionesMatriculas.php');
require('../funciones/FuncionesEstudiante.php');
require('../funciones/FuncionesConceptos.php');


if (isset($_POST['enviar'])) {
 
    
    $id_matricula = $_POST['id_matricula'];

    $idestudiante = idEstudianteMatricula($id_matricula);
    $nombreestudiante = nombreEstudiante($idestudiante);
    $id_programa = idProgramaMatricula($id_matricula);
    $nombreprograma = nombrePrograma($id_programa);
    $semestre =semestreMatricula($id_matricula)    ;
    

//Creamos clase PDF que herada de FPDF
	class PDF extends FPDF
	{
		
        
		// Cabecera de página
		function Header()
		{
			// Logo
			$this->Image('../imagenes/logo_monteria.png',14,5,25);
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
            $this->Cell (0,5,'LISTADO DE PAGOS REGISTRADOS EN EL SISTEMA','0','0','C');    
            $this->Ln(6);
            $this->SetFont('Times','B',10);    
            $this->Cell(10, 5, utf8_decode('#'), 1, 0 ,'C', 0);
            $this->Cell(50, 5, utf8_decode('CÓDIGO PAGO'), 1, 0 ,'C', 0);            
            $this->Cell(55, 5, 'CONCEPTO', 1, 0 ,'C', 0);
            $this->Cell(25, 5, utf8_decode('VALOR'), 1, 0 ,'C', 0); 
            $this->Cell(25, 5, utf8_decode('FECHA'), 1, 1 ,'C', 0); 
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
   
    $link = "SELECT *, FORMAT(valor, 0) AS valor2 FROM pagos WHERE matricula_id = $id_matricula";  	
       $turnos = $mysqli->query($link);     
            $contador = 1;
               if ($turnos->num_rows > 0) {
                   $contador = 1;  
                   $totalabonado = 0;
                   while ($pago = $turnos->fetch_assoc()) 
                   
   {
                $codigo=$pago['id_pago'];
                $matricula_id=$pago['matricula_id'];
                $concepto=$pago['concepto_id'];
                $nombreconcepto = nombreConcepto($concepto);
                $valor=$pago['valor2'];
                $fecha=$pago['fecha_pago'];
                $pdf->SetFont('Helvetica','B', 8);
                $pdf->Cell(10,5,$contador,1,0,'C');
                $pdf->Cell(50,5,$codigo,1,0,'C');                
                $pdf->Cell(55,5,utf8_decode($nombreconcepto),1,0,'C');
                $pdf->Cell(25,5,utf8_decode($valor),1,0,'C');
                $pdf->Cell(25,5,utf8_decode($fecha),1,1,'C');

                $contador++;
               
                $totalabonado = $totalabonado + $pago['valor'];
           
   }
   // Salto de línea
   $pdf->SetFont('Helvetica','B', 8);
   $pdf->Cell(75,5,'TOTAL: ',0,0,'C');
   $pdf->Cell(58,5,number_format($totalabonado),'B',1,'R',0);
   $pdf->Ln(2);
   $pdf->Cell(150, 5, 'Estudiante: ' . utf8_decode( $nombreestudiante . ' Programa: ' . $nombreprograma . ' Semestre: ' . $semestre),0,1, 'C');   
  
               }  				
   $pdf->Output("Constancia_de_pagos $nombreestudiante.pdf",'D');
   
    
            }
?>
   

            