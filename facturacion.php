<?php
    require("../../conexiondb_club.php");


        try{



    
            $conexionDB->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

            $sql="INSERT INTO cobros (id_caja, id_persona, total_cobros, fch_cobro, hr_cobro)
                VALUES (1, 1, 5500, curdate(), curtime())";
            $queryVentas=$conexionDB->query($sql);


            if (!$queryVentas)
                throw new exception ($conexionDB->error);
            {  
                $sql="INSERT INTO detalle_cobro (id_cobro, id_tipo_ingreso, mont_total, mont_unitario)
                    VALUES (".$conexionDB->insert_id.",1,4500,2000)";
                $queryVentas_Item=$conexionDB->query($sql);

                if (!$queryVentas_Item)
                    throw new exception ($conexionDB->error);
                
                {
                    $conexionDB->commit();
                    echo "¡Grabación exitosa de nueva venta!";
                }
            }
        }
        catch (Exception $ex)
        {
            $conexionDB->rollback();
            echo "Ocurrió un error al intentar grabar la Venta!". $ex->getMessage();
        }
    
?>