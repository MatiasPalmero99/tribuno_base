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
                            <h1>GRAFICOS</h1>
                            <!-- <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol> -->
                        </div>
                        <div class="col-12 col-md-6 my-2">
                            <ol class="breadcrumb" style="float: right;">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                                <li class="breadcrumb-item active">Salidas T&aacute;cticas</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row my-3 justify-content-left">
                        <div class="col-12 mb-3">
                            <h3>Seleccione el gr&aacute;fico que desea ver.</h2>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-dark" id="inscripcion" style="width:100%" data-toggle="modal" data-target="#modal-grafic-cantidad-inscriptos">
                                <i class="bi bi-clipboard-check" style="font-size:17px;"></i>&nbsp;&nbsp;Cantidad de Inscriptos por Categor&iacute;a
                            </button>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-danger" id="cobroCuotas" style="width:100%" data-toggle="modal" data-target="#modal-inscriptosxmes">
                            <i class="bi bi-credit-card-2-front" style="font-size:17px;"></i>&nbsp;&nbsp;Hist&oacute;rico mensual de jugadores inscriptos.
                            </button>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-warning" id="cobroCuotas" style="width:100%" data-toggle="modal" data-target="#modal-ingresos-mensuales">
                            <i class="bi bi-clipboard2-data" style="font-size:17px;"></i>&nbsp;&nbsp;Hist&oacute;rico mensual de ingresos obtenidos.
                            </button>
                        </div>
                    </div>
                </div>
                <!-- INSCRIPTOS POR CATEGORIA -->
                <div class="modal fade" id="modal-grafic-cantidad-inscriptos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Cantidad de Inscriptos por Categor&iacute;a</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="row p-5">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white">
                                            Gr&aacute;fico de barra
                                        </div>
                                        <div class="card-body">
                                            <canvas id="barChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-danger text-white">
                                            Grafico de torta
                                        </div>
                                        <div class="card-body h-50">
                                            <canvas id="pieChart"></canvas>
                                        </div>
                                    </div>               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- INSCRIPTOS POR MES -->
                <div class="modal fade" id="modal-inscriptosxmes" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Hist&oacute;rico mensual de jugadores inscriptos.</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="row p-5">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white">
                                            Gr&aacute;fico de barra
                                        </div>
                                        <div class="card-body">
                                            <canvas id="barChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-danger text-white">
                                            Grafico de torta
                                        </div>
                                        <div class="card-body h-50">
                                            <canvas id="pieChart2"></canvas>
                                        </div>
                                    </div>               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INGRESOS POR MES -->
                <div class="modal fade" id="modal-ingresos-mensuales" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Hist&oacute;rico mensual de ingresos obtenidos.</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="row p-5">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white">
                                            Gr&aacute;fico de barra
                                        </div>
                                        <div class="card-body">
                                            <canvas id="barChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-danger text-white">
                                            Grafico de torta
                                        </div>
                                        <div class="card-body h-50">
                                            <canvas id="pieChart3"></canvas>
                                        </div>
                                    </div>               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
            <footer class="text-body-secondary py-3">
                <div class="container">
                    <div class="text-center">
                        <p class="mb-1">&copy; Matias Palmero. All Rights Reserved</p>
                    </div>
                </div>
            </footer>
        </div><!-- layoutSidenav_content -->
</div><!-- layoutSidenav -->

<!-- MENU SCROLL -->
<script src="js/scrollPosStyler.min.js"></script>
<!-- OCULTAR/MOSTRAR BARRA LATERAL MENU -->
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="assets/demo/chart-pie-demo.js"></script>
<script>


////////////////////            Cantidad de Inscriptos por Categoria            /////////////////////////////////////////////////
$(function() {
    const barChart = document.getElementById('barChart').getContext('2d');
    const pieChart = document.getElementById('pieChart').getContext('2d');
    
    $.get('grafic_insc_por_cat.php', function(response) {
        response = JSON.parse(response);
        if(response.success) {
            
            let labels = response.results[0];
            let count = response.results[1];

            // Para Graficar el Diagrama de Barras (BarChart)
            graficar(barChart, 'bar', labels, count, 'Cantidad de inscriptos por categoria');

            // Para Graficar el Diagrama de Torta (PieChart)
            graficar(pieChart, 'pie', labels, count, 'Cantidad de inscriptos por categoria');
        } else {
            console.log(response.message);
        }
    })
    .fail(function(error) {
        console.log(error.statusText, error.status);
    });

    function graficar(context, typeGraphic, labels, count, title) {
        let myChart = new Chart(context, {
            type: typeGraphic,
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: count,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgba(255, 159, 64)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales:{
                    yAxes:[{
                        ticks: { 
                            beginAtZero: true,
                            stepSize: 5,
                        }
                    }]
                },
            }
        });
    }
});


////////////////////            Historico mensual de jugadores inscriptos.            /////////////////////////////////////////////////

$(function() {
    const barChart = document.getElementById('barChart2').getContext('2d');
    const pieChart = document.getElementById('pieChart2').getContext('2d');
    
    $.get('grafic_insc_por_mes.php', function(response) {
        response = JSON.parse(response);
        if(response.success) {
            
            let labels = response.results[0];
            let count = response.results[1];

            // Para Graficar el Diagrama de Barras (BarChart)
            graficar(barChart, 'bar', labels, count, 'Cantidad de inscriptos por mes');

            // Para Graficar el Diagrama de Torta (PieChart)
            graficar(pieChart, 'pie', labels, count, 'Cantidad de inscriptos por mes');
        } else {
            console.log(response.message);
        }
    })
    .fail(function(error) {
        console.log(error.statusText, error.status);
    });

    function graficar(context, typeGraphic, labels, count, title) {
        let myChart = new Chart(context, {
            type: typeGraphic,
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: count,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192,)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales:{
                    yAxes:[{
                        ticks: { 
                            beginAtZero :true,
                            stepSize:10,
                        }
                    }]
                },
            }
        });
    }
});


////////////////////            Historico mensual de ingresos obtenidos.            /////////////////////////////////////////////////

$(function() {
    const barChart = document.getElementById('barChart3').getContext('2d');
    const pieChart = document.getElementById('pieChart3').getContext('2d');
    
    $.get('grafic_mont_por_mes.php', function(response) {
        response = JSON.parse(response);
        if(response.success) {
            
            let labels = response.results[0];
            let count = response.results[1];

            // Para Graficar el Diagrama de Barras (BarChart)
            graficar(barChart, 'bar', labels, count, 'Monto ingresado por mes');

            // Para Graficar el Diagrama de Torta (PieChart)
            graficar(pieChart, 'pie', labels, count, 'Monto ingresado por mes');
        } else {
            console.log(response.message);
        }
    })
    .fail(function(error) {
        console.log(error.statusText, error.status);
    });

    function graficar(context, typeGraphic, labels, count, title) {
        let myChart = new Chart(context, {
            type: typeGraphic,
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: count,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgba(255, 159, 64)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales:{
                    yAxes:[{
                        ticks: { 
                            beginAtZero :true,
                        }
                    }]
                },
            }
        });
    }
});

</script>

<!-- DATA TABLE -->
<script src="js/datatables-simple-demo.js"></script>
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
</body>
</html>
<?php
}else{
    header("Location: login/login_index.php");
}
?>