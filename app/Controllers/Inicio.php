<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\VentasModel;
use App\Models\DetalleRolesPermisosModel;
use App\Libraries\permisosMenu;
use App\Models\TratamientosModel;
use App\Models\PacientesModel;
use App\Models\ProcedimientosRealizadosModel;

class Inicio extends BaseController
{
	protected $productoModel, $ventasModel, $session;

	public function __construct()
	{
		$this->tratamientos = new TratamientosModel();
		$this->procedimientosRealizados = new ProcedimientosRealizadosModel();
		$this->pacientes = new PacientesModel();
		$this->permisosMenu = new permisosMenu();
		$this->detalleRoles = new DetalleRolesPermisosModel();
		$this->session = session();
	}

	public function index()
	{
		if (!isset($this->session->idUsuario)) {
			return redirect()->to(base_url());
		} else {
			$tratamientosPendientes = $this->tratamientos->where('activoTratamiento', 1)->where('procedimientoTratamiento','PENDIENTE')->countAllResults();
			$tratamientosEnProceso = $this->tratamientos->where('activoTratamiento', 1)->where('procedimientoTratamiento','EN PROCESO')->countAllResults();
			$tratamientosFinalizados = $this->tratamientos->where('activoTratamiento', 1)->where('procedimientoTratamiento','TERMINADO')->countAllResults();
			$procedimientosRelizados = $this->procedimientosRealizados->where('activoProcedimientosRealizados', 1)->countAllResults();
			$datos=['tratamientosPendientes'=>$tratamientosPendientes, 'tratamientosEnProceso'=>$tratamientosEnProceso, 'tratamientosFinalizados'=>$tratamientosFinalizados, 'procedimientosRelizados'=>$procedimientosRelizados];
			echo view('header');
			$this->permisosMenu->habilitarpermisos();
			echo view('inicio', $datos);
			echo view('footer');
		}
	}
/*
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
	}*/
}
