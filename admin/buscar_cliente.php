<?php
require('../conexiondb_club.php');


    
        $term=$_GET['term'];

		$reccli="SELECT
		personas.id_persona,
        personas.nom_persona,
        personas.ape_persona,
        personas.dni_persona,
        personas.cel_persona,
        personas.correo_persona,
        personas.nom_usuario,
        personas.domicilio_persona,
        personas.fch_nac_persona,

        personasxrol.id_usuario,
        personasxrol.id_persona,
        personasxrol.id_rol,

        alumnos.legajo,
        alumnos.id_usuario

        FROM personas
        INNER JOIN personasxrol ON personas.id_persona=personasxrol.id_persona
        INNER JOIN alumnos ON personasxrol.id_usuario=alumnos.id_usuario
        WHERE personas.dni_persona LIKE '%".$_GET['term']."%'
        OR personas.nom_persona LIKE '%".$_GET['term']."%'
        OR personas.ape_persona LIKE '%".$_GET['term']."%'
        ";

	
    $resultado=$conexionDB->query($reccli);
	// if(mysql_num_rows($resultado)>0){
		while($fila= $resultado->fetch_assoc()){

            
            
			$salida[] = array(
				'id_persona'=>$fila['id_persona'],
                'nom_persona'=>$fila['nom_persona'],
                'ape_persona'=>$fila['ape_persona'],
                'dni_persona'=>$fila['dni_persona'],
                'id_usuario'=>$fila['id_usuario'],
                'legajo'=>$fila['legajo']
				);
		}
		echo json_encode($salida);
	// }
	// else{
	// 	//echo 'null';
	// 	echo $reccli;
	// }

?>