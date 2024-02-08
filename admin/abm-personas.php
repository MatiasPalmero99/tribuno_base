<?php
require('../conexiondb_club.php');

// CARGAR CLIENTES! 
        if(isset($_POST['Cargar'])){


            if($conexionDB === false){
                die("Error: No fue posible conectarse con la base de datos. ".mysqli_connect_error());
            }

            if(empty($_POST['nom_persona']) || empty($_POST['ape_persona']) || empty($_POST['dni_persona']) || empty($_POST['cel_persona']) || empty($_POST['correo_persona']) ||
             empty($_POST['nom_usuario']) || empty($_POST['password']) || empty($_POST['domicilio_persona']) || empty($_POST['fch_nac_persona'])){

                header('Location: ../personas_form.php?mensaje=falta');
                exit();
            }

            $nombre= $conexionDB->escape_string($_POST['nom_persona']);
            $apellido= $conexionDB->escape_string($_POST['ape_persona']);
            $dni= $conexionDB->escape_string($_POST['dni_persona']);
            $celular= $conexionDB->escape_string($_POST['cel_persona']);
            $mail= $conexionDB->escape_string($_POST['correo_persona']);
            $nomUsuario=$conexionDB->escape_string($_POST['nom_usuario']);
            $clave=$_POST['password'];
            $clave_cod=md5($clave);
            $domicilio= $conexionDB->escape_string($_POST['domicilio_persona']);
            $fec_persona= $conexionDB->escape_string($_POST['fch_nac_persona']);

            $sql= "INSERT INTO personas (nom_persona, ape_persona, dni_persona, cel_persona, correo_persona, nom_usuario,password,domicilio_persona, fch_nac_persona)
                    VALUES ('$nombre','$apellido','$dni','$celular','$mail','$nomUsuario','$clave_cod','$domicilio','$fec_persona')";

            if($conexionDB->query($sql) === true){
                header('Location: ../personas_form.php?mensaje=registrado');
            }else{
                header('Location: ../personas_form.php?mensaje=error');
                exit();
            }

            $insertpersxrol= "INSERT INTO personasxrol (id_persona, id_rol)
            VALUES (".$conexionDB->insert_id.",'8')";
            $conexionDB->query($insertpersxrol);
            
    }




// MODIFICAR CLIENTES
        if(isset($_POST['Modificar'])){
            if(!isset($_POST['codigo'])){
                header('Location: ../personas_form.php?mensaje=error');
            }

            $idPersona= $_POST['codigo'];
            $instruccionSql= "SELECT*FROM personas WHERE id_persona='$idPersona'";
            $resultado= $conexionDB->query($instruccionSql);
             
                $nombre= $_POST["nom_persona"];
                $apellido= $_POST["ape_persona"];
                $dni= $_POST["dni_persona"];
                $cel_persona= $_POST["cel_persona"];
                $mail_persona= $_POST["correo_persona"];
                $nom_usuario=$_POST["nom_usuario"];
                $clave=$_POST["password"];
                $clave_cod=md5($clave);
                $dom_persona= $_POST["domicilio_persona"];
                $fec_persona= $_POST["fch_nac_persona"];
                
                $instruccionSql= "UPDATE personas SET nom_persona= '$nombre', ape_persona='$apellido',
                                    dni_persona='$dni', cel_persona='$cel_persona', correo_persona='$mail_persona', nom_usuario='$nom_usuario',
                                    password='$clave_cod', domicilio_persona='$dom_persona',fch_nac_persona='$fec_persona'
                                    WHERE id_persona='$idPersona'";
                $resultado= $conexionDB->query($instruccionSql);
                if($resultado){
                    header('Location: ../personas_form.php?mensaje=editado');
                }else{
                    header('Location: ../personas_form.php?mensaje=error');
                }
        }



// ELIMINAR CLIENTES
        if(isset($_POST['Eliminar'])){
            if(isset($_POST['codigo'])){
                $idPersona= $_POST['codigo'];
                $instruccionSql= "SELECT*FROM personas WHERE id_persona='$idPersona'";
                $resultado= $conexionDB->query($instruccionSql);

                    $instruccionSql= "DELETE FROM personas WHERE id_persona= '$idPersona'";
                    $resultado= $conexionDB->query($instruccionSql);
                    if($resultado === true){
                        header('Location: ../personas_form.php?mensaje=eliminado');
                    }else{
                        header('Location: ../personas_form.php?mensaje=error');
                    }
            }
        }

// ASIGNAR ROL A CLIENTE
if(isset($_POST['asign_rol'])){
    if(isset($_POST['codigo'])){
        $idPersona= $_POST['codigo'];
        $id_rol= $_POST['rol_pers'];
        $cons_persxrol= "SELECT * FROM personasxrol WHERE id_persona='$idPersona'";
        $resultadopxr= $conexionDB->query($cons_persxrol);
        if($resultadopxr->num_rows > 0){

            $updatepersxrol= "UPDATE personasxrol SET id_rol='$id_rol'
                                WHERE id_persona='$idPersona'";

            $resultadoupdatepxr= $conexionDB->query($updatepersxrol);
            if($resultadoupdatepxr === true){
                header('Location: ../personas_form.php?mensaje=editado');
            }else{
                header('Location: ../personas_form.php?mensaje=error');
            }
        }else if($resultadopxr->num_rows == 0){

            $instruccionSql= "INSERT INTO personasxrol (id_persona, id_rol)
            VALUES ('$idPersona','$id_rol')";
            $resultado= $conexionDB->query($instruccionSql);
            if($resultado === true){
                header('Location: ../personas_form.php?mensaje=editado');
            }else{
                header('Location: ../personas_form.php?mensaje=error');
            }
        }
    }
}

?>

