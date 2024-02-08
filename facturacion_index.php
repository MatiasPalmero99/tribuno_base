<?php 
session_start();
if(isset($_SESSION['usuario'])&&isset($_SESSION['id_persona'])){
include 'conexiondb_club.php';
include 'template/header_admin.html';
?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <h1>Facturación</h1>
                            <!-- <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol> -->
                        </div>
                        <div class="col-12 col-md-6 my-2">
                            <ol class="breadcrumb" style="float: right;">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                                <li class="breadcrumb-item active">Facturación</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row my-3">
                        <div class="col-12 col-md-10">
<?php   
                            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error_mes'){
                            
?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> No hay ningun monto a abonar, debe seleccionar al menos un mes.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

<?php
                            }
?>
                        
<?php
                            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Inscripción realizada con exito!</strong> Se han guardado correctamente los datos.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

<?php
                            }
?>
<?php
                            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'cuota_abonada'){
?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Cobro de cuotas realizado con exito!</strong> Se han guardado correctamente los datos.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

<?php
                            }
?>
<?php
                            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'reinscripcion_exitosa'){
?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Reinscripci&oacute;n del jugador realizada con exito!</strong> Se han guardado correctamente los datos.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

<?php
                            }
?>
<?php
                            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'caja_cerrada'){
?>

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error de Facturaci&oacute;n</strong> La caja se encuentra cerrada.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

<?php
                            }
?>
<?php
                            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'jugador_existente'){
?>

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>El jugador ya est&aacute; cargado en la base de datos!</strong> Por favor verifique los datos ingresados.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

<?php
                            }
?>
<?php
                            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'jugador_notfound'){
?>

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Jugador no encontrado!</strong> Para reinscribir a un jugador &eacute;ste se debe encontrar registrado en la base de datos.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

<?php
                            }
?>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row my-3 justify-content-left">
                        <div class="col-12 mb-3">
                            <h3>Seleccione el tipo de operación</h2>
                        </div>
                        <div class="col-12 col-md-2 mb-2">
                            <button type="button" class="btn btn-primary" id="inscripcion" style="width:100%">
                                <i class="bi bi-clipboard-check" style="font-size:17px;"></i>&nbsp;&nbsp;Inscripción
                            </button>
                        </div>
                        <div class="col-12 col-md-2 mb-2">
                            <button type="button" class="btn btn-info" id="reinscripcion" style="width:100%">
                                <i class="bi bi-journal-check" style="font-size:17px;"></i>&nbsp;&nbsp;Reinscripción
                            </button>
                        </div>
                        <div class="col-12 col-md-2 mb-2">
                            <button type="button" class="btn btn-success" id="cobroCuotas" style="width:100%">
                            <i class="bi bi-ui-checks-grid" style="font-size:17px;"></i>&nbsp;&nbsp;Cuotas
                            </button>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row mb-5 mx-1">

                        <!-- ------------------------------------------- INSCRIPCION -------------------------------------------------------->

                        <div class="col-12 col-md-10 shadow-lg bg-body rounded p-3 border border-3 border-primary" id="form_inscripcion" style="display:none;">
<?php
                            $rectipoin="SELECT
                            id_tipo_ingreso,
                            tipo_ingreso,
                            mont_ingreso
                            FROM tipo_ingreso
                            WHERE id_tipo_ingreso=1 OR tipo_ingreso='Inscripcion'";
                            $qrectipoin=$conexionDB->query($rectipoin);
                            $fila= $qrectipoin->fetch_object();
