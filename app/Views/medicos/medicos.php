  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo ?></h1>

      <div>
        <?php if ($permisoInsertar == 1) { ?>
          <a id="insertarMedicos" href="<?php echo base_url(); ?>/Medicos/nuevo" class="btn btn-info">Agregar</a>
        <?php } ?>
        <?php if ($permisoEliminar == 1) { ?>
          <a href="<?php echo base_url(); ?>/Medicos/eliminados" class="btn btn-warning">Eliminados</a>
        <?php } ?>
      </div>
      <br>
      <table id="datatablesSimple">
      <caption>Listado de médicos</caption>
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Médico</th>
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
              <td><?php echo $dato['idMedico'] ?></td>
              <td><?php echo $dato['nombreMedico'] ?> <?php echo $dato['apellidoMedico'] ?></td>
              <?php if ($permisoEditar == 1) { ?>
                <td><a href="<?php echo base_url() . '/Medicos/editar/' . $dato['idMedico'] ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
              <?php } ?>
              <?php if ($permisoEliminar == 1) { ?>
                <td><a href="#" data-href="<?php echo base_url() . '/Medicos/eliminar/' . $dato['idMedico'] ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
              <?php } ?>
    </div>
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