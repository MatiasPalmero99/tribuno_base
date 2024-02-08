<?php
include 'conexiondb_club.php';

    $query = "SELECT MONTH(fch_cobro) as mes, SUM(total_cobros) AS total_cobros_x_mes FROM cobros GROUP BY MONTH(fch_cobro)";

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
            $count[]= $row['total_cobros_x_mes'];
        }

        $response['success'] = true;
        $response['results'] = [$labels, $count];   
    }

    echo json_encode($response);


?>