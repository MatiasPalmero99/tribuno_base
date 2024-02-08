<?php
include 'conexiondb_club.php';

    $query = "SELECT MONTH(alumnos.fch_ingreso) AS mes, COUNT(alumnos.legajo) AS Cantidad_Alumnos FROM alumnos
            INNER JOIN categorias ON alumnos.id_categoria=categorias.id_categoria GROUP BY MONTH(alumnos.fch_ingreso)";

    $result = $conexionDB->query($query);

    $response = [
        'success' => false,
        'results' => null,
        'message' => ''
    ];
    
    if($result->num_rows > 0) {

        $labels = [];
        $count = [];

        while ($row= $result->fetch_assoc()){
            switch ($row['mes']) {
                case 1:
                    $labels[]= "Enero";
                    break;
                case 2:
                    $labels[]= "Febrero";
                    break;
                case 3:
                    $labels[]= "Marzo";
                    break;
                case 4:
                    $labels[]= "Abril";
                    break;
                case 5:
                    $labels[]= "Mayo";
                    break;
                case 6:
                    $labels[]= "Junio";
                    break;
                case 7:
                    $labels[]= "Julio";
                    break;
                case 8:
                    $labels[]= "Agosto";
                    break;
                case 9:
                    $labels[]= "Septiembre";
                    break;
                case 10:
                    $labels[]= "Ocubre";
                    break;
                case 11:
                    $labels[]= "Noviembre";
                    break;
                case 12:
                    $labels[]= "Diciembre";
                    break;
            }
            $count[]= $row['Cantidad_Alumnos'];
        }

        $response['success'] = true;
        $response['results'] = [$labels, $count];   
    }

    echo json_encode($response);


?>
