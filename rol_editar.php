<!-- Modal Edicion-->
<div class="modal fade" id="modal-edit-usuario-<?php echo $fila->id_rol;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-usuario" action='admin/abm-rol.php' method="POST">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_rol;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_rol" class="form-label">Rol:</label>
                                <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" required value="<?php echo $fila->nombre_rol ?>">
                                <div id="nombreHelp" class="form-text">Ingresar nombre rol.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="Modificar" name="Modificar" type="submit" class="btn btn-success">Guardar datos</button>
                    <button type="button" class="btn bg-danger text-white" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>