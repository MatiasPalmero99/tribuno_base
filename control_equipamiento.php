<?php 
session_start();
if(isset($_SESSION['usuario'])&&isset($_SESSION['id_persona'])){
include 'template/header_admin.html' ; 
include 'conexiondb_club.php';

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12 col-md-6">
                    <h1>Control de Equipamiento</h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->
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
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12 col-md-8  border border-1 rounded py-3">
                    <table id="datatablesSimple" class="table table-light table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Descripción de ajustes realizados</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Descripción de ajustes realizados</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </tfoot>
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
                                <!-- <td class="text-center">
                                    <button type="button" class="text-success" style="border:none; background-color:transparent;" title="Editar" data-toggle="modal" data-target="#modal-edit-ajuste-<?php echo$fila->id_ajuste;?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>   
                                <td class="text-center">
                                    <button type="button" class="text-danger" style="border:none; background-color:transparent;" title="Borrar" data-toggle="modal" data-target="#modal-delete-usuario-<?php echo$fila->id_ajuste;?>"
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td> -->
                            </tr>

<?php  
                            }  
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
<?php 
include 'template/footer_admin.html' ; 
}else{
    header("Location: login/login_index.php");
}
?>

