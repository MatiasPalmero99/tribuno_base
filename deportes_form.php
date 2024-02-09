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
                            <h1>Deportes</h1>
                        </div>
                        <div class="col-12 col-md-6 my-2">
                            <ol class="breadcrumb" style="float: right;">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                                <li class="breadcrumb-item active">Deportes</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!---------------------->

                <!-- INICIO DATATABLE -->
                <div class="container-fluid">
                    <div class="row mb-4 justify-content-center">
                        <div class="col-12 col-md-4">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" style="float:right; width:200px;" data-bs-target="#modal-nuevo-deporte">
                                <i class="bi bi-plus-circle" style="font-size:17px;"></i>&nbsp;&nbsp; Nuevo deporte
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
                        <div class="col-12 col-md-8 border border-1 rounded table-responsive py-3">
                            <table id="example" class="table table-light table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Deporte</th>
                                        <th>Cupos</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

        <?php
                                    $sql= "SELECT*FROM deportes";
                                    $resultado=$conexionDB->query($sql);     
                                    while($fila= $resultado->fetch_object()){
        ?>
                                    <tr>
                                        <td class="col-1 fw-bold" style="color:#C10707;" scope="row"><?php echo $fila->id_deporte ?></td>
                                        <td class="col-5 fw-bold" style="color:#0026BF;"><?php echo ucfirst($fila->nom_deporte); ?></td>
                                        <td class="col-4"><?php echo $fila->cupos ?></td>                        
                                        
                                        <td class="col-1 text-center">
                                            <button type="button" style="border:none; background-color:transparent;color:#53CA0A;" title="Editar" data-bs-toggle="modal" data-bs-target="#modal-edit-deporte-<?php echo $fila->id_deporte;?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>   
                                        <td class="col-1 text-center">
                                            <button type="button" class="text-danger" style="border:none; background-color:transparent;" title="Borrar" data-bs-toggle="modal" data-bs-target="#modal-delete-deporte-<?php echo $fila->id_deporte;?>">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Alta-->
                                    <div class="modal fade" id="modal-nuevo-deporte" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Nuevo Deporte</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form id="form-nuevo-deporte" action='admin/abm-deportes.php' method="POST">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nom_deporte" class="form-label">Nombre del Deporte:</label>
                                                                    <input type="text" class="form-control" id="nom_deporte" name="nom_deporte" required>
                                                                    <div id="nombredepHelp" class="form-text">Ingresar nombre deporte.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="cupos" class="form-label">Cupos:</label>
                                                                    <input type="text" class="form-control" id="cupos" name="cupos" required>
                                                                    <div id="cuposHelp" class="form-text">Ingresar cupos.</div>
                                                                </div>
                                                            </div>                            
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="Cargar" name="Cargar" type="submit" class="btn btn-success">Cargar datos</button>
                                                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Borrar-->
                                    <div class="modal fade" id="modal-delete-deporte-<?php echo $fila->id_deporte;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Confirmar Operación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form id="form-delete-deporte" action='admin/abm-deportes.php' method="POST">
                                                    <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_deporte;?>">
                                                    <div class="modal-body">
                                                        <span>
                                                            ¿Realmente desea eliminar el deporte <strong><?php echo $fila->nom_deporte;?></strong> de la base de datos?
                                                        </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="Eliminar" name="Eliminar" type="submit" class="btn btn-success">Aceptar</button>
                                                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Cancelar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <!-- Modal Edit-->
<?php  
                            include('deportes_editar.php');
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