<?php

// CARGAR DEPORTES 


require('../conexiondb_club.php');

        if(isset($_POST['Cargar'])){


            if($conexionDB === false){
                die("Error: No fue posible conectarse con la base de datos. ".mysqli_connect_error());
            }

            if(empty($_POST['nom_deporte']) || empty($_POST['cupos']) ){

                header('Location: ../deportes_form.php?mensaje=falta');
                exit();
            }

            $nom_deporte= $conexionDB->escape_string($_POST['nom_deporte']);
            $cupos= $conexionDB->escape_string($_POST['cupos']);
           

            $sql= "INSERT INTO deportes (nom_deporte, cupos)
                    VALUES ('$nom_deporte','$cupos')";
            if($conexionDB->query($sql) === true){
                header('Location: ../deportes_form.php?mensaje=registrado');
            }else{
                header('Location: ../deportes_form.php?mensaje=error');
                exit();
            }
            
    }
// MODIFICAR DEPORTES


        
 
        if(isset($_POST['Modificar'])){
            if(!isset($_POST['codigo'])){
                header('Location: ../deportes_form.php?mensaje=error');
            }

            $iddep= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM deportes WHERE id_deporte='$iddep'";
            $resultado= $conexionDB->query($instruccionSql);
             
                $nombre= $_POST["nom_deporte"];
                $cupos= $_POST["cupos"];

                $instruccionSql= "UPDATE deportes SET nom_deporte= '$nombre', cupos='$cupos'
                                    WHERE id_deporte='$iddep'";

                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../deportes_form.php?mensaje=editado');
                }else{
                    header('Location: ../deportes_form.php?mensaje=error');
                }
        }


// ELIMINAR DEPORTES
    if(isset($_POST['Eliminar'])){
        if(isset($_POST['codigo'])){
            $iddep= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM deportes WHERE id_deporte='$iddep'";
            $resultado= $conexionDB->query($instruccionSql);

                $instruccionSql= "DELETE FROM deportes WHERE id_deporte= '$iddep'";
                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../deportes_form.php?mensaje=eliminado');
                }else{
                    header('Location: ../deportes_form.php?mensaje=error');
                }
            }
        }
        

?>