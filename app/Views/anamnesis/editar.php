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
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Anamnesis/actualizar" autocomplete="off">

                    <input type="hidden" id="id" name="id" value="<?php echo $datos['idAnamnesis']; ?>">
                    <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $datos['idPaciente']; ?>">


                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Motivo de consulta:</label>
                                <textarea class="form-control" id="motivoConsulta" name="motivoConsulta" autofocus required><?php echo $datos['motivoConsultaAnamnesis']; ?></textarea>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Descripción del problema:</label>
                                <textarea class="form-control" id="problema" name="problema" autofocus required><?php echo $datos['descripcionProblemaAnamnesis']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <?php $grupoEtareo=$datos['grupoEtarioAnamnesis']?>
                                <label>Grupo etario:</label>
                                <select class="form-control" id="grupoEtario" name="grupoEtario" required>
                                    <option value="" <?php if ("" == $grupoEtareo) {
                                                            echo 'selected';
                                                        } ?>>Seleccionar grupo etario</option>
                                    <option value="Menor de 1 año" <?php if ("Menor de 1 año" == $grupoEtareo) {
                                                                        echo 'selected';
                                                                    } ?>>Menor de 1 año</option>
                                    <option value="1-4 años" <?php if ("1-4 años" == $grupoEtareo) {
                                                                    echo 'selected';
                                                                } ?>>1-4 años</option>
                                    <option value="5-9 años programado" <?php if ("5-9 años programado" == $grupoEtareo) {
                                                                            echo 'selected';
                                                                        } ?>>5-9 años programado</option>
                                    <option value="5-14 años no programado" <?php if ("5-14 años no programado" == $grupoEtareo) {
                                                                                echo 'selected';
                                                                            } ?>>5-14 años no programado</option>
                                    <option value="10-14 años programado" <?php if ("10-14 años programado" == $grupoEtareo) {
                                                                                echo 'selected';
                                                                            } ?>>10-14 años programado</option>
                                    <option value="15-19 años" <?php if ("15-19 años" == $grupoEtareo) {
                                                                    echo 'selected';
                                                                } ?>>15-19 años</option>
                                    <option value="Mayor de 20 años" <?php if ("Mayor de 20 años" == $grupoEtareo) {
                                                                            echo 'selected';
                                                                        } ?>>Mayor de 20 años</option>
                                    <option value="Embarazada" <?php if ("Embarazada" == $grupoEtareo) {
                                                                    echo 'selected';
                                                                } ?>>Embarazada</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <a href="<?php echo base_url(); ?>/Anamnesis/mostrarAnamnesis/<?php echo $datos['idPaciente']; ?>" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</main>