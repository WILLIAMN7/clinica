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
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Tratamientos/insertar" autocomplete="off">
                        <?php csrf_field(); ?>
                        <input type="hidden" id="idMedicos" name="idMedicos" value="<?php echo $user_session->idMedico; ?>">
                        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Tratamiento</label>
                                    <select class="mi-selector form-control" id="tratamiento" name="tratamiento" required>
                                        <option value="">Seleccionar codigo</option>
                                        <?php foreach ($codigos_cie as $codigo_cie) { ?>
                                            <option value="<?php echo $codigo_cie['idCodigosCie'] ?>"><?php echo $codigo_cie['descripcionCodigosCie'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Comentario</label>
                                    <textarea class="form-control" id="comentario" name="comentario" type="text" autofocus></textarea>
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