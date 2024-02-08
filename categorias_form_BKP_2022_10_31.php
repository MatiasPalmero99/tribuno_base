<?php include 'template/header-pages.html' ; ?>
    <main>
        <div class="container py-3">
            <div class="table-responsive">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10">
                            <?php
                                include 'conexiondb_club.php';
                                $sql= "SELECT*FROM categorias";
                                $resultado=$conexionDB->query($sql);     
                            ?>
                            <table class="table table-striped table-bordered table-warning table-sm align-middle">
                                <thead class="table-dark">
                                <tr class="text-center">
                                    <td colspan="11">CATEGORIAS</td>
                                </tr>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Edad de Ingreso</th>
                                        <th scope="col">Edad de Egreso</th>
                                        <th scope="col" colspan="2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($fila= $resultado->fetch_object()){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $fila->id_categoria ?></th>
                                        <td><?php echo $fila->categoria ?></td>
                                        <td><?php echo $fila->edad_ingreso ?></td>
                                        <td><?php echo $fila->edad_egreso ?></td>
                                        <td>
                                            <a href="categorias_editar.php?codigo=<?php echo $fila->id_categoria ?>" class="text-success"><i class="bi bi-pencil-square"></i></a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('¿Está seguro que desea eliminar este empleado de la base de datos?');" href="admin/abm-categorias.php?codigo=<?php echo $fila->id_categoria?>" class="text-danger"><i class="bi bi-trash-fill"></i></a>
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
        </div>

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



                    <form action='admin/abm-categorias.php' method="POST">
                        <div class="row pt-3">
                            <div class="text-center mt-3 d-grid my-5">
                                <label for="exampleInputNombre" class="form-label">Categoria:</label>
                                <input type="text" name="categoria" class="form-control" id="exampleInputNombre" aria-describedby="nombreHelp" required>
                                <div id="nombreHelp" class="form-text">Ingresar nombre de la categoria.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputNombre" class="form-label">Edad de Ingreso:</label>
                                <input type="number"  name="edad_ingreso" class="form-control" id="exampleInputNombre" aria-describedby="nombreHelp" required>
                                <div id="nombreHelp" class="form-text">Ingresar la edad de ingreso a la categoria.</div>
                            </div>
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="exampleInputCel" class="form-label">Edad de Egreso</label>
                                <input type="number" name="edad_egreso" class="form-control" id="exampleInputCel" aria-describedby="celHelp" required>
                                <div id="celHelp" class="form-text">Ingrese la edad de egreso.</div>
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