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
                    <h1>Equipamiento</h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->
                </div>
                <div class="col-12 col-md-6 my-2">
                    <ol class="breadcrumb" style="float: right;">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                        <li class="breadcrumb-item active">Equipamiento</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-4 justify-content-center">
                <div class="col-12 col-md-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" style="float:right; width:220px;" data-target="#modal-nuevo-equipamiento">
                        <i class="bi bi-plus-circle" style="font-size:17px;"></i>&nbsp;&nbsp;Nuevo Equipamiento
                    </button>
                </div>
            </div>
<!-----------------------------------INICIO ALERTAS------------------------------------------------------------->
            <div class="row">
                <div class="col-12 col-md-8">
<?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){

?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>ERROR:</strong> Rellena todos los campos!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

<?php
                    }
?>

<?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
                            
?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Registrado!</strong> Se han guardado los datos con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

<?php
                    }
?>

<?php   
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
                            
?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Vuelve a intentar.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

<?php
                    }
?>

<?php           
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
                            
?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Listo!</strong> Los datos fueron actualizados.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

<?php
                    }
?>

<?php           
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
                            
?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>¡Eliminado! </strong> Los datos fueron borrados. 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
<?php
                    }
?>
                </div>
            </div>
<!-----------------------------------INICIO ALERTAS------------------------------------------------------------->
            <div class="row">
                <div class="col-12 col-md-8  border border-1 rounded py-3">
                    <table id="datatablesSimple" class="table table-light table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Equipamiento</th>
                                <th>Cantidad</th>
                                <th class="text-center" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Equipamiento</th>
                                <th>Cantidad</th>
                                <th class="text-center" colspan="2">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
<?php
                            $sql= "SELECT*FROM equipamiento";
                            $resultado=$conexionDB->query($sql);     
                            while($fila= $resultado->fetch_object()){
?>
                            <tr>
                                <td class="col-1 fw-bold" style="color:#C10707;" scope="row"><?php echo $fila->id_equipamiento ?></td>
                                <td class="col-7 fw-bold" style="color:#0026BF;"><?php echo $fila->nom_equipamiento ?></td>
                                <td class="col-2"><?php echo $fila->cantidad ?></td>
                                <td class="col-1 text-center">
                                    <button type="button" style="border:none; background-color:transparent;color:#53CA0A;" title="Editar" data-toggle="modal" data-target="#modal-edit-equipamiento-<?php echo $fila->id_equipamiento;?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <!-- <a href="personas_editar.php?codigo=<?php echo $fila->id_equipamiento?>" class="text-success"><i class="bi bi-pencil-square"></i></a> -->
                                </td>   
                                <td class="col-1 text-center">
                                    <button type="button" class="text-danger" style="border:none; background-color:transparent;" title="Borrar" data-toggle="modal" data-target="#modal-delete-equipamiento-<?php echo $fila->id_equipamiento;?>">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    <!-- <a onclick="return confirm('¿Está seguro que desea eliminar este cliente de la base de datos?');" href="admin/abm-personas.php?codigo=<?php echo $fila->id_equipamiento?>" class="text-danger"><i class="bi bi-trash-fill"></i></a> -->
                                </td>
                            </tr>

                            <!-- Modal Alta-->
                            <div class="modal fade" id="modal-nuevo-equipamiento" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Nuevo equipamiento</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="form-nuevo-equipamiento" action='admin/abm-equipamiento.php' method="POST">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nom_persona" class="form-label">Equipamiento:</label>
                                                            <input type="text" class="form-control" id="nom_equipamiento" name="nom_equipamiento" required>
                                                            <div id="nombreHelp" class="form-text">Ingresar Equipamiento.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ape_persona" class="form-label">Cantidad:</label>
                                                            <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                                                            <div id="idHelp" class="form-text">Ingresar cantidad.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="Cargar" name="Cargar" type="submit" class="btn btn-success">Cargar Datos</button>
                                                <button type="button" class="btn bg-danger text-white" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Borrar-->
                            <div class="modal fade" id="modal-delete-equipamiento-<?php echo $fila->id_equipamiento;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Confirmar Operación <?php echo $fila->id_equipamiento;?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="form-delete-equipamiento" action='admin/abm-equipamiento.php' method="POST">
                                            <input type="hidden" id="codigo_equip" name="codigo_equip" value="<?php echo$fila->id_equipamiento;?>">
                                            <div class="modal-body">
                                                <span>
                                                    ¿Realmente desea eliminar <strong><?php  echo $fila->cantidad; echo ' '.$fila->nom_equipamiento;?></strong> de la base de datos?
                                                </span>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="Eliminar" name="Eliminar" type="submit" class="btn btn-success">Aceptar</button>
                                                <button type="button" class="btn bg-danger text-white" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
<?php  
                            include('equipamiento_editar.php');
                            }  
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


  
    
<?php include 'template/footer_admin.html' ; 
}else{
    header("Location: login/login_index.php");
}
?>