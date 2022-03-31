
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
                                <form method="POST" action="<?php echo base_url();?>/roles/actualizar" autocomplete="off">
                                
                                <input type="hidden" id="id" name="id" value="<?php echo $datos['idRoles'];?>">

                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Nombre</label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $datos['nombreRoles'];?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <a href="<?php echo base_url();?>/roles" class="btn btn-primary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                        </div>                                    
                    </div>
                </main>