
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo?></h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div>                                    
                                    <a href="<?php echo base_url();?>/Historial" class="btn btn-warning">Pacientes</a>
                                </div>
                                <table id="datatablesSimple">
                                    <caption>Listado de pacientes eliminados</caption>
                                    <thead>
                                            <th scope="col">Id</th>
                                            <th scope="col">Paciente</th>
                                            <th scope="col"></th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($datos as $dato){
                                        ?>
                                        <tr>
                                            <td><?php echo $dato['idPaciente']?></td>
                                            <td><?php echo $dato['nombrePaciente']?> <?php echo $dato['apellidoPaciente']?></td>
                                            <td><a href="#" data-href="<?php echo base_url().'/Historial/reingresar/'. $dato['idPaciente']?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Reingresar registro" class="btn btn-success"><em class="fas fa-arrow-alt-circle-up"></em></a></td>
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


                <!-- Modal -->
<div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reingresar registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>??Desea reingresar este registro?</p>
      </div>
      <div class="modal-footer">      
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
      <a class="btn btn-success btn-ok">SI</a>
      </div>
    </div>
  </div>
</div>