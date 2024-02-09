<!-- Modal Edicion-->
<div class="modal fade" id="modal-edit-ingreso-<?php echo $fila->id_tipo_ingreso;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Tipo de Ingreso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-ingreso" action='admin/abm-ingreso.php' method="POST">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_tipo_ingreso;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_ingreso" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="tipo_ingreso" name="tipo_ingreso" required value="<?php echo $fila->tipo_ingreso ?>" readonly>
                                <div id="nombreHelp" class="form-text">Ingresar tipo de ingreso completo.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mont_ingreso" class="form-label">Monto de Ingreso:</label>
                                <input type="text" class="form-control" id="mont_ingreso" name="mont_ingreso" required value="<?php echo $fila->mont_ingreso ?>">
                                <div id="idHelp" class="form-text">Ingresar monto.</div>
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