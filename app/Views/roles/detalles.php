<div id="layoutSidenav_content">    
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo?></h1>
                        <form id="form_permisos" name="form_permisos" method="POST" action="<?php echo base_url().'/roles/guardaPermisos'?>">
                        <input type="hidden" id="id_rol" name="id_rol" value="<?php echo $id_rol;?>">
                        <div class=form-group>
                                    <div class="row">
                                        <div class="col-4 col-sm-4">
                                            Menu
                                            <br/>
                        <?php                        
                        foreach($permisos as $permiso){                                                       
                            if ($permiso['tipoPermisos'] == 1){
                            ?>
                            
                            <input type="checkbox" value="<?php echo $permiso['idPermisos']?>" name="permisos[]" <?php if(isset($asignado[$permiso['idPermisos']])){ echo 'checked';}?> /> <label><?php echo $permiso['nombrePermisos'] ?></label>  
                            <br/>  
                            <?php                             
                        } 
                    }
                        ?>
                        </div>
                        
                        <div class="col-4 col-sm-4">
                                           SubMenu
                                            <br/>
                        <?php
                        foreach($permisos as $permiso){                                                       
                            if ($permiso['tipoPermisos'] == 2){
                            ?>                            
                            <input type="checkbox" value="<?php echo $permiso['idPermisos']?>" name="permisos[]" <?php if(isset($asignado[$permiso['idPermisos']])){ echo 'checked';}?> /> <label><?php echo $permiso['nombrePermisos'] ?></label>
                            <br/>  
                            <?php                             
                        }}
                        ?>
                        </div>
                        
                        
                        
                      <div class="col-4  col-sm-4">
                                        CRUD
                                            <br/>
                        <?php
                        foreach($permisos as $permiso){                                                       
                            if ($permiso['tipoPermisos'] == 3){
                            ?>
                            <input type="checkbox" value="<?php echo $permiso['idPermisos']?>" name="permisos[]" <?php if(isset($asignado[$permiso['idPermisos']])){ echo 'checked';}?> /> <label><?php echo $permiso['nombrePermisos'] ?></label>  
                            <br/>  
                            <?php                             
                        }}
                        ?>
                        </div>
                        </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </main>