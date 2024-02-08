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
		while($fila= $resultado->fetch_object()){

            if($fila->cuotas_estado==1){
                $check='<strong class="text-success">PAGADO</strong>';
            }else{
                $check='<strong class="text-danger">IMPAGO</strong>';
            }

            $tabla.='<tr>
                        <td style="color:#0026BF;" class="col-4 border-success-end"><strong>'.$fila->nombre.'</strong></td>
                        <td class="col-8 border-start">'.$check.'</td>
                    </tr>';
		}
//<option value="'.$fila->id_cuota.'">'.$fila->nombre.'</option>
$salida['tabla']=utf8_encode($tabla);
echo json_encode($salida);

?>