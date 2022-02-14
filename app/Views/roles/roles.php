<?php
include("nuevo.php");
//	include("editar.php");		

?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo ?></h1>

      <div class="card mb-4">
        <div class="card-body">
          <div>
            <a href="<?php echo base_url(); ?>/roles/nuevo" class="btn btn-info">Agregar</a>

            <a href="#" data-href="<?php echo base_url(); ?>/roles/nuevo" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-ingresar" data-bs-placement="top" title="Ingresar registro" class="btn btn-danger">Agregar modal</a>
            <!--<a href="#" data-href="" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><i class="fas fa-trash"></i></a>-->

            <a href="<?php echo base_url(); ?>/roles/eliminados" class="btn btn-warning">Eliminados</a>

            <?php if (session('mensaje')) :  ?>
              <div class="alert alert-success" role="alert">
                <strong>¡Bien hecho!</strong>
                <?php echo session('mensaje') ?>
              </div>
            <?php endif ?>

          </div>
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($datos as $dato) {
              ?>
                <tr>
                  <td><?php echo $dato['idRoles'] ?></td>
                  <td><?php echo $dato['nombreRoles'] ?></td>
                  <td><a href="<?php echo base_url() . '/roles/detalles/' . $dato['idRoles'] ?>" class="btn btn-success"><i class="fas fa-list"></i></a></td>
                  <td><a href="<?php echo base_url() . '/roles/editar/' . $dato['idRoles'] ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a></td>

                  <td><a href="#" data-href="<?php echo base_url() . '/roles/eliminar/' . $dato['idRoles'] ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
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



  <!-- Modal de eliminar registros-->
  <!--
<div class="modal fade" id="modal-ingresar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      fff


      </div>
      <div class="modal-footer">      
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
      <a class="btn btn-success btn-ok">SI</a>
      </div>
    </div>
  </div>
</div>

                                    -->