<?php 
require('../conexiondb_club.php');
session_start();
if(isset($_SESSION['usuario'])&&isset($_SESSION['id_persona'])){

    $id_usuario=$_SESSION['id_usuario'];
    if(isset($_POST['abrir_caja']) && ($_POST['abrir_caja']) == 'Abrir Caja'){
        if(!empty($_POST['caja_monto_inicial']) || !empty($_POST['caja_observaciones'])){

            $mon_ini= $_POST['caja_monto_inicial'];
            $caja_obs= $_POST['caja_observaciones'];


            $sql= "INSERT INTO caja (id_usuario, mon_ini, observaciones_caja, saldo_caja, fch_apert, hr_apert, fch_cierre, hr_cierre, ord_apertura, total_ingreso, total_egreso)
                    VALUES ('$id_usuario','$mon_ini','$caja_obs','0', curdate(), curtime(), NULL, NULL, '1', '0', '0')";

            if($conexionDB->query($sql) === true){
                header('Location: ../apertura_form.php');
            }else{
                header('Location: ../apertura_form.php?error');
                exit();
            }
        }else{
            header('Location: ../apertura_form.php?error_carga_de_datos');
        }

    }

    if(isset($_POST['cerrar_caja']) && ($_POST['cerrar_caja']) == 'Cerrar Caja'){

            $total= "SELECT id_caja, mon_ini, saldo_caja from caja ORDER BY id_caja DESC LIMIT 1 ";
            $resultado=$conexionDB->query($total);
            $row= $resultado->fetch_object();
            $id_caja= $row->id_caja;
            $sum_total_caja= $row->mon_ini + $row->saldo_caja;

            $sql= "UPDATE caja SET fch_cierre=curdate() ,hr_cierre=curtime(), ord_apertura= '0', total_ingreso='$sum_total_caja'
                    WHERE id_caja='$id_caja'";

            if($conexionDB->query($sql) === true){
                header('Location: ../apertura_form.php');
            }else{
                header('Location: ../apertura_form.php?error');
                exit();
            }

    }
}else{
    header("Location: login/login_index.php");
}
?>