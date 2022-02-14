<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MedicosModel;
use App\Models\DetalleRolesPermisosModel;
use App\Libraries\PermisosMenu;

class Medicos extends BaseController
{
	protected $medicos, $detalleRoles;
	protected $reglas, $session;

	public function __construct()
	{
		$this->permisosMenu = new PermisosMenu();
		$this->medicos = new MedicosModel();
		$this->detalleRoles = new DetalleRolesPermisosModel();
		$this->session = session();
		helper(['form']);
		$this->reglas = [
			'nombre' => [
				'rules' => 'required|min_length[2]|max_length[50]',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			], 'apellido' => [
				'rules' => 'required|min_length[2]|max_length[50]',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			], 'fechaNacimiento' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			], 'telefono' => [
				'rules' => 'required|min_length[7]|max_length[10]|numeric',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.',
					'min_length' => 'El campo {field} debe tener como mínimo 7 caracteres.',
					'max_length' => 'El campo {field} debe tener como máximo 10 caracteres.'
				]
			], 'correo' => [
				'rules' => 'required|min_length[10]|max_length[80]|valid_email',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.',
					'valid_email' => 'El campo {field} debe estar en el formato correcto. Ejemplo: ejemplo@gmail.com'
				]
			], 'identificacion' => [
				'rules' => 'required|min_length[10]|max_length[13]|numeric',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			], 'direccion' => [
				'rules' => 'required|min_length[5]|max_length[50]',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			], 'genero' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			]
		];
	}

	public function index($activo = 1)
	{
		if (!isset($this->session->idUsuario)) {
			return redirect()->to(base_url());
		} else {
			$permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MedicosMostrar');
			if (!$permiso) {
				echo view('header');
				$this->permisosMenu->habilitarpermisos();
				$this->permisosMenu->mensajeNoPermisos();
				echo view('footer');
			} else {
				$medicos = $this->medicos->where('activoMedico', $activo)->findAll();
				$permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MedicosInsertar');
				$permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MedicosEditar');
				$permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MedicosEliminar');
				$data = ['titulo' => 'Médicos', 'datos' => $medicos, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar];

				echo view('header');
				$this->permisosMenu->habilitarpermisos();
				echo view('medicos/medicos', $data);
				echo view('footer');
			}
		}
	}

	public function eliminados($activo = 0)
	{
		$permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MedicosEliminar');
		if (!$permisoEliminar) {
			echo view('header');
			$this->permisosMenu->habilitarpermisos();
			$this->permisosMenu->mensajeNoPermisos();
			echo view('footer');
		} else {
			$medicos = $this->medicos->where('activoMedico', $activo)->findAll();
			$data = ['titulo' => 'Médicos eliminados', 'datos' => $medicos];
			echo view('header');
			$this->permisosMenu->habilitarpermisos();
			echo view('medicos/eliminados', $data);
			echo view('footer');
		}
	}

	public function nuevo()
	{
		if (!isset($this->session->idUsuario)) {
			return redirect()->to(base_url());
		} else {
			$permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MedicosInsertar');
			if (!$permisoInsertar) {
				echo view('header');
				$this->permisosMenu->habilitarpermisos();
				$this->permisosMenu->mensajeNoPermisos();
				echo view('footer');
			} else {
				$data = ['titulo' => 'Agregar médicos'];
				echo view('header');
				$this->permisosMenu->habilitarpermisos();
				echo view('medicos/nuevo', $data);
				echo view('footer');
			}
		}
	}
	public function insertar()
	{
		$permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MedicosInsertar');
		if (!$permisoInsertar) {
			echo view('header');
			$this->permisosMenu->habilitarpermisos();
			$this->permisosMenu->mensajeNoPermisos();
			echo view('footer');
		} else {
			if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
				if($this->medicos->save([
					'nombreMedico' => $this->request->getPost('nombre'),
					'apellidoMedico' => $this->request->getPost('apellido'),
					'fechaNacimientoMedico' => $this->request->getPost('fechaNacimiento'),
					'telefonoMedico' => $this->request->getPost('telefono'),
					'correoMedico' => $this->request->getPost('correo'),
					'identificacionMedico' => $this->request->getPost('identificacion'),
					'direccionMedico' => $this->request->getPost('direccion'),
					'generoMedico' => $this->request->getPost('genero')
				])){
					return redirect()->to(base_url() . '/medicos')->with('mensaje', 'Se ha ingresado correctamente.');
				}else{
					return redirect()->to(base_url() . '/medicos')->with('mensajeError', 'No se ha ingresado correctamente.');
				}
			} else {
				$data = ['titulo' => 'Agregar médicos', 'validation' => $this->validator];
				echo view('header');
				$this->permisosMenu->habilitarpermisos();
				echo view('medicos/nuevo', $data);
				echo view('footer');
			}
		}
	}

	public function editar($id, $valid = null)
	{
		if (!isset($this->session->idUsuario)) {
			return redirect()->to(base_url());
		} else {
			$permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'MedicosEditar');
			if (!$permisoEditar) {
				echo view('header');
				$this->permisosMenu->habilitarpermisos();
				$this->permisosMenu->mensajeNoPermisos();
				echo view('footer');
			} else {
				$medico = $this->medicos->where('idmedico', $id)->first();
				if ($valid != null) {
					$data = ['titulo' => 'Editar médicos', 'datos' => $medico, 'validation' => $valid];
				} else {
					$data = ['titulo' => 'Editar médicos', 'datos' => $medico];
				}
				echo view('header');
				$this->permisosMenu->habilitarpermisos();
				echo view('medicos/editar', $data);
				echo view('footer');
			}
		}
	}
	public function actualizar()
	{
		if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
			if($this->medicos->update(
				$this->request->getPost('id'),
				[
					'nombreMedico' => $this->request->getPost('nombre'),
					'apellidoMedico' => $this->request->getPost('apellido'),
					'fechaNacimientoMedico' => $this->request->getPost('fechaNacimiento'),
					'telefonoMedico' => $this->request->getPost('telefono'),
					'correoMedico' => $this->request->getPost('correo'),
					'identificacionMedico' => $this->request->getPost('identificacion'),
					'direccionMedico' => $this->request->getPost('direccion'),
					'generoMedico' => $this->request->getPost('genero')
				]
			)){
				return redirect()->to(base_url() . '/medicos')->with('mensaje', 'Se ha modificado correctamente.');
			}else{
				return redirect()->to(base_url() . '/medicos')->with('mensajeError', 'No se ha modificado correctamente.');
			}
		} else {
			return $this->editar($this->request->getPost('id'), $this->validator);
		}
	}

	public function eliminar($id)
	{
		if($this->medicos->update($id, ['activoMedico' => 0])){
            return redirect()->to(base_url() . '/medicos')->with('mensaje', 'Se ha eliminado correctamente.');
        }else{
            return redirect()->to(base_url() . '/medicos')->with('mensajeError', 'No se ha eliminado correctamente.');
        }
	}
	public function reingresar($id)
	{
		if($this->medicos->update($id, ['activoMedico' => 1])){
			return redirect()->to(base_url() . '/medicos')->with('mensaje', 'Se ha reingresado correctamente.');
			}else{
				return redirect()->to(base_url() . '/medicos')->with('mensajeError', 'No se ha reingresado correctamente.');
		   }
	}
}
