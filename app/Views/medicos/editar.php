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
                <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/Medicos/actualizar" autocomplete="off">

                    <input type="hidden" id="id" name="id" value="<?php echo $datos['idMedico']; ?>">

                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Nombres</label>
                                <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $datos['nombreMedico']; ?>" autofocus required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Apellidos</label>
                                <input class="form-control" id="apellido" name="apellido" type="text" value="<?php echo $datos['apellidoMedico']; ?>" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <?php $date = date('Y-m-d', time()); 
                                $nuevaFecha = strtotime ('-18 year' , strtotime($date));
                                $nuevaFecha = date ('Y-m-d',$nuevaFecha);
                                ?>
                                <label>Fecha de nacimiento:</label>
                                <input class="form-control" id="fechaNacimiento" name="fechaNacimiento" type="date" value="<?php echo $datos['fechanacimientoMedico']; ?>" min="1900-01-01" max="<?php echo $nuevaFecha; ?>" autofocus required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Tel??fono:</label>
                                <input class="form-control" id="telefono" name="telefono" type="text" value="<?php echo $datos['telefonoMedico']; ?>" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Correo:</label>
                                <input class="form-control" id="correo" name="correo" type="text" value="<?php echo $datos['correoMedico']; ?>" autofocus required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Identificaci??n:</label>
                                <input class="form-control" id="identificacion" name="identificacion" type="text" value="<?php echo $datos['identificacionMedico']; ?>" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class=form-group>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Direccion:</label>
                                <input class="form-control" id="direccion" name="direccion" type="text" value="<?php echo $datos['direccionMedico']; ?>" autofocus required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>G??nero:</label>
                                <select class="form-control" id="genero" name="genero" required>
                                    <option value="" <?php if ("" == $datos['generoMedico']) {
                                                            echo 'selected';
                                                        } ?>>Seleccionar g??nero</option>
                                    <option value="M" <?php if ("M" == $datos['generoMedico']) {
                                                            echo 'selected';
                                                        } ?>>Masculino</option>
                                    <option value="F" <?php if ("F" == $datos['generoMedico']) {
                                                            echo 'selected';
                                                        } ?>>Femenino</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <a href="<?php echo base_url(); ?>/Medicos" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</main>