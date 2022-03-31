
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
                                <form method="POST" action="<?php echo base_url();?>/usuarios/insertar" autocomplete="off">
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Usuario</label>
                                            <input class="form-control" id="usuario" name="usuario" type="text" value="<?php echo set_value('usuario')?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Alias</label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo set_value('nombre')?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Clave</label>
                                            <input class="form-control" id="password" name="password" type="password" value="<?php echo set_value('password')?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Repetir clave</label>
                                            <input class="form-control" id="repassword" name="repassword" type="password" value="<?php echo set_value('repassword')?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">                                    
                                        <div class="col-12 col-sm-6">
                                            <label>Roles</label>
                                            <select class="form-control" id="idRol" name="idRol" required>
                                                <option value="" <?php if(""==set_value('idRol')){ echo 'selected';}?>>Seleccionar rol</option>
                                            <?php foreach($roles as $rol){ ?>    
                                                <option value="<?php echo $rol['idRoles']?>" <?php if($rol['idRoles']==set_value('idRol')){ echo 'selected';}?>><?php echo $rol['nombreRoles']?></option>
                                            <?php }?>    
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Médico</label>
                                            <select class="form-control" id="idMedico" name="idMedico" required>
                                                <option value="" <?php if(""==set_value('idMedico')){ echo 'selected';}?>>Seleccionar medico</option>
                                            <?php foreach($medicos as $medico){ ?>    
                                                <option value="<?php echo $medico['idMedico']?>" <?php if($medico['idMedico']==set_value('idMedico')){ echo 'selected';}?>><?php echo $medico['nombreMedico']?></option>
                                            <?php }?>    
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                                <a href="<?php echo base_url();?>/usuarios" class="btn btn-primary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                        </div>                                    
                    </div>
                </main>


 