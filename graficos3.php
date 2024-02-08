<?php 
session_start();
if(isset($_SESSION['usuario'])&&isset($_SESSION['id_persona'])){
include 'template/header_admin.html' ; 
include 'conexiondb_club.php';

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12 col-md-6">
                    <h2>Comparativo de ingresos totales mensuales obtenuidos</h2>
                </div>
                <div class="col-12 col-md-6 my-2">
                    <ol class="breadcrumb" style="float: right;">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="panel_admin.php">Panel Administración</a></li>
                        <li class="breadcrumb-item"><a href="panel_graficos.php">Graficos</a></li>
                        <li class="breadcrumb-item active">Salida 3</li>
                    </ol>
                </div>
            </div>
        </div>
       
        <div class="container my-5">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Grafico de Barra
                        </div>
                        <div class="card-body">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            Grafico de Torta
                        </div>
                        <div class="card-body h-50">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>               
                </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
        <script>

            $(function() {
                const barChart = document.getElementById('barChart').getContext('2d');
                const pieChart = document.getElementById('pieChart').getContext('2d');
                
                $.get('graficos_datos3.php', function(response) {
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
                                        beginAtZero :true
                                    }
                                }]
                            },
                        }
                    });
                }
            })

        </script>
    
    </div>       
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>   
<?php 
include 'template/footer_admin.html' ; 
}else{
    header("Location: login/login_index.php");
}
?>
