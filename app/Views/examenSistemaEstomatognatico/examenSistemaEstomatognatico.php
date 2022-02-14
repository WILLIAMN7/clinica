<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo ?></h1>
      <div>
        <a href="<?php echo base_url(); ?>/ExamenSistemaEstomatognatico/nuevo/<?php echo $idanamnesis; ?>/<?php echo $idpaciente; ?>" class="btn btn-info">Agregar</a>
        <!--<a href="<?php echo base_url(); ?>/SignosVitales/eliminados" class="btn btn-warning">Eliminados</a>-->
        <a href="<?php echo base_url(); ?>/Anamnesis/index/<?php echo $idpaciente; ?>" class="btn btn-primary">Regresar</a>
      </div>
      <br>
      <table id="datatablesSimple">
        <thead>
          <tr style="font-size: 12px;">
            <th style="display:none;">Id</th>
            <th>Labios</th>
            <th>Mejillas</th>
            <th>Maxilar Superior</th>
            <th>Maxilar Inferior</th>
            <th>Lengua</th>
            <th>Paladar</th>
            <th>Piso de boca</th>
            <th>Carrillos</th>
            <th>Glándulas Salivales</th>
            <th>Faringe</th>
            <th>ATM</th>
            <th>Ganglios</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($datos as $dato) {
          ?>
            <tr>
              <td style="display:none;"><?php echo $dato['idExamenSistemaEstomatognatico'] ?></td>
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
              <td><a href="<?php echo base_url() . '/ExamenSistemaEstomatognatico/editar/' . $dato['idExamenSistemaEstomatognatico'] . '/' . $dato['idAnamnesis'] . '/' . $idpaciente; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a></td>
              <td><a href="#" data-href="<?php echo base_url() . '/ExamenSistemaEstomatognatico/eliminar/' . $dato['idExamenSistemaEstomatognatico'] . '/' . $dato['idAnamnesis'] . '/' . $idpaciente; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
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