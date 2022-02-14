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
                                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>/SignosVitales/actualizar" autocomplete="off">
                                <input type="hidden" id="id" name="id" value="<?php echo $datos['idSignosVitales'];?>">
                                <input type="hidden" id="idanamnesis" name="idanamnesis" value="<?php echo $datos['idAnamnesis'];?>">
                                <input type="hidden" id="idpaciente" name="idpaciente" value="<?php echo $idpaciente;?>">

                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Presión arterial:</label>
                                            <input class="form-control" id="presionArterial" name="presionArterial" type="text" value="<?php echo $datos['presionArterialSignosVitales'];?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Frecuencia cardiaca:</label>
                                            <input class="form-control" id="frecuenciaCardiaca" name="frecuenciaCardiaca" type="text" value="<?php echo $datos['frecuenciaCardiacaSignosVitales'];?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Frecuencia respiratoria:</label>
                                            <input class="form-control" id="frecuenciaRespiratoria" name="frecuenciaRespiratoria" type="text" value="<?php echo $datos['frecuenciaRespiratoriaSignosVitales'];?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Temperatura:</label>
                                            <input class="form-control" id="temperatura" name="temperatura" type="text" value="<?php echo $datos['temperaturaSignosVitales'];?>" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label>Peso (Libras):</label>
                                            <input class="form-control" id="peso" name="peso" type="text" value="<?php echo $datos['pesoSignosVitales'];?>" autofocus required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Talla:</label>
                                            <input class="form-control" id="talla" name="talla" type="text" value="<?php echo $datos['tallaSignosVitales'];?>" autofocus required>
                                        </div>
                                    </div>
                                </div>                
                            </div>                        
                                <a href="<?php echo base_url();?>/SignosVitales/index/<?php echo $datos['idAnamnesis'];?>/<?php echo $idpaciente;?>" class="btn btn-primary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                        </div>                                    
                    </div>
                </main>