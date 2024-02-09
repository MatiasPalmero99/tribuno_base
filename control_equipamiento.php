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
            <main>
                <!-- TITLE Y BREADCUMB -->
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <h1>Control de Equipamiento</h1>
                        </div>
                        <div class="col-12 col-md-6 my-2">
                            <ol class="breadcrumb" style="float: right;">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                                <li class="breadcrumb-item active">Control de Equipamiento</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!---------------------->

                <!-- INICIO DATATABLE -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-8 border border-1 rounded table-responsive py-3">
                            <table id="example" class="table table-light table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Descripción de ajustes realizados</th>
                                        <th>Fecha y Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
        <?php
                                    $sql= "SELECT id_ajuste, 
                                                descripcion, 
                                                id_equipamiento, 
                                                DATE_FORMAT(fch_ajuste, '%d/%m/%Y %H:%i') AS fecha
                                                FROM ajustes 
                                                ORDER BY id_ajuste DESC";
                                    $resultado=$conexionDB->query($sql);     
                                    while($fila= $resultado->fetch_object()){
        ?>
                                    <tr>
                                        <td class="col-1 fw-bold" style="color:#C10707;" scope="row"><?php echo $fila->id_ajuste; ?></td>
                                        <td class="col-9" style="color:#0026BF;"><?php echo ucfirst($fila->descripcion); ?></td>
                                        <td class="col-2 text-success"><?php echo ucfirst($fila->fecha); ?></td>
                                    </tr>

<?php  
                            }  
?>
                                </tbody>      
                                <tfoot>
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