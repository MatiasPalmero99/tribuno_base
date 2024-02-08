<?php
require('../conexiondb_club.php');

		$recestcta="SELECT
        cuotas.id_cuota,
        cuotas.legajo,
        cuotas.id_mes,
        cuotas.cuotas_estado,

        mes.id_mes,
        mes.nombre

        FROM cuotas
        INNER JOIN mes ON mes.id_mes=cuotas.id_mes
        WHERE legajo='".$_GET['legajo']."'";

$tabla='';
    $resultado=$conexionDB->query($recestcta);
	// if(mysql_num_rows($resultado)>0){
        $tabla.='<label class="form-label"><strong>Estado de cuenta: </strong></label>';
		while($fila= $resultado->fetch_object()){

            if($fila->cuotas_estado==1){
                $check="checked disabled";
            }else{
                $check="";
            }

            $tabla.='<div class="form-check form-switch">
                        <input class="form-check-input mes" type="checkbox" id="'.$fila->id_cuota.'" name="mes[]" '.$check.' value="'.$fila->id_mes.'">
                        <label class="form-check-label" for="'.$fila->id_cuota.'">'.$fila->nombre.'</label>
                    </div>';
		}
//<option value="'.$fila->id_cuota.'">'.$fila->nombre.'</option>
$salida['tabla']=utf8_encode($tabla);
echo json_encode($salida);

?>