<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo?></h1>                            
                                <div>
                                    <a href="<?php echo base_url();?>/SignosVitales/nuevo/<?php echo $idanamnesis;?>/<?php echo $idpaciente;?>" class="btn btn-info">Agregar</a>
                                    <!--<a href="<?php echo base_url();?>/SignosVitales/eliminados" class="btn btn-warning">Eliminados</a>-->
                                    <a href="<?php echo base_url();?>/Anamnesis/index/<?php echo $idpaciente;?>" class="btn btn-primary">Regresar</a>
                                </div>
                                <br>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>P. Arterial</th>
                                            <th>F. Cardica</th>
                                            <th>F. Respiratoria</th>
                                            <th>Temperatura(°C)</th>
                                            <th>Peso(Lb)</th>
                                            <th>Talla(cm)</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($datos as $dato){
                                        ?>
                                        <tr>
                                            <td><?php echo $dato['idSignosVitales']?></td>
                                            <td><?php echo $dato['presionArterialSignosVitales']?></td>
                                            <td><?php echo $dato['frecuenciaCardiacaSignosVitales']?></td>
                                            <td><?php echo $dato['frecuenciaRespiratoriaSignosVitales']?></td>
                                            <td><?php echo $dato['temperaturaSignosVitales']?></td>
                                            <td><?php echo $dato['pesoSignosVitales']?></td>
                                            <td><?php echo $dato['tallaSignosVitales']?></td>
                                            <td><a href="<?php echo base_url().'/SignosVitales/editar/'. $dato['idSignosVitales'].'/'.$dato['idAnamnesis'].'/'.$idpaciente;?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a></td>
                                            <td><a href="#" data-href="<?php echo base_url().'/SignosVitales/eliminar/'. $dato['idSignosVitales'].'/'.$dato['idAnamnesis'].'/'.$idpaciente;?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar registro" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
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