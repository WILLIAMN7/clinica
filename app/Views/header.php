<?php
$user_session = session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HISTORIAL ODONTOLÓGICO</title>
    <link href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <link href="<?php echo base_url();?>/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?php echo base_url(); ?>/inicio">Historial Odontológico</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><em class="fas fa-bars"></em></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user_session->nombre; ?><em class="fas fa-user fa-fw"></em></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/cambiarClave">Cambiar contraseña</a></li>
                    <!--<li><a class="dropdown-item" href="#!">Activity Log <?php
                                                                        //echo $user_session->idRol;
                                                                        ?></a></li>-->
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/logout">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a id="menuCatalogos" class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menucatalogos" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><em class="fas fa-user-md"></em></div>
                            Catálogos
                            <div class="sb-sidenav-collapse-arrow"><em class="fas fa-angle-down"></em></div>
                        </a>
                        <div class="collapse" id="menucatalogos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a id="submenuMedicos" class="nav-link" href="<?php echo base_url() ?>/medicos">Médicos</a>
                                <a id="submenuCodigosCIE" class="nav-link" href="<?php echo base_url() ?>/codigosCie">Códigos médicos</a>
                            </nav>
                        </div>

                        <a id="menuHistorial" class="nav-link" href="<?php echo base_url() ?>/historial">
                            <div class="sb-nav-link-icon"><em class="fas fa-notes-medical"></em></div>
                            Historial
                        </a>

                        <a id="menuReportes" class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menureportes" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><em class="fas fa-list"></em></div>
                            Reportes
                            <div class="sb-sidenav-collapse-arrow"><em class="fas fa-angle-down"></em></div>
                        </a>
                        <div class="collapse" id="menureportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a id="submenuReportes1" class="nav-link" href="<?php echo base_url() ?>/tratamientos/muestraTratamientosPDF">Reporte de tratamientos</a>
                                <a id="submenuReportes2" class="nav-link" href="<?php echo base_url() ?>/pacientes/muestraPacientesPDF">Reportes de pacientes</a>
                            </nav>
                        </div>

                        <a id="menuAdministracion" class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subAdministracion" aria-expanded="false" aria-controls="subAdministracion">
                            <div class="sb-nav-link-icon"><em class="fas fa-tools"></em></div>
                            Administracion
                            <div class="sb-sidenav-collapse-arrow"><em class="fas fa-angle-down"></em></div>
                        </a>
                        <div class="collapse" id="subAdministracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a id="submenuConfiguracion" class="nav-link" href="<?php echo base_url() ?>/configuracion">Configuracion</a>
                                <a id="submenuUsuarios" class="nav-link" href="<?php echo base_url() ?>/usuarios">Usuarios</a>
                                <a id="submenuRoles" class="nav-link" href="<?php echo base_url() ?>/roles">Roles</a>
                            </nav>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
        <style>
            .centrar {
                text-align: center;
            }
        </style>
        <div id="layoutSidenav_content">
            <?php if (session('mensaje')) { ?>
                <div class="alert alert-success">
                    <?php echo session('mensaje'); ?>
                </div>
            <?php } ?>
            <?php if (session('mensajeError')) { ?>
                <div class="alert alert-danger">
                    <?php echo session('mensajeError'); ?>
                </div>
            <?php } ?>