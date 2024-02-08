<?php

// CARGAR USUARIOS! 


require('../conexiondb_club.php');

        if(isset($_POST['Cargar'])){


            if($conexionDB === false){
                die("Error: No fue posible conectarse con la base de datos. ".mysqli_connect_error());
            }

            if(empty($_POST['tipo_ingreso']) || empty($_POST['mont_ingreso'])){

                header('Location: ../ingreso_form.php?mensaje=falta');
                exit();
            }

            $tipo_ingreso= $conexionDB->escape_string($_POST['tipo_ingreso']);
            $mont_ingreso= $conexionDB->escape_string($_POST['mont_ingreso']);

            $sql= "INSERT INTO tipo_ingreso (tipo_ingreso, mont_ingreso)
                    VALUES ('$tipo_ingreso','$mont_ingreso')";
            if($conexionDB->query($sql) === true){
                header('Location: ../ingreso_form.php?mensaje=registrado');
            }else{
                header('Location: ../ingreso_form.php?mensaje=error');
                exit();
            }
            
    }
// MODIFICAR USUARIOS


        /*FALTA COMPLETAR POR POCA BATERIA*/
 
        if(isset($_POST['Modificar'])){
            if(!isset($_POST['codigo'])){
                header('Location: ../ingreso_form.php?mensaje=error');
            }

            $idingreso= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM tipo_ingreso WHERE id_tipo_ingreso='$idingreso'";
            $resultado= $conexionDB->query($instruccionSql);
             
                $tipo_ingreso= $_POST["tipo_ingreso"];
                $mont_ingreso= $_POST["mont_ingreso"];

                $instruccionSql= "UPDATE tipo_ingreso SET tipo_ingreso= '$tipo_ingreso', mont_ingreso='$mont_ingreso'
                                    WHERE id_tipo_ingreso='$idingreso'";

                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../ingreso_form.php?mensaje=editado');
                }else{
                    header('Location: ../ingreso_form.php?mensaje=error');
                }
        }


// ELIMINAR USUARIOS
if(isset($_POST['Eliminar'])){

        if(isset($_POST['codigo'])){
            $idingreso= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM tipo_ingreso WHERE id_tipo_ingreso='$idingreso'";
            $resultado= $conexionDB->query($instruccionSql);

                $instruccionSql= "DELETE FROM tipo_ingreso WHERE id_tipo_ingreso= '$idingreso'";
                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../ingreso_form.php?mensaje=eliminado');
                }else{
                    header('Location: ../ingreso_form.php?mensaje=error');
                }
            } 
        }
?>