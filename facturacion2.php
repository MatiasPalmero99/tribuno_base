<?php
    include 'conexiondb_club.php';

        try{
 
            $conexionDB->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

            
            if(isset($_POST['Enviar'])){

                $tipo_pago= $_POST['tipo_ingreso'];
                $descripcion= $_POST['descripcion'];
                $dni= $_POST['nDni'];
                $caja= $_POST['caja'];
                $mUnitario= $_POST['mUnitario'];
                $total= $_POST['Total'];
               
                $sqlLegajo= "SELECT legajo FROM alumnos WHERE id_usuario IN(select id_usuario from personasxrol WHERE id_persona IN (select id_persona from personas WHERE dni_persona='$dni'))";
               
                $resultado=$conexionDB->query($sqlLegajo);
                $fila= $resultado->fetch_assoc();
                $legajo= $fila['legajo'];
                

                $sql= "INSERT INTO cobros(id_caja, legajo, total_cobros, fch_cobro, hr_cobro)
                    VALUES ('$caja', '$legajo', $total, curdate(), curtime())";
                $queryVentas=$conexionDB->query($sql);

 
                if (!$queryVentas)
                    throw new exception ($conexionDB->error);
                {  
                    $sql="INSERT INTO detalle_cobro (id_cobro, id_tipo_ingreso, descripcion, mont_unitario, mont_total)
                        VALUES (".$conexionDB->insert_id.",'$tipo_pago','$descripcion','$mUnitario','$total')";
                    $queryVentas_Item=$conexionDB->query($sql);

                    if (!$queryVentas_Item)
                        throw new exception ($conexionDB->error);
                    
                    {
                        $conexionDB->commit();
                        header('Location: index.php?mensaje=registrado');
                    }
                }
            }
        }
        catch (Exception $ex)
        {
            $conexionDB->rollback();
            echo "Ocurrió un error al intentar grabar la Venta!". $ex->getMessage();
        }
    
?>