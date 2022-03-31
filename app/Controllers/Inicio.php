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
			$permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'GraficasMostrar');
            if (!$permiso) {
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('footer');
            } else {
			$tratamientosPendientes = $this->tratamientos->where('activoTratamiento', 1)->where('procedimientoTratamiento','PENDIENTE')->countAllResults();
			$tratamientosEnProceso = $this->tratamientos->where('activoTratamiento', 1)->where('procedimientoTratamiento','EN PROCESO')->countAllResults();
			$tratamientosFinalizados = $this->tratamientos->where('activoTratamiento', 1)->where('procedimientoTratamiento','FINALIZADO')->countAllResults();
			$procedimientosRelizados = $this->procedimientosRealizados->where('activoProcedimientosRealizados', 1)->countAllResults();
			$datos=['tratamientosPendientes'=>$tratamientosPendientes, 'tratamientosEnProceso'=>$tratamientosEnProceso, 'tratamientosFinalizados'=>$tratamientosFinalizados, 'procedimientosRelizados'=>$procedimientosRelizados];
			echo view('header');
			$this->permisosMenu->habilitarpermisos();
			echo view('inicio', $datos);
			echo view('footer');
			}
		}
	}
}
