<?php



    try{

        $conexionDB= new mysqli("localhost","root","","tribuno");

        if($conexionDB->connect_error){

            die("Ocurrió un error al conectar a la base de datos!");

        }

    }

    catch(Exception $ex){

        echo "Ocurrrió un error al conectarse a la base de datos!".$ex->getMessage();

    }



?>