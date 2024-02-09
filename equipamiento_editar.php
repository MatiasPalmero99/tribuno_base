<!-- Modal Edicion-->
<div class="modal fade" id="modal-edit-equipamiento-<?php echo $fila->id_equipamiento;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Equipamiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-equipamiento" action='admin/abm-equipamiento.php' method="POST">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_equipamiento;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom_equipamiento" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nom_equipamiento" name="nom_equipamiento" required value="<?php echo $fila->nom_equipamiento ?>">
                                <div id="nombreHelp" class="form-text">Ingresar nombre completo.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" required value="<?php echo $fila->cantidad ?>">
                                <div id="cantHelp" class="form-text">Ingresar cantidad.</div>
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