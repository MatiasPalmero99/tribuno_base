<?php 
session_start();
if(isset($_SESSION['usuario'])&&isset($_SESSION['id_persona'])){
include 'template/header_admin.html'; 
include 'conexiondb_club.php';

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12 col-md-6">
                    <h1>Actividades</h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->
                </div>
                <div class="col-12 col-md-6 my-2">
                    <ol class="breadcrumb" style="float: right;">
                        <!-- <li class="breadcrumb-item"><a href="index.php">Inicio</a></li> -->
                        <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                        <li class="breadcrumb-item active">Actividades</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-4 justify-content-center">
                <div class="col-12 col-md-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" style="float:right; width:200px;" data-target="#alta">
                        <i class="bi bi-plus-circle" style="font-size:17px;"></i>&nbsp;&nbsp;Nueva Actividad
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
<!-----------------------------------FIN ALERTAS------------------------------------------------------------->
            <div class="row">
                <div class="col-12 col-md-8  border border-1 rounded py-3">
                    <table id="datatablesSimple" class="table table-success table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Actividades</th>
                                <th class="text-center" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Actividades</th>
                                <th class="text-center" colspan="2">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
<?php
                            $sql= "SELECT*FROM actividades";
                            $resultado=$conexionDB->query($sql);     
                            while($fila= $resultado->fetch_object()){
?>
                            <tr>
                                <td class="col-1" scope="row"><?php echo $fila->id_actividad ?></td>
                                <td class="col-9"><?php echo $fila->nombre_actividad ?></td>
                                <td class="col-1 text-center">
                                    <button type="button" class="text-success" style="border:none; background-color:transparent;" title="Editar" data-toggle="modal" data-target="#modal-edit-actividad-<?php echo $fila->id_actividad?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <!-- <a href="personas_editar.php?codigo=<?php echo $fila->id_actividad?>" class="text-success"><i class="bi bi-pencil-square"></i></a> -->
                                </td>   
                                <td class="col-1 text-center">
                                    <button type="button" class="text-danger" style="border:none; background-color:transparent;" title="Borrar" data-toggle="modal" data-target="#borrar-<?php echo$fila->id_actividad?>">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    <!-- <a onclick="return confirm('¿Está seguro que desea eliminar este cliente de la base de datos?');" href="admin/abm-personas.php?codigo=<?php echo $fila->id_actividad?>" class="text-danger"><i class="bi bi-trash-fill"></i></a> -->
                                </td>
                            </tr>

                            <!-- Modal Alta-->
                            <div class="modal fade" id="alta" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Nueva Actividad</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="form-nueva_actividad" action='admin/abm-actividades.php' method="POST">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre_actividad" class="form-label">Actividad:</label>
                                                            <input type="text" class="form-control" id="nombre_actividad" name="nombre_actividad" required>
                                                            <div id="actHelp" class="form-text">Ingresar la actividad.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="Cargar" name="Cargar" type="submit" class="btn btn-success">Cargar datos</button>
                                                <button type="button" class="btn bg-danger text-white" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal Delete-->
                            <div class="modal fade" id="borrar-<?php echo $fila->id_actividad?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Confirmar Operación</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="form-delete-actividad" action='admin/abm-actividades.php' method="POST">
                                            <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_actividad;?>">
                                            <div class="modal-body">
                                                <span>
                                                    ¿Realmente desea eliminar la actividad <strong><?php echo $fila->nombre_actividad; ?></strong> de la base de datos?
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

                            <!-- Modal Edit-->
<?php  
                            include('actividades_editar.php');
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