<?php 
session_start();
if(isset($_SESSION['usuario'])&&isset($_SESSION['id_persona'])){
include 'conexiondb_club.php';
include 'template/header.html';
?>
<body class="sb-nav-fixed">

    <!-- MENU PARTE SUPERIOR -->
<?php 
    include 'template/navbar_top.html';
?>
    <!-- MENU PARTE SUPERIOR -->

    <div id="layoutSidenav">
        <!-- MENU BARRA LATERAL -->
    <?php 
        include 'template/navbar_lateral.html';
    ?>
        <!-- MENU BARRA LATERAL -->


        <div id="layoutSidenav_content">
            <main class="p-3">
                <!-- TITLE Y BREADCUMB -->
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <h1>Control de Caja Diaria</h1>
                        </div>
                        <div class="col-12 col-md-6 my-2">
                            <ol class="breadcrumb" style="float: right;">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                                <li class="breadcrumb-item active">Control de Caja Diaria</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!---------------------->

                <!-- INICIO DATATABLE -->
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12 col-md-8 border border-1 rounded py-3 table-responsive">
                            <table id="example" class="table table-light table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>N°</th>
                                        <th>Jugador</th>
                                        <th>Fecha y hora</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Ver detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
        <?php                       
                                $sqlcaja="SELECT id_caja, ord_apertura FROM caja ORDER BY id_caja DESC LIMIT 1";

                                $result_caja=$conexionDB->query($sqlcaja);
                                $est_caja=$result_caja->fetch_object();
                                if($est_caja->ord_apertura == 0){
        ?>
                                    <tr>
                                        <td colspan="5" class="text-center"><span><strong>No se puede visualizar los movimientos de caja porque esta se encuentra cerrada</strong></span></td>
                                    </tr>
        <?php                           
                                }else{                  
                                $sql="SELECT * FROM cobros INNER JOIN alumnos ON cobros.legajo=alumnos.legajo 
                                        INNER JOIN personasxrol ON alumnos.id_usuario=personasxrol.id_usuario 
                                        INNER JOIN personas ON personasxrol.id_persona=personas.id_persona 
                                        INNER JOIN caja ON cobros.id_caja=caja.id_caja WHERE caja.ord_apertura='1' ORDER BY id_cobro DESC";
                                $resultado=$conexionDB->query($sql);
                                if(mysqli_num_rows($resultado)>=1){

                                $total_caja_diaria=0;
                                    
                                while($fila= $resultado->fetch_object()){
        ?>
                                    <tr>
                                        <td class="col-1 fw-bold" style="color:#C10707;" scope="row"><?php echo $fila->id_cobro ;?></td>
                                        <td class="col-4 fw-bold" style="color:#0026BF;"><?php echo $fila->nom_persona. ' ' .$fila->ape_persona;?></td>
                                        <td class="col-3"><?php echo $fila->fch_cobro.' <strong>|</strong> ',$fila->hr_cobro;; ?></td>
                                        <td class="col-2 text-end text-success" ><strong><?php echo '$ '.number_format($fila->total_cobros,2,'.','')?></strong></td>
                                        <td class="col-2 text-center">
                                            <button type="button" style="border:none; background-color:transparent;">
                                                <a href="arqueo_caja_detalle.php?codigo=<?php echo$fila->id_cobro;?>" style="color:#53CA0A;" ><i class="bi bi-eye-fill"></i></a> 
                                            </button>
                                        </td>
                                    </tr>
        <?php  
                                $total_caja_diaria+=$fila->total_cobros;
                                }
                                }else{
        ?>
                                    <tr>
                                        <td colspan="5" class="text-center"><span><strong>Aun no se han realizado movimientos de caja por facturaci&oacute;n o cobro de cuotas</strong></span></td>
                                    </tr>
        <?php 
                                    }
                                }
        ?>
                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>TOTAL:</strong></td>
                                        <td class="text-end"><strong class="text-danger">$ <?php echo number_format($total_caja_diaria,2,'.','') ?></strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- FIN DATATABLE -->
            </main>
            <footer class="text-body-secondary py-3">
                <div class="container">
                <div class="text-center">
                    <p class="mb-1">&copy; Matias Palmero. All Rights Reserved</p>
                </div>
                </div>
            </footer>
        </div>
        <!-- END CONTAINER DATATABLE -->
    </div>


<!-- SCRIPTS-->
<?php 
    include 'template/footer_scripts.html';
?>
<!--------------------------------->

</body>
</html>
<?php 
}else{
    header("Location: login/login_index.php");
}
?>