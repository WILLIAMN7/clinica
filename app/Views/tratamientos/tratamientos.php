  <main>
    <div class="container-fluid px-4">
      <h2 class="mt-4"><?php echo $titulo ?> de <?php echo $pacientes['apellidoPaciente']; ?> <?php echo $pacientes['nombrePaciente']; ?></h2>      
      
      <div>
        <?php if ($permisoInsertar == 1) { ?>
          <a href="<?php echo base_url(); ?>/Tratamientos/nuevo/<?php echo $idPaciente; ?>" class="btn btn-info">Agregar</a>
        <?php } ?>
        <a href="<?php echo base_url(); ?>/Anamnesis/index/<?php echo $idPaciente; ?>" class="btn btn-primary">Regresar</a>
        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">

      </div>
      <br>
      <table id="datatablesSimple">
      <caption>Listado de tratamientos</caption>
        <thead>
          <tr>
            <th scope="col" style="display:none;">Id</th>
            <th scope="col">Doctor</th>
            <th scope="col">Tratamiento</th>
            <th scope="col">Estado</th>
            <th scope="col">Comentario</th>
            <?php if ($permisoEditar == 1) { ?>
              <th scope="col"></th>
            <?php } ?>
            <th scope="col"></th>
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
              <td style="display:none;"><?php echo $dato['idTratamiento'] ?></td>
              <td><?php echo $dato['apellidoMedico'] ?> <?php echo $dato['nombreMedico'] ?></td>
              <td><?php echo $dato['descripcionCodigosCie'] ?></td>
              <td><?php echo $dato['procedimientoTratamiento'] ?></td>
              <td><?php echo $dato['prescripcionTratamiento'] ?></td>
              <?php if ($permisoEditar == 1) { ?>
                <td><a href="<?php echo base_url() . '/Tratamientos/editar/' . $dato['idTratamiento'] . '/' . $idPaciente ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
              <?php } ?>
              <td><a href="<?php echo base_url() . '/ProcedimientosRealizados/index/' . $idPaciente . '/' . $dato['idTratamiento'] ?>" class="btn btn-success"><em class="fas fa-file-medical"></em></a></td>
              <?php if ($permisoEliminar == 1) { ?>
                <td><a href="#" data-href="<?php echo base_url() . '/Tratamientos/eliminar/' . $dato['idTratamiento'] . '/' . $idPaciente ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
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
          <p>¿Desea eliminar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
          <a class="btn btn-success btn-ok">SI</a>
        </div>
      </div>
    </div>
  </div>