<?php
session_start();

include('../fpdf/fpdf.php');
require('../funciones/connect.php');
require('../funciones/funciones.php');
require('../funciones/FuncionesEstudiante.php');
require('../funciones/FuncionesAsesores.php');
require('../funciones/FuncionesDias.php');
		

	if (isset($_GET['id'])) {
 
    
	$id_estudiante = $_GET['id'];
	

//Creamos clase PDF que herada de FPDF
	class PDF extends FPDF
	{
		
		// Cabecera de página
		function Header()
		{
			// Logo
			$this->Image('../imagenes/logo_monteria.png',40,5,28);
			// Arial bold 15
			$this->SetFont('Times','B',20);
			// Movernos a la derecha
			$this->Cell(130);
			// Título
			$this->Cell(30,5,utf8_decode('FUNDACIÓN COLOMBIA ESTUDIA'),0,0,'C');
			// Salto de línea
            $this->Ln(4);   
            $this->SetFont('Times','BI',8);
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,'Creciendo sin limites...',0,0,'C');
			// Salto de línea
            $this->Ln(3);   
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,'FUNCOE',0,0,'C');
			// Salto de línea
            $this->Ln(3);   
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,'NIT: 900028762-0',0,0,'C');
			// Salto de línea
            $this->Ln(3);   
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Según Resolución N° 4729 y Registro de Programa N° 0516 de 2018'),0,0,'C');
			// Salto de línea
            $this->Ln(3);   
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Secretaria de Educación Municipal'),0,0,'C');
			// Salto de línea
			$this->Ln(12);          
            $this->SetFont('Times','B',14);          
            $this->Cell (0,5,'DATOS DE ESTUDIANTE','0','0','C');
            $this->Ln(6);
            
		}
		
		// Pie de página
		function Footer()
		{
            // Arial italic 8			
            // Salto de línea
            $this->SetY(-34);            
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Contáctanos: www.funcoe.edu'),0,1,'C');
            $this->SetY(-31);            
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Dirección: Carrera 3 N° 21-45'),0,1,'C');
            $this->SetY(-28);        
            $this->SetFont('Times','B',10);
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,'TEL: 7816885-3168776662',0,1,'C');
            $this->SetY(-25);                          
			// Movernos a la derecha
			$this->Cell(130);
			// Subtitulo
			$this->Cell(30,5,utf8_decode('Montería - Córdoba'),0,1,'C');
			// Posición: a 1,5 cm del final

			$this->SetY(-24);	
			$this->Cell(130);					
			// Número de página
			$this->Cell(35,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
	}
   
	$pdf = new PDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',10);
	$pdf->Ln(8);     

    $link = "SELECT * FROM estudiantes WHERE id_estudiante = $id_estudiante";
    $turnos = $mysqli->query($link);        
                
            
                                                  
                if ($turnos->num_rows > 0) {
                    $contador = 1;  
                    while ($turno = $turnos->fetch_assoc()) 
                    
    {
            $cedula=$turno['cedula'];
            $fecha_nacimiento =$turno['fecha_nacimiento'];
			$nombres=$turno['nombres'];
            $apellidos=$turno['apellidos'];
			$municipio=$turno['municipio'];
			$direccion=$turno['direccion'];
			$celular=$turno['celular'];
			$genero=$turno['genero'];
			$dia_id=$turno['dia_id'];
			$fecha_registro=$turno['fecha_registro'];
			$jornada=$turno['jornada'];
			$numero_registro=$turno['numero_registro'];
			$asesor_id=$turno['asesor_id'];			
            $pdf->SetFont('Helvetica','B', 11);
			$pdf->Cell(30);

			$pdf->Cell(50, 5, utf8_decode('CÉDULA'), 1, 0 ,'C', 0);
			$pdf->Cell(150,5,$cedula,1,1,'C');
			$pdf->Cell(30);
			$pdf->Cell(50, 5, utf8_decode( 'FECHA NACIMIENTO'), 1, 0 ,'C', 0);
			$pdf->Cell(150,5, utf8_decode( $fecha_nacimiento ),1,1,'C');
			$pdf->Cell(30);
            $pdf->Cell(50, 5,  utf8_decode('NOMBRES'), 1, 0 ,'C', 0);
			$pdf->Cell(150,5, utf8_decode( $nombres ),1,1,'C');
			$pdf->Cell(30);
            $pdf->Cell(50, 5, utf8_decode( 'APELLIDOS'), 1, 0 ,'C', 0);
			$pdf->Cell(150,5,utf8_decode($apellidos),1,1,'C');
			$pdf->Cell(30);
            $pdf->Cell(50, 5,  utf8_decode('MUNICIPIO'), 1, 0 ,'C', 0);
			$pdf->Cell(150,5,utf8_decode($municipio),1,1,'C');
			$pdf->Cell(30);
            $pdf->Cell(50, 5,  utf8_decode('DIRECCIÓN'), 1, 0,'C', 0);
            $pdf->Cell(150,5,utf8_decode($direccion),1,1,'C');
			$pdf->Cell(30);
			$pdf->Cell(50, 5,  utf8_decode('CELULAR'), 1, 0 ,'C', 0);
			$pdf->Cell(150,5,utf8_decode($celular),1,1,'C');	
			$pdf->Cell(30);
            $pdf->Cell(50, 5,  utf8_decode('GÉNERO'), 1, 0 ,'C', 0);            
			$pdf->Cell(150,5,utf8_decode($genero),1,1,'C');
			$pdf->Cell(30);
			$pdf->Cell(50, 5, utf8_decode( 'DIA'), 1, 0 ,'C', 0);      
			$pdf->Cell(150,5,utf8_decode( nombreDia( $dia_id)),1,1,'C');
			$pdf->Cell(30);
			$pdf->Cell(50, 5,  utf8_decode('FECHA REGISTRO'), 1, 0 ,'C', 0);      
			$pdf->Cell(150,5,utf8_decode($fecha_registro),1,1,'C');
			$pdf->Cell(30);
			$pdf->Cell(50, 5,  utf8_decode('JORNADA'), 1, 0 ,'C', 0);      
			$pdf->Cell(150,5,utf8_decode($jornada),1,1,'C');			
			$pdf->Cell(30);
			$pdf->Cell(50, 5,  utf8_decode('NRO REGISTRO'), 1, 0 ,'C', 0);      
			$pdf->Cell(150,5,utf8_decode($numero_registro),1,1,'C');
			$pdf->Cell(30);
            $pdf->Cell(50, 5, utf8_decode('ASESOR'), 1, 0 ,'C', 0); 
			$pdf->Cell(150,5,utf8_decode(nombreAsesor( $asesor_id)),1,1,'C');
            //$fill=!$fill;
            
            
    }
                }
	
	$pdf->Output("Estudiante $nombres $apellidos.pdf",'D');

}
?>