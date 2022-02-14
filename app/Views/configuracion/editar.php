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
                                <form method="POST" action="<?php echo base_url();?>/unidades/actualizar" autocomplete="off">
                                
                                <input type="hidden" id="id" name="id" value="<?php echo $datos['wn7_uni_id'];?>">

                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Nombre</label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $datos['wn7_uni_nombre'];?>" autofocus required>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label>Nombre corto</label>
                                            <input class="form-control" id="nombre_corto" name="nombre_corto" type="text" value="<?php echo $datos['wn7_uni_nombre_corto'];?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                                <a href="<?php echo base_url();?>/unidades" class="btn btn-primary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                        </div>                                    
                    </div>
                </main>