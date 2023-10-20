<?php
session_start();

include('../fpdf/fpdf.php');
require('../funciones/connect.php');
require('../funciones/funciones.php');


if (isset($_POST['enviar'])) {
    # code...
    $id_profe = $_POST['profe'];
    $fecha_inicio = $_POST['finicio'];
    $fecha_fin = $_POST['ffin'];
    $nombre_profe =  $_POST['nombreprofe']; 

}

    //validamos los campos
    if ($nombre_profe == "todos") {
        $sql = "SELECT  id_turno, modulo_id, cant_horas, FORMAT(sueldo, 0) AS moneda, fecha_registro, docente_id FROM turnos WHERE fecha_registro BETWEEN '$fecha_inicio' AND '$fecha_fin' order by fecha_registro";
        
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
        $this->Ln(8);          
        $this->SetFont('Times','B',12);          
        $this->Cell (0,5,utf8_decode('LISTADO DE TURNOS'),'0','1','C');
        $this->Cell (0,5,utf8_decode('FECHA: '. date("Y-m-d")),'0','0','C');                
        $this->Ln(5);
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
        $this->Cell(20);			
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

        // Creación del objeto de la clase heredada
	$pdf = new PDF('L', 'mm', 'A4');
    
    #Establecemos los márgenes izquierda, arriba y derecha:
    $pdf->SetMargins(10, 5 , 10); 
    #Establecemos el margen inferior:
    $pdf->SetAutoPageBreak(true,35);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);				
	// Movernos a la derecha	    
    $pdf->Ln();
	$pdf->SetFont('Times','B',11);    	
	$pdf->Cell(5, 8, '#', 1, 0 ,'C', 0);
    $pdf->Cell(90, 8, utf8_decode('MÓDULO'), 1, 0 ,'C', 0);
    $pdf->Cell(8, 8, 'HRS', 1, 0 ,'C', 0);    
    $pdf->Cell(17, 8, 'SUELDO', 1, 0 ,'C', 0);
    $pdf->Cell(17, 8, 'FECHA', 1, 0 ,'C', 0);
    $pdf->Cell(65, 8, utf8_decode('DOCENTE'), 1, 0 ,'C', 0);
    $pdf->Cell(50, 8, utf8_decode('FIRMA'), 1, 1 ,'C', 0);
	
    
    

    $turnos = $mysqli->query($sql);        
                
            
                                                  
                if ($turnos->num_rows > 0) {
                    $contador = 1;  
	
                    while ($turno = $turnos->fetch_assoc()) 
                    
    {
            $nom_modulo=nombreModulo($turno['modulo_id']);                        
            $horas = $turno['cant_horas'];
            $sueldo=$turno['moneda'];  
            $fecha=$turno['fecha_registro'];  
            $docente = nombreDocente($turno['docente_id']);

            $pdf->SetFont('Helvetica','B', 8);
            // Movernos a la derecha
			
            $pdf->Cell(5,5,$contador,1,0,'C');			
            $pdf->Cell(90,5,$nom_modulo,1,0,'C');	
            $pdf->Cell(8,5,$horas,1,0,'C');	
            $pdf->Cell(17,5,'$ '.$sueldo,1,0,'C');	
            $pdf->Cell(17,5,$fecha,1,0,'C');	
            $pdf->Cell(65,5,utf8_decode($docente),1,0,'C');            
            $pdf->Cell(50,5,'',1,1,'C');            
			
            //$fill=!$fill;
			$contador++;
            
    }
                }
	
	$pdf->Output(utf8_decode("Turnos.pdf"),'D');
     }else{
        $sql = "SELECT  id_turno, modulo_id, cant_horas, FORMAT(sueldo, 0) AS moneda, fecha_registro, docente_id FROM turnos WHERE docente_id = $id_profe  and fecha_registro between '$fecha_inicio' and '$fecha_fin' order by fecha_registro";


        

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
            $this->SetFont('Times','B',12);          
            $this->Cell (0,5,utf8_decode('LISTADO DE TURNOS'),'0','0','C');
            $this->Ln(7);
            
            
            
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
	$pdf = new PDF('P', 'mm', 'A4');
    #Establecemos los márgenes izquierda, arriba y derecha:
    $pdf->SetMargins(10, 5 , 10); 
    #Establecemos el margen inferior:
    $pdf->SetAutoPageBreak(true,35);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','B',11);
    // Movernos a la derecha
    $pdf->Cell(30); 
    // Movernos a la derecha	
    $pdf->Cell (38,5,'DOCENTE: '.utf8_decode(nombreDocente($id_profe)),'0','0','C');
    $pdf->Cell(50); 
    $pdf->Cell (38,5,' DESDE: '. $fecha_inicio ,'0','0','C');    
    $pdf->Cell (38,5,' HASTA: '. $fecha_fin,'0','0','C');
    $pdf->Ln(7);
    
    // Movernos a la derecha
	
	$pdf->SetFont('Times','B',11);    	
	$pdf->Cell(5, 8, '#', 1, 0 ,'C', 0);
    $pdf->Cell(140, 8, utf8_decode('MÓDULO'), 1, 0 ,'C', 0);
    $pdf->Cell(10, 8, 'HRS', 1, 0 ,'C', 0);    
    $pdf->Cell(20, 8, 'SUELDO', 1, 0 ,'C', 0);
    $pdf->Cell(20, 8, 'FECHA', 1, 1 ,'C', 0);
	
    
    

    $turnos = $mysqli->query($sql);        
                
            
                                                  
                if ($turnos->num_rows > 0) {
                    $contador = 1;  
	
                    while ($turno = $turnos->fetch_assoc()) 
                    
    {
            $nom_modulo=nombreModulo($turno['modulo_id']);                        
            $horas = $turno['cant_horas'];
            $sueldo=$turno['moneda'];  
            $fecha=$turno['fecha_registro'];  
            

            $pdf->SetFont('Helvetica','B', 8);
            // Movernos a la derecha
			
            $pdf->Cell(5,5,$contador,1,0,'C');			
            $pdf->Cell(140,5,$nom_modulo,1,0,'C');	
            $pdf->Cell(10,5,$horas,1,0,'C');	
            $pdf->Cell(20,5,'$ '.$sueldo,1,0,'C');	
            $pdf->Cell(20,5,$fecha,1,1,'C');	
            
			
            //$fill=!$fill;
			$contador++;
            
    }
                }
	
	$pdf->Output(utf8_decode("Turnos.pdf"),'D');
    }


    
?>
