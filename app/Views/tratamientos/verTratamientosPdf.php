<main>
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body">
                <form class="form-inline" method="post" name="formFechas" id="formFechas">
                    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>">
                    <?php
                    $DateAndTime = date("Y-m-d\TH:i");
                    ?>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label>Fecha Inicio:</label>
                            <input type="datetime-local" class="form-control" name="fechaInicio" id="fechaInicio" min="2022-01-01T00:00" max="<?php echo $DateAndTime ?>">
                        </div>
                        <div class="col-12 col-sm-4">
                            <label>Fecha Final:</label>
                            <input type="datetime-local" class="form-control" name="fechaFinal" id="fechaFinal" min="2022-01-01T00:00" max="<?php echo $DateAndTime ?>">
                        </div>
                        <div class="col-12 col-sm-4">
                            <label>Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="TODOS">Todos</option>
                                <option value="PENDIENTE" <?php if ("PENDIENTE" == $tratamientos) {
                                                                echo 'selected';
                                                            } ?>>Pendiente</option>
                                <option value="EN PROCESO" <?php if ("EN PROCESO" == $tratamientos) {
                                                                echo 'selected';
                                                            } ?>>En proceso</option>
                                <option value="FINALIZADO" <?php if ("FINALIZADO" == $tratamientos) {
                                                                echo 'selected';
                                                            } ?>>Finalizado</option>
                                <option value="ANULADO" <?php if ("ANULADO" == $tratamientos) {
                                                            echo 'selected';
                                                        } ?>>Anulado</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        //$DateAndTime = date('Y-m-d h:i:s a', time());
        //echo $DateAndTime; 
        ?>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel">
                <div class="embed-responsive embed-responsive-4by3" style="margin-top: 30px;">
                    <iframe id="youriframe" style="width: 100%; height:100%; min-height:500px" class="embed-responsive-item" src="<?php echo base_url() . "/tratamientos/generaHistorialPDF/" . $tratamientos . '/2022-01-01/' . $DateAndTime; ?>" title="tratamientos"></iframe>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript">
    var form = $("#formFechas");

    $("#formFechas").submit(function(e) {
        temporal = $("#estado").val();
        fechaInicio = $("#fechaInicio").val();
        fechaFinal = $("#fechaFinal").val();
        baseurl = $("#baseurl").val();
        var hoy = new Date();
        var fecha = hoy.getFullYear() + '-' + (hoy.getMonth() + 1) + '-' + hoy.getDate();
        var hora = hoy.getHours() + ':' + hoy.getMinutes();
        var fechaYHora = fecha + ' ' + hora;

        if (temporal == "") {
            temporal = 0;
        }
        if (fechaInicio == "") {
            fechaInicio = "2022-01-01";
        }
        if (fechaFinal == "") {
            fechaFinal = fechaYHora;
        }

        e.preventDefault();
        var url = form.attr('action');
        if ((fechaInicio >= "2022-01-01" && fechaFinal >= "2022-01-01") && (fechaInicio <= fechaYHora && fechaFinal <= fechaYHora)) {
            if (fechaInicio < fechaFinal) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . '/tratamientos/muestraTratamientosPDF' ?>",
                    data: form.serialize(),
                    success: function(data) {
                        document.getElementById('youriframe').src = baseurl + "/tratamientos/generaHistorialPDF/" + temporal + '/' + fechaInicio + '/' + fechaFinal;
                    }
                });
            } else {
                alert("la fecha inicial es mayor a la fecha final");
                document.getElementById('youriframe').src = "";
            }
        } else {
            alert("los rangos de fecha no pueden ser superiores al 2022-01-01 ni mayores a " + fechaYHora);
            document.getElementById('youriframe').src = "";
        }
    });
</script>