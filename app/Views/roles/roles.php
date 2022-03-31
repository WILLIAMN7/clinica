  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo ?></h1>

      <div class="card mb-4">
        <div class="card-body">
          <div>
          <?php if ($permisoInsertar == 1) { ?>
            <a href="<?php echo base_url(); ?>/roles/nuevo" class="btn btn-info">Agregar</a>
            <?php } ?>
            <?php if ($permisoEliminar == 1) { ?>
            <a href="<?php echo base_url(); ?>/roles/eliminados" class="btn btn-warning">Eliminados</a>
            <?php } ?>

          </div>
          <table id="datatablesSimple">
          <caption>Listado de roles</caption>
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <?php if ($permisoEditar == 1) { ?>
                <th scope="col"></th>
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
                  <td><?php echo $dato['idRoles'] ?></td>
                  <td><?php echo $dato['nombreRoles'] ?></td>
                  <?php if ($permisoEditar == 1) { ?>
                  <td><a href="<?php echo base_url() . '/roles/detalles/' . $dato['idRoles'] ?>" class="btn btn-success"><em class="fas fa-list"></em></a></td>
                  <td><a href="<?php echo base_url() . '/roles/editar/' . $dato['idRoles'] ?>" class="btn btn-warning"><em class="fas fa-pencil-alt"></em></a></td>
                  <?php } ?>
                  <?php if ($permisoEliminar == 1) { ?>
                  <td><a href="#" data-href="<?php echo base_url() . '/roles/eliminar/' . $dato['idRoles'] ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><em class="fas fa-trash"></em></a></td>
                  <?php } ?>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>


  <!-- Modal de eliminar registros-->
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
