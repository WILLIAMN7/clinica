  <main>
    <div class="container-fluid px-4">
      <h2 class="mt-4"><?php echo $titulo ?> a <?php echo $pacientes['apellidoPaciente']; ?> <?php echo $pacientes['nombrePaciente']; ?></h2>
      <div>
      <?php if ($permisoInsertar == 1) { ?>
        <a href="<?php echo base_url(); ?>/Examenes/nuevo/<?php echo $idPaciente; ?>" class="btn btn-info">Agregar</a>
        <?php } ?>
        <a href="<?php echo base_url(); ?>/Anamnesis/index/<?php echo $idPaciente; ?>" class="btn btn-primary">Regresar</a>
        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
      </div>
      <br>
      <table id="datatablesSimple">
      <caption>Listado de examenes realizados</caption>
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Examen enviado</th>
            <th scope="col">Comentario</th>
            <th scope="col"></th>
            <?php if ($permisoEditar == 1) { ?>
            <th scope="col"></th>
            <?php } ?>
              <?php if ($permisoEliminar == 1) { ?>
            <th scope="col"></th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($datos as $dato) {
          ?>
            <tr>
              <td><?php echo $dato['idPlanDiagnostico'] ?></td>
              <td><?php echo $dato['examenEnviadoPlanDiagnostico'] ?></td>
              <td><?php echo $dato['comentarioPlanDiagnostico'] ?></td>
              <td>
                <?php
                $directory = getcwd() . "/images/examenes/" . $dato['idPlanDiagnostico'] . "/";
                if (file_exists($directory)) {
                  // Returns array of files
                  $files1 = scandir($directory);
                  // Count number of files and store them to variable
                  $num_files = count($files1) - 2;
                  //echo $num_files . " files";
                  for ($i = 1; $i < $num_files + 1; $i++) {
                ?>
                    <a href="<?php echo base_url() . '/images/examenes/' . $dato['idPlanDiagnostico'] . '/archivo_' . $i . '.pdf' ?>" target=_blank>Ver archivo_<?php echo $i ?>.pdf</a>
                <?php
                  }
                } else {
                  echo "No hay archivos";
                }
                ?>
              </td>
              <?php if ($permisoEditar == 1) { ?>
              <td><a href="<?php echo base_url() . '/Examenes/editar/' . $dato['idPlanDiagnostico'] . '/' . $idPaciente ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
              <?php } ?>
              <?php if ($permisoEliminar == 1) { ?>
              <td><a href="#" data-href="<?php echo base_url() . '/Examenes/eliminar/' . $dato['idPlanDiagnostico'] . '/' . $idPaciente ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
              <?php } ?>
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
          <p>??Desea eliminar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
          <a class="btn btn-success btn-ok">SI</a>
        </div>
      </div>
    </div>
  </div>