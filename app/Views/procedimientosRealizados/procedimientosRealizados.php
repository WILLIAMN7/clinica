  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo ?></h1>
      
      <div>
        <?php if ($permisoInsertar == 1) { ?>
          <a href="<?php echo base_url(); ?>/ProcedimientosRealizados/nuevo/<?php echo $idPaciente; ?>/<?php echo $idTratamiento; ?>" class="btn btn-info">Agregar</a>
          <a href="<?php echo base_url(); ?>/ProcedimientosRealizados/finalizado/<?php echo $idPaciente; ?>/<?php echo $idTratamiento; ?>" class="btn btn-success">Tratamiento finalizado</a>
        <?php } ?>
        <a href="<?php echo base_url(); ?>/Tratamientos/index/<?php echo $idPaciente; ?>" class="btn btn-primary">Regresar</a>
        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
        <input type="hidden" id="idTratamiento" name="idTratamiento" value="<?php echo $idTratamiento; ?>">

      </div>
      <br>
      <table id="datatablesSimple">
      <caption>Listado de procedimientos realizados</caption>
        <thead>
          <tr>
            <th scope="col">N. Sesión</th>
            <th scope="col" style="display:none;">Id</th>
            <th scope="col">Doctor</th>
            <th scope="col">Tratamiento</th>
            <th scope="col">Procedimiento</th>
            <th scope="col">Prescripción</th>
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
          $contador = 1;
          foreach ($datos as $dato) {
          ?>
            <tr>
              <td><?php echo $contador ++?></td>
              <td style="display:none;"><?php echo $dato['idProcedimientosRealizados'] ?></td>
              <td><?php echo $dato['nombreMedico'] ?> <?php echo $dato['apellidoMedico'] ?></td>
              <td><?php echo $dato['descripcionCodigosCie'] ?></td>
              <td><?php echo $dato['procedimientoProcedimientosRealizados'] ?></td>
              <td><?php echo $dato['prescripcionProcedimientosRealizados'] ?></td>
              <?php if ($permisoEditar == 1) { ?>
                <td><a href="<?php echo base_url() . '/ProcedimientosRealizados/editar/' . $dato['idProcedimientosRealizados'] . '/' . $idPaciente . '/' . $dato['idTratamiento'] ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
              <?php } ?>
              <?php if ($permisoEliminar == 1) { ?>
                <td><a href="#" data-href="<?php echo base_url() . '/ProcedimientosRealizados/eliminar/' . $dato['idProcedimientosRealizados'] . '/' . $idPaciente . '/' . $dato['idTratamiento'] ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
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