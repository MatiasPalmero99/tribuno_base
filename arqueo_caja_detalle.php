<?php

$idcobro=$_GET['codigo'];
?>

<?php 
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
                        <h1>Detalle de Cobro</h1>
                </div>
                <div class="col-12 col-md-6 my-2">
                    <ol class="breadcrumb" style="float: right;">
                        <!-- <li class="breadcrumb-item"><a href="index.php">Inicio</a></li> -->
                        <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                        <li class="breadcrumb-item"><a href="arqueo_caja.php">Control de Caja Diaria</a></li>
                        <li class="breadcrumb-item active">Detalle de Cobro</li>
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
                                <th>N° de operaci&oacute;n</th>     
                                <th>Tipo de ingreso</th>
                                <th>Mes</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $sql= "SELECT*FROM detalle_cobro INNER JOIN tipo_ingreso ON detalle_cobro.id_tipo_ingreso=tipo_ingreso.id_tipo_ingreso
                                   INNER JOIN mes ON detalle_cobro.id_mes=mes.id_mes WHERE id_cobro='$idcobro'";
                            $resultado=$conexionDB->query($sql);

                            $resultado_total=$conexionDB->query($sql);
                            $row_det_cobro= $resultado_total->fetch_object();
                            while($fila= $resultado->fetch_object()){
?>
                            <tr>    
                                <td class="col-1 fw-bold" style="color:#C10707;"><?php echo $fila->id_det_cobro ?></td>
                                <td class="col-4 fw-bold" style="color:#0026BF;"><?php echo $fila->tipo_ingreso ?></td>
                                <td class="text-primary"><strong><?php echo $fila->nombre ?></strong></td>
                                <td class="text-end"><strong class="text-success">$ <?php echo number_format($fila->mont_unitario,2,'.','')?></strong></td>
                            </tr>
<?php
                            }
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>TOTAL:</strong></td>
                                <td class="text-end"><strong class="text-danger">$ <?php echo number_format($row_det_cobro->mont_total,2,'.','') ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
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