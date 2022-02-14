<div id="layoutSidenav_content">    
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo?></h1>

                        <?php if(isset($validation)){ ?>
                        <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                        </div>
                        <?php }?> 
                        
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>/configuracion/actualizar" autocomplete="off">                                
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Nombre de la tienda</label>
                                            <input class="form-control" id="tienda_nombre" name="tienda_nombre" type="text" value="<?php echo $nombre['valorConfiguracion']; ?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>RFC</label>
                                            <input class="form-control" id="tienda_rfc" name="tienda_rfc" type="text" value="<?php echo $rfc['valorConfiguracion']; ?>" autofocus required>
                                        </div>
                                    </div>
                                </div>

                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Telefono</label>
                                            <input class="form-control" id="tienda_telefono" name="tienda_telefono" type="text" value="<?php echo $telefono['valorConfiguracion']; ?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Email</label>
                                            <input class="form-control" id="tienda_email" name="tienda_email" type="text" value="<?php echo $email['valorConfiguracion']; ?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Direccion</label>
                                            <textarea class="form-control" id="tienda_direccion" name="tienda_direccion" type="text" autofocus required><?php echo $direccion['valorConfiguracion']; ?></textarea>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Leyenda del ticket</label>
                                            <textarea class="form-control" id="ticket_leyenda" name="ticket_leyenda" type="text" autofocus required><?php echo $leyenda['valorConfiguracion']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                        <label>Logotipo</label>
                                        <br>
                                        <img src="<?php echo base_url().'/images/logotipo.png?nocache='.''.time();?>" class="img-responsive" width="200" />
                                        <input type="file" id="tienda_logo" name="tienda_logo" accept="image/png"/>
                                        <p class="text-danger">Cargar imagen en formato png de 150x150 px</p>
                                        </div>
                                    </div>
                                </div>

                            </div>    
                            
                            

                             <a href="<?php echo base_url();?>/unidades" class="btn btn-primary">Regresar</a>
                             <button type="submit" class="btn btn-success">Guardar</button>
                        </form>                                                
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

