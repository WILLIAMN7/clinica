<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo?></h1>                                                    
                                <div>                                    
                                    <a href="<?php echo base_url();?>/CodigosCie" class="btn btn-warning">Códigos CIE</a>
                                </div>
                                <table id="datatablesSimple">
                                    <thead>
                                            <th>Id</th>
                                            <th>Descripción</th>
                                            <th>Código</th>
                                            <th></th>                                            
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($datos as $dato){
                                        ?>
                                        <tr>
                                            <td><?php echo $dato['idCodigosCie']?></td>
                                            <td><?php echo $dato['descripcionCodigosCie']?></td>
                                            <td><?php echo $dato['codigoCodigosCie']?></td>
                                            <td><a href="#" data-href="<?php echo base_url().'/CodigosCie/reingresar/'. $dato['idCodigosCie']?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Reingresar registro" class="btn btn-success"><i class="fas fa-arrow-alt-circle-up"></i></a></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Reingresar registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>¿Desea reingresar este registro?</p>
      </div>
      <div class="modal-footer">      
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
      <a class="btn btn-success btn-ok">SI</a>
      </div>
    </div>
  </div>
</div>