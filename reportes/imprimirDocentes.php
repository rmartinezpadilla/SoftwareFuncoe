<?php
session_start();

include('../fpdf/fpdf.php');
require('../funciones/connect.php');
require('../funciones/funciones.php');


//Creamos clase PDF que herada de FPDF
	class PDF extends FPDF
	{
		
		// Cabecera de página
		function Header()
		{
			// Logo
			$this->Image('../imagenes/logo_monteria.png',10,5,28);
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
			$this->Ln(12);          
            $this->SetFont('Times','B',14);          
            $this->Cell (0,5,'LISTADO DE DOCENTES REGISTRADOS EN EL SISTEMA','0','0','C');
            $this->Ln(6);
            $this->SetFont('Times','B',12);    
            $this->Cell(40, 8, utf8_decode('CÉDULA'), 1, 0 ,'C', 0);
            $this->Cell(70, 8, 'DOCENTE', 1, 0 ,'C', 0);
            $this->Cell(70, 8, utf8_decode('ÁREA'), 1, 1 ,'C', 0); 
		}
		
		// Pie de página
		function Footer()
		{
            // Arial italic 8			
            // Salto de línea
            $this->SetY(-34);            
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Contáctanos: www.funcoe.edu'),0,1,'C');
            $this->SetY(-31);            
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Dirección: Carrera 3 N° 21-45'),0,1,'C');
            $this->SetY(-28);        
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,'TEL: 7816885-3168776662',0,1,'C');
            $this->SetY(-25);                          
			// Movernos a la derecha
			$this->Cell(80);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Montería - Córdoba'),0,1,'C');
			// Posición: a 1,5 cm del final
			$this->SetY(-24);			
			// Número de página
			$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
	}
   


    // Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',10);

    $link = "SELECT * FROM docente";
    $turnos = $mysqli->query($link);        
                
            
                                                  
                if ($turnos->num_rows > 0) {
                    $contador = 1;  
                    while ($turno = $turnos->fetch_assoc()) 
                    
    {
            $cedula=$turno['cedula'];
            $nombre=$turno['nombre_comp_docente'];
            $area=nombrePrograma($turno['programa_id']);
            $pdf->SetFont('Helvetica','B', 8);
            $pdf->Cell(40,5,$cedula,1,0,'C');
            $pdf->Cell(70,5, utf8_decode( $nombre ),1,0,'C');
            $pdf->Cell(70,5,utf8_decode($area),1,1,'C');
            //$fill=!$fill;
            
    }
                }
	
	$pdf->Output("Listado de Docentes.pdf",'D');
?>