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
                                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>/Historial/actualizar" autocomplete="off">
                                
                                <input type="hidden" id="id" name="id" value="<?php echo $datos['idPaciente'];?>">
                                
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Nombres</label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $datos['nombrePaciente'];?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Apellidos</label>
                                            <input class="form-control" id="apellido" name="apellido" type="text" value="<?php echo $datos['apellidoPaciente'];?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Fecha de nacimiento:</label>
                                            <input class="form-control" id="fechaNacimiento" name="fechaNacimiento" type="date" value="<?php echo $datos['fechaNacimientoPaciente'];?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Teléfono:</label>
                                            <input class="form-control" id="telefono" name="telefono" type="text" value="<?php echo $datos['telefonoPaciente'];?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Correo:</label>
                                            <input class="form-control" id="correo" name="correo" type="text" value="<?php echo $datos['correoPaciente'];?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Identificación:</label>
                                            <input class="form-control" id="identificacion" name="identificacion" type="text" value="<?php echo $datos['identificacionPaciente'];?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Direccion:</label>
                                            <input class="form-control" id="direccion" name="direccion" type="text" value="<?php echo $datos['direccionPaciente'];?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Género:</label>
                                            <select class="form-control" id="genero" name="genero" required>
                                                <option value="" <?php if(""==$datos['generoPaciente']){ echo 'selected';}?>>Seleccionar género</option>
                                                <option value="M" <?php if("M"==$datos['generoPaciente']){ echo 'selected';}?>>Masculino</option>
                                                <option value="F" <?php if("F"==$datos['generoPaciente']){ echo 'selected';}?>>Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                                <a href="<?php echo base_url();?>/Historial" class="btn btn-primary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                        </div>                                    
                    </div>
                </main>