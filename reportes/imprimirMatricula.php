<?php
session_start();

include('../fpdf/fpdf.php');
require('../funciones/connect.php');
require('../funciones/funciones.php');
require('../funciones/FuncionesMatriculas.php');
require('../funciones/FuncionesEstudiante.php');


if (isset($_GET['id'])) {
 
    
                $id_matricula = $_GET['id'];
                $valor = valorMatricula($id_matricula);
                $cuotas = cuotasMatricula($id_matricula);
                $valorxcuotas = valorCuotasMatricula($id_matricula);
                $programa = idProgramaMatricula($id_matricula);                                
                $nombreprograma = nombrePrograma($programa);
                $id_estudiante = idEstudianteMatricula($id_matricula); 
                $nombreestudiante = nombreEstudiante($id_estudiante);
                $semestre = semestreMatricula($id_matricula);
                $fecha = fechaMatricula($id_matricula);  
                $fecha_pago = date("d-m-Y",strtotime($fecha." + 1 month"));    
               
            
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
                        $this->Cell (0,5,'LISTADO DE CUOTAS A PAGAR','0','0','C');                        
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
                $pdf = new PDF();
                #Establecemos los márgenes izquierda, arriba y derecha:
                $pdf->SetMargins(10, 5 , 10); 
                #Establecemos el margen inferior:
                $pdf->SetAutoPageBreak(true,35);
                $pdf->AliasNbPages();
                $pdf->AddPage();                
                // Movernos a la derecha
                $pdf->SetFont('Times','',10);
                $pdf->Cell(10);
                $pdf->Cell(40,5, utf8_decode(' CÓDIGO MATRICULA:'),1,0,'C');
                $pdf->SetFont('Times','B',10);
                $pdf->Cell(130, 5,utf8_decode( $id_matricula),1,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Times','',10);
                $pdf->Cell(10);
                $pdf->Cell(40,5, ' ALUMNO: ',1,0,'C');
                $pdf->SetFont('Times','B',10);
                $pdf->Cell(130, 5,utf8_decode( $nombreestudiante),1,0,'C');
                $pdf->Ln();
                // Movernos a la derecha
                $pdf->SetFont('Times','',10);
                $pdf->Cell(10);
                $pdf->Cell(40, 5, ' PROGRAMA: ',1,0,'C');
                $pdf->SetFont('Times','B',10);
                $pdf->Cell(130, 5, $nombreprograma,1,0,'C');
                $pdf->Ln();
                // Movernos a la derecha
                $pdf->Cell(10);
                $pdf->SetFont('Times','',10);                
                $pdf->Cell(40, 5, 'VALOR SEM #'. $semestre,1,0,'C');
                $pdf->SetFont('Times','B',12);
                $pdf->Cell(130,5,' $ ' .  $valor . ' COP.',1,1,'C');
                $pdf->Ln(2);                                              
                $pdf->SetFont('Times','',12);
                $pdf->Cell(60);
                $pdf->Cell(20, 5, 'Clase #',1,0,'C');                                                  
                $pdf->Cell(30, 5, 'Valor',1,0,'C');                
                $pdf->Cell(30, 5, 'Fecha',1,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Times','',10);      
                for($i=1;$i<=$cuotas;$i++){         
                            $fecha_pago = date("d-m-Y",strtotime($fecha." + 1 week"));                                                              
                            $pdf->Cell(60);
                            $pdf->Cell(20,5,utf8_decode($i),1,0,'C');
                            $pdf->Cell(30,5,number_format($valorxcuotas),1,0,'C');
                            $pdf->Cell(30,5,utf8_decode($fecha_pago),1,1,'C');
                            $fecha = $fecha_pago;   
                }
$pdf->Output("Matricula.pdf",'D');
}
?>