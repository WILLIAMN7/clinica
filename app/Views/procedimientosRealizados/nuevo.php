<?php
$user_session = session();
?>
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
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/ProcedimientosRealizados/insertar" autocomplete="off">
                        <?php csrf_field(); ?>
                        <input type="hidden" id="idMedicos" name="idMedicos" value="<?php echo $user_session->idMedico; ?>">
                        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                        <input type="hidden" id="idTratamientos" name="idTratamientos" value="<?php echo $idTratamiento; ?>">
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Paciente:</label>
                                    <input class="form-control" id="direccion" name="direccion" type="text" value="<?php echo $pacientes['nombrePaciente'];?> <?php echo $pacientes['apellidoPaciente'];?>" autofocus required readonly>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Tratamiento:</label>
                                    <input class="form-control" id="direccion" name="direccion" type="text" value="<?php echo $tratamientos['descripcionCodigosCie'];?>" autofocus required readonly>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Procedimiento:</label>
                                    <textarea class="form-control" id="procedimiento" name="procedimiento" type="text" autofocus><?php echo set_value('procedimiento')?></textarea>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Prescripción:</label>
                                    <textarea class="form-control" id="prescripcion" name="prescripcion" type="text" autofocus><?php echo set_value('prescripcion')?></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <a href="<?php echo base_url(); ?>/ProcedimientosRealizados/index/<?php echo $idPaciente; ?>/<?php echo $idTratamiento; ?>" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </main>