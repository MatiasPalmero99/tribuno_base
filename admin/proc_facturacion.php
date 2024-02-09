<?php
    include '../conexiondb_club.php';

        try{
            $conexionDB->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            //Recuperar datos de caja(id)
            $caja= "SELECT * from caja ORDER BY id_caja DESC LIMIT 1 ";
            $resultadocaja=$conexionDB->query($caja);
            $row_caja= $resultadocaja->fetch_object();
            $id_caja= $row_caja->id_caja;

            //Consultar si la caja está abierta
            if($row_caja->ord_apertura == 1){
/***********************************************************         INICIO PROCESO INSCRIPCION         *************************************************************************************/
                if(isset($_POST['inscripcion'])){
                    //INPUT type Hidden
                    $id_tipo_ingreso= $conexionDB->escape_string($_POST['id_tipo_ingreso']);
                    $tipo_ingreso= $conexionDB->escape_string($_POST['tipo_ingreso']);
                    $monto_tipo_ingreso= $conexionDB->escape_string($_POST['monto_tipo_ingreso']);

                    $id_categoria= $conexionDB->escape_string($_POST['categoria']);

                    //INPUT formulario carga de nueva persona
                    $nombre= $conexionDB->escape_string($_POST['nom_persona']);
                    $apellido= $conexionDB->escape_string($_POST['ape_persona']);
                    $dni= $conexionDB->escape_string($_POST['dni_persona']);
                    $celular= $conexionDB->escape_string($_POST['cel_persona']);
                    $mail= $conexionDB->escape_string($_POST['correo_persona']);
                    $domicilio= $conexionDB->escape_string($_POST['domicilio_persona']);
                    $fec_persona= $conexionDB->escape_string($_POST['fch_nac_persona']);

                    $consulta_pers= "SELECT id_persona, dni_persona, nom_persona, ape_persona FROM personas WHERE dni_persona='$dni'";
                    $qconsulta_pers=$conexionDB->query($consulta_pers);

                    // Verificar si el jugador ya se encuentra cargado o no en la base de datos.
                    if($qconsulta_pers->num_rows >= 1){
                        header('Location: ../facturacion_index.php?mensaje=jugador_existente');
                    }else{
                    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        //actualizar saldo de caja con monto inicial + monto ingresado por inscripcion
                        $saldo_caja= $row_caja->saldo_caja;
                        $saldo_caja+= $monto_tipo_ingreso;
                        $upcaja="UPDATE caja SET saldo_caja='$saldo_caja'
                        WHERE id_caja='$id_caja'";
                        $conexionDB->query($upcaja);


                    ///////////////////////////         Dar de alta nueva persona         ///////////////////////////////////////////////////////////////////////////////////////////////////
                        $sql= "INSERT INTO personas (nom_persona, ape_persona, dni_persona, cel_persona, correo_persona, nom_usuario,password,domicilio_persona, fch_nac_persona)
                        VALUES ('$nombre','$apellido','$dni','$celular','$mail', NULL, NULL,'$domicilio','$fec_persona')";
                        $conexionDB->query($sql);

                        //Recuperar datos de jugador recien cargado (id)
                        // $jugador= "SELECT id_persona, dni_persona from personas WHERE dni_persona='$dni'";
                        // $resultadojugador=$conexionDB->query($jugador);
                        // $row_jugador=$resultadojugador->fetch_object();
                        // $id_persona= $row_jugador->id_persona;
                        
                    ///////////////////////////////         Dar de alta en personasxrol el nuevo inscripto       ///////////////////////////////////////////////////////////////////////////////
                        $id_persona=$conexionDB->insert_id;
                        $sqlpersxrol= "INSERT INTO personasxrol (id_persona, id_rol)
                        VALUES ('$id_persona','7')";
                        $conexionDB->query($sqlpersxrol);
                        //Recuperar datos de personasxrol recien cargado
                        $id_persxrol= "SELECT id_usuario, id_persona, id_rol from personasxrol WHERE id_persona='$id_persona'";
                        $qpersxrol=$conexionDB->query($id_persxrol);
                        $row_persxrol=$qpersxrol->fetch_object();
                        $id_usuario= $row_persxrol->id_usuario;

                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                    ///////////////////////////         Dar de alta legajo de alumno con los datos cargados en persona        //////////////////////////////////////////////////////////////////
                        $sqlalumnos= "INSERT INTO alumnos (id_usuario, id_deporte, id_categoria, id_profesor, fch_ingreso, fch_egreso)
                        VALUES ('$id_usuario','1','$id_categoria', NULL, curdate(), NULL)";
                        $conexionDB->query($sqlalumnos);
                        //Recuperar datos de legajo del alumno recien cargado
                        $cons_legajo= "SELECT legajo, id_usuario from alumnos WHERE id_usuario='$id_usuario'";
                        $qcons_legajo=$conexionDB->query($cons_legajo);
                        $row_legajo=$qcons_legajo->fetch_object();
                        $legajo= $row_legajo->legajo;



                    ///////////////////////       Dar de alta en la tabla de cuotas los 12 registros correspondientes al jugador inscripto      ////////////////////////////////////////////////
                        for($i=1; $i<=12; $i++){
                            $sqlcuotas= "INSERT INTO cuotas (legajo, id_mes, cuotas_estado)
                                        VALUES ('$legajo','$i','0')";
                            $conexionDB->query($sqlcuotas);
                        }

                        //Actualizar el primer registro 
                        $upinscripcion="UPDATE cuotas SET cuotas_estado='1'
                        WHERE legajo='$legajo'
                        AND id_mes=1";
                        $conexionDB->query($upinscripcion);

                    ////////////////////////////////////////////      FACTURACION DE INSCRIPCION     ///////////////////////////////////////////////////////////////////////////////////////////

                        $insert_cobro= "INSERT INTO cobros(id_caja, legajo, total_cobros, fch_cobro, hr_cobro, fch_limite)
                            VALUES ('$id_caja', '$legajo', '$monto_tipo_ingreso', curdate(), curtime(), curdate())";
                        $queryVentas=$conexionDB->query($insert_cobro);

                        //Recuperar ultimo id de cobro para cargar en detalle
                        // $cobro= "SELECT * from cobros ORDER BY id_cobro DESC LIMIT 1 ";
                        // $resultadocobro=$conexionDB->query($cobro);
                        // $row_cobro= $resultadocobro->fetch_object();
                        // $id_cobro= $row_cobro->id_cobro;
        
                        if (!$queryVentas)
                            throw new exception ($conexionDB->error);
                        {  
                            $sql="INSERT INTO detalle_cobro (id_cobro, id_tipo_ingreso, id_mes,  mont_unitario, cantidad, mont_total)
                                VALUES (".$conexionDB->insert_id.",'$id_tipo_ingreso', '1', '$monto_tipo_ingreso','1','$monto_tipo_ingreso')";
                            $queryVentas_Item=$conexionDB->query($sql);

                            if (!$queryVentas_Item)
                                throw new exception ($conexionDB->error);
                            
                            {
                                $conexionDB->commit();
                                header('Location: ../facturacion_index.php?mensaje=registrado');
                            }
                        }
                    }
                }
/***********************************************************         FIN PROCESO INSCRIPCION         *************************************************************************************/                
/*****************************************************************************************************************************************************************************************/
/*****************************************************************************************************************************************************************************************/
/***********************************************************         INICIO PROCESO REINSCRIPCION         ********************************************************************************/
                if(isset($_POST['reinscripcion_submit'])){
                    $id_tipo_ingreso_reins= $conexionDB->escape_string($_POST['id_tipo_ingreso_reins']);
                    $monto_tipo_ingreso_reins= $conexionDB->escape_string($_POST['monto_tipo_ingreso_reins']);
                    $id_legajo= $_POST['id_legajo_reins'];

                    if($id_legajo){
                        //Actualizar el primer registro 
                        $upinscripcion="UPDATE cuotas SET cuotas_estado='0'
                        WHERE legajo='$id_legajo'
                        AND id_mes!='1'";
                        $conexionDB->query($upinscripcion);

                        //actualizar saldo de caja con monto inicial + monto ingresado por reinscripcion
                        $saldo_caja= $row_caja->saldo_caja;
                        $saldo_caja+= $monto_tipo_ingreso_reins;
                        $upcajacuota="UPDATE caja SET saldo_caja='$saldo_caja'
                        WHERE id_caja='$id_caja'";
                        $conexionDB->query($upcajacuota);

                        ////////////////////////////////////////////      FACTURACION DE CUOTA     ///////////////////////////////////////////////////////////////////////////////////////////

                        $insert_cobro_reins= "INSERT INTO cobros(id_caja, legajo, total_cobros, fch_cobro, hr_cobro, fch_limite)
                                                    VALUES ('$id_caja', '$id_legajo', '$monto_tipo_ingreso_reins', curdate(), curtime(), curdate())";
                        $queryVentas_reins=$conexionDB->query($insert_cobro_reins);

                        if (!$queryVentas_reins)
                            throw new exception ($conexionDB->error);
                        {  
                            $sql="INSERT INTO detalle_cobro (id_cobro, id_tipo_ingreso, id_mes,  mont_unitario, cantidad, mont_total)
                                VALUES (".$conexionDB->insert_id.",'$id_tipo_ingreso_reins', '1', '$monto_tipo_ingreso_reins','1','$monto_tipo_ingreso_reins')";
                            $queryVentas_Item=$conexionDB->query($sql);
                            
                            if (!$queryVentas_Item)
                                throw new exception ($conexionDB->error);
                            {
                                //Recuperar ultimo id de cobro para cargar en detalle
                        $cobro= "SELECT * from cobros ORDER BY id_cobro DESC LIMIT 1 ";
                        $resultadocobro=$conexionDB->query($cobro);
                        $row_cobro= $resultadocobro->fetch_object();
                        $id_cobro= $row_cobro->id_cobro;
                                $conexionDB->commit();
                                //header('Location: ../reportes/index_factura.php?id_cobro='.$id_cobro.'&id_legajo='.$id_legajo);
                                header('Location: ../facturacion_index.php?mensaje=reinscripcion_exitosa');
                            }
                            
                        }
                    }else{
                        header('Location: ../facturacion_index.php?mensaje=jugador_notfound');
                    }
                }
/***********************************************************         FIN PROCESO REINSCRIPCION            *************************************************************************************/
/**********************************************************************************************************************************************************************************************/
/**********************************************************************************************************************************************************************************************/
                if(isset($_POST['cuotas'])){
/***********************************************************         INICIO PROCESO CUOTAS         ********************************************************************************************/
                    $id_tipo_ingreso_cuota= $conexionDB->escape_string($_POST['id_tipo_ingreso_cuota']);
                    $tipo_ingreso_cuota= $conexionDB->escape_string($_POST['tipo_ingreso_cuota']);
                    $monto_tipo_ingreso_cuota= $conexionDB->escape_string($_POST['monto_tipo_ingreso_cuota']);

                    $id_legajo= $_POST['id_legajo_cuotas'];
                    $monto_total_abonar= $_POST['monto_total_abonar'];

                    //////////////////////////////      ACTUALIZAR ESTADO DE CUENTA POR MES INGRESADO     //////////////////////////////////////////////////////////////////////////////////////
                    if(!empty($_POST['mes'])){
                        foreach($_POST['mes'] as $mes){

                            $upcuotas="UPDATE cuotas SET cuotas_estado='1'
                                            WHERE legajo='$id_legajo'
                                            AND id_mes='$mes'";
                            $conexionDB->query($upcuotas);

                        }

                        //actualizar saldo de caja con monto inicial + monto ingresado por cuotas
                        $saldo_caja= $row_caja->saldo_caja;
                        $saldo_caja+= $monto_total_abonar;
                        $upcajacuota="UPDATE caja SET saldo_caja='$saldo_caja'
                        WHERE id_caja='$id_caja'";
                        $conexionDB->query($upcajacuota);


                    ////////////////////////////////////////////      FACTURACION DE CUOTA     ///////////////////////////////////////////////////////////////////////////////////////////

                        $insert_cobro_cuota= "INSERT INTO cobros(id_caja, legajo, total_cobros, fch_cobro, hr_cobro, fch_limite)
                                        VALUES ('$id_caja', '$id_legajo', '$monto_total_abonar', curdate(), curtime(), curdate())";
                        $queryVentas_cuota=$conexionDB->query($insert_cobro_cuota);

                        //Recuperar ultimo id de cobro para cargar en detalle
                        $cobro= "SELECT * from cobros ORDER BY id_cobro DESC LIMIT 1 ";
                        $resultadocobro=$conexionDB->query($cobro);
                        $row_cobro= $resultadocobro->fetch_object();
                        $id_cobro= $row_cobro->id_cobro;

                        if (!$queryVentas_cuota)
                            throw new exception ($conexionDB->error);
                        {  
                            foreach($_POST['mes'] as $mes_id){
                                $sql_cuota="INSERT INTO detalle_cobro (id_cobro, id_tipo_ingreso, id_mes, mont_unitario, cantidad, mont_total)
                                    VALUES ('$id_cobro','$id_tipo_ingreso_cuota', '$mes_id', '$monto_tipo_ingreso_cuota','1','$monto_total_abonar')";
                                $queryVentas_Item=$conexionDB->query($sql_cuota);
                            }
                            
                            if (!$queryVentas_Item)
                                throw new exception ($conexionDB->error);
                            {
                                $conexionDB->commit();
                                header('Location: ../facturacion_index.php?mensaje=cuota_abonada');
                            }
                            
                        }

                    }else{
                        header('Location: ../facturacion_index.php?mensaje=error_mes');
                    }

                }

            }else{
                header('Location: ../facturacion_index.php?mensaje=caja_cerrada');
            }
        }
        catch (Exception $ex)
        {
            $conexionDB->rollback();
            echo "Ocurrió un error al intentar grabar la Venta!". $ex->getMessage();
        }

    
?>