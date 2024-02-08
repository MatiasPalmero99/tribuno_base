<?php
include 'conexiondb_club.php';

    $query = "SELECT categorias.categoria AS cat_nombre, COUNT(alumnos.legajo) AS Cantidad_Alumnos FROM alumnos
            INNER JOIN categorias ON alumnos.id_categoria=categorias.id_categoria GROUP BY categorias.categoria ORDER BY Cantidad_Alumnos DESC";

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
            $labels[]= $row['cat_nombre'];
            $count[]= $row['Cantidad_Alumnos'];
        }

        $response['success'] = true;
        $response['results'] = [$labels, $count];   
    }

    echo json_encode($response);


?>
