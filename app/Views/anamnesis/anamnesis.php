<?php
$user_session = session();
?>
<div id="layoutSidenav_content">
    <main>

        <div class="container-fluid px-4">
            <h2 class="mt-4"><?php echo $titulo ?> de <?php echo $pacientes['apellidoPaciente']; ?> <?php echo $pacientes['nombrePaciente']; ?></h2>
            <div>
                <a href="<?php echo base_url(); ?>/Anamnesis/nuevo/<?php echo $idPaciente; ?>" class="btn btn-info">Agregar Anamnesis</a>
                <a href="<?php echo base_url(); ?>/Examenes/index/<?php echo $idPaciente; ?>" class="btn btn-danger">Examenes realizados</a>
                <a href="<?php echo base_url(); ?>/Diagnosticos/index/<?php echo $idPaciente; ?>" class="btn btn-primary">Diagnosticos</a>
                <a href="<?php echo base_url(); ?>/Tratamientos/index/<?php echo $idPaciente; ?>" class="btn btn-success">Tratamientos</a>
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
                                    <div class="col-12">
                                        <center><b>ANTECEDENTES PERSONALES Y FAMILIARES</b></center>
                                        <input type="hidden" id="idPaciente" name="idPaciente" value="<?php echo $idPaciente; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class=form-group>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <label>Alergia a antivioticos</label>
                                        <select class="form-control" id="alergiaAntivioticos" name="alergiaAntivioticos">
                                            <option value="" <?php if ("" == $antecedentesPacientes['alergiaAntibioticoAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['alergiaAntibioticoAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['alergiaAntibioticoAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['alergiaAntibioticoAntecedentePaciente']) {
                                                                                                echo 'selected';
                                                                                            } ?>>Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Alergia a Anestesia</label>
                                        <select class="form-control" id="alergiaAnestesia" name="alergiaAnestesia">
                                            <option value="" <?php if ("" == $antecedentesPacientes['alergiaAnestesiaAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['alergiaAnestesiaAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['alergiaAnestesiaAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['alergiaAnestesiaAntecedentePaciente']) {
                                                                                                echo 'selected';
                                                                                            } ?>>Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Hemorragias</label>
                                        <select class="form-control" id="hemorragias" name="hemorragias">
                                            <option value="" <?php if ("" == $antecedentesPacientes['hemorragiasAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['hemorragiasAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['hemorragiasAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['hemorragiasAntecedentePaciente']) {
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
                                        <select class="form-control" id="sida" name="sida">
                                            <option value="" <?php if ("" == $antecedentesPacientes['sidaAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['sidaAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['sidaAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['sidaAntecedentePaciente']) {
                                                                                                echo 'selected';
                                                                                            } ?>>Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Tuberculosis</label>
                                        <select class="form-control" id="tuberculosis" name="tuberculosis">
                                            <option value="" <?php if ("" == $antecedentesPacientes['tuberculosisAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['tuberculosisAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['tuberculosisAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['tuberculosisAntecedentePaciente']) {
                                                                                                echo 'selected';
                                                                                            } ?>>Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Asma</label>
                                        <select class="form-control" id="asma" name="asma">
                                            <option value="" <?php if ("" == $antecedentesPacientes['asmaAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['asmaAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['asmaAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['asmaAntecedentePaciente']) {
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
                                        <select class="form-control" id="diabetes" name="diabetes">
                                            <option value="" <?php if ("" == $antecedentesPacientes['diabetesAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['diabetesAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['diabetesAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['diabetesAntecedentePaciente']) {
                                                                                                echo 'selected';
                                                                                            } ?>>Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Hipertensión</label>
                                        <select class="form-control" id="hipertension" name="hipertension">
                                            <option value="" <?php if ("" == $antecedentesPacientes['hipertensionAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['hipertensionAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['hipertensionAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['hipertensionAntecedentePaciente']) {
                                                                                                echo 'selected';
                                                                                            } ?>>Antecedente familiar y personal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Enfermedad cardiaca</label>
                                        <select class="form-control" id="enfermedadCardiaca" name="enfermedadCardiaca">
                                            <option value="" <?php if ("" == $antecedentesPacientes['enfermedadCardiacaAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['enfermedadCardiacaAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['enfermedadCardiacaAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['enfermedadCardiacaAntecedentePaciente']) {
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
                                        <select class="form-control" id="otros" name="otros">
                                            <option value="" <?php if ("" == $antecedentesPacientes['otroAntecedentePaciente']) {
                                                                    echo 'selected';
                                                                } ?>>Seleccionar</option>
                                            <option value="AF" <?php if ("AF" == $antecedentesPacientes['otroAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente familiar</option>
                                            <option value="AP" <?php if ("AP" == $antecedentesPacientes['otroAntecedentePaciente']) {
                                                                                        echo 'selected';
                                                                                    } ?>>Antecedente personal</option>
                                            <option value="AP Y AF" <?php if ("AP Y AF" == $antecedentesPacientes['otroAntecedentePaciente']) {
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
                            <center><button type="submit" class="btn btn-success">Guardar</button></center>
                        </form>
                    </div>
                <?php } elseif ($contadordeantecedentes == 0) { ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Anamnesis/insertarAntecedentes" autocomplete="off">
                                <?php csrf_field(); ?>
                                <div class=form-group>
                                    <div class="row">
                                        <div class="col-12">
                                            <center><b>ANTECEDENTES PERSONALES Y FAMILIARES</b></center>
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
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <label>Alergia a Anestesia</label>
                                            <select class="form-control" id="alergiaAnestesia" name="alergiaAnestesia">
                                                <option value="">Seleccionar</option>
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <label>Hemorragias</label>
                                            <select class="form-control" id="hemorragias" name="hemorragias">
                                                <option value="">Seleccionar</option>
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
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
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <label>Tuberculosis</label>
                                            <select class="form-control" id="tuberculosis" name="tuberculosis">
                                                <option value="">Seleccionar</option>
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <label>Asma</label>
                                            <select class="form-control" id="asma" name="asma">
                                                <option value="">Seleccionar</option>
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
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
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <label>Hipertensión</label>
                                            <select class="form-control" id="hipertension" name="hipertension">
                                                <option value="">Seleccionar</option>
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <label>Enfermedad cardiaca</label>
                                            <select class="form-control" id="enfermedadCardiaca" name="enfermedadCardiaca">
                                                <option value="">Seleccionar</option>
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
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
                                                <option value="AF">Antecedente familiar</option>
                                                <option value="AP">Antecedente personal</option>
                                                <option value="AP Y AF">Antecedente familiar y personal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-8">
                                            <label>Cometario</label>
                                            <textarea class="form-control" id="comentario" name="comentario" type="text" autofocus required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <center><button type="submit" class="btn btn-success">Guardar</button></center>
                            </form>
                        </div>
                    <?php } ?>
                    </div>





                    <div class="card mb-4">
                        <div class="card-body">
                            <!--<form method="POST" enctype="multipart/form-data" action="" autocomplete="off">-->
                            <?php csrf_field(); ?>
                            <div class=form-group>
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <label>Número de pieza</label>
                                            <input class="form-control" id="idPiezaSeleccionado" name="idPiezaSeleccionado" type="hidden" readonly>
                                            <input class="form-control" id="numeroPiezaSeleccionado" name="numeroPiezaSeleccionado" type="text" readonly>
                                        </center>
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
                                        <input class="form-control" id="recesion" name="recesion" type="text" autofocus>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label id="lblMovilidad">Movilidad</label>
                                        <input class="form-control" id="movilidad" name="movilidad" type="text" autofocus>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <h2><label>Plano</label></h2>
                                        </center>
                                        <center>
                                            <pre> <label>derecha</label>   <input id="derecha" name="derecha" type="checkbox" autofocus> <label>arriba</label>     <input id="arriba" name="arriba" type="checkbox" autofocus>      <label>abajo</label>  <input id="abajo" name="abajo" type="checkbox" autofocus>    <label>centro</label>    <input id="centro" name="centro" type="checkbox" autofocus>      <label>izquierda</label>      <input id="izquierda" name="izquierda" type="checkbox" autofocus> </pre>
                                        </center>
                                    </div>
                                </div>
                                <center>
                                    <button class="btn btn-success" onclick="insertarDatos(<?php echo $idPaciente; ?>)">Guardar</button>
                                </center>

                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <table>
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
                                                    </style>

                                                    <td>
                                                        Recesión
                                                        <br>
                                                        <br>
                                                        Movilidad
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </td>

                                                    <?php
                                                    foreach ($dentaduraActualMaxilarSuperiorDerecha as $dienteActualMaxilarSuperiorDerecha) {
                                                    ?>
                                                        <td>
                                                            <?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>
                                                            <?php $arreglodiente = $dienteActualMaxilarSuperiorDerecha['caraOdontogramaActual'] ?>
                                                            <input id="CARA<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorDerecha['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                            <input class="form-control" id="RECESION<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorDerecha['recesionOdontogramaActual'] ?>" type="text" style="width:40px" readonly>
                                                            <input class="form-control" id="MOVILIDAD<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorDerecha['movilidadOdontogramaActual'] ?>" type="text" style="width:40px" readonly>
                                                            <input type="hidden" value="permanente" id="temporal<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>">

                                                            <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarSuperiorDerecha['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>)">
                                                                <tr>
                                                                    <td id="cuadranteDerecha<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteArriba<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteCentro<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteAbajo<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" align=center <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </table>
                                                            <?php if ($dienteActualMaxilarSuperiorDerecha['tratamientoOdontogramaActual'] != "") { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarSuperiorDerecha['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php } else { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarSuperiorDerecha['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
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
                                                            <input class="form-control" id="RECESION<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorIzquierda['recesionOdontogramaActual'] ?>" type="text" style="width:40px" readonly>
                                                            <input class="form-control" id="MOVILIDAD<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarSuperiorIzquierda['movilidadOdontogramaActual'] ?>" type="text" style="width:40px" readonly>
                                                            <input type="hidden" value="permanente" id="temporal<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>">

                                                            <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarSuperiorIzquierda['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>)">
                                                                <tr>
                                                                    <td id="cuadranteDerecha<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteArriba<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteCentro<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteAbajo<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" align=center <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </table>
                                                            <?php if ($dienteActualMaxilarSuperiorIzquierda['tratamientoOdontogramaActual'] != "") { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarSuperiorIzquierda['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php } else { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
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
                                                                <tr>
                                                                    <td id="cuadranteDerecha<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteArriba<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteCentro<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteAbajo<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" align=center <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </table>
                                                            <?php if ($dienteActualMaxilarSuperiorDerechaTemporales['tratamientoOdontogramaActual'] != "") { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarSuperiorDerechaTemporales['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php } else { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
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
                                                                <tr>
                                                                    <td id="cuadranteDerecha<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteArriba<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteCentro<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteAbajo<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" align=center <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </table>
                                                            <?php if ($dienteActualMaxilarSuperiorIzquierdaTemporales['tratamientoOdontogramaActual'] != "") { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarSuperiorIzquierdaTemporales['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php } else { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
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
                                                                <tr>
                                                                    <td id="cuadranteDerecha<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteArriba<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteCentro<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteAbajo<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" align=center <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </table>
                                                            <?php if ($dienteActualMaxilarInferiorDerechoTemporales['tratamientoOdontogramaActual'] != "") { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarInferiorDerechoTemporales['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php } else { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
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
                                                                <tr>
                                                                    <td id="cuadranteDerecha<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteArriba<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteCentro<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteAbajo<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" align=center <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </table>
                                                            <?php if ($dienteActualMaxilarInferiorIzquierdaTemporales['tratamientoOdontogramaActual'] != "") { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarInferiorIzquierdaTemporales['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php } else { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
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
                                                        <br>
                                                        Movilidad
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </td>


                                                    <?php
                                                    foreach ($dentaduraActualMaxilarInferiorDerecho as $dienteActualMaxilarInferiorDerecho) {
                                                    ?>
                                                        <td>
                                                            <?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>
                                                            <?php $arreglodiente = $dienteActualMaxilarInferiorDerecho['caraOdontogramaActual'] ?>
                                                            <input id="CARA<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorDerecho['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                            <input class="form-control" id="RECESION<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorDerecho['recesionOdontogramaActual'] ?>" type="text" style="width:40px;" readonly>
                                                            <input class="form-control" id="MOVILIDAD<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorDerecho['movilidadOdontogramaActual'] ?>" type="text" style="width:40px" readonly>
                                                            <input type="hidden" value="permanente" id="temporal<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>">

                                                            <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarInferiorDerecho['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>)">
                                                                <tr>
                                                                    <td id="cuadranteDerecha<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteArriba<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteCentro<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteAbajo<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" align=center <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </table>
                                                            <?php if ($dienteActualMaxilarInferiorDerecho['tratamientoOdontogramaActual'] != "") { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarInferiorDerecho['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php } else { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarInferiorDerecho['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
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
                                                        <td>
                                                            <?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>
                                                            <?php $arreglodiente = $dienteActualMaxilarInferiorIzquierda['caraOdontogramaActual'] ?>
                                                            <input id="CARA<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorIzquierda['caraOdontogramaActual'] ?>" type="hidden" autofocus>
                                                            <input class="form-control" id="RECESION<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorIzquierda['recesionOdontogramaActual'] ?>" type="text" style="width:40px" readonly>
                                                            <input class="form-control" id="MOVILIDAD<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" value="<?php echo $dienteActualMaxilarInferiorIzquierda['movilidadOdontogramaActual'] ?>" type="text" style="width:40px" readonly>
                                                            <input type="hidden" value="permanente" id="temporal<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>">

                                                            <table class="tabla" onclick="buscarDiente(<?php echo $dienteActualMaxilarInferiorIzquierda['idPiezaDental'] ?>, <?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>)">
                                                                <tr>
                                                                    <td id="cuadranteDerecha<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[0] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteArriba<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[6] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                    <td id="cuadranteIzquierda<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" align=center rowspan=3 <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[2] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteCentro<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[4] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="cuadranteAbajo<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" align=center <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Azul") { ?> style="background-color:blue;" <?php } ?> <?php if ($arreglodiente[8] == 1 && $dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'] == "Rojo") { ?> style="background-color:red;" <?php } ?>>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </table>
                                                            <?php if ($dienteActualMaxilarInferiorIzquierda['tratamientoOdontogramaActual'] != "") { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/' . $dienteActualMaxilarInferiorIzquierda['tratamientoOdontogramaActual'] . '.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php } else { ?>
                                                                <center>
                                                                    <img id="T<?php echo $dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] ?>" src="<?php echo base_url() . '/images/odontograma/blanco.png?nocache=' . '' . time(); ?>" class="img-responsive" width="25" height="25" />
                                                                </center>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                            </table>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--</form>-->
                    </div>


                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Médico</th>
                                <th>Motivo de consulta</th>
                                <th>Anamnesis</th>
                                <th>Signos Vitales</th>
                                <th>Examen Estomatognático</th>
                                <th>Salud bucal</th>
                                <!--<th>Diagnóstico</th>
                                            <th>Tratamiento</th>-->
                                <!--<th></th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($datos as $dato) {
                            ?>
                                <tr>
                                    <td><?php echo $dato['nombrePaciente'] ?> <?php echo $dato['apellidoPaciente'] ?></td>
                                    <td><?php echo $dato['nombreMedico'] ?> <?php echo $dato['apellidoMedico'] ?></td>
                                    <td><?php echo $dato['motivoConsultaAnamnesis'] ?></td>
                                    <td><a href="<?php echo base_url() . '/Anamnesis/editar/' . $dato['idAnamnesis'] ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a></td>
                                    <td><a href="<?php echo base_url() . '/SignosVitales/index/' . $dato['idAnamnesis'] . '/' . $idPaciente; ?>" class="btn btn-warning"><i class="fas fa-diagnoses"></i></a></td>
                                    <td><a href="<?php echo base_url() . '/ExamenSistemaEstomatognatico/index/' . $dato['idAnamnesis'] . '/' . $idPaciente; ?>" class="btn btn-warning"><i class="fas fa-file-medical"></i></a></td>
                                    <td><a href="<?php echo base_url() . '/SaludBucal/index/' . $dato['idAnamnesis'] . '/' . $idPaciente; ?>" class="btn btn-warning"><i class="fas fa-file-medical"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
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
                            //$(tagCodigo).val('');
                            console.log('si valio');
                            alert(codigo);
                        } else {
                            //$(tagCodigo).removeClass('has-error');
                            $("#resultado_error").html(resultado.error);

                            alert(codigo);
                            if (resultado.existe) {
                                $("#idPiezaSeleccionado").val(resultado.datos1.idPiezaDental);
                                $("#numeroPiezaSeleccionado").val(resultado.datos1.numeroPiezaDental);
                                caraDiente = resultado.datos1.caraOdontogramaActual;
                                alert(caraDiente);
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
                                    alert(temporal);
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
            alert($("#idPiezaSeleccionado").val());

            var tratamientos = $("#tratamientosPieza").val();
            //alert(tratamientos);
            var dienteEstado = $("#estadoPieza").val();
            //alert(dienteEstado);


            var derecha = 0;
            var arriba = 0;
            var abajo = 0;
            var centro = 0;
            var izquierda = 0;
            alert($piezadental);
            if (document.getElementById('derecha').checked) {
                derecha = 1;
                alert(derecha);
            } else {
                derecha = 0;
                alert(derecha);
            }
            if (document.getElementById('arriba').checked) {
                arriba = 1;
                alert(arriba);
            } else {
                arriba = 0;
                alert(arriba);
            }
            if (document.getElementById('abajo').checked) {
                abajo = 1;
                alert(abajo);
            } else {
                abajo = 0;
                alert(abajo);
            }
            if (document.getElementById('centro').checked) {
                centro = 1;
                alert(centro);
            } else {
                centro = 0;
                alert(centro);
            }
            if (document.getElementById('izquierda').checked) {
                izquierda = 1;
                alert(izquierda);
            } else {
                izquierda = 0;
                alert(izquierda);
            }

            var carasdedientes = derecha.toString() + ',' + izquierda.toString() + ',' + centro.toString() + ',' + arriba.toString() + ',' + abajo.toString();
            alert(carasdedientes);

            if ($piezadental != '') {
                $.ajax({
                    url: '<?php echo base_url(); ?>/anamnesis/insertarPorPiezaDental/' + $piezadental + "/" + paciente + "/" + carasdedientes + "/" + movilidad + "/" + recesion + "/" + tratamientos + "/" + dienteEstado,
                    datatype: 'JSON',
                    success: function(resultados) {
                        //transformar a json para descerializar
                        var resultado = JSON.parse(resultados);
                        if (resultado == 0) {
                            //$(tagCodigo).val('');
                            console.log('si valio');
                            alert(piezadental);
                        } else {
                            //$(tagCodigo).removeClass('has-error');
                            $("#resultado_error").html(resultado.error);
                            if (resultado.existe) {
                                //console.log('si valio');
                                alert("SI EXISTE");
                                //var tr=$("#numeroPiezaSeleccionado").val(resultado.datos1.numeroPiezaDental);
                                var idpiezadental = resultado.datos2.idPiezaDental;
                                var s = resultado.datos2.numeroPiezaDental;
                                var car = resultado.datos2.caraOdontogramaActual;
                                //var car=resultado.datos2.caraodontograma;

                                alert(idpiezadental);
                                alert(s);
                                alert("inicial" + car);
                                alert("caradientes" + carasdedientes);
                                limpiar();

                                var tratamientoActual1 = resultado.datos2.tratamientoOdontogramaActual;
                                var dienteEstadoActual1 = resultado.datos2.dienteEstadoOdontogramaActual;

                                alert("trat" + tratamientoActual1);
                                alert("dien" + dienteEstadoActual1);

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
                                alert("caras" + car);
                                alert("rec" + resultado.datos2.recesionOdontogramaActual);
                                alert("mov" + resultado.datos2.movilidadOdontogramaActual);

                                $("#RECESION" + s).val(resultado.datos2.recesionOdontogramaActual);
                                $("#MOVILIDAD" + s).val(resultado.datos2.movilidadOdontogramaActual);

                                document.getElementById("T" + s).src = baseurl + "/images/odontograma/" + tratamientoActual1 + ".png";

                            } else {
                                alert("NO EXISTE");
                                $("#idPiezaSeleccionado").html('');
                                $("#numeroPiezaSeleccionado").html('');

                            }
                        }
                    }
                });
            }
        }
    </script>