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
                                <input type="date" class="form-control" name="fechaInicio" id="fechaInicio">
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Fecha Final:</label>
                                <input type="date" class="form-control" name="fechaFinal" id="fechaFinal">
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>txtcampo:</label>
                                <input type="text" class="form-control" name="txtcampo" id="txtcampo">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>

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
        var form = $("#formFechas");

        $("#formFechas").submit(function(e) {
            temporal = $("#txtcampo").val();
            fechaInicio = $("#fechaInicio").val();
            fechaFinal = $("#fechaFinal").val();
            baseurl = $("#baseurl").val();

            if (temporal == "") {
                temporal = 0;
            }
            if (fechaInicio == "") {
                fechaInicio = "2022-01-01";
            }
            if (fechaFinal == "") {
                fechaFinal = "2022-02-13";
            }

            e.preventDefault();
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . '/tratamientos/muestraTratamientosPDF' ?>",
                data: form.serialize(),
                success: function(data) {
                    alert(document.getElementById('youriframe').src = baseurl + "/tratamientos/generaHistorialPDF/" + temporal + '/' + fechaInicio + '/' + fechaFinal);
                }
            });
        });
    </script>