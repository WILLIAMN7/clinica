<!--
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo ?></h1>
                        <?php if (isset($validation)) { ?>
                        <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                        </div>
                        <?php } ?> 
                        
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="POST" action="<?php echo base_url(); ?>/roles/insertar" autocomplete="off">
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Nombre</label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo set_value('nombre') ?>" autofocus required>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>                        
                                <a href="<?php echo base_url(); ?>/roles" class="btn btn-primary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                        </div>                                    
                    </div>
                </main>
-->

<div class="modal fade" id="modal-ingresar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="<?php echo base_url(); ?>/roles/insertar" autocomplete="off">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo set_value('nombre') ?>" autofocus required>
                            </div>
                        </div>
                    </div>
                    <!--                               <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Nombre</label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo set_value('nombre') ?>" autofocus required>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>                        
                                <a href="<?php echo base_url(); ?>/roles" class="btn btn-primary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                                -->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <!--<a class="btn btn-success btn-ok">SI</a>-->
                </div>
            </div>
        </div>
    </form>
</div>