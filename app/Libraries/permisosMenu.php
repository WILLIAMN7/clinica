<?php
namespace App\Libraries;

use App\Models\DetalleRolesPermisosModel;


class permisosMenu{
public function __construct()
{
    $this->detalleRoles = new DetalleRolesPermisosModel();
    $this->session = session();
}

public function mensajeNoPermisos(){
            echo '<div id="layoutSidenav_content">
				 <main>
				<div class="container-fluid alert alert-success">';
			echo 'No tiene permisos';
			echo '</div>
				  </main>';
}

public function habilitarpermisos()
{
    //Permisos de menu principal
    $permisoMenuCatalogos = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MenuCatalogos');
    $permisoMenuHistorial = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MenuHistorial');
    $permisoMenuReportes = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MenuReportes');
    $permisoMenuAdministracion = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MenuAdministracion');
    //Permisos de submenu
    $permisoSubmenuMedicos = $this->detalleRoles->verificaPermisos($this->session->idRol, 'SubMedicos');
    $permisoSubmenuCodigosCIE = $this->detalleRoles->verificaPermisos($this->session->idRol, 'SubCodigosCIE');
    $permisoSubmenuReporte1 = $this->detalleRoles->verificaPermisos($this->session->idRol, 'SubReporte1');
    $permisoSubmenuReporte2 = $this->detalleRoles->verificaPermisos($this->session->idRol, 'SubReporte2');
    $permisoSubmenuConfiguracion = $this->detalleRoles->verificaPermisos($this->session->idRol, 'SubConfiguracion');
    $permisoSubmenuUsuarios = $this->detalleRoles->verificaPermisos($this->session->idRol, 'SubUsuarios');
    $permisoSubmenuRoles = $this->detalleRoles->verificaPermisos($this->session->idRol, 'SubRoles');
    //Menu
    if (!$permisoMenuCatalogos) {
        echo '
    <script>				
    var menuCatalogos = document.getElementById("menuCatalogos");
    menuCatalogos.style.display = "none";
    </script>
    ';
    } else {
    }
    if (!$permisoMenuHistorial) {
        echo '
    <script>				
    var menuHistorial = document.getElementById("menuHistorial");
    menuHistorial.style.display = "none";
    </script>
    ';
    } else {
        
    }
    if (!$permisoMenuReportes) {
        echo '
    <script>				
    var menuReportes = document.getElementById("menuReportes");
    menuReportes.style.display = "none";
    </script>
    ';
    } else {
    }
    if (!$permisoMenuAdministracion) {
        echo '
    <script>				
    var menuAdministracion = document.getElementById("menuAdministracion");
    menuAdministracion.style.display = "none";
    </script>
    ';
    } else {
    }
    //Submenu
    if (!$permisoSubmenuMedicos) {
        echo '
        <script>				
        var submenuMedicos = document.getElementById("submenuMedicos");
        submenuMedicos.style.display = "none";
        </script>
        ';
    } else {
    }
    if (!$permisoSubmenuCodigosCIE) {
        echo '
        <script>				
        var submenuCodigosCIE = document.getElementById("submenuCodigosCIE");
        submenuCodigosCIE.style.display = "none";
        </script>
        ';
    } else {
    }
    if (!$permisoSubmenuReporte1) {
        echo '
        <script>				
        var submenuReportes1 = document.getElementById("submenuReportes1");
        submenuReportes1.style.display = "none";
        </script>
        ';
    } else {
    }
    if (!$permisoSubmenuReporte2) {
        echo '
        <script>				
        var submenuReportes2 = document.getElementById("submenuReportes2");
        submenuReportes2.style.display = "none";
        </script>
        ';
    } else {
    }
    if (!$permisoSubmenuConfiguracion) {
        echo '
        <script>				
        var submenuConfiguracion = document.getElementById("submenuConfiguracion");
        submenuConfiguracion.style.display = "none";
        </script>
        ';
    } else {
    }
    if (!$permisoSubmenuUsuarios) {
        echo '
        <script>				
        var submenuUsuarios = document.getElementById("submenuUsuarios");
        submenuUsuarios.style.display = "none";
        </script>
        ';
    } else {
    }
    if (!$permisoSubmenuRoles) {
        echo '
        <script>				
        var submenuRoles = document.getElementById("submenuRoles");
        submenuRoles.style.display = "none";
        </script>
        ';
    } else {
    }
}

}
