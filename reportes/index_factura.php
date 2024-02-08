<?php

	require('fpdf/fpdf.php');
	include '../conexiondb_club.php';

	//inscripcion
	if(isset($_GET['motivo']) && $_GET['motivo']!='' && $_GET['motivo']== "inscripcion"){
		$dni_persona=$_GET['dni_persona'];
	}

	//reinscripcion
	if(isset($_GET['motivo']) && $_GET['motivo']!='' && $_GET['motivo']== "reinscripcion"){
		$id_legajo=$_GET['id_legajo_reins'];
	}

	//cobro de cuotas
	if(isset($_GET['motivo']) && $_GET['motivo']!='' && $_GET['motivo']== "cuotas"){
		$id_legajo=$_GET['id_legajo'];
	}
	
	

	class PDF extends FPDF{
		// Cabecera de página
		function Header(){
		    // Arial bold 15
		    $this->SetFont('Arial','B',25);
		    // Movernos a la derecha
		    $this->Cell(80);
		    // Título
		    $this->Cell(30,10,'FACTURA C',0,0,'C');		    
		    // Logo
		    $this->Image('logo.png',10,8,30);
		    // Salto de línea
		    $this->Ln(20);
		}

		// Pie de página
		function Footer(){
		    // Posición: a 1,5 cm del final
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Número de página
		    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}


	///////////////////       CONSULTAS PARA CARGA DE INFORMACION        ////////////////////////////

	/**************           INFORMACION DEL JUGADOR      **********/
	if(isset($_GET['motivo']) && $_GET['motivo']!='' && ($_GET['motivo']== "reinscripcion") || $_GET['motivo']== "cuotas"){

		$jugador = "SELECT 
					alumnos.legajo,
					alumnos.id_usuario,

					personasxrol.id_usuario,
					personasxrol.id_persona,

					personas.id_persona,
					personas.nom_persona,
					personas.ape_persona,
					personas.domicilio_persona,
					personas.dni_persona
					FROM alumnos
					INNER JOIN personasxrol ON personasxrol.id_usuario=alumnos.id_usuario
					INNER JOIN personas ON personas.id_persona=personasxrol.id_persona
					WHERE alumnos.legajo='$id_legajo'";

		$qjugador=$conexionDB->query($jugador);
		$row_jugador= $qjugador->fetch_object();
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);

	}

	if(isset($_GET['motivo']) && $_GET['motivo']!='' && $_GET['motivo']== "inscripcion"){

		$jugador = "SELECT 
					personas.id_persona,
					personas.nom_persona,
					personas.ape_persona,
					personas.domicilio_persona,
					personas.dni_persona,

					personasxrol.id_usuario,
					personasxrol.id_persona,

					alumnos.legajo,
					alumnos.id_usuario
					FROM personas
					INNER JOIN personasxrol ON personasxrol.id_persona=personas.id_persona
					INNER JOIN alumnos ON alumnos.id_usuario=personasxrol.id_usuario
					WHERE personas.dni_persona='$dni_persona'";
		
		$qjugador=$conexionDB->query($jugador);
		$row_jugador= $qjugador->fetch_object();

		$id_legajo= $row_jugador->legajo;
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);

	}


		
	/**************           INFORMACION DE LA OPERACION     **********/

	//  INSCRIPCION

	if(isset($_GET['motivo']) && $_GET['motivo']!='' && $_GET['motivo']== "inscripcion"){

		$conscobro= "SELECT 
					cobros.id_cobro,
					cobros.id_caja,
					cobros.legajo,
					cobros.total_cobros,
					cobros.fch_cobro,
					cobros.hr_cobro,
					cobros.fch_limite,

					detalle_cobro.id_det_cobro,
					detalle_cobro.id_cobro,
					detalle_cobro.id_tipo_ingreso,
					detalle_cobro.id_mes,
					detalle_cobro.mont_unitario,
					detalle_cobro.mont_total,

					tipo_ingreso.id_tipo_ingreso,
					tipo_ingreso.tipo_ingreso,

					mes.id_mes,
					mes.nombre

					FROM cobros
					INNER JOIN detalle_cobro ON cobros.id_cobro=detalle_cobro.id_cobro
					INNER JOIN tipo_ingreso ON detalle_cobro.id_tipo_ingreso=tipo_ingreso.id_tipo_ingreso
					INNER JOIN mes ON detalle_cobro.id_mes=mes.id_mes
					WHERE cobros.legajo='$id_legajo' ORDER BY cobros.id_cobro DESC LIMIT 1";
	$qconscobro=$conexionDB->query($conscobro);

	$qconscobro2=$conexionDB->query($conscobro);
	$row_cobros= $qconscobro2->fetch_object();

	}



	// REINSCRIPCION
	if(isset($_GET['motivo']) && $_GET['motivo']!='' && $_GET['motivo']== "reinscripcion"){

		$conscobro= "SELECT 
					cobros.id_cobro,
					cobros.id_caja,
					cobros.legajo,
					cobros.total_cobros,
					cobros.fch_cobro,
					cobros.hr_cobro,
					cobros.fch_limite,

					detalle_cobro.id_det_cobro,
					detalle_cobro.id_cobro,
					detalle_cobro.id_tipo_ingreso,
					detalle_cobro.id_mes,
					detalle_cobro.mont_unitario,
					detalle_cobro.mont_total,

					tipo_ingreso.id_tipo_ingreso,
					tipo_ingreso.tipo_ingreso,

					mes.id_mes,
					mes.nombre

					FROM cobros
					INNER JOIN detalle_cobro ON cobros.id_cobro=detalle_cobro.id_cobro
					INNER JOIN tipo_ingreso ON detalle_cobro.id_tipo_ingreso=tipo_ingreso.id_tipo_ingreso
					INNER JOIN mes ON detalle_cobro.id_mes=mes.id_mes
					WHERE cobros.legajo='$id_legajo' ORDER BY cobros.id_cobro DESC LIMIT 1";
	$qconscobro=$conexionDB->query($conscobro);

	$qconscobro2=$conexionDB->query($conscobro);
	$row_cobros= $qconscobro2->fetch_object();

	}


	//   CUOTAS
	if(isset($_GET['motivo']) && $_GET['motivo']!='' && $_GET['motivo']== "cuotas"){

		$consid_cobro="SELECT * FROM cobros where legajo='$id_legajo' ORDER BY id_cobro DESC LIMIT 1";
		$qconsid_cobro=$conexionDB->query($consid_cobro);
		$qconsid= $qconsid_cobro->fetch_object();
		$id_cobro=$qconsid->id_cobro;





		$conscobro="SELECT
					detalle_cobro.id_det_cobro,
					detalle_cobro.id_cobro,
					detalle_cobro.id_tipo_ingreso,
					detalle_cobro.id_mes,
					detalle_cobro.mont_unitario,
					detalle_cobro.mont_total,

					cobros.id_cobro,
					cobros.id_caja,
					cobros.legajo,
					cobros.total_cobros,
					cobros.fch_cobro,
					cobros.hr_cobro,
					cobros.fch_limite,

					tipo_ingreso.id_tipo_ingreso,
					tipo_ingreso.tipo_ingreso,

					mes.id_mes,
					mes.nombre

					FROM detalle_cobro
					INNER JOIN cobros ON detalle_cobro.id_cobro=cobros.id_cobro
					INNER JOIN tipo_ingreso ON detalle_cobro.id_tipo_ingreso=tipo_ingreso.id_tipo_ingreso
					INNER JOIN mes ON detalle_cobro.id_mes=mes.id_mes
					WHERE cobros.legajo='$id_legajo' 
					AND detalle_cobro.id_cobro='$id_cobro'
					ORDER BY mes.id_mes ASC";
		$qconscobro=$conexionDB->query($conscobro);

		$qconscobro2=$conexionDB->query($conscobro);
		$row_cobros= $qconscobro2->fetch_object();
	}



	// Datos de la empresa
	$pdf->SetFont('Arial','B',10);    
	$pdf->setY(40);$pdf->setX(10);
	$pdf->Cell(5,$textypos,"DE:");
	$pdf->SetFont('Arial','',10);    
	$pdf->setY(45);$pdf->setX(10);
	$pdf->Cell(5,$textypos,"Razon social: Tribuno Basquet");
	$pdf->setY(50);$pdf->setX(10);
	$pdf->Cell(5,$textypos,"Direccion: Complejo Nicolas Vitae");
	$pdf->setY(55);$pdf->setX(10);
	$pdf->Cell(5,$textypos,"Tel: 3875801622");

	// Datos del cliente
	$pdf->SetFont('Arial','B',10);    
	$pdf->setY(40);$pdf->setX(75);
	$pdf->Cell(5,$textypos,"PARA:");
	$pdf->SetFont('Arial','',10);    
	$pdf->setY(45);$pdf->setX(75);
	$pdf->Cell(5,$textypos, "Nombre: " . $row_jugador->nom_persona . " " . $row_jugador->ape_persona);
	$pdf->setY(50);$pdf->setX(75);
	$pdf->Cell(5,$textypos,"Direccion: " . $row_jugador->domicilio_persona);
	$pdf->setY(55);$pdf->setX(75);
	$pdf->Cell(5,$textypos,"D.N.I: ".$row_jugador->dni_persona);

	//Datos de la Factura
	$pdf->SetFont('Arial','B',10);    
	$pdf->setY(40);$pdf->setX(145);
	$pdf->Cell(5,$textypos,"FACTURA #".$row_cobros->id_cobro);
	$pdf->SetFont('Arial','',10);    
	$pdf->setY(45);$pdf->setX(145);
	$pdf->Cell(5,$textypos,"Fecha: " . date("d-m-Y", strtotime($row_cobros->fch_cobro)));
	$pdf->setY(50);$pdf->setX(145);
	$pdf->Cell(5,$textypos,"Hora: " . $row_cobros->hr_cobro);
	$pdf->setY(55);$pdf->setX(145);
	$pdf->Cell(5,$textypos,"");
	$pdf->setY(60);$pdf->setX(145);
	$pdf->Cell(5,$textypos,"");