?>
                            <form action="admin/proc_facturacion.php" method="POST" id="formulario_inscripcion">
                                <input type="hidden" class="form-control" id="id_tipo_ingreso" name="id_tipo_ingreso" value="<?php echo$fila->id_tipo_ingreso;?>">
                                <input type="hidden" class="form-control" id="tipo_ingreso" name="tipo_ingreso" value="<?php echo$fila->tipo_ingreso;?>">
                                <input type="hidden" class="form-control" id="monto_tipo_ingreso" name="monto_tipo_ingreso" value="<?php echo$fila->mont_ingreso;?>">
                                <div class="row mt-3">        
                                    <div class="row">
                                        <div class ="col-12 mb-4">
                                            <div class="form-group">
                                                <h4>Inscripci&oacute;n</h4>
                                            </div>
                                        </div>
                                    </div>            
                                    <div class="row">
                                        <div class ="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="nom_persona" class="form-label">Nombre:</label>
                                                <input type="text" class="form-control" id="nom_persona" name="nom_persona" required>
                                                <div id="nombreHelp" class="form-text">Ingresar nombre completo.</div>
                                            </div>
                                        </div>
                                        <div class ="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="ape_persona" class="form-label">Apellido:</label>
                                                <input type="text" class="form-control" id="ape_persona" name="ape_persona" required>
                                                <div id="idHelp" class="form-text">Ingresar apellido/s.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="dni_persona" class="form-label">DNI:</label>
                                                <input type="number" class="form-control" id="dni_persona" name="dni_persona" required>
                                                <div id="DniHelp" class="form-text">Ingresar DNI.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="cel_persona" class="form-label">Número de celular</label>
                                                <input type="number" class="form-control" id="cel_persona" name="cel_persona" required>
                                                <div id="celHelp" class="form-text">Ingrese número de celular para contactarnos.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="correo_persona" class="form-label">Correo electrónico</label>
                                                <input type="email" class="form-control" id="correo_persona" name="correo_persona">
                                                <div id="emailHelp" class="form-text">Ingrese una dirección de correo electrónico.</div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="nom_usuario" class="form-label">Nombre de Usuario</label>
                                                <input type="text" class="form-control" id="nom_usuario" name="nom_usuario" required>
                                                <div id="UsuHelp" class="form-text">Ingresar nombre de usuario al sistema.</div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input type="text" class="form-control" id="password" name="password" required>
                                                <div id="PassHelp" class="form-text">Ingresar su contraseña.</div>
                                            </div>
                                        </div> -->
                                        <div class="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="domicilio_persona" class="form-label">Domicilio</label>
                                                <input type="text" class="form-control" id="domicilio_persona" name="domicilio_persona" required>
                                                <div id="DomHelp" class="form-text">Ingresar domicilio.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="fch_nac_persona" class="form-label">Fecha de nacimiento</label>
                                                <input type="date" class="form-control" id="fch_nac_persona" name="fch_nac_persona" required>
                                                <div id="FchNacHelp" class="form-text">Ingrese la fecha de nacimiento.</div>
                                            </div>
                                        </div>
                                        <div class ="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="categoria" class="form-label">Categoría: </label>
                                                <select class="form-select" id="categoria" name="categoria">

<?php
                                                $sql= "SELECT*FROM categorias";
                                                $resultado=$conexionDB->query($sql);     
                                                while($file= $resultado->fetch_object()){
?>
                                                    <option value="<?php echo $file->id_categoria ?>"><?php echo $file->categoria;?></option>
<?php
                                                }
?>
                                                </select>
                                                <div id="cateHelp" class="form-text">Ingresar categor&iacute;a del jugador.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-light justify-content-end my-2 py-3">
                                    <div class ="col-8 col-md-3">
                                        <span><strong>Monto a abonar: </strong></span>
                                    </div>
                                    <div class ="col-4 col-md-1 text-primary text-end">
                                        <strong>$ <?php echo$fila->mont_ingreso;?></strong>
                                    </div>
                                </div> 
 
                                <div class="row mt-2 text-center">
                                    <div class="col-12 col-md-6 mb-2">
                                        <input class=" btn btn-primary" type="submit" name="inscripcion" id="inscripcion_submit" value="Facturar" style="width: 100%;" onclick="return confirm('¿Está seguro que desea inscribir a este jugador?')">
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <button type="button" class=" btn btn-danger" name="ocultar" id="ocultar" value="Ocultar" style="width: 100%;">Ocultar</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- COL -->



                        <!-- ------------------------------------------- REINSCRIPCION -------------------------------------------------------->

                        <div class="col-12 col-md-10 shadow-lg bg-body rounded p-3 border border-3 border-info" id="form_reinscripcion" style="display:none;">
