  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo ?></h1>
      <div>
        <?php if ($permisoInsertar == 1) { ?>
          <a href="<?php echo base_url(); ?>/SignosVitales/nuevo/<?php echo $idanamnesis; ?>/<?php echo $idpaciente; ?>" class="btn btn-info">Agregar</a>
        <?php } ?>
        <a href="<?php echo base_url(); ?>/Anamnesis/mostrarAnamnesis/<?php echo $idpaciente; ?>" class="btn btn-primary">Regresar</a>
      </div>
      <br>
      <table id="datatablesSimple">
      <caption>Listado de signos vitales</caption>
        <thead>
          <tr>
            <th scope="col" style="display:none;">Id</th>
            <th scope="col">P. Arterial(MM HG)</th>
            <th scope="col">F. Cardica(PPM)</th>
            <th scope="col">F. Respiratoria(RPM)</th>
            <th scope="col">Temperatura(°C)</th>
            <th scope="col">Peso(KG)</th>
            <th scope="col">Talla(CM)</th>
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
            <td style="display:none;"><?php echo $dato['idSignosVitales'] ?></td>
              <td><?php echo $dato['presionArterialSistolicaSignosVitales'] ?>/<?php echo $dato['presionArterialDiastolicaSignosVitales'] ?></td>
              <td><?php echo $dato['frecuenciaCardiacaSignosVitales'] ?></td>
              <td><?php echo $dato['frecuenciaRespiratoriaSignosVitales'] ?></td>
              <td><?php echo $dato['temperaturaSignosVitales'] ?></td>
              <td><?php echo $dato['pesoSignosVitales'] ?></td>
              <td><?php echo $dato['tallaSignosVitales'] ?></td>
              <?php if ($permisoEditar == 1) { ?>
                <td><a href="<?php echo base_url() . '/SignosVitales/editar/' . $dato['idSignosVitales'] . '/' . $dato['idAnamnesis'] . '/' . $idpaciente; ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
              <?php } ?>
              <?php if ($permisoEliminar == 1) { ?>
                <td><a href="#" data-href="<?php echo base_url() . '/SignosVitales/eliminar/' . $dato['idSignosVitales'] . '/' . $dato['idAnamnesis'] . '/' . $idpaciente; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
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