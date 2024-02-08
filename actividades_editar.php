<!-- Modal Edicion-->
<div class="modal fade" id="modal-edit-actividad-<?php echo $fila->id_actividad;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-actividad" action='admin/abm-actividades.php' method="POST">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_actividad;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="actividad" class="form-label">Actividad:</label>
                                <input type="text" class="form-control" id="actividad" name="actividad" required value="<?php echo $fila->nombre_actividad ?>">
                                <div id="actividadHelp" class="form-text">Ingresar actividad actualizada!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="Modificar" name="Modificar" type="submit" class="btn btn-success">Guardar Cambios</button>
                    <button type="button" class="btn bg-danger text-white" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>