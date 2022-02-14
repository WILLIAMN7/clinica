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
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/SaludBucal/actualizar" autocomplete="off">
                        <input type="hidden" id="id" name="id" value="<?php echo $datos['idSaludBucal']; ?>">
                        <input type="hidden" id="idanamnesis" name="idanamnesis" value="<?php echo $datos['idAnamnesis']; ?>">
                        <input type="hidden" id="idpaciente" name="idpaciente" value="<?php echo $idpaciente; ?>">

                        <div class=form-group>
                            <div class="row">
                            <?php $datospieza161755 = explode(",", $datos['higieneOral161755SaludBucal']);?>
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza161755" name="pieza161755" required>
                                        <option value="-" <?php if("-"==$datospieza161755[0]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="16" <?php if("16"==$datospieza161755[0]){ echo 'selected';}?>>16</option>
                                        <option value="17" <?php if("17"==$datospieza161755[0]){ echo 'selected';}?>>17</option>
                                        <option value="55" <?php if("55"==$datospieza161755[0]){ echo 'selected';}?>>55</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa161755" name="placa161755" required>
                                        <option value="" <?php if(""==$datospieza161755[1]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza161755[1]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza161755[1]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza161755[1]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza161755[1]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo161755" name="calculo161755" required>
                                        <option value="" <?php if(""==$datospieza161755[2]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza161755[2]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza161755[2]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza161755[2]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza161755[2]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis161755" name="gingivitis161755" required>
                                        <option value="" <?php if(""==$datospieza161755[3]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza161755[3]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza161755[3]){ echo 'selected';}?>>1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                            <?php $datospieza112151 = explode(",", $datos['higieneOral112151SaludBucal']);?>
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza112151" name="pieza112151" required>
                                        <option value="-" <?php if("-"==$datospieza112151[0]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="11" <?php if("11"==$datospieza112151[0]){ echo 'selected';}?>>11</option>
                                        <option value="21" <?php if("21"==$datospieza112151[0]){ echo 'selected';}?>>21</option>
                                        <option value="51" <?php if("51"==$datospieza112151[0]){ echo 'selected';}?>>51</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa112151" name="placa112151" required>
                                        <option value="" <?php if(""==$datospieza112151[1]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza112151[1]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza112151[1]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza112151[1]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza112151[1]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo112151" name="calculo112151" required>
                                        <option value="" <?php if(""==$datospieza112151[2]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza112151[2]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza112151[2]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza112151[2]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza112151[2]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis112151" name="gingivitis112151" required>
                                        <option value="" <?php if(""==$datospieza112151[3]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza112151[3]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza112151[3]){ echo 'selected';}?>>1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                            <?php $datospieza262765 = explode(",", $datos['higieneOral262765SaludBucal']);?>
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza262765" name="pieza262765" required>
                                        <option value="-" <?php if("-"==$datospieza262765[0]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="26" <?php if("26"==$datospieza262765[0]){ echo 'selected';}?>>26</option>
                                        <option value="27" <?php if("27"==$datospieza262765[0]){ echo 'selected';}?>>27</option>
                                        <option value="65" <?php if("65"==$datospieza262765[0]){ echo 'selected';}?>>65</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa262765" name="placa262765" required>
                                        <option value="" <?php if(""==$datospieza262765[1]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza262765[1]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza262765[1]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza262765[1]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza262765[1]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo262765" name="calculo262765" required>
                                        <option value="" <?php if(""==$datospieza262765[2]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza262765[2]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza262765[2]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza262765[2]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza262765[2]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis262765" name="gingivitis262765" required>
                                        <option value="" <?php if(""==$datospieza262765[3]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza262765[3]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza262765[3]){ echo 'selected';}?>>1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                            <?php $datospieza363775 = explode(",", $datos['higieneOral363775SaludBucal']);?>
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza363775" name="pieza363775" required>
                                        <option value="-" <?php if("-"==$datospieza363775[0]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="36" <?php if("36"==$datospieza363775[0]){ echo 'selected';}?>>36</option>
                                        <option value="37" <?php if("37"==$datospieza363775[0]){ echo 'selected';}?>>37</option>
                                        <option value="75" <?php if("75"==$datospieza363775[0]){ echo 'selected';}?>>75</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa363775" name="placa363775" required>
                                        <option value="" <?php if(""==$datospieza363775[1]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza363775[1]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza363775[1]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza363775[1]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza363775[1]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo363775" name="calculo363775" required>
                                        <option value="" <?php if(""==$datospieza363775[2]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza363775[2]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza363775[2]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza363775[2]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza363775[2]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis363775" name="gingivitis363775" required>
                                        <option value="" <?php if(""==$datospieza363775[3]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza363775[3]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza363775[3]){ echo 'selected';}?>>1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <?php $datospieza314171 = explode(",", $datos['higieneOral314171SaludBucal']);?>
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza314171" name="pieza314171" required>
                                        <option value="-" <?php if("-"==$datospieza314171[0]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="31" <?php if("31"==$datospieza314171[0]){ echo 'selected';}?>>31</option>
                                        <option value="41" <?php if("41"==$datospieza314171[0]){ echo 'selected';}?>>41</option>
                                        <option value="71" <?php if("71"==$datospieza314171[0]){ echo 'selected';}?>>71</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa314171" name="placa314171" required>
                                        <option value="" <?php if(""==$datospieza314171[1]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza314171[1]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza314171[1]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza314171[1]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza314171[1]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo314171" name="calculo314171" required>
                                        <option value="" <?php if(""==$datospieza314171[2]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza314171[2]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza314171[2]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza314171[2]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza314171[2]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis314171" name="gingivitis314171" required>
                                        <option value="" <?php if(""==$datospieza314171[3]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza314171[3]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza314171[3]){ echo 'selected';}?>>1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <?php $datospieza464785 = explode(",", $datos['higieneOral464785SaludBucal']);?>
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza464785" name="pieza464785" required>
                                        <option value="-" <?php if("-"==$datospieza464785[0]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="46" <?php if("46"==$datospieza464785[0]){ echo 'selected';}?>>46</option>
                                        <option value="47" <?php if("47"==$datospieza464785[0]){ echo 'selected';}?>>47</option>
                                        <option value="85" <?php if("85"==$datospieza464785[0]){ echo 'selected';}?>>85</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa464785" name="placa464785" required>
                                        <option value="" <?php if(""==$datospieza464785[1]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza464785[1]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza464785[1]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza464785[1]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza464785[1]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo464785" name="calculo464785" required>
                                        <option value="" <?php if(""==$datospieza464785[2]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza464785[2]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza464785[2]){ echo 'selected';}?>>1</option>
                                        <option value="2" <?php if("2"==$datospieza464785[2]){ echo 'selected';}?>>2</option>
                                        <option value="3" <?php if("3"==$datospieza464785[2]){ echo 'selected';}?>>3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis464785" name="gingivitis464785" required>
                                        <option value="" <?php if(""==$datospieza464785[3]){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="0" <?php if("0"==$datospieza464785[3]){ echo 'selected';}?>>0</option>
                                        <option value="1" <?php if("1"==$datospieza464785[3]){ echo 'selected';}?>>1</option>
                                    </select>                                
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label>Enf. Periodontal:</label>
                                    <select class="form-control" id="periodontal" name="periodontal" required>
                                        <option value="" <?php if(""==$datos['enfermedadPeriodontalSaludBucal']){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="Leve" <?php if("Leve"==$datos['enfermedadPeriodontalSaludBucal']){ echo 'selected';}?>>Leve</option>
                                        <option value="Moderado" <?php if("Moderado"==$datos['enfermedadPeriodontalSaludBucal']){ echo 'selected';}?>>Moderado</option>
                                        <option value="Severa" <?php if("Severa"==$datos['enfermedadPeriodontalSaludBucal']){ echo 'selected';}?>>Severa</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Maloclusión:</label>
                                    <select class="form-control" id="maloclucion" name="maloclucion" required>
                                        <option value="" <?php if(""==$datos['maloclusionSaludBucal']){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="Angle I" <?php if("Angle I"==$datos['maloclusionSaludBucal']){ echo 'selected';}?>>Angle I</option>
                                        <option value="Angle II" <?php if("Angle II"==$datos['maloclusionSaludBucal']){ echo 'selected';}?>>Angle II</option>
                                        <option value="Angle III" <?php if("Angle III"==$datos['maloclusionSaludBucal']){ echo 'selected';}?>>Angle III</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Fluorosis:</label>
                                    <select class="form-control" id="fluorosis" name="fluorosis" required>
                                        <option value="" <?php if(""==$datos['fluorosisSaludBucal']){ echo 'selected';}?>>Seleccionar</option>
                                        <option value="Leve" <?php if("Leve"==$datos['fluorosisSaludBucal']){ echo 'selected';}?>>Leve</option>
                                        <option value="Moderado" <?php if("Moderado"==$datos['fluorosisSaludBucal']){ echo 'selected';}?>>Moderado</option>
                                        <option value="Severa" <?php if("Severa"==$datos['fluorosisSaludBucal']){ echo 'selected';}?>>Severa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <a href="<?php echo base_url(); ?>/SaludBucal/index/<?php echo $idanamnesis; ?>/<?php echo $idpaciente; ?>" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </main>