/// Apartir de aqui empezamos con la tabla de productos
	$pdf->setY(65);$pdf->setX(135);
	    $pdf->Ln();
	/////////////////////////////
	//// Array de Cabecera
	$header = array("Cod.", "Motivo","Desc.","Monto");
	//// Arrar de Productos

	    // Column widths
	    $w = array(20, 85, 50, 30);
	    // Header
	    for($i=0;$i<count($header);$i++)
	        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
	    $pdf->Ln();
	    // Data
	    //$total = 0;
	    // foreach($products as $row)
	    // {
	    //     $pdf->Cell($w[0],6,$row[0],1);
	    //     $pdf->Cell($w[1],6,$row[1],1);
	    //     $pdf->Cell($w[3],6,"$ ".number_format($row[3],2,".",","),'1',0,'R');
	    //     $pdf->Cell($w[4],6,"$ ".number_format($row[3]*$row[10],2,".",","),'1',0,'R');

	    //     $pdf->Ln();
	    //     $total+=$row[3]*$row[2];

	    // }


	// 	$sql= "SELECT*FROM detalle_cobro INNER JOIN tipo_ingreso ON detalle_cobro.id_tipo_ingreso=tipo_ingreso.id_tipo_ingreso
	// 	INNER JOIN mes ON detalle_cobro.id_mes=mes.id_mes WHERE id_cobro='$id_detalle_cobro'";
	// $resultado=$conexionDB->query($sql);



		while($fila= $qconscobro->fetch_object()){
			
			$pdf->Cell($w[0],6,utf8_decode($fila->id_det_cobro),1);
	        $pdf->Cell($w[1],6,utf8_decode($fila->tipo_ingreso),1);
			$pdf->Cell($w[2],6,utf8_decode($fila->nombre),1);
	        $pdf->Cell($w[3],6,"$".number_format($fila->mont_unitario,2,".",","),'1',0,'R');
			$pdf->Ln();

	        
		}
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell($w[0],6,'',2);
		$pdf->Cell($w[1],6,'',2);
		$pdf->Cell($w[2],6,"TOTAL: ",1,0,'R');
		$pdf->Cell($w[3],6,"$".number_format($row_cobros->total_cobros,2,".",","),'1',0,'R');





		
	/////////////////////////////
	//// Apartir de aqui esta la tabla con los subtotales y totales
	// $yposdinamic = 60 + (count($products)*10);

	// $pdf->setY($yposdinamic+40);
	// $pdf->setX(235);
	//     $pdf->Ln();
	// /////////////////////////////
	// $header = array("", "");
	// $data2 = array(
	// 	array("Total", $total),
	// );
	//     // Column widths
	//     $w2 = array(40, 40);
	//     // Header

	//     $pdf->Ln();
	//     // Data
	//     foreach($data2 as $row)
	//     {
	// $pdf->setX(115);
	//         $pdf->Cell($w2[0],6,$row[0],1);
	//         $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');

	//         $pdf->Ln();
	//     }
	// /////////////////////////////

	// $yposdinamic += (count($data2)*10);
	// $pdf->SetFont('Arial','B',10);    

	// $pdf->setY($yposdinamic+40);
	// $pdf->setX(10);
	// $pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
	// $pdf->SetFont('Arial','',10);    

	// $pdf->setY($yposdinamic+50);
	// $pdf->setX(10);
	// $pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
	// $pdf->setY($yposdinamic+20);
	
	$pdf->output();
?>