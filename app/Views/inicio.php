    <main>
        <div class="container-fluid px-4">
            <br />
            <div class="row">
                <div class="col-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <?php echo $tratamientosPendientes; ?> Total de tratamientos pendientes
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url() ?>/tratamientos/muestraTratamientosPdf/PENDIENTE">Ver detalles</a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <?php echo $tratamientosEnProceso; ?> Total de tratamientos en proceso
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url() ?>/tratamientos/muestraTratamientosPdf/EN PROCESO">Ver detalles</a>

                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <?php echo $tratamientosFinalizados; ?> Total de tratamientos finalizados
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url() ?>/tratamientos/muestraTratamientosPdf/FINALIZADO">Ver detalles</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--aqui se elige el tamaño si es completo como esta ahorita o si se divide en 3 o en 4-->
                <div class="col-6">
                    <canvas id="myChart" width="150" height="110"></canvas>
                </div>
                <div class="col-6">
                    <canvas id="myChart2" width="150" height="110"></canvas>
                </div>
            </div>


            <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    echo "'Tratamientos pendientes',";
                    echo "'Tratamientos en proceso',";
                    echo "'Tratamientos finalizados'";
                    ?>
                ],
                datasets: [{
                    label: '# Tratamientos',
                    data: [<?php
                    echo "'" . $tratamientosPendientes . "',";
                    echo "'" . $tratamientosEnProceso . "',";
                    echo "'" . $tratamientosFinalizados . "'";
                            ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });




        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    echo "'Procedimientos realizados',";
                    ?>
                ],
                datasets: [{
                    label: '# Procedimientos realizados',
                    data: [<?php
                    echo "'" . $procedimientosRelizados . "'";
                            ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
        </div>
    </main>
