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
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/CodigosCie/actualizar" autocomplete="off">
                    <input type="hidden" id="id" name="id" value="<?php echo $datos['idCodigosCie']; ?>">
                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Códigos Cie</label>
                                <input class="form-control" id="codigoMedico" name="codigoMedico" type="text" value="<?php echo $datos['codigoCodigosCie']; ?>" autofocus required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Descripcion</label>
                                <input class="form-control" id="descripcion" name="descripcion" type="text" value="<?php echo $datos['descripcionCodigosCie']; ?>" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Tipo:</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="" <?php if ("" == $datos['tipoCodigosCie']) {
                                                            echo 'selected';
                                                        } ?>>Seleccionar</option>
                                    <option value="DIA" <?php if ("DIA" == $datos['tipoCodigosCie']) {
                                                            echo 'selected';
                                                        } ?>>Diagnostico</option>
                                    <option value="TRA" <?php if ("TRA" == $datos['tipoCodigosCie']) {
                                                            echo 'selected';
                                                        } ?>>Tratamiento</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <a href="<?php echo base_url(); ?>/CodigosCie" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</main>