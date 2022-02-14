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
                                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>/Pacientes/insertar" autocomplete="off">
                                <?php csrf_field(); ?>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Nombres</label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo set_value('nombre')?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Apellidos</label>
                                            <input class="form-control" id="apellido" name="apellido" type="text" value="<?php echo set_value('apellido')?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Fecha de nacimiento:</label>
                                            <input class="form-control" id="fechaNacimiento" name="fechaNacimiento" type="date" value="<?php echo set_value('fechaNacimiento')?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Teléfono:</label>
                                            <input class="form-control" id="telefono" name="telefono" type="text" value="<?php echo set_value('telefono')?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Correo:</label>
                                            <input class="form-control" id="correo" name="correo" type="text" value="<?php echo set_value('correo')?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Identificación:</label>
                                            <input class="form-control" id="identificacion" name="identificacion" type="text" value="<?php echo set_value('identificacion')?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Direccion:</label>
                                            <input class="form-control" id="direccion" name="direccion" type="text" value="<?php echo set_value('direccion')?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Género:</label>
                                            <select class="form-control" id="genero" name="genero" required>
                                                <option value="">Seleccionar género</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <a href="<?php echo base_url();?>/Pacientes" class="btn btn-primary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                        </div>                                   
                    </div>
                </main>