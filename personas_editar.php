<!-- Modal Edicion-->
<div class="modal fade" id="modal-edit-usuario-<?php echo $fila->id_persona;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-usuario" action='admin/abm-personas.php' method="POST">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_persona;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="nom_persona" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nom_persona" name="nom_persona" required value="<?php echo $fila->nom_persona ?>">
                                <div id="nombreHelp" class="form-text">Ingresar nombre completo.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="ape_persona" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="ape_persona" name="ape_persona" required value="<?php echo $fila->ape_persona ?>">
                                <div id="idHelp" class="form-text">Ingresar apellido/s.</div>
                            </div>                            
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="dni_persona" class="form-label">DNI:</label>
                                <input type="number" class="form-control" id="dni_persona" name="dni_persona" required value="<?php echo $fila->dni_persona ?>">
                                <div id="DniHelp" class="form-text">Ingresar DNI.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="cel_persona" class="form-label">Número de celular</label>
                                <input type="number" class="form-control" id="cel_persona" name="cel_persona" required value="<?php echo $fila->cel_persona ?>">
                                <div id="celHelp" class="form-text">Ingrese número de celular para contactarnos.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="correo_persona" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo_persona" name="correo_persona" required value="<?php echo $fila->correo_persona ?>">
                                <div id="emailHelp" class="form-text">Ingrese una dirección de correo electrónico.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="nom_usuario" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="nom_usuario" name="nom_usuario" value="<?php echo $fila->nom_usuario ?>">
                                <div id="UsuHelp" class="form-text">Ingresar nombre de usuario al sistema.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $fila->password ?>">
                                <div id="PassHelp" class="form-text">Ingresar su contraseña.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="domicilio_persona" class="form-label">Domicilio</label>
                                <input type="text" class="form-control" id="domicilio_persona" name="domicilio_persona" required value="<?php echo $fila->domicilio_persona ?>">
                                <div id="DomHelp" class="form-text">Ingresar domicilio.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="fch_nac_persona" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fch_nac_persona" name="fch_nac_persona" required value="<?php echo $fila->fch_nac_persona ?>">
                                <div id="FchNacHelp" class="form-text">Ingrese la fecha de nacimiento.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="Modificar" name="Modificar" type="submit" class="btn btn-success">Cargar datos</button>
                    <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>