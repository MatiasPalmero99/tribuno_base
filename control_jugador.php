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
                            <h1>Control de Jugador</h1>
                            <!-- <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol> -->
                        </div>
                        <div class="col-12 col-md-6 my-2">
                            <ol class="breadcrumb" style="float: right;">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                                <li class="breadcrumb-item active">Control de Jugador</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row mb-5 mx-1">

                        <div class="col-12 col-md-10 shadow-lg bg-body rounded p-3" id="form_cobroCuota" style="display:block;">
                            <form id="form_cobro" action="admin/proc_facturacion.php" method="POST">

                                <input type="hidden" class="form-control" id="monto_total_abonar" name="monto_total_abonar" value="">
                                <input type="hidden" class="form-control" id="id_legajo" name="id_legajo" value="">

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

                                </div>
                                <div class="row">
                                    <div class ="col-12 col-md-8 mt-4" id="estado_cuenta" style="display:none;">
                                    <table id="datatablesSimple" class="table table-light table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="border-end">Mes</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody id="estado_cuenta_table">
                                            <label for="nom_jugador" class="form-label"><strong>Estado de cuenta: </strong></label>
                                        </tbody>
                                    </table>        

                                    </div>
                                </div>

                            </form>
                        </div><!-- COL -->


                    </div><!-- ROW -->
                </div><!-- CONTAINER -->
            </main>



            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Troyanos 2022</div>
                        <div>
                        <img src="images/troyanos-log3.png" alt="TROYANOS" title="TROYANOS" class="img-responsive" width="180px" height="65px" style="text-align: right;" />

                            <!--<a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>-->
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- layoutSidenav_content -->
</div><!-- layoutSidenav -->


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
        $('#id_legajo').val(pav[5]);

        $.ajax({
            url: 'admin/cargar_estado_cuenta_table.php',
            type: "GET",
            data: "proc=ajax&legajo="+pav[5]+'',
            async: false,
            beforeSend: function(){},
            success: function(data){
                data=$.parseJSON(data);
                if (data.cant!=0){
                    $('#estado_cuenta').css("display","block");
                    $('#estado_cuenta_table').html(data.tabla);

                }
            },
            error: function(){
            },
            complete: function(objeto, exito){
            }
        })

    }

    

});


</script>
</body>
</html>
<?php
}else{
    header("Location: login/login_index.php");
}
?>