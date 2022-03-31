<?php
$user_session = session();
$AF = "AF";
$AP = "AP";
$APYAF = "AP Y AF";
?>
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4"><?php echo $titulo ?> de <?php echo $pacientes['apellidoPaciente']; ?> <?php echo $pacientes['nombrePaciente']; ?></h2>
        <div>
            <a href="<?php echo base_url(); ?>/Anamnesis/mostrarAnamnesis/<?php echo $idPaciente; ?>" class="btn btn-info">Agregar Anamnesis</a>
            <?php if ($contadorAnamnesis > 0) { ?>
                <a href="<?php echo base_url(); ?>/Diagnosticos/index/<?php echo $idPaciente; ?>" class="btn btn-primary">Diagnosticos</a>
                <?php if ($contadorDiagnosticos > 0) { ?>
                    <a href="<?php echo base_url(); ?>/Examenes/index/<?php echo $idPaciente; ?>" class="btn btn-danger">Examenes realizados</a>
                    <a href="<?php echo base_url(); ?>/Tratamientos/index/<?php echo $idPaciente; ?>" class="btn btn-success">Tratamientos</a>
                <?php } ?>
            <?php } ?>
            <a href="<?php echo base_url(); ?>/historial/" class="btn btn-warning">Regresar</a>
            <input type="hidden" id="id" name="id" value="<?php echo $idPaciente; ?>">
            <input type="hidden" id="idMedico" name="idMedico" value="<?php echo $user_session->idMedico; ?>">
            <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>">
        </div>
        <br>
        <?php if ($contadordeantecedentes > 0) { ?>
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Anamnesis/insertarAntecedentes" autocomplete="off">
                        <?php csrf_field(); ?>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 centrar">
                                    <strong>ANTECEDENTES PERSONALES Y FAMILIARES</strong>
                                    <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label>Alergia a antivioticos</label>
                                    <?php $valorAlergiaAntibiotico = $antecedentesPacientes['alergiaAntibioticoAntecedentePaciente'] ?>
                                    <select class="form-control" id="alergiaAntivioticos" name="alergiaAntivioticos">
                                        <option value="" <?php if ("" == $valorAlergiaAntibiotico) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorAlergiaAntibiotico) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorAlergiaAntibiotico) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorAlergiaAntibiotico) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Alergia a Anestesia</label>
                                    <?php $valorAlergiaAnestesia = $antecedentesPacientes['alergiaAnestesiaAntecedentePaciente'] ?>
                                    <select class="form-control" id="alergiaAnestesia" name="alergiaAnestesia">
                                        <option value="" <?php if ("" == $valorAlergiaAnestesia) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorAlergiaAnestesia) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorAlergiaAnestesia) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorAlergiaAnestesia) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Hemorragias</label>
                                    <?php $valorHemorragias = $antecedentesPacientes['hemorragiasAntecedentePaciente'] ?>
                                    <select class="form-control" id="hemorragias" name="hemorragias">
                                        <option value="" <?php if ("" == $valorHemorragias) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorHemorragias) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorHemorragias) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorHemorragias) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label>Sida</label>
                                    <?php $valorSida = $antecedentesPacientes['sidaAntecedentePaciente'] ?>
                                    <select class="form-control" id="sida" name="sida">
                                        <option value="" <?php if ("" == $valorSida) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorSida) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorSida) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorSida) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Tuberculosis</label>
                                    <?php $valorTuberculosis = $antecedentesPacientes['tuberculosisAntecedentePaciente'] ?>
                                    <select class="form-control" id="tuberculosis" name="tuberculosis">
                                        <option value="" <?php if ("" == $valorTuberculosis) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorTuberculosis) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorTuberculosis) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorTuberculosis) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Asma</label>
                                    <?php $valorAsma = $antecedentesPacientes['asmaAntecedentePaciente'] ?>
                                    <select class="form-control" id="asma" name="asma">
                                        <option value="" <?php if ("" == $valorAsma) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorAsma) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorAsma) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorAsma) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label>Diabetes</label>
                                    <?php $valorDiabetes = $antecedentesPacientes['diabetesAntecedentePaciente'] ?>
                                    <select class="form-control" id="diabetes" name="diabetes">
                                        <option value="" <?php if ("" == $valorDiabetes) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorDiabetes) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorDiabetes) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorDiabetes) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Hipertensión</label>
                                    <?php $valorHipertension = $antecedentesPacientes['hipertensionAntecedentePaciente'] ?>
                                    <select class="form-control" id="hipertension" name="hipertension">
                                        <option value="" <?php if ("" == $valorHipertension) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorHipertension) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorHipertension) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorHipertension) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Enfermedad cardiaca</label>
                                    <?php $valorEnfermedadCardiaca = $antecedentesPacientes['enfermedadCardiacaAntecedentePaciente'] ?>
                                    <select class="form-control" id="enfermedadCardiaca" name="enfermedadCardiaca">
                                        <option value="" <?php if ("" == $valorEnfermedadCardiaca) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorEnfermedadCardiaca) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorEnfermedadCardiaca) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorEnfermedadCardiaca) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label>Otros</label>
                                    <?php $valorOtro = $antecedentesPacientes['otroAntecedentePaciente'] ?>
                                    <select class="form-control" id="otros" name="otros">
                                        <option value="" <?php if ("" == $valorOtro) {
                                                                echo 'selected';
                                                            } ?>>Seleccionar</option>
                                        <option value="<?php echo $AF ?>" <?php if ($AF == $valorOtro) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente familiar</option>
                                        <option value="<?php echo $AP ?>" <?php if ($AP == $valorOtro) {
                                                                                echo 'selected';
                                                                            } ?>>Antecedente personal</option>
                                        <option value="<?php echo $APYAF ?>" <?php if ($APYAF == $valorOtro) {
                                                                                    echo 'selected';
                                                                                } ?>>Antecedente familiar y personal</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-8">
                                    <label>Cometario</label>
                                    <textarea class="form-control" id="comentario" name="comentario" type="text" autofocus required><?php echo $antecedentesPacientes['comentarioAntecedentePaciente'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php if ($permisoEditar == 1) { ?>
                            <button type="submit" class="btn btn-success form-control">Guardar</button>
                        <?php } ?>
                    </form>
                </div>
            <?php } elseif ($contadordeantecedentes == 0) { ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Anamnesis/insertarAntecedentes" autocomplete="off">
                            <?php csrf_field(); ?>
                            <div class=form-group>
                                <div class="row">
                                    <div class="col-12 centrar">
                                        <strong>ANTECEDENTES PERSONALES Y FAMILIARES</strong>
                                        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class=form-group>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <label>Alergia a antivioticos</label>
                                        <select class="form-control" id="alergiaAntivioticos" name="alergiaAntivioticos">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Alergia a Anestesia</label>
                                        <select class="form-control" id="alergiaAnestesia" name="alergiaAnestesia">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Hemorragias</label>
                                        <select class="form-control" id="hemorragias" name="hemorragias">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class=form-group>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <label>Sida</label>
                                        <select class="form-control" id="sida" name="sida">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Tuberculosis</label>
                                        <select class="form-control" id="tuberculosis" name="tuberculosis">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Asma</label>
                                        <select class="form-control" id="asma" name="asma">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class=form-group>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <label>Diabetes</label>
                                        <select class="form-control" id="diabetes" name="diabetes">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Hipertensión</label>
                                        <select class="form-control" id="hipertension" name="hipertension">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Enfermedad cardiaca</label>
                                        <select class="form-control" id="enfermedadCardiaca" name="enfermedadCardiaca">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class=form-group>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <label>Otros</label>
                                        <select class="form-control" id="otros" name="otros">
                                            <option value="">Seleccionar</option>
                                            <option value="<?php echo $AF ?>">Antecedente familiar</option>
                                            <option value="<?php echo $AP ?>">Antecedente personal</option>
                                            <option value="<?php echo $APYAF ?>">Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <label>Cometario</label>
                                        <textarea class="form-control" id="comentario" name="comentario" type="text" autofocus></textarea>
                                    </div>
                                </div>
                            </div>
                            <?php if ($permisoEditar == 1) { ?>
                                <button type="submit" class="btn btn-success form-control">Guardar</button>
                            <?php } ?>
                        </form>
                    </div>
                <?php } ?>
                </div>





                <div class="card mb-4">
                    <div class="card-body">
                        <?php csrf_field(); ?>
                        <div class=form-group>
                            <div class="row">
                                <div class="col-12">
                                    <label>Número de pieza</label>
                                    <input class="form-control" id="idPiezaSeleccionado" name="idPiezaSeleccionado" type="hidden" readonly>
                                    <input class="form-control" id="numeroPiezaSeleccionado" name="numeroPiezaSeleccionado" type="text" style="height:30px;" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Tratamiento de pieza</label>
                                    <select class="form-control" id="tratamientosPieza" name="tratamientosPieza">
                                        <option value="blanco">Seleccionar</option>
                                        <option value="Caries">Caries</option>
                                        <option value="Sellante">Sellante</option>
                                        <option value="Restauracion">Restauración</option>
                                        <option value="Extraccion">Extracción</option>
                                        <option value="Ausente">Ausente</option>
                                        <option value="Corona">Corona</option>
                                        <option value="Endodoncia">Endodoncia</option>
                                        <option value="Protesis_removible">Protesis removible</option>
                                        <option value="Protesis_fila">Protesis fila</option>
                                        <option value="Protesis_total">Protesis total</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Estado de pieza</label>
                                    <select class="form-control" id="estadoPieza" name="estadoPieza">
                                        <option value="">Seleccionar</option>
                                        <option value="Azul">Tratamiento realizado</option>
                                        <option value="Rojo">Patologia actual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label id="lblRecesion">Recesión</label>
                                    <select class="form-control" id="recesion" name="recesion">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label id="lblMovilidad">Movilidad</label>
                                    <select class="form-control" id="movilidad" name="movilidad">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 centrar">
                                    <h4><label>Plano</label></h4>
                                    <pre> <label>Distal</label>   <input id="derecha" name="derecha" type="checkbox" autofocus> <label>Vestibular</label>     <input id="arriba" name="arriba" type="checkbox" autofocus>      <label>Lingual</label>  <input id="abajo" name="abajo" type="checkbox" autofocus>    <label>Oclusal</label>    <input id="centro" name="centro" type="checkbox" autofocus>      <label>Mesial</label>      <input id="izquierda" name="izquierda" type="checkbox" autofocus> </pre>
                                </div>
                            </div>
                            <?php if ($permisoEditar == 1) { ?>
                                <button class="btn btn-success form-control" onclick="insertarDatos(<?php echo $idPaciente; ?>)">Guardar</button>
                            <?php } ?>

                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <table class="centrado">
                                            <caption style="display:none"></caption>
                                            <tr style="display:none">
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <style>
                                                    .tabla {
                                                        border: 2px solid;
                                                        width: 50px;
                                                        height: 50px;
                                                        border-collapse: collapse;
                                                    }

                                                    .tabla td {
                                                        border: 2px solid;
                                                    }

                                                    .centrado {
                                                        text-align: center;
                                                    }
                                                </style>

                                                <td>
                                                    Recesión
                                                    <br>
                                                    Movilidad
                                                    <br>
                                                    <br>
                                                    <br>
                                                </td>

                                                <?php
                                                foreach ($dentaduraActualMaxilarSuperiorDerecha as $dienteActualMaxilarSuperiorDerecha) {
                                                ?>
                                                    <td class="centrado">
                                                        <?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>
                                                        <?php $arreglodiente = $dienteActualMaxilarSuperiorDerecha['caraOdontogramaActual'] ?>
                                                        <input id="CARA<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorDerecha['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                        <input class="form-control centrado" id="RECESION<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorDerecha['recesionOdontogramaActual'] ?>" type="text" style="width:50px; height:30px;" readonly>
                                                        <input class="form-control centrado" id="MOVILIDAD<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorDerecha['movilidadOdontogramaActual'] ?>" type="text" style="width:50px; height:30px;" readonly>
                                                        <input type="hidden" value="permanente" id="temporal<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>">

                                                        <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarSuperiorDerecha['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>)">
                                                            <caption style="display:none"></caption>
                                                            <tr style="display:none">
                                                                <th scope="col"></th>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteDerecha<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteArriba<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteCentro<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteAbajo<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <?php if ($dienteActualMaxilarSuperiorDerecha['tratamientoOdontogramaActual'] != "") { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarSuperiorDerecha['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento lleno de piezas maxilar superior derecho" />
                                                        <?php } else { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento vacio de piezas maxilar superior derecho" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                foreach ($dentaduraActualMaxilarSuperiorIzquierda as $dienteActualMaxilarSuperiorIzquierda) {
                                                ?>
                                                    <td>
                                                        <?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>
                                                        <?php $arreglodiente = $dienteActualMaxilarSuperiorIzquierda['caraOdontogramaActual'] ?>
                                                        <input id="CARA<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorIzquierda['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                        <input class="form-control" id="RECESION<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorIzquierda['recesionOdontogramaActual'] ?>" type="text" style="width:40px; height:30px;" readonly>
                                                        <input class="form-control" id="MOVILIDAD<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorIzquierda['movilidadOdontogramaActual'] ?>" type="text" style="width:40px; height:30px;" readonly>
                                                        <input type="hidden" value="permanente" id="temporal<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>">

                                                        <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarSuperiorIzquierda['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>)">
                                                            <caption style="display:none"></caption>
                                                            <tr style="display:none">
                                                                <th scope="col"></th>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteDerecha<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteArriba<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteCentro<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteAbajo<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <?php if ($dienteActualMaxilarSuperiorIzquierda['tratamientoOdontogramaActual'] != "") { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarSuperiorIzquierda['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento lleno de piezas maxilar superior izquierdo" />
                                                        <?php } else { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento vacio de piezas maxilar superior izquierdo" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>


                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                                <?php
                                                foreach ($dentaduraActualMaxilarSuperiorDerechaTemporales as $dienteActualMaxilarSuperiorDerechaTemporales) {
                                                ?>
                                                    <td>
                                                        <?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>
                                                        <?php $arreglodiente = $dienteActualMaxilarSuperiorDerechaTemporales['caraOdontogramaActual'] ?>
                                                        <input id="CARA<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                        <input type="hidden" value="temporal" id="temporal<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>">
                                                        <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>)">
                                                            <caption style="display:none"></caption>
                                                            <tr style="display:none">
                                                                <th scope="col"></th>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteDerecha<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteArriba<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteCentro<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteAbajo<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <?php if ($dienteActualMaxilarSuperiorDerechaTemporales['tratamientoOdontogramaActual'] != "") { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarSuperiorDerechaTemporales['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento lleno de piezas maxilar superior derecho temporal" />
                                                        <?php } else { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento vacio de piezas maxilar superior derecho temporal" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                foreach ($dentaduraActualMaxilarSuperiorIzquierdaTemporales as $dienteActualMaxilarSuperiorIzquierdaTemporales) {
                                                ?>
                                                    <td>

                                                        <?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>
                                                        <?php $arreglodiente = $dienteActualMaxilarSuperiorIzquierdaTemporales['caraOdontogramaActual'] ?>
                                                        <input id="CARA<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                        <input type="hidden" value="temporal" id="temporal<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>">

                                                        <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>)">
                                                            <caption style="display:none"></caption>
                                                            <tr style="display:none">
                                                                <th scope="col"></th>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteDerecha<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteArriba<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteCentro<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteAbajo<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <?php if ($dienteActualMaxilarSuperiorIzquierdaTemporales['tratamientoOdontogramaActual'] != "") { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarSuperiorIzquierdaTemporales['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento lleno de piezas maxilar superior izquierdo temporal" />
                                                        <?php } else { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento vacio de piezas maxilar superior izquierdo temporal" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <?php
                                                foreach ($dentaduraActualMaxilarInferiorDerechoTemporales as $dienteActualMaxilarInferiorDerechoTemporales) {
                                                ?>
                                                    <td>

                                                        <?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>
                                                        <?php $arreglodiente = $dienteActualMaxilarInferiorDerechoTemporales['caraOdontogramaActual'] ?>
                                                        <input id="CARA<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorDerechoTemporales['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                        <input type="hidden" value="temporal" id="temporal<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>">

                                                        <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarInferiorDerechoTemporales['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>)">
                                                            <caption style="display:none"></caption>
                                                            <tr style="display:none">
                                                                <th scope="col"></th>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteDerecha<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteArriba<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteCentro<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteAbajo<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <?php if ($dienteActualMaxilarInferiorDerechoTemporales['tratamientoOdontogramaActual'] != "") { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarInferiorDerechoTemporales['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento lleno de piezas maxilar inferior derecho temporal" />
                                                        <?php } else { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento vacio de piezas maxilar inferior derecho temporal" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                foreach ($dentaduraActualMaxilarInferiorIzquierdaTemporales as $dienteActualMaxilarInferiorIzquierdaTemporales) {
                                                ?>
                                                    <td>

                                                        <?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>
                                                        <?php $arreglodiente = $dienteActualMaxilarInferiorIzquierdaTemporales['caraOdontogramaActual'] ?>
                                                        <input id="CARA<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                        <input type="hidden" value="temporal" id="temporal<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>">

                                                        <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>)">
                                                            <caption style="display:none"></caption>
                                                            <tr style="display:none">
                                                                <th scope="col"></th>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteDerecha<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteArriba<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteCentro<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteAbajo<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <?php if ($dienteActualMaxilarInferiorIzquierdaTemporales['tratamientoOdontogramaActual'] != "") { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarInferiorIzquierdaTemporales['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento lleno de piezas maxilar inferior izquierdo temporal" />
                                                        <?php } else { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento vacio de piezas maxilar inferior izquierdo temporal" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>




                                            </tr>


                                            <tr>
                                                <td>
                                                    Recesión
                                                    <br>
                                                    Movilidad
                                                    <br>
                                                    <br>
                                                    <br>
                                                </td>


                                                <?php
                                                foreach ($dentaduraActualMaxilarInferiorDerecho as $dienteActualMaxilarInferiorDerecho) {
                                                ?>
                                                    <td class="centrado">
                                                        <?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>
                                                        <?php $arreglodiente = $dienteActualMaxilarInferiorDerecho['caraOdontogramaActual'] ?>
                                                        <input id="CARA<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorDerecho['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                        <input class="form-control centrado" id="RECESION<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorDerecho['recesionOdontogramaActual'] ?>" type="text" style="width:40px; height:30px;" readonly>
                                                        <input class="form-control centrado" id="MOVILIDAD<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorDerecho['movilidadOdontogramaActual'] ?>" type="text" style="width:40px; height:30px;" readonly>
                                                        <input type="hidden" value="permanente" id="temporal<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>">
                                                        <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarInferiorDerecho['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>)">
                                                            <caption style="display:none"></caption>
                                                            <tr style="display:none">
                                                                <th scope="col"></th>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteDerecha<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteArriba<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteCentro<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteAbajo<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <?php if ($dienteActualMaxilarInferiorDerecho['tratamientoOdontogramaActual'] != "") { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarInferiorDerecho['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento lleno de piezas maxilar inferior derecho" />
                                                        <?php } else { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento vacio de piezas maxilar inferior derecho" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                foreach ($dentaduraActualMaxilarInferiorIzquierda as $dienteActualMaxilarInferiorIzquierda) {
                                                ?>
                                                    <td class="centrado">
                                                        <?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>
                                                        <?php $arreglodiente = $dienteActualMaxilarInferiorIzquierda['caraOdontogramaActual'] ?>
                                                        <input id="CARA<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorIzquierda['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                        <input class="form-control" id="RECESION<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorIzquierda['recesionOdontogramaActual'] ?>" type="text" style="width:40px; height:30px;" readonly>
                                                        <input class="form-control" id="MOVILIDAD<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorIzquierda['movilidadOdontogramaActual'] ?>" type="text" style="width:40px; height:30px;" readonly>
                                                        <input type="hidden" value="permanente" id="temporal<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>">

                                                        <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarInferiorIzquierda['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>)">
                                                            <caption style="display:none"></caption>
                                                            <tr style="display:none">
                                                                <th scope="col"></th>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteDerecha<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteArriba<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                                <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteCentro<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="cuadranteAbajo<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <?php if ($dienteActualMaxilarInferiorIzquierda['tratamientoOdontogramaActual'] != "") { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarInferiorIzquierda['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento lleno de piezas maxilar inferior izquierdo" />
                                                        <?php } else { ?>
                                                            <img id="T<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" alt="Tipo de Tratamiento vacio de piezas maxilar inferior izquierdo" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                        <img id="simbologia" src="<?php echo base_url() . '/images/odontograma/Simbologia.png?nocache=' . '' . time(); ?>" class="img-responsive" width="1000" height="160" alt="Simbología" />
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
</main>
<!-- Modal -->
<div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                <a class="btn btn-success btn-ok">SI</a>
            </div>
        </div>
    </div>
</div>

<script>
    function buscarDiente(codigo, numeroPieza) {
        temporal = $("#temporal" + numeroPieza).val();
        baseurl = $("#baseurl").val();
        idcara = $("#CARA" + codigo).val();
        recesion = $("#RECESION" + codigo).val();
        movilidad = $("#MOVILIDAD" + codigo).val();
        paciente = $("#id").val();
        limpiar();
        if (codigo != '') {
            $.ajax({
                url: '<?php echo base_url(); ?>/anamnesis/buscarPorPiezaDental/' + codigo + "/" + paciente,
                datatype: 'JSON',
                success: function(resultados) {
                    //transformar a json para descerializar
                    var resultado = JSON.parse(resultados);
                    if (resultado == 0) {
                        console.log('si valio');
                    } else {
                        $("#resultado_error").html(resultado.error);
                        if (resultado.existe) {
                            $("#idPiezaSeleccionado").val(resultado.datos1.idPiezaDental);
                            $("#numeroPiezaSeleccionado").val(resultado.datos1.numeroPiezaDental);
                            caraDiente = resultado.datos1.caraOdontogramaActual;
                            $("#recesion").val(resultado.datos1.recesionOdontogramaActual);
                            $("#movilidad").val(resultado.datos1.movilidadOdontogramaActual);
                            $("#tratamientosPieza").val(resultado.datos1.tratamientoOdontogramaActual);
                            $("#estadoPieza").val(resultado.datos1.dienteEstadoOdontogramaActual);

                            if (temporal == "temporal") {
                                $("#recesion").hide();
                                $("#movilidad").hide();
                                $("#lblMovilidad").hide();
                                $("#lblRecesion").hide();
                            }
                            if (temporal == "permanente") {
                                //alert(temporal);
                                $("#recesion").show();
                                $("#movilidad").show();
                                $("#lblMovilidad").show();
                                $("#lblRecesion").show();
                            }

                            if (caraDiente[0] == 1) {
                                $btnDerecha.checked = true;
                            }
                            if (caraDiente[2] == 1) {
                                $btnIzquierda.checked = true;
                            }
                            if (caraDiente[4] == 1) {
                                $btnCentro.checked = true;
                            }
                            if (caraDiente[6] == 1) {
                                $btnArriba.checked = true;
                            }
                            if (caraDiente[8] == 1) {
                                $btnAbajo.checked = true;
                            }
                        } else {
                            $("#numeroPiezaSeleccionado").html('');
                            $("#idPiezaSeleccionado").html('');
                        }
                    }
                }
            });
        }
    }

    function limpiar() {
        $("#numeroPiezaSeleccionado").val('');
        $("#idPiezaSeleccionado").val('');
        $("#recesion").val('');
        $("#movilidad").val('');
        $("#tratamientosPieza").val('');
        $("#estadoPieza").val('');
        $btnDerecha = document.querySelector("#derecha");
        $btnDerecha.checked = false;
        $btnIzquierda = document.querySelector("#izquierda");
        $btnIzquierda.checked = false;
        $btnArriba = document.querySelector("#arriba");
        $btnArriba.checked = false;
        $btnAbajo = document.querySelector("#abajo");
        $btnAbajo.checked = false;
        $btnCentro = document.querySelector("#centro");
        $btnCentro.checked = false;
    }

    function insertarDatos(paciente) {
        baseurl = $("#baseurl").val();
        $piezadental = $("#idPiezaSeleccionado").val()
        movilidad = $("#movilidad").val();
        recesion = $("#recesion").val();

        var tratamientos = $("#tratamientosPieza").val();

        var dienteEstado = $("#estadoPieza").val();


        var derecha = 0;
        var arriba = 0;
        var abajo = 0;
        var centro = 0;
        var izquierda = 0;

        if (document.getElementById('derecha').checked) {
            derecha = 1;

        } else {
            derecha = 0;

        }
        if (document.getElementById('arriba').checked) {
            arriba = 1;

        } else {
            arriba = 0;

        }
        if (document.getElementById('abajo').checked) {
            abajo = 1;
        } else {
            abajo = 0;
        }
        if (document.getElementById('centro').checked) {
            centro = 1;
        } else {
            centro = 0;
        }
        if (document.getElementById('izquierda').checked) {
            izquierda = 1;
        } else {
            izquierda = 0;
        }

        var carasdedientes = derecha.toString() + ',' + izquierda.toString() + ',' + centro.toString() + ',' + arriba.toString() + ',' + abajo.toString();

        if ($piezadental != '') {
            $.ajax({
                url: '<?php echo base_url(); ?>/anamnesis/insertarPorPiezaDental/' + $piezadental + "/" + paciente + "/" + carasdedientes + "/" + movilidad + "/" + recesion + "/" + tratamientos + "/" + dienteEstado,
                datatype: 'JSON',
                success: function(resultados) {
                    //transformar a json para descerializar
                    var resultado = JSON.parse(resultados);
                    if (resultado == 0) {
                        console.log('si valio');
                    } else {
                        $("#resultado_error").html(resultado.error);
                        if (resultado.existe) {
                            var idpiezadental = resultado.datos2.idPiezaDental;
                            var s = resultado.datos2.numeroPiezaDental;
                            var car = resultado.datos2.caraOdontogramaActual;
                            limpiar();

                            var tratamientoActual1 = resultado.datos2.tratamientoOdontogramaActual;
                            var dienteEstadoActual1 = resultado.datos2.dienteEstadoOdontogramaActual;


                            if (car[0] == 1 && dienteEstadoActual1 == "Azul") {
                                document.getElementById('cuadranteDerecha' + s).style.background = 'blue';
                            }
                            if (car[2] == 1 && dienteEstadoActual1 == "Azul") {
                                document.getElementById('cuadranteIzquierda' + s).style.background = 'blue';
                            }
                            if (car[4] == 1 && dienteEstadoActual1 == "Azul") {
                                document.getElementById('cuadranteCentro' + s).style.background = 'blue';
                            }
                            if (car[6] == 1 && dienteEstadoActual1 == "Azul") {
                                document.getElementById('cuadranteArriba' + s).style.background = 'blue';
                            }
                            if (car[8] == 1 && dienteEstadoActual1 == "Azul") {
                                document.getElementById('cuadranteAbajo' + s).style.background = 'blue';
                            }

                            if (car[0] == 1 && dienteEstadoActual1 == "Rojo") {
                                document.getElementById('cuadranteDerecha' + s).style.background = 'red';
                            }
                            if (car[2] == 1 && dienteEstadoActual1 == "Rojo") {
                                document.getElementById('cuadranteIzquierda' + s).style.background = 'red';
                            }
                            if (car[4] == 1 && dienteEstadoActual1 == "Rojo") {
                                document.getElementById('cuadranteCentro' + s).style.background = 'red';
                            }
                            if (car[6] == 1 && dienteEstadoActual1 == "Rojo") {
                                document.getElementById('cuadranteArriba' + s).style.background = 'red';
                            }
                            if (car[8] == 1 && dienteEstadoActual1 == "Rojo") {
                                document.getElementById('cuadranteAbajo' + s).style.background = 'red';
                            }

                            if (car[0] == 0) {
                                document.getElementById('cuadranteDerecha' + s).style.background = 'white';
                            }
                            if (car[2] == 0) {
                                document.getElementById('cuadranteIzquierda' + s).style.background = 'white';
                            }
                            if (car[4] == 0) {
                                document.getElementById('cuadranteCentro' + s).style.background = 'white';
                            }
                            if (car[6] == 0) {
                                document.getElementById('cuadranteArriba' + s).style.background = 'white';
                            }
                            if (car[8] == 0) {
                                document.getElementById('cuadranteAbajo' + s).style.background = 'white';
                            }

                            $("#CARA" + s).val(car);


                            $("#RECESION" + s).val(resultado.datos2.recesionOdontogramaActual);
                            $("#MOVILIDAD" + s).val(resultado.datos2.movilidadOdontogramaActual);

                            document.getElementById("T" + s).src = baseurl + "/images/odontograma/" + tratamientoActual1 + ".png";

                            alert('Se ha actualizado la pieza dental correctamente');

                        } else {

                            $("#idPiezaSeleccionado").html('');
                            $("#numeroPiezaSeleccionado").html('');

                        }
                    }
                }
            });
        }
    }
</script>