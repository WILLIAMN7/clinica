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
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/ExamenSistemaEstomatognatico/actualizar" autocomplete="off">
                        <input type="hidden" id="id" name="id" value="<?php echo $datos['idExamenSistemaEstomatognatico']; ?>">
                        <input type="hidden" id="idanamnesis" name="idanamnesis" value="<?php echo $datos['idAnamnesis']; ?>">
                        <input type="hidden" id="idpaciente" name="idpaciente" value="<?php echo $idpaciente; ?>">

                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <table width="100%">
                                    <caption></caption>
                                    <tr style="display:none"><th scope="col"></th></tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Labios:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="labios" name="labios" type="checkbox" value="X" <?php if($datos['labiosExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>  >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Mejillas:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="mejillas" name="mejillas" type="checkbox" value="X" <?php if($datos['mejillasExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Maxilar superior:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="maxilarSuperior" name="maxilarSuperior" type="checkbox" value="X" <?php if($datos['maxilarSuperiorExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Maxilar inferior:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="maxilarInferior" name="maxilarInferior" type="checkbox" value="X" <?php if($datos['maxilarInferiorExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <table width="100%">
                                    <caption></caption>
                                    <tr style="display:none"><th scope="col"></th></tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Lengua:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="lengua" name="lengua" type="checkbox" value="X" <?php if($datos['lenguaExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Paladar:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="paladar" name="paladar" type="checkbox" value="X" <?php if($datos['paladarExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Piso de boca:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="pisoBoca" name="pisoBoca" type="checkbox" value="X" <?php if($datos['pisoDeBocaExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Carrillos:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="carrillos" name="carrillos" type="checkbox" value="X" <?php if($datos['carrillosExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <table width="100%">
                                    <caption></caption>
                                    <tr style="display:none"><th scope="col"></th></tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Glándulas salivales:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="glandulasSalivales" name="glandulasSalivales" type="checkbox" value="X" <?php if($datos['glandulasSalivalesExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Faringe:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="faringe" name="faringe" type="checkbox" value="X" <?php if($datos['faringeExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>ATM:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="atm" name="atm" type="checkbox" value="X" <?php if($datos['atmExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Gánglios:</label>
                                            </td>
                                            <td width="50%">
                                                <input id="ganglios" name="ganglios" type="checkbox" value="X" <?php if($datos['gangliosExamenSistemaEstomatognatico']=="X"){ echo 'checked';}?>>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 centrar">
                                    <label>Comentario:</label>
                                    <textarea class="form-control" id="comentario" name="comentario"><?php echo $datos['comentarioExamenSistemaEstomatognatico'];?></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <a href="<?php echo base_url(); ?>/ExamenSistemaEstomatognatico/index/<?php echo $idanamnesis; ?>/<?php echo $idpaciente; ?>" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </main>