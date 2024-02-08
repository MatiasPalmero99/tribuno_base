<?php



if(isset($_POST['cuotas'])){//Para ejecutar PHP script en Submit
    if(!empty($_POST['mes'])){
        echo ($_POST['id_legajo']);
    // Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
    foreach($_POST['mes'] as $mes){
    echo $mes;
    }
    }else{
        echo 'error mes';
    }
}else{
    echo 'error boton';
}







?>