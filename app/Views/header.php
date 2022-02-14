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
        <!--<script src="<?php echo base_url();?>/js/jquery-ui/external/jquery/jquery.js"></script>-->
        <!--<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />-->
        <link href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css" rel="stylesheet" />
        
        <link href="<?php echo base_url();?>/css/styles.css" rel="stylesheet" />     
        <!--<link href="<?php echo base_url();?>/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->                
        <!--<link href="<?php echo base_url();?>/js/jquery-ui/jquery-ui.min.js"/>-->
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>  
        <!--<script src="<?php //echo base_url();?>/js/Chart.min.js"></script>-->
    </head>    

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url();?>/inicio">Historial Odontológico</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!--<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>-->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user_session->nombre;?><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url();?>/usuarios/cambia_password">Cambiar contraseña</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log <?php
            echo $user_session->idRol;            
            ?></a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?php echo base_url();?>/usuarios/logout">Cerrar sesión</a></li>
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
                                <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                                Catálogos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="menucatalogos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a id="submenuMedicos" class="nav-link" href="<?php echo base_url()?>/medicos">Médicos</a>
                                    <a id="submenuCodigosCIE" class="nav-link" href="<?php echo base_url()?>/codigosCie">Códigos CIE</a>
                                </nav>
                            </div>

                            <!--<a class="nav-link" href="<?php echo base_url()?>/medicos">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                                Médico
                            </a>-->
                            <!--<a class="nav-link" href="<?php echo base_url()?>/pacientes">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Paciente
                            </a>-->
                            <a id="menuHistorial" class="nav-link" href="<?php echo base_url()?>/historial">
                                <div class="sb-nav-link-icon"><i class="fas fa-notes-medical"></i></div>
                                Historial
                            </a>
                            <!--<a class="nav-link" href="<?php echo base_url()?>/codigosCie">
                                <div class="sb-nav-link-icon"><i class="fas fa-notes-medical"></i></div>
                                Códigos CIE
                            </a>-->
                            
                            
                            <!--<div class="sb-sidenav-menu-heading">Interface</div>-->
                            <!--<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-notes-medical"></i></div>
                                Historial
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url()?>/tipoMascotas">Tipo de mascota</a>
                                    <a class="nav-link" href="<?php echo base_url()?>/mascotas">Registro de mascota</a>
                                    <a class="nav-link" href="<?php echo base_url()?>/vacunas">Vacunas</a>
                                    <a class="nav-link" href="<?php echo base_url()?>/asignacionVacunas">Control de vacunas</a>
                                </nav>
                            </div>-->

                            <a id="menuReportes" class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menureportes" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="menureportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a id="submenuReportes1" class="nav-link" href="<?php echo base_url()?>/tratamientos/muestraTratamientosPDF">Reporte de tratamientos</a>
                                    <a id="submenuReportes2" class="nav-link" href="<?php echo base_url()?>/pacientes/muestraPacientesPDF">Reportes de pacientes</a>
                                </nav>
                            </div>

                            <a id="menuAdministracion" class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subAdministracion" aria-expanded="false" aria-controls="subAdministracion">
                                <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                                Administracion
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="subAdministracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a id="submenuConfiguracion" class="nav-link" href="<?php echo base_url()?>/configuracion">Configuracion</a>
                                    <a id="submenuUsuarios" class="nav-link" href="<?php echo base_url()?>/usuarios">Usuarios</a>                                    
                                    <a id="submenuRoles" class="nav-link" href="<?php echo base_url()?>/roles">Roles</a>
                                </nav>
                            </div>                        

                        </div>
                    </div>
                    <!--<div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>-->
                </nav>
            </div>