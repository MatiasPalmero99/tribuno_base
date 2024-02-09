<!-- Modal Edicion-->
<div class="modal fade" id="modal-edit-ajuste-<?php echo$fila->id_ajuste;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Ajustes de Equipamiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-ajuste" action='admin/proc_control_equipamiento.php' method="POST">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila->id_ajuste;?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion" class="form-label">Descripcion:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required value="<?php echo $fila->descripcion ?>">
                                <div id="nombreHelp" class="form-text">Ingresar Ajuste de Equipamiento completo.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_equipamiento" class="form-label">Equipamiento:</label>
                                    <select id="id_equipamiento" name="id_equipamiento" class="form-control" require value="<?php echo $fila->id_equipamiento ?>">
                                    <?php    
                                                                $query="SELECT * FROM equipamiento";  
                                                                $result=$conexionDB->query($query);
                                                                while($fila= $result->fetch_object()){ ?>
                                                                    <option value="<?php echo $fila->id_equipamiento?>" ><?php echo $fila->nom_equipamiento?></option>
                                                                <?php
                                                            }
                                                            ?>         
                                    </select>
                                <div id="idHelp" class="form-text">Ingresar equipamiento.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="Modificar" name="Modificar" type="submit" class="btn btn-success">Cargar datos</button>
                    <button type="button" class="btn bg-danger text-white" data-bs.dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>