<!-- Modal Edicion-->
<div class="modal fade" id="modal-edit-categoria-<?php echo $fila->id_categoria;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-categoria" action='admin/abm-categorias.php' method="POST">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_categoria;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 md-4 mb-4">
                            <div class="form-group">
                                <label for="categoria" class="form-label">Categoría:</label>
                                <input type="text" class="form-control" id="categoria" name="categoria" required value="<?php echo $fila->categoria ?>">
                                <div id="categHelp" class="form-text">Ingresar nombre de la categoría.</div>
                            </div>
                        </div>
                        <div class="col-md-6 md-4 mb-4">
                            <div class="form-group">
                                <label for="ingreso" class="form-label">Edad de Ingreso:</label>
                                <input type="number" class="form-control" id="ingreso" name="ingreso" required value="<?php echo $fila->edad_ingreso ?>">
                                <div id="edadingHelp" class="form-text">Ingresar edad de ingreso a la categoría.</div>
                            </div>
                        </div>
                        <div class="col-md-6 md-4 mb-4">
                            <div class="form-group">
                                <label for="egreso" class="form-label">Edad de egreso:</label>
                                <input type="numer" class="form-control" id="egreso" name="egreso" required value="<?php echo $fila->edad_egreso ?>">
                                <div id="edadegrHelp" class="form-text">Ingresar edad de egreso de la categoría.</div>
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