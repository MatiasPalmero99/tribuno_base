<?php
require('../conexiondb_club.php');

// CARGAR CONTROL DE EQUIPAMIENTO! 
        if(isset($_POST['Cargar'])){


            if($conexionDB === false){
                die("Error: No fue posible conectarse con la base de datos. ".mysqli_connect_error());
            }

            if(empty($_POST['descripcion']) || empty($_POST['id_equipamiento'])){

                header('Location: ../control_equipamiento.php?mensaje=falta');
                exit();
            }

            $descripcion= $conexionDB->escape_string($_POST['descripcion']);
            $idequipamiento= $conexionDB->escape_string($_POST['id_equipamiento']);

            $sql= "INSERT INTO ajustes (descripcion, id_equipamiento)
                    VALUES ('$descripcion','$idequipamiento')";
            if($conexionDB->query($sql) === true){
                header('Location: ../control_equipamiento.php?mensaje=registrado');
            }else{
                header('Location: ../control_equipamiento.php?mensaje=error');
                exit();
            }
            
    }
// MODIFICAR CONTROL DE EQUIPAMIENTO!


        /*FALTA COMPLETAR POR POCA BATERIA*/
 
        if(isset($_POST['Modificar'])){
            if(!isset($_POST['codigo'])){
                header('Location: ../control_equipamiento.php?mensaje=error');
            }

            $idajuste= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM ajustes WHERE id_ajuste='$idajuste'";
            $resultado= $conexionDB->query($instruccionSql);
             
                $descripcion= $_POST["descripcion"];
                $idequipamiento= $_POST["id_equipamiento"];

                $instruccionSql= "UPDATE ajustes SET descripcion= '$descripcion', id_equipamiento='$idequipamiento'
                                    WHERE id_ajuste='$idajuste'";

                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../control_equipamiento.php?mensaje=editado');
                }else{
                    header('Location: ../control_equipamiento.php?mensaje=error');
                }
        }


// ELIMINAR CONTROL DE EQUIPAMIENTO!
if(isset($_POST['Eliminar'])){

        if(isset($_POST['codigo'])){
            $idajuste= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM ajustes WHERE id_ajuste='$idajuste'";
            $resultado= $conexionDB->query($instruccionSql);

                $instruccionSql= "DELETE FROM ajustes WHERE id_ajuste= '$idajuste'";
                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../control_equipamiento.php?mensaje=eliminado');
                }else{
                    header('Location: ../control_equipamiento.php?mensaje=error');
                }
            } 
        }
?>