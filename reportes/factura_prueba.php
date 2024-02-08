<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

include '../conexiondb_club.php';
$consulta = "SELECT nom_persona, ape_persona FROM personas LIMIT 1";
$resultados = mysqli_query($conexionDB, $consulta);

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);


$row = $resultados->fetch_assoc();
$pdf->Cell(90,10, $row['nom_persona'], 1, 0, 'C', 0);
$pdf->Cell(90,10, $row['ape_persona'], 1, 0, 'C', 0);

// while ($row = $resultados->fetch_assoc()){
//     $pdf->Cell(90,10, $row['nom_persona'], 1, 0, 'C', 0);
//     $pdf->Cell(90,10, $row['ape_persona'], 1, 0, 'C', 0);
// }

$pdf->Output();
?>