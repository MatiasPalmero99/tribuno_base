<?php
require('../conexiondb_club.php');

// CARGAR ROL! 
        if(isset($_POST['Cargar'])){


            if($conexionDB === false){
                die("Error: No fue posible conectarse con la base de datos. ".mysqli_connect_error());
            }

            if(empty($_POST['nombre_rol'])){

                header('Location: ../rol_form.php?mensaje=falta');
                exit();
            }

            $rol= $conexionDB->escape_string($_POST['nombre_rol']);            

            $sql= "INSERT INTO rol (nombre_rol)
                    VALUES ('$rol')";
            if($conexionDB->query($sql) === true){
                header('Location: ../rol_form.php?mensaje=registrado');
            }else{
                header('Location: ../rol_form.php?mensaje=error');
                exit();
            }
            
    }




// MODIFICAR ROL
        if(isset($_POST['Modificar'])){
            if(!isset($_POST['codigo'])){
                header('Location: ../rol_form.php?mensaje=error1');
            }

            $idRol= $_POST['codigo'];
            $nombre_rol= $_POST["nombre_rol"];
            $instruccionSql= "SELECT*FROM rol WHERE id_rol='$idRol'";
            $resultado= $conexionDB->query($instruccionSql);
             
                
                                
                $instruccionSql= "UPDATE rol SET nombre_rol= '$nombre_rol'
                                    WHERE id_rol='$idRol'";
                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../rol_form.php?mensaje=editado');
                }else{
                    header('Location: ../rol_form.php?mensaje=error2');
                }
        }



// ELIMINAR CLIENTES
        if(isset($_POST['Eliminar'])){
            if(isset($_POST['codigo'])){
                $idRol= $_POST['codigo'];
                $instruccionSql= "SELECT*FROM rol WHERE id_rol='$idRol'";
                $resultado= $conexionDB->query($instruccionSql);

                    $instruccionSql= "DELETE FROM rol WHERE id_rol= '$idRol'";
                    $resultado= $conexionDB->query($instruccionSql);
                    if($resultado === true){
                        header('Location: ../rol_form.php?mensaje=eliminado');
                    }else{
                        header('Location: ../rol_form.php?mensaje=error');
                    }
            }
        }
?>




<!-- ###################################### -->


