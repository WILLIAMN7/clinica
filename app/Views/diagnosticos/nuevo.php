<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $titulo ?></h1>
        <?php if (isset($validation)) { ?>
            <div class="alert alert-danger">
                <?php echo $validation->listErrors(); ?>
            </div>
        <?php } ?>

        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Diagnosticos/insertar" autocomplete="off">
                    <?php csrf_field(); ?>
                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                <label>Diagnostico</label>
                                <select class="mi-selector form-control" id="diagnostico" name="diagnostico" required>
                                    <option value="">Seleccionar codigo</option>
                                    <?php foreach ($codigosCie as $codigoCie) { ?>
                                        <option value="<?php echo $codigoCie['idCodigosCie'] ?>"><?php echo $codigoCie['descripcionCodigosCie'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Tipo de diagnósticos:</label>
                                <select class="mi-selector form-control" id="tipoDiagnostico" name="tipoDiagnostico" required>
                                    <option value="">Seleccionar</option>
                                    <option value="PRE">Presuntivo</option>
                                    <option value="DEF">Definitivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=form-group>
                        <div class="row">
                            <div class="col-12">
                                <label>Descripcion de diagnostico:</label>
                                <textarea class="form-control" id="descripcionDiagnostico" name="descripcionDiagnostico" type="text" autofocus></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <a href="<?php echo base_url(); ?>/Diagnosticos/index/<?php echo $idPaciente; ?>" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</main>

