<!-- Modal Edicion-->
<div class="modal fade" id="modal-edit-deporte-<?php echo $fila->id_deporte;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar deporte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-deportes" action='admin/abm-deportes.php' method="POST">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_deporte;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom_deporte" class="form-label">Nombre del Deporte:</label>
                                <input type="text" class="form-control" id="nom_deporte" name="nom_deporte" required value="<?php echo $fila->nom_deporte ?>">
                                <div id="nombredepHelp" class="form-text">Ingresar nombre deporte.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cupos" class="form-label">Cupos:</label>
                                <input type="number" class="form-control" id="cupos" name="cupos" required value="<?php echo $fila->cupos ?>">
                                <div id="cuposHelp" class="form-text">Ingresar cupos.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="Modificar" name="Modificar" type="submit" class="btn btn-success">Guardar Cambios</button>
                    <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>