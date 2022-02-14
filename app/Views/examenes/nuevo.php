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
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Examenes/insertar" autocomplete="off">
                        <?php csrf_field(); ?>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                    <label>Examenes</label>
                                    <select class="form-control" id="examenes" name="examenes" required>
                                        <option value="">Seleccionar</option>
                                        <option value="Biometria">Biometría</option>
                                        <option value="Química sanguínea">Química Sanguinea</option>
                                        <option value="Rayos X">Rayos X</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Archivo</label>
                                    <br>
                                    <input type="file" id="imgExamenes" name="imgExamenes[]" accept="application/pdf" multiple />
                                    <!--<p class="text-danger">Cargar imagen en formato png de 150x150 px</p>-->
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12">
                                    <label>Comentario:</label>
                                    <textarea class="form-control" id="comentario" name="comentario" type="text" autofocus></textarea>
                                </div>
                            </div>
                        </div>
                </div>

                <a href="<?php echo base_url(); ?>/Examenes/index/<?php echo $idPaciente; ?>" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </main>