<?php

// CARGAR USUARIOS! 


require('../conexiondb_club.php');

        if(isset($_POST['Cargar'])){


            if($conexionDB === false){
                die("Error: No fue posible conectarse con la base de datos. ".mysqli_connect_error());
            }

            if(empty($_POST['nombre_actividad'])){

                header('Location: ../actividades_form.php?mensaje=falta');
                exit();
            }

            $actividad= $conexionDB->escape_string($_POST['nombre_actividad']);
           

            $sql= "INSERT INTO actividades (nombre_actividad)
                    VALUES ('$actividad')";
            if($conexionDB->query($sql) === true){
                header('Location: ../actividades_form.php?mensaje=registrado');
            }else{
                header('Location: ../actividades_form.php?mensaje=error');
                exit();
            }
            
    }
// MODIFICAR USUARIOS


        
 
        if(isset($_POST['Modificar'])){
            if(!isset($_POST['codigo'])){
                header('Location: ../actividades_form.php?mensaje=error');
            }

            $idact= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM actividades WHERE id_actividad='$idact'";
            $resultado= $conexionDB->query($instruccionSql);
             
                $actividad= $_POST["actividad"];

                $instruccionSql= "UPDATE actividades SET nombre_actividad= '$actividad'
                                    WHERE id_actividad='$idact'";

                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../actividades_form.php?mensaje=editado');
                }else{
                    header('Location: ../actividades_form.php?mensaje=error');
                }
        }


// ELIMINAR USUARIOS
    if(isset($_POST['Eliminar'])){
        if(isset($_POST['codigo'])){
            $idact= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM actividades WHERE id_actividad='$idact'";
            $resultado= $conexionDB->query($instruccionSql);

                $instruccionSql= "DELETE FROM actividades WHERE id_actividad= '$idact'";
                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../actividades_form.php?mensaje=eliminado');
                }else{
                    header('Location: ../actividades_form.php?mensaje=error');
                }
            }
    }

?>