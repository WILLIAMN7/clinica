<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-body">
                    <form class="form-inline" method="post" name="formFechas" id="formFechas">
                        <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Fecha Inicio:</label>
                                <input type="datetime-local" class="form-control" name="fechaInicio" id="fechaInicio" min="2022-01-01" max="2022-02-31">
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Fecha Final:</label>
                                <input type="datetime-local" class="form-control" name="fechaFinal" id="fechaFinal" min="2022-01-01" max="2022-02-31">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success form-control">Buscar</button>
                    </form>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel">
                    <div class="embed-responsive embed-responsive-4by3" style="margin-top: 30px;">
                        <iframe id="youriframe" style="width: 100%; height:100%; min-height:500px" class="embed-responsive-item" src=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        function formatoFecha(fecha, formato) {
            const map = {
                dd: fecha.getDate(),
                mm: fecha.getMonth() + 1,
                yy: fecha.getFullYear().toString().slice(-2),
                yyyy: fecha.getFullYear(),
                h: fecha.getHours(),
                mm: fecha.getMinutes(),
                s: fecha.getSeconds()
            }

            return formato.replace(/dd|mm|yy|yyy/gi, matched => map[matched])
        }

        var form = $("#formFechas");

        $("#formFechas").submit(function(e) {
            fechaInicio = $("#fechaInicio").val();
            fechaFinal = $("#fechaFinal").val();
            baseurl = $("#baseurl").val();
            var hoy = new Date();
            var fecha = hoy.getFullYear() + '-' + (hoy.getMonth() + 1) + '-' + hoy.getDate();
            var hora = hoy.getHours() + ':' + hoy.getMinutes();
            var fechaYHora = fecha + ' ' + hora;

            if (fechaInicio == "") {
                fechaInicio = "2022-01-01";
            }
            if (fechaFinal == "") {
                fechaFinal = fechaYHora;
            }
            e.preventDefault();
            var url = form.attr('action');
            //if ((fechaInicio>="2022-01-01" && fechaFinal>="2022-01-01") && (fechaInicio<=fechaYHora && fechaFinal<=fechaYHora)) {
            if (fechaInicio < fechaFinal) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . '/pacientes/muestraPacientesPdf' ?>",
                    data: form.serialize(),
                    success: function(data) {
                        alert(document.getElementById('youriframe').src = baseurl + "/pacientes/generaPacientesPdf/" + fechaInicio + '/' + fechaFinal);
                    }
                });
            } else {
                alert("la fecha inicial es mayor a la fecha final");
                document.getElementById('youriframe').src = "";
            }
            /*}else{
                alert("los rangos de fecha no pueden ser superiores al 2022-01-01 ni mayores a "+fechaYHora);
                document.getElementById('youriframe').src = "";
            }*/
        });
    </script>