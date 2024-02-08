<?php 

include 'template/header_admin.html' ; 
include 'conexiondb_club.php';

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Personas</h1>
            <!-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol> -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DATOS PERSONALES
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Celular</th>
                                <th>Correo Electrónico</th>
                                <th>Usuario</th>
                                <th>Domicilio</th>
                                <th>Fecha de Nacimiento</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Celular</th>
                                <th>Correo Electrónico</th>
                                <th>Usuario</th>
                                <th>Domicilio</th>
                                <th>Fecha de Nacimiento</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php
                            $sql= "SELECT*FROM personas";
                            $resultado=$conexionDB->query($sql);     
                            while($fila= $resultado->fetch_object()){
                        ?>
                            <tr>
                                <td scope="row"><?php echo $fila->id_persona ?></td>
                                <td><?php echo $fila->nom_persona ?></td>
                                <td><?php echo $fila->ape_persona ?></td>
                                <td><?php echo $fila->dni_persona ?></td>
                                <td><?php echo $fila->cel_persona ?></td>
                                <td><?php echo $fila->correo_persona ?></td>
                                <td><?php echo $fila->nom_usuario ?></td>
                                <td><?php echo $fila->domicilio_persona ?></td>
                                <td><?php echo $fila->fch_nac_persona ?></td>
                                <td>
                                    <a href="personas_editar.php?codigo=<?php echo $fila->id_persona?>" class="text-success"><i class="bi bi-pencil-square"></i></a>
                                </td>   
                                <td>
                                    <a onclick="return confirm('¿Está seguro que desea eliminar este cliente de la base de datos?');" href="admin/abm-personas.php?codigo=<?php echo $fila->id_persona?>" class="text-danger"><i class="bi bi-trash-fill"></i></a>
                                </td>
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

        <button type="button" class="btn btn-black mb-2" data-toggle="modal" data-target="#modal-nuevo-usuario">
            Nuevo usuario
        </button>
  
        <!-- Modal -->
        <div class="modal fade" id="modal-nuevo-usuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nuevo usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="form-nuevo-usuario" action="#" method="post">
                        <div class="modal-body">
                            
                            <div class="col-md-12">

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Usuario</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" id="user_email" name="user_email" required>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="zona">Zona</label>
                                        <select id="zona" name="zona" class="form-control">
                                            <option value="1" selected>Norte</option>
                                            <option value="2">Sur</option>
                                            <option value="3">Este</option>
                                            <option value="4">Oeste</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="barrio">Barrios</label>
                                        <select id="barrio" name="barrio" class="form-control">

                                        </select>
                                    </div>

                                </div>

                            </div>
                    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-danger text-white" data-dismiss="modal">Cerrar</button>
                            <button id="enviar_form" type="submit" class="btn btn-black">Guardar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    <main>
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-1">

                </div>
                <div class="col-12 col-md-10">

                    <!--INICIO ALERTAS-->

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

                    
                    <!--FIN ALERTAS-->



                    <form action='admin/abm-personas.php' method="POST">
                        <div class="row pt-3">
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputNombre" class="form-label">Nombre:</label>
                                <input type="text" name="nom_persona" class="form-control" id="exampleInputNombre" aria-describedby="nombreHelp" required>
                                <div id="nombreHelp" class="form-text">Ingresar nombre completo.</div>
                            </div>
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputId" class="form-label">Apellido: </label>
                                <input type="text" name="ape_persona" class="form-control" id="exampleInputNombre" aria-describedby="idHelp" required>
                                <div id="idHelp" class="form-text">Ingresar apellido/s.</div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputNombre" class="form-label">DNI: </label>
                                <input type="number" name="dni_persona" class="form-control" id="exampleInputNombre" aria-describedby="nombreHelp" required>
                                <div id="nombreHelp" class="form-text">Ingresar DNI.</div>
                            </div>
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputCel" class="form-label">Número de celular</label>
                                <input type="number" name="cel_persona" class="form-control" id="exampleInputCel" aria-describedby="celHelp" required>
                                <div id="celHelp" class="form-text">Ingrese número de celular para contactarnos.</div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                                <input type="email" name="correo_persona" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                <div id="emailHelp" class="form-text">Ingresar dirección de correo electrónico.</div>
                            </div>
                        
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputCel" class="form-label">Nombre de Usuario</label>
                                <input type="text" name="nom_usuario" class="form-control" id="exampleInputCel" aria-describedby="celHelp" required>
                                <div id="celHelp" class="form-text">Ingresar nombre de usuario al sistema.</div>
                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputCel" class="form-label">Contraseña</label>
                                <input type="text" name="password" class="form-control" id="exampleInputCel" aria-describedby="celHelp" required>
                                <div id="celHelp" class="form-text">Ingresar su contraseña.</div>
                            </div>  

                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputCel" class="form-label">Domicilio</label>
                                <input type="text" name="domicilio_persona" class="form-control" id="exampleInputCel" aria-describedby="celHelp" required>
                                <div id="celHelp" class="form-text">Ingresar domicilio.</div>
                            </div>                
                        </div>

                        <div class="row">
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="fch_nac_persona" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                <div id="emailHelp" class="form-text">Ingrese la fecha de nacimiento.</div>
                            </div>
                        </div>
                        

                        <div class="text-center mt-3 d-grid my-5">
                            <button type="submit" name="Cargar" id="idCargar" class="btn btn-success">Cargar datos</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-1">

                </div>
            </div>
        </div>
    </main>

    <?php include 'template/footer_admin.html' ; ?>
