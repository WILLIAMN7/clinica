<?php
$user_session = session();
?>
<div id="layoutSidenav_content">
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
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Tratamientos/actualizar" autocomplete="off">

                        <input type="hidden" id="id" name="id" value="<?php echo $tratamientos['idTratamiento']; ?>">
                        <input type="hidden" id="idMedicos" name="idMedicos" value="<?php echo $user_session->idMedico; ?>">
                        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Tratamiento</label>
                                    <select class="form-control" id="tratamiento" name="tratamiento" required>
                                        <option value="">Seleccionar codigo</option>
                                        <?php foreach ($codigos_cie as $codigoCie) { ?>
                                            <option value="<?php echo $codigoCie['idCodigosCie'] ?>" <?php if ($codigoCie['idCodigosCie'] == $tratamientos['idCodigoCie']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo $codigoCie['descripcionCodigosCie'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Comentario</label>
                                    <textarea class="form-control" id="comentario" name="comentario" type="text" autofocus><?php echo $tratamientos['prescripcionTratamiento']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Estado</label>
                                    <select class="form-control" id="estado" name="estado" required>
                                        <option value="PENDIENTE" <?php if ("PENDIENTE" == $tratamientos['procedimientoTratamiento']) {
                                                                        echo 'selected';
                                                                    } ?>>Pendiente</option>
                                        <option value="EN PROCESO" <?php if ("EN PROCESO" == $tratamientos['procedimientoTratamiento']) {
                                                                        echo 'selected';
                                                                    } ?>>En proceso</option>
                                        <option value="FINALIZADO" <?php if ("FINALIZADO" == $tratamientos['procedimientoTratamiento']) {
                                                                        echo 'selected';
                                                                    } ?>>Finalizado</option>
                                        <option value="ANULADO" <?php if ("ANULADO" == $tratamientos['procedimientoTratamiento']) {
                                                                        echo 'selected';
                                                                    } ?>>Anulado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <a href="<?php echo base_url(); ?>/Tratamientos/index/<?php echo $idPaciente; ?>" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </main>