<?php
                            $rectipoin="SELECT
                            id_tipo_ingreso,
                            tipo_ingreso,
                            mont_ingreso
                            FROM tipo_ingreso
                            WHERE id_tipo_ingreso=8 OR tipo_ingreso='Reinscripcion'";
                            $qrectipoin=$conexionDB->query($rectipoin);
                            $fila= $qrectipoin->fetch_object();
?>
                            <form id="form_reinscripcion" action="admin/proc_facturacion.php" method="POST">
                                <input type="hidden" class="form-control" id="id_tipo_ingreso_reins" name="id_tipo_ingreso_reins" value="<?php echo$fila->id_tipo_ingreso;?>">
                                <input type="hidden" class="form-control" id="tipo_ingreso_reins" name="tipo_ingreso_reins" value="<?php echo$fila->tipo_ingreso;?>">
                                <input type="hidden" class="form-control" id="monto_tipo_ingreso_reins" name="monto_tipo_ingreso_reins" value="<?php echo$fila->mont_ingreso;?>">

                                <input type="hidden" class="form-control" id="id_legajo_reins" name="id_legajo_reins" value="">
                                <div class="row">
                                    <div class ="col-12 mb-4">
                                        <div class="form-group">
                                            <h4>Reinscripci&oacute;n</h4>
                                        </div>
                                    </div>
                                </div>        
                                <div class="row mt-3">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="cli_busc_reins" class="form-label"><strong>BUSCAR JUGADOR: </strong></label>
                                            <input type="text" class="form-control" id="cli_busc_reins" name="cli_busc_reins" required>
                                            <div id="DniHelp" class="form-text">Ingresar Nombre o DNI del jugador.</div>
                                        </div>
                                    </div>
                                    <div class ="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="nom_jugador_reins" class="form-label"><strong>Nombre y Apellido: </strong></label>
                                            <input type="text" class="form-control" id="nom_jugador_reins" name="nom_jugador_reins" value="" readonly>
                                        </div>
                                    </div>
                                    <div class ="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="doc_jugador_reins" class="form-label"><strong>Documento: </strong></label>
                                            <input type="text" class="form-control" id="doc_jugador_reins" name="doc_jugador_reins" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-light justify-content-end my-2 py-3">
                                    <div class ="col-8 col-md-3">
                                        <span><strong>Monto a abonar: </strong></span>
                                    </div>
                                    <div class ="col-4 col-md-1 text-info text-end">
                                        <strong>$ <?php echo$fila->mont_ingreso;?></strong>
                                    </div>
                                </div> 
                                <div class="row mt-2 text-center">
                                    <div class="col-12 col-md-6 mb-2">
                                        <input class=" btn btn-info" type="submit" name="reinscripcion_submit" id="reinscripcion_submit" value="Facturar" style="width: 100%;" onclick="return confirm('¿Está seguro que desea Reinscribir a este jugador?')">
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <button type="button" class=" btn btn-danger" name="ocultar3" id="ocultar3" value="Ocultar" style="width: 100%;">Ocultar</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- COL -->





                        <!-- -------------------------------------------COBRO DE CUOTAS-------------------------------------------------------->

                        <div class="col-12 col-md-10 shadow-lg bg-body rounded p-3 border border-3 border-success" id="form_cobroCuota" style="display:none;">
<?php
                            $recingcuot="SELECT
                            id_tipo_ingreso,
                            tipo_ingreso,
                            mont_ingreso
                            FROM tipo_ingreso
                            WHERE id_tipo_ingreso=2 OR tipo_ingreso LIKE '%cuota%'";
                            $qrecingcuot=$conexionDB->query($recingcuot);
                            $fila_ing_cuot= $qrecingcuot->fetch_object();
?>
                            <form id="form_cuotas" action="admin/proc_facturacion.php" method="POST">
                                <input type="hidden" class="form-control" id="id_tipo_ingreso_cuota" name="id_tipo_ingreso_cuota" value="<?php echo$fila_ing_cuot->id_tipo_ingreso;?>">
                                <input type="hidden" class="form-control" id="tipo_ingreso_cuota" name="tipo_ingreso_cuota" value="<?php echo$fila_ing_cuot->tipo_ingreso;?>">
                                <input type="hidden" class="form-control" id="monto_tipo_ingreso_cuota" name="monto_tipo_ingreso_cuota" value="<?php echo$fila_ing_cuot->mont_ingreso;?>">

                                <input type="hidden" class="form-control" id="monto_total_abonar" name="monto_total_abonar" value="">
                                <input type="hidden" class="form-control" id="id_legajo_cuotas" name="id_legajo_cuotas" value="">
                                <div class="row">
                                    <div class ="col-12 mb-4">
                                        <div class="form-group">
                                            <h4>Cobro de Cuotas</h4>
                                        </div>
                                    </div>
                                </div>           
                                <div class="row mt-3">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="cli_busc" class="form-label"><strong>BUSCAR JUGADOR: </strong></label>
                                            <input type="text" class="form-control" id="cli_busc" name="cli_busc" required>
                                            <div id="DniHelp" class="form-text">Ingresar Nombre o DNI del jugador.</div>
                                        </div>
                                    </div>
                                    <div class ="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="nom_jugador" class="form-label"><strong>Nombre y Apellido: </strong></label>
                                            <input type="text" class="form-control" id="nom_jugador" name="nom_jugador" value="" readonly>
                                        </div>
                                    </div>
                                    <div class ="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="doc_jugador" class="form-label"><strong>Documento: </strong></label>
                                            <input type="text" class="form-control" id="doc_jugador" name="doc_jugador" value="" readonly>
                                        </div>
                                    </div>

                                    <div class ="col-12 col-md-4 mt-3" id="estado_cuenta">
                                    </div>
                                </div>
                                <div class="row bg-light justify-content-end mt-2 pt-3">
                                    <div class ="col-8 col-md-2 text-secondary">
                                        <span><strong>Precio de la cuota: </strong></span>
                                    </div>
                                    <div class ="col-4 col-md-2 text-secondary text-end">
                                        <strong>$ <?php echo$fila_ing_cuot->mont_ingreso;?></strong>
                                    </div>
                                </div>
                                <div class="row bg-light justify-content-end mb-2 py-3">
                                    <div class ="col-8 col-md-2">
                                        <span><strong>Monto a abonar: </strong></span>
                                    </div>
                                    <div class ="col-4 col-md-2 text-success text-end">
                                        <strong id="monto_0">$ 0</strong><strong id="monto_total_cuotas"></strong>
                                    </div>
                                </div> 
                                <div class="row mt-2 text-center">
                                    <div class="col-12 col-md-6 mb-2">
                                        <input class=" btn btn-success" type="submit" name="cuotas" id="cuotas" value="Facturar" style="width: 100%;" onclick="return confirm('¿Confirma operación de Cobro de cuotas?')">
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <button type="button" class=" btn btn-danger" name="ocultar2" id="ocultar2" value="Ocultar" style="width: 100%;">Ocultar</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- COL -->


                    </div><!-- ROW -->
                </div><!-- CONTAINER -->
            </main>



            <footer class="pb-3 mt-5 bg-light">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Troyanos 2022</div>
                        <div>
                        <img src="images/troyanos-log3.png" alt="TROYANOS" title="TROYANOS" class="img-responsive" width="180px" height="60px" style="text-align: right;" />

                            <!--<a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>-->
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- layoutSidenav_content -->
</div><!-- layoutSidenav -->


<!-- SERIALIZE PARA MANDAR DATOS DEL FORMULARIO AL PDF -->

<script>
    // $(document).ready(function() {
    //     $('#btnFacturar').on('click', function(e) {
    //         e.preventDefault();
    //         var dataString = $('#formInscripcion').serialize();
    //         console.log('Datos serializados: '+ dataString);
    //     }); 
    // });

    // $('document').ready(function(){
    //     $("#btnFacturar").click(function(){
    //         $.post('formulario_prueba.php', $('#formInscripcion').serialize(),function(data){
    //             alert(data);
    //         });
    //     });
    // });
</script>

<!-- MENU SCROLL -->
<!-- <script src="js/scrollPosStyler.min.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
<!-- <script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
<!-- OCULTAR/MOSTRAR BARRA LATERAL MENU -->
<script src="js/scripts.js"></script>

<!-- DATA TABLE -->
<!-- <script src="js/datatables-simple-demo.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->



<script>

$(document).ready(function() {

//EVENTOS DE BOTONES PARA INSCRIPCION Y COBRO DE CUOTAS

    //INSCRIPCION
    $('#inscripcion').click(function(){
        $('#form_inscripcion').slideDown();
        $('#form_cobroCuota').slideUp();
        $('#form_reinscripcion').slideUp();
    });

    $('#ocultar').click(function(){
        $('#form_inscripcion').slideUp();
    });


    //REINSCRIPCION
    $('#reinscripcion').click(function(){
        $('#form_reinscripcion').slideDown();
        $('#form_cobroCuota').slideUp();
        $('#form_inscripcion').slideUp();
    });

    $('#ocultar3').click(function(){
        $('#form_reinscripcion').slideUp();
    });


    //CUOTAS
    $('#cobroCuotas').click(function(){
        $('#form_cobroCuota').slideDown();
        $('#form_inscripcion').slideUp();
        $('#form_reinscripcion').slideUp();
    });

    $('#ocultar2').click(function(){
        $('#form_cobroCuota').slideUp();
    });

});
//////////////////////////////////////////////////////////


/////////// Autocomplete de busqueda de jugador y estado de cuenta para cobro de cuotas /////////////////////////////////////
$( "#cli_busc" ).autocomplete({
    source: function(request, response){

         $.ajax({
            url: 'admin/buscar_cliente.php',
            data: 'proc=ajax&term='+request.term+'&recurso=f_busc_cli',
            type: 'GET',
            dataType: "html",
            cache:false,
            beforeSend: function(){},
            complete: function() {},
            success:function(data){
                if(data!=''){
                    data=$.parseJSON(data);
                    var aData=$.map(data, function(item){
                        return{
                            label: item.nom_persona+'  '+item.ape_persona+' | DNI: '+item.dni_persona,
                            value: item.dni_persona,
                            desc: item.id_persona+'#|*'+item.nom_persona+'#|*'+item.ape_persona+'#|*'+item.dni_persona+'#|*'+item.id_usuario+'#|*'+item.legajo
                        };
                    });
                    response(aData);
                }else{
                    response(null);
                }

            }
         });
    },
    minLength:1,

    select: function(event,ui){
        var dat=ui.item.desc
        var pav=dat.split('#|*');

        $('#nom_jugador').val(''+pav[1]+' '+pav[2]);
        $('#doc_jugador').val(pav[3]);
        $('#id_legajo_cuotas').val(pav[5]);

        $.ajax({
            url: 'admin/cargar_estado_cuenta.php',
            type: "GET",
            data: "proc=ajax&legajo="+pav[5]+'',
            async: false,
            beforeSend: function(){},
            success: function(data){
                data=$.parseJSON(data);
                if (data.cant!=0){
                    $('#estado_cuenta').html(data.tabla);


                    var monto_cuota=parseInt($('#monto_tipo_ingreso_cuota').val());
                    var monto_a_abonar=0;
                    $('.mes').click(function() {
                        
                        if ($(this).is(':checked')) {
                        
                            monto_a_abonar+=monto_cuota;
                            $('#monto_0').css("display","none");
                            $('#monto_total_cuotas').html('$ '+monto_a_abonar);

                            $('#monto_total_abonar').val(monto_a_abonar);
                        }else{
                            monto_a_abonar-=monto_cuota;
                            $('#monto_total_cuotas').html('$ '+monto_a_abonar);
                            $('#monto_total_abonar').val(monto_a_abonar);
                        }
                    });

                }
            },
            error: function(){
            },
            complete: function(objeto, exito){
            }
        })

    }

    

});



/////////// Autocomplete de busqueda de jugador para verificar existencia en base de datos y reiniciar estado de cuenta /////////////////////////////////////
$( "#cli_busc_reins" ).autocomplete({
    source: function(request, response){

         $.ajax({
            url: 'admin/buscar_cliente.php',
            data: 'proc=ajax&term='+request.term+'&recurso=f_busc_cli',
            type: 'GET',
            dataType: "html",
            cache:false,
            beforeSend: function(){},
            complete: function() {},
            success:function(data){
                if(data!=''){
                    data=$.parseJSON(data);
                    var aData=$.map(data, function(item){
                        return{
                            label: item.nom_persona+'  '+item.ape_persona+' | DNI: '+item.dni_persona,
                            value: item.dni_persona,
                            desc: item.id_persona+'#|*'+item.nom_persona+'#|*'+item.ape_persona+'#|*'+item.dni_persona+'#|*'+item.id_usuario+'#|*'+item.legajo
                        };
                    });
                    response(aData);
                }else{
                    response(null);
                }

            }
         });
    },
    minLength:1,

    select: function(event,ui){
        var dat=ui.item.desc
        var pav=dat.split('#|*');

        $('#nom_jugador_reins').val(''+pav[1]+' '+pav[2]);
        $('#doc_jugador_reins').val(pav[3]);
        $('#id_legajo_reins').val(pav[5]);

    }
});


    // $( "#cli_busc" ).autocomplete({
    // source: function(request,response){
    //     var strvar='proc=ajax';
    //     strvar+='&term='+request.term.trim()+'&recurso=f_busc_cli';

    //      $.ajax({
    //         url: 'admin/buscar_cliente.php',
    //         data: strvar,
    //         type: 'GET',
    //         dataType: "html",
    //         cache: false,
    //         beforeSend: function(){},
    //         complete: function() {},
    //         success:function(data){
                
    //             if(data!=''){

    //                 data=$.parseJSON(data);

    //                 response($.map(data,function(item){
    //                     return {
    //                             label: item.nom_persona+'  '+item.ape_persona+' | DNI: '+item.dni_persona ,
    //                             value: item.dni_persona,
    //                             desc: item.id_persona+'#|*'+item.nom_persona
    //                         }
    //                 }))
    //             }else{
    //                 response(null);
    //             }
    //         }
    //      })
    // },
    // minLength: 0.5,
    // change: function (event, ui) {
    //     if(ui.item == null || ui.item == undefined) {

    //         $('#cli_busc').val('');
    //     }
    // },
    // select: function(event,ui){
    //     var dat=ui.item.desc
    //     var pav=dat.split('#|*');
    //     console.log(pav[1]);

    //     $('#nom_jugador').html(pav[0]);
    //     $('#nom_jugador').append(pav[0]);
    // }

    // });

//  REINSCRIPCION
    $( "#inscripcion_submit" ).click(function(){
        $( "#formulario_inscripcion" ).submit();
        window.open('reportes/index_factura.php?motivo=inscripcion&dni_persona='+ $( "#dni_persona").val());
    });


//  REINSCRIPCION
    $( "#reinscripcion_submit" ).click(function(){
        $( "#form_reinscripcion" ).submit();
        window.open('reportes/index_factura.php?motivo=reinscripcion&id_legajo_reins='+ $( "#id_legajo_reins").val());
    });


//  CUOTAS
    $( "#cuotas" ).click(function(){
        $( "#form_cuotas" ).submit();
        //$( "#form_cuotas" ).submit(function( event ) {
        window.open('reportes/index_factura.php?motivo=cuotas&id_legajo='+ $( "#id_legajo_cuotas").val());
        //});
    });


</script>
</body>
</html>
<?php
}else{
    header("Location: login/login_index.php");
}
?>