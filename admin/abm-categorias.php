<?php

// CARGAR USUARIOS! 


require('../conexiondb_club.php');

        if(isset($_POST['Cargar'])){


            if($conexionDB === false){
                die("Error: No fue posible conectarse con la base de datos. ".mysqli_connect_error());
            }

            if(empty($_POST['categoria']) || empty($_POST['edad_ingreso']) || empty($_POST['edad_egreso'])){

                header('Location: ../categorias_form.php?mensaje=falta');
                exit();
            }

            $categoria= $conexionDB->escape_string($_POST['categoria']);
            $edad_ingreso= $conexionDB->escape_string($_POST['edad_ingreso']);
            $edad_egreso= $conexionDB->escape_string($_POST['edad_egreso']);
           

            $sql= "INSERT INTO categorias (categoria, edad_ingreso, edad_egreso)
                    VALUES ('$categoria','$edad_ingreso','$edad_egreso')";
            if($conexionDB->query($sql) === true){
                header('Location: ../categorias_form.php?mensaje=registrado');
            }else{
                header('Location: ../categorias_form.php?mensaje=error');
                exit();
            }
            
    }
// MODIFICAR USUARIOS


        
 
        if(isset($_POST['Modificar'])){
            if(!isset($_POST['codigo'])){
                header('Location: ../categorias_form.php?mensaje=error');
            }

            $idcat= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM categorias WHERE id_categoria='$idcat'";
            $resultado= $conexionDB->query($instruccionSql);
             
                $categoria= $_POST["categoria"];
                $ingreso= $_POST["ingreso"];
                $egreso= $_POST["egreso"];

                $instruccionSql= "UPDATE categorias SET categoria= '$categoria', edad_ingreso='$ingreso',
                                    edad_egreso='$egreso'
                                    WHERE id_categoria='$idcat'";

                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../categorias_form.php?mensaje=editado');
                }else{
                    header('Location: ../categorias_form.php?mensaje=error');
                }
        }


// ELIMINAR USUARIOS
if(isset($_POST['Eliminar'])){
        if(isset($_POST['codigo'])){
            $idcat= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM categorias WHERE id_categoria='$idcat'";
            $resultado= $conexionDB->query($instruccionSql);

                $instruccionSql= "DELETE FROM categorias WHERE id_categoria= '$idcat'";
                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../categorias_form.php?mensaje=eliminado');
                }else{
                    header('Location: ../categorias_form.php?mensaje=error');
                }
            }
        }
        

?>