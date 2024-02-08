<?php

// CARGAR USUARIOS! 

require('../conexiondb_club.php');

        if(isset($_POST['Cargar'])){


            if($conexionDB === false){
                die("Error: No fue posible conectarse con la base de datos. ".mysqli_connect_error());
            }

            if(empty($_POST['nom_equipamiento']) || empty($_POST['cantidad'])){

                header('Location: ../equipamiento_form.php?mensaje=falta');
                exit();
            }

            $nom_equipamiento= $conexionDB->escape_string($_POST['nom_equipamiento']);
            $cantidad= $conexionDB->escape_string($_POST['cantidad']);
           

            $sql= "INSERT INTO equipamiento (nom_equipamiento, cantidad)
                    VALUES ('$nom_equipamiento','$cantidad')";
            if($conexionDB->query($sql) === true){
                header('Location: ../equipamiento_form.php?mensaje=registrado');
            }else{
                header('Location: ../equipamiento_form.php?mensaje=error');
                exit();
            }
            
    }
// MODIFICAR USUARIOS


        
 
        if(isset($_POST['Modificar'])){
            if(!isset($_POST['codigo'])){
                header('Location: ../equipamiento_form.php?mensaje=error');
            }

            $idEquip= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM equipamiento WHERE id_equipamiento='$idEquip'";
            $resultado= $conexionDB->query($instruccionSql);
             
                $nombre= $_POST["nom_equipamiento"];
                $cant= $_POST["cantidad"];

                $instruccionSql= "UPDATE equipamiento SET nom_equipamiento= '$nombre', cantidad='$cant'
                                    WHERE id_equipamiento='$idEquip'";

                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../equipamiento_form.php?mensaje=editado');
                }else{
                    header('Location: ../equipamiento_form.php?mensaje=error');
                }
        }


// ELIMINAR USUARIOS
if(isset($_POST['Eliminar'])){
        if(isset($_POST['codigo_equip'])){
            $idEquip= $_POST['codigo_equip'];
                $instruccionSql= "DELETE FROM equipamiento WHERE id_equipamiento='$idEquip'";
                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../equipamiento_form.php?mensaje=eliminado');
                }else{
                    header('Location: ../equipamiento_form.php?mensaje=error');
                }
            }
}

?>