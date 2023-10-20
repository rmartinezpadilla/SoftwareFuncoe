<?php
session_start();

include('../fpdf/fpdf.php');
require('../funciones/connect.php');
require('../funciones/funciones.php');

if (isset($_POST['enviar'])) {
    # code...
    $programa = $_POST['id_programa'];    

}


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
			$this->Ln(8);          
            $this->SetFont('Times','B',14);          
            $this->Cell (0,5,utf8_decode('PENSUM'),'0','0','C');
            $this->Ln(12);
            
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
	$pdf->SetFont('Times','',12);
	// Movernos a la derecha
	$pdf->Cell(15);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(160,5,utf8_decode(nombrePrograma($programa)),1,1,'C');				
	// Movernos a la derecha
	$pdf->Cell(15);
	$pdf->SetFont('Times','B',10);    	
	$pdf->Cell(5, 8, '#', 1, 0 ,'C', 0);
    $pdf->Cell(134, 8, 'MODULO', 1, 0 ,'C', 0);
	$pdf->Cell(21, 8, utf8_decode('SEMESTRE'), 1, 1 ,'C', 0);    
    $sql = "SELECT * FROM modulo WHERE programa_id = $programa";
    $turnos = $mysqli->query($sql);        
                
            
                                                  
                if ($turnos->num_rows > 0) {
                    $contador = 1;  
	
                    while ($turno = $turnos->fetch_assoc()) 
                    
    {
            $nom_modulo=$turno['nombre_modulo'];
            $sem=$turno['semestre'];

            $pdf->SetFont('Helvetica','B', 8);
            // Movernos a la derecha
			$pdf->Cell(15);
            $pdf->Cell(5,5,$contador,1,0,'C');			
            $pdf->Cell(134,5,$nom_modulo,1,0,'C');	
            $pdf->Cell(21,5,utf8_decode($sem),1,1,'C');
			
            //$fill=!$fill;
			$contador++;
            
    }
                }
	
	$pdf->Output(utf8_decode("Módulos del programa.pdf"),'D');
?>