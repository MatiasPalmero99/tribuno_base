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

        <!-----------------------------------INICIO ALERTAS------------------------------------------------------------->
        <div class="row justify-content-center">
                <div class="col-12 col-md-11">
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


        <div id="layoutSidenav_content">
            <main>
                <!-- TITLE Y BREADCUMB -->
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <h1>Personas</h1>
                        </div>
                        <div class="col-12 col-md-6 my-2">
                            <ol class="breadcrumb" style="float: right;">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                                <li class="breadcrumb-item active">Personas</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!---------------------->

                <!-- INICIO DATATABLE -->
                <div class="container-fluid">
                    <div class="row mb-4 justify-content-center">
                        <div class="col-12 col-md-11">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" style="float:right; width:200px;" data-bs-target="#modal-nuevo-usuario">
                                <i class="bi bi-plus-circle" style="font-size:17px;"></i>&nbsp;&nbsp; Nuevo usuario
                            </button>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-11 border border-1 rounded table-responsive">
                            <table id="example" class="table table-light table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre y Apellido</th>
                                        <th>DNI</th>
                                        <th>Celular</th>
                                        <th>Correo Electrónico</th>
                                        <th>Domicilio</th>
                                        <th>Rol</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Modal Alta-->
                                    <div class="modal fade" id="modal-nuevo-usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Nuevo usuario</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="form-nuevo-usuario" action='admin/abm-personas.php' method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="nom_persona" class="form-label">Nombre:</label>
                                                                        <input type="text" class="form-control" id="nom_persona" name="nom_persona" required>
                                                                        <div id="nombreHelp" class="form-text">Ingresar nombre completo.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="ape_persona" class="form-label">Apellido:</label>
                                                                        <input type="text" class="form-control" id="ape_persona" name="ape_persona" required>
                                                                        <div id="idHelp" class="form-text">Ingresar apellido/s.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="dni_persona" class="form-label">DNI:</label>
                                                                        <input type="number" class="form-control" id="dni_persona" name="dni_persona" required>
                                                                        <div id="DniHelp" class="form-text">Ingresar DNI.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="cel_persona" class="form-label">Número de celular</label>
                                                                        <input type="number" class="form-control" id="cel_persona" name="cel_persona" required>
                                                                        <div id="celHelp" class="form-text">Ingrese número de celular para contactarnos.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="correo_persona" class="form-label">Correo electrónico</label>
                                                                        <input type="email" class="form-control" id="correo_persona" name="correo_persona" required>
                                                                        <div id="emailHelp" class="form-text">Ingrese una dirección de correo electrónico.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="nom_usuario" class="form-label">Nombre de Usuario</label>
                                                                        <input type="text" class="form-control" id="nom_usuario" name="nom_usuario" required>
                                                                        <div id="UsuHelp" class="form-text">Ingresar nombre de usuario al sistema.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="password" class="form-label">Contraseña</label>
                                                                        <input type="password" class="form-control" id="password" name="password" required>
                                                                        <div id="PassHelp" class="form-text">Ingresar su contraseña.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="domicilio_persona" class="form-label">Domicilio</label>
                                                                        <input type="text" class="form-control" id="domicilio_persona" name="domicilio_persona" required>
                                                                        <div id="DomHelp" class="form-text">Ingresar domicilio.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="fch_nac_persona" class="form-label">Fecha de nacimiento</label>
                                                                        <input type="date" class="form-control" id="fch_nac_persona" name="fch_nac_persona" required>
                                                                        <div id="FchNacHelp" class="form-text">Ingrese la fecha de nacimiento.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" id="Cargar" name="Cargar" title="Cargar">Cargar datos</button>
                                                            <button type="button" class="btn btn-secondary bg-danger text-white" title="Cancelar" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Alta-->
                                    <div class="modal fade" id="modal-nuevo-usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Nuevo usuario</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form id="form-nuevo-usuario" action='admin/abm-personas.php' method="POST">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="nom_persona" class="form-label">Nombre:</label>
                                                                    <input type="text" class="form-control" id="nom_persona" name="nom_persona" required>
                                                                    <div id="nombreHelp" class="form-text">Ingresar nombre completo.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="ape_persona" class="form-label">Apellido:</label>
                                                                    <input type="text" class="form-control" id="ape_persona" name="ape_persona" required>
                                                                    <div id="idHelp" class="form-text">Ingresar apellido/s.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="dni_persona" class="form-label">DNI:</label>
                                                                    <input type="number" class="form-control" id="dni_persona" name="dni_persona" required>
                                                                    <div id="DniHelp" class="form-text">Ingresar DNI.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="cel_persona" class="form-label">Número de celular</label>
                                                                    <input type="number" class="form-control" id="cel_persona" name="cel_persona" required>
                                                                    <div id="celHelp" class="form-text">Ingrese número de celular para contactarnos.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="correo_persona" class="form-label">Correo electrónico</label>
                                                                    <input type="email" class="form-control" id="correo_persona" name="correo_persona" required>
                                                                    <div id="emailHelp" class="form-text">Ingrese una dirección de correo electrónico.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="nom_usuario" class="form-label">Nombre de Usuario</label>
                                                                    <input type="text" class="form-control" id="nom_usuario" name="nom_usuario" required>
                                                                    <div id="UsuHelp" class="form-text">Ingresar nombre de usuario al sistema.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="password" class="form-label">Contraseña</label>
                                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                                    <div id="PassHelp" class="form-text">Ingresar su contraseña.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="domicilio_persona" class="form-label">Domicilio</label>
                                                                    <input type="text" class="form-control" id="domicilio_persona" name="domicilio_persona" required>
                                                                    <div id="DomHelp" class="form-text">Ingresar domicilio.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="fch_nac_persona" class="form-label">Fecha de nacimiento</label>
                                                                    <input type="date" class="form-control" id="fch_nac_persona" name="fch_nac_persona" required>
                                                                    <div id="FchNacHelp" class="form-text">Ingrese la fecha de nacimiento.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="Cargar" name="Cargar" type="submit" title="Cargar" class="btn btn-success">Cargar datos</button>
                                                        <button type="button" class="btn bg-danger text-white" title="Cancelar" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
        <?php                       
                                $sql= "SELECT 
                                        personas.id_persona,
                                        personas.nom_persona,
                                        personas.ape_persona,
                                        personas.dni_persona,
                                        personas.cel_persona,
                                        personas.correo_persona,
                                        personas.nom_usuario,
                                        personas.password,
                                        personas.domicilio_persona,
                                        personas.fch_nac_persona,

                                        personasxrol.id_usuario,
                                        personasxrol.id_persona,
                                        personasxrol.id_rol,

                                        rol.id_rol,
                                        rol.nombre_rol

                                        FROM personas 
                                        INNER JOIN personasxrol ON personasxrol.id_persona=personas.id_persona
                                        INNER JOIN rol ON rol.id_rol=personasxrol.id_rol
                                        ORDER BY personas.id_persona DESC";

                                $resultado=$conexionDB->query($sql);     
                                while($fila= $resultado->fetch_object()){
        ?>
                                <tr>
                                    <td class="fw-bold" scope="row" style="color:#C10707;"><strong><?php echo $fila->id_persona ?></strong></td>
                                    <td class="fw-bold" style="color:#0026BF;"><?php echo $fila->nom_persona.' '.$fila->ape_persona; ?></td>
                                    <td class="text-primary"><?php echo $fila->dni_persona ?></td>
                                    <td><?php echo $fila->cel_persona ?></td>
                                    <td><?php echo $fila->correo_persona ?></td>
                                    <td><?php echo $fila->domicilio_persona ?></td>
                                    <td class="fw-bold" style="color:#F99905;"><?php echo $fila->nombre_rol ?></td>
                                    <td><?php echo $fila->fch_nac_persona ?></td>
                                    <td class="text-center">
                                        <button type="button" class="text-info" style="border:none; background-color:transparent;" title="Asignar rol" data-toggle="modal" data-target="#modal-rol-usuario-<?php echo $fila->id_persona;?>">
                                            <i class="bi bi-person-rolodex"></i>
                                        </button>
                                    </td> 
                                    <td class="text-center">
                                        <button type="button" style="border:none; background-color:transparent;color:#53CA0A;" title="Editar" data-toggle="modal" data-target="#modal-edit-usuario-<?php echo $fila->id_persona;?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>   
                                    <td class="text-center">
                                        <button type="button" class="text-danger" style="border:none; background-color:transparent;" title="Borrar" data-toggle="modal" data-target="#modal-delete-usuario-<?php echo $fila->id_persona;?>">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>


                                <!-- Modal Delete-->
                                <div class="modal fade" id="modal-delete-usuario-<?php echo $fila->id_persona;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Confirmar Operación</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form id="form-delete-usuario" action='admin/abm-personas.php' method="POST">
                                                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_persona;?>">
                                                <div class="modal-body">
                                                    <span>
                                                        ¿Realmente desea eliminar a <strong><?php  echo $fila->nom_persona.' '.$fila->ape_persona;?></strong> de la base de datos?
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

                                 <!-- Modal Rol-->
                                <div class="modal fade" id="modal-rol-usuario-<?php echo $fila->id_persona;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Asignar rol a <strong><?php echo $fila->nom_persona.' '.$fila->ape_persona; ?></strong></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action='admin/abm-personas.php' method="POST">
                                                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_persona;?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="rol_pers" class="form-label">Roles: </label>
                                                        <select class="form-select" id="rol_pers" name="rol_pers">
                                                            <option value="" selected="selected">~ Seleccionar rol ~</option>

        <?php
                                                        $sqlrol= "SELECT*FROM rol";
                                                        $resultrol=$conexionDB->query($sqlrol);     
                                                        while($rol= $resultrol->fetch_object()){
        ?>
                                                            <option value="<?php echo $rol->id_rol ?>"><?php echo $rol->nombre_rol ?></option>
        <?php
                                                        }
        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="asign_rol" name="asign_rol" type="submit" class="btn btn-success">Aceptar</button>
                                                    <button type="button" class="btn bg-danger text-white" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Edit-->
        <?php                           
                                include('personas_editar.php');
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