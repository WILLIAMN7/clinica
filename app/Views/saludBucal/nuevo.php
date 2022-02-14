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
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/SaludBucal/insertar" autocomplete="off">
                        <?php csrf_field(); ?>
                        <input type="hidden" id="id" name="id" value="<?php echo $idanamnesis; ?>">
                        <input type="hidden" id="idpaciente" name="idpaciente" value="<?php echo $idpaciente; ?>">
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza161755" name="pieza161755" required>
                                        <option value="-">Seleccionar</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="55">55</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa161755" name="placa161755" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo161755" name="calculo161755" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis161755" name="gingivitis161755" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza112151" name="pieza112151" required>
                                        <option value="-">Seleccionar</option>
                                        <option value="11">11</option>
                                        <option value="21">21</option>
                                        <option value="51">51</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa112151" name="placa112151" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo112151" name="calculo112151" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis112151" name="gingivitis112151" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza262765" name="pieza262765" required>
                                        <option value="-">Seleccionar</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="65">65</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa262765" name="placa262765" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo262765" name="calculo262765" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis262765" name="gingivitis262765" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza363775" name="pieza363775" required>
                                        <option value="-">Seleccionar</option>
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="75">75</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa363775" name="placa363775" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo363775" name="calculo363775" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis363775" name="gingivitis363775" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza314171" name="pieza314171" required>
                                        <option value="-">Seleccionar</option>
                                        <option value="31">31</option>
                                        <option value="41">41</option>
                                        <option value="71">71</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa314171" name="placa314171" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo314171" name="calculo314171" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis314171" name="gingivitis314171" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label>Pieza:</label>
                                    <select class="form-control" id="pieza464785" name="pieza464785" required>
                                        <option value="-">Seleccionar</option>
                                        <option value="46">46</option>
                                        <option value="47">47</option>
                                        <option value="85">85</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Placa:</label>
                                    <select class="form-control" id="placa464785" name="placa464785" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Cálculo:</label>
                                    <select class="form-control" id="calculo464785" name="calculo464785" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Gingivitis:</label>
                                    <select class="form-control" id="gingivitis464785" name="gingivitis464785" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label>Enf. Periodontal:</label>
                                    <select class="form-control" id="periodontal" name="periodontal" required>
                                        <option value="">Seleccionar</option>
                                        <option value="Leve">Leve</option>
                                        <option value="Moderado">Moderado</option>
                                        <option value="Severa">Severa</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Maloclusión:</label>
                                    <select class="form-control" id="maloclucion" name="maloclucion" required>
                                        <option value="">Seleccionar</option>
                                        <option value="Angle I">Angle I</option>
                                        <option value="Angle II">Angle II</option>
                                        <option value="Angle III">Angle III</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Fluorosis:</label>
                                    <select class="form-control" id="fluorosis" name="fluorosis" required>
                                        <option value="">Seleccionar</option>
                                        <option value="Leve">Leve</option>
                                        <option value="Moderado">Moderado</option>
                                        <option value="Severa">Severa</option>
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