    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo ?></h1>
            <div>
                <?php if ($permisoInsertar == 1) { ?>
                    <a href="<?php echo base_url(); ?>/Historial/nuevo" class="btn btn-info">Agregar</a>
                <?php } ?>
                <?php if ($permisoEliminar == 1) { ?>
                    <a href="<?php echo base_url(); ?>/Historial/eliminados" class="btn btn-warning">Eliminados</a>
                <?php } ?>
            </div>
            <br>
            <table id="datatablesSimple">
            <caption>Listado de pacientes</caption>
                <thead>
                    <tr>
                        <th scope="col" style="display:none;">Id</th>
                        <th scope="col">Identificación</th>
                        <th scope="col">Paciente</th>
                        <?php if ($permisoEditar == 1) { ?>
                            <th scope="col"></th>
                        <?php } ?>
                        <?php if ($permisoEliminar == 1) { ?>
                            <th scope="col"></th>
                        <?php } ?>
                        <?php if ($permisoMostrar == 1) { ?>
                            <th scope="col"></th>
                        <?php } ?>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($datos as $dato) {
                    ?>
                        <tr>
                            <td style="display:none;"><?php echo $dato['idPaciente'] ?></td>
                            <td><?php echo $dato['identificacionPaciente'] ?></td>
                            <td><?php echo $dato['nombrePaciente'] ?> <?php echo $dato['apellidoPaciente'] ?></td>
                            <?php if ($permisoEditar == 1) { ?>
                                <td><a href="<?php echo base_url() . '/Historial/editar/' . $dato['idPaciente'] ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
                            <?php } ?>
                            <?php if ($permisoEliminar == 1) { ?>
                                <td><a href="#" data-href="<?php echo base_url() . '/Historial/eliminar/' . $dato['idPaciente'] ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
                            <?php } ?>
                            <?php if ($permisoMostrar == 1) { ?>
                                <td><a href="<?php echo base_url() . '/Anamnesis/index/' . $dato['idPaciente'] ?>" class="btn btn-info"><em class="fas fa-notes-medical"></em></a></td>
                            <?php } ?>
                            <td><a href="<?php echo base_url() . '/Historial/muestraHistorialPDF/' . $dato['idPaciente'] ?>" class="btn btn-success"><em class="fas fa-file-pdf"></em></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                    <a class="btn btn-success btn-ok">SI</a>
                </div>
            </div>
        </div>
    </div>