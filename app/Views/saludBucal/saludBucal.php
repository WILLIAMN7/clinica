
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo ?></h1>

      <div>
        <?php if ($permisoInsertar == 1) { ?>
          <a href="<?php echo base_url(); ?>/SaludBucal/nuevo/<?php echo $idanamnesis; ?>/<?php echo $idpaciente; ?>" class="btn btn-info">Agregar</a>
        <?php } ?>
        <a href="<?php echo base_url(); ?>/Anamnesis/mostrarAnamnesis/<?php echo $idpaciente; ?>" class="btn btn-primary">Regresar</a>
      </div>
      <br>
      <table id="datatablesSimple">
      <caption>Listado de salud bucal</caption>
        <thead>
          <tr>
            <th scope="col" style="display:none;">Id</th>
            <th scope="col">Enf. periodontal</th>
            <th scope="col">Maloclusión</th>
            <th scope="col">Fluorosis</th>
            <th scope="col">Total placa</th>
            <th scope="col">Total calculo</th>
            <th scope="col">Total gingivitis</th>
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
              <td style="display:none;"><?php echo $dato['idSaludBucal'] ?></td>
              <td><?php echo $dato['enfermedadPeriodontalSaludBucal'] ?></td>
              <td><?php echo $dato['maloclusionSaludBucal'] ?></td>
              <td><?php echo $dato['fluorosisSaludBucal'] ?></td>
              <?php $datospieza161755 = explode(",", $dato['higieneOral161755SaludBucal']); ?>
              <?php $datospieza112151 = explode(",", $dato['higieneOral112151SaludBucal']); ?>
              <?php $datospieza262765 = explode(",", $dato['higieneOral262765SaludBucal']); ?>
              <?php $datospieza363775 = explode(",", $dato['higieneOral363775SaludBucal']); ?>
              <?php $datospieza314171 = explode(",", $dato['higieneOral314171SaludBucal']); ?>
              <?php $datospieza464785 = explode(",", $dato['higieneOral464785SaludBucal']); ?>
              <td><?php echo round((($datospieza161755[1] + $datospieza112151[1] + $datospieza262765[1] + $datospieza363775[1] + $datospieza314171[1] + $datospieza464785[1]) / 6), 2) ?></td>
              <td><?php echo round((($datospieza161755[2] + $datospieza112151[2] + $datospieza262765[2] + $datospieza363775[2] + $datospieza314171[2] + $datospieza464785[2]) / 6), 2) ?></td>
              <td><?php echo round((($datospieza161755[3] + $datospieza112151[3] + $datospieza262765[3] + $datospieza363775[3] + $datospieza314171[3] + $datospieza464785[3]) / 6), 2) ?></td>
              <?php if ($permisoEditar == 1) { ?>
                <td><a href="<?php echo base_url() . '/SaludBucal/editar/' . $dato['idSaludBucal'] . '/' . $dato['idAnamnesis'] . '/' . $idpaciente; ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
              <?php } ?>
              <?php if ($permisoEliminar == 1) { ?>
                <td><a href="#" data-href="<?php echo base_url() . '/SaludBucal/eliminar/' . $dato['idSaludBucal'] . '/' . $dato['idAnamnesis'] . '/' . $idpaciente; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
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