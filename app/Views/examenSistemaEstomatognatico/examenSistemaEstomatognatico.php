  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo ?></h1>
      <div>
        <?php if ($permisoInsertar == 1) { ?>
          <a href="<?php echo base_url(); ?>/ExamenSistemaEstomatognatico/nuevo/<?php echo $idanamnesis; ?>/<?php echo $idpaciente; ?>" class="btn btn-info">Agregar</a>
        <?php } ?>
        <a href="<?php echo base_url(); ?>/Anamnesis/mostrarAnamnesis/<?php echo $idpaciente; ?>" class="btn btn-primary">Regresar</a>
      </div>
      <br>
      <table id="datatablesSimple">
      <caption>Listado de examen del sistema estomatognático</caption>
        <thead>
          <tr style="font-size: 12px;">
            <th scope="col" style="display:none;">Id</th>
            <th scope="col">Labios</th>
            <th scope="col">Mejillas</th>
            <th scope="col">Maxilar Superior</th>
            <th scope="col">Maxilar Inferior</th>
            <th scope="col">Lengua</th>
            <th scope="col">Paladar</th>
            <th scope="col">Piso de boca</th>
            <th scope="col">Carrillos</th>
            <th scope="col">Glándulas Salivales</th>
            <th scope="col">Faringe</th>
            <th scope="col">ATM</th>
            <th scope="col">Ganglios</th>
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
              <?php $idExamen=$dato['idExamenSistemaEstomatognatico']?>
              <td style="display:none;"><?php echo $idExamen ?></td>
              <td><?php echo $dato['labiosExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['mejillasExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['maxilarSuperiorExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['maxilarInferiorExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['lenguaExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['paladarExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['pisoDeBocaExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['carrillosExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['glandulasSalivalesExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['faringeExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['atmExamenSistemaEstomatognatico'] ?></td>
              <td><?php echo $dato['gangliosExamenSistemaEstomatognatico'] ?></td>

              <?php if ($permisoEditar == 1) { ?>
                <td><a href="<?php echo base_url() . '/ExamenSistemaEstomatognatico/editar/' . $idExamen . '/' . $dato['idAnamnesis'] . '/' . $idpaciente; ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
              <?php } ?>
              <?php if ($permisoEliminar == 1) { ?>
                <td><a href="#" data-href="<?php echo base_url() . '/ExamenSistemaEstomatognatico/eliminar/' . $idExamen . '/' . $dato['idAnamnesis'] . '/' . $idpaciente; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
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