<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SignosVitalesModel;
use App\Models\DetalleRolesPermisosModel;
use App\Libraries\permisosMenu;

class SignosVitales extends BaseController
{
    protected $signosVitales, $redireccionIndexSignosVitales;
    protected $reglas, $session;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->signosVitales = new SignosVitalesModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->redireccionIndexSignosVitales = '/SignosVitales/index/';
        $this->session = session();
        helper(['form']);
        $this->reglas = [
            'presionArterialSistolica' => [
                'rules' => 'required|integer|less_than[200]|greater_than[100]'
            ], 'presionArterialDiastolica' => [
                'rules' => 'required|integer|less_than[140]|greater_than[60]'
            ], 'frecuenciaCardiaca' => [
                'rules' => 'required|integer|less_than[200]|greater_than[50]'
            ], 'frecuenciaRespiratoria' => [
                'rules' => 'required|integer|less_than[100]|greater_than[20]'
            ], 'temperatura' => [
                'rules' => 'required|decimal|less_than[50]|greater_than[30]'
            ], 'peso' => [
                'rules' => 'required|decimal|less_than[600]|greater_than[1]'
            ], 'talla' => [
                'rules' => 'required|decimal|less_than[260]|greater_than[20]'
            ]
        ];
    }

    public function index($idanamnesis, $idpaciente, $activo = 1)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisMostrar');
            if (!$permiso) {
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                $this->permisosMenu->mensajeNoPermisos();
                echo view('footer');
            } else {
            $signosVitales = $this->signosVitales->where('activoSignosVitales', $activo)->where('idanamnesis', $idanamnesis)->findAll();
            $permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisInsertar');
            $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisEditar');
            $permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisEliminar');
            $data = ['titulo' => 'Signos Vitales', 'datos' => $signosVitales, 'idanamnesis' => $idanamnesis, 'idpaciente' => $idpaciente, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar];

            echo view('header');
            $this->permisosMenu->habilitarpermisos();
            echo view('signosVitales/signosVitales', $data);
            echo view('footer');
            }
        }
    }

    public function eliminados($activo = 0)
    {
        $signosVitales = $this->signosVitales->where('activoSignosVitales', $activo)->findAll();
        $data = ['titulo' => 'Códigos CIE eliminados', 'datos' => $signosVitales];

        echo view('header');
        echo view('codigosCie/eliminados', $data);
        echo view('footer');
    }

    public function nuevo($id, $idpaciente)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $data = ['titulo' => 'Agregar signos vitales', 'idanamnesis' => $id, 'idpaciente' => $idpaciente];
            echo view('header');
            echo view('SignosVitales/nuevo', $data);
            echo view('footer');
        }
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->signosVitales->save([
                'idAnamnesis' => $this->request->getPost('id'),
                'presionArterialSistolicaSignosVitales' => $this->request->getPost('presionArterialSistolica'),
                'presionArterialDiastolicaSignosVitales' => $this->request->getPost('presionArterialDiastolica'),
                'frecuenciaCardiacaSignosVitales' => $this->request->getPost('frecuenciaCardiaca'),
                'frecuenciaRespiratoriaSignosVitales' => $this->request->getPost('frecuenciaRespiratoria'),
                'temperaturaSignosVitales' => $this->request->getPost('temperatura'),
                'pesoSignosVitales' => $this->request->getPost('peso'),
                'tallaSignosVitales' => $this->request->getPost('talla'),
            ])) {
                return redirect()->to(base_url() . $this->redireccionIndexSignosVitales . $this->request->getPost('id') . '/' . $this->request->getPost('idpaciente'))->with('mensaje', 'Se ha ingresado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexSignosVitales . $this->request->getPost('id') . '/' . $this->request->getPost('idpaciente'))->with('mensajeError', 'No se ha ingresado correctamente.');
            }
        } else {
            $data = ['titulo' => 'Agregar signos vitales', 'validation' => $this->validator, 'idanamnesis' => $this->request->getPost('id'), 'idpaciente' => $this->request->getPost('idpaciente')];
            echo view('header');
            echo view('SignosVitales/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $idanamnesis, $idpaciente, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $signosVitales = $this->signosVitales->where('idSignosVitales', $id)->first();
            if ($valid != null) {
                $data = ['titulo' => 'Editar signos vitales', 'datos' => $signosVitales, 'idanamnesis' => $idanamnesis, 'idpaciente' => $idpaciente, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Editar signos vitales', 'datos' => $signosVitales, 'idanamnesis' => $idanamnesis, 'idpaciente' => $idpaciente];
            }
            echo view('header');
            echo view('SignosVitales/editar', $data);
            echo view('footer');
        }
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->signosVitales->update(
                $this->request->getPost('id'),
                [
                    'idAnamnesis' => $this->request->getPost('idanamnesis'),
                    'presionArterialSistolicaSignosVitales' => $this->request->getPost('presionArterialSistolica'),
                    'presionArterialDiastolicaSignosVitales' => $this->request->getPost('presionArterialDiastolica'),
                    'frecuenciaCardiacaSignosVitales' => $this->request->getPost('frecuenciaCardiaca'),
                    'frecuenciaRespiratoriaSignosVitales' => $this->request->getPost('frecuenciaRespiratoria'),
                    'temperaturaSignosVitales' => $this->request->getPost('temperatura'),
                    'pesoSignosVitales' => $this->request->getPost('peso'),
                    'tallaSignosVitales' => $this->request->getPost('talla'),
                ]
            )) {
                return redirect()->to(base_url() . $this->redireccionIndexSignosVitales . $this->request->getPost('idanamnesis') . '/' . $this->request->getPost('idpaciente'))->with('mensaje', 'Se ha modificado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexSignosVitales . $this->request->getPost('idanamnesis') . '/' . $this->request->getPost('idpaciente'))->with('mensajeError', 'No se ha modificado correctamente.');
            }
        } else {
            return $this->editar($this->request->getPost('id'), $this->request->getPost('idanamnesis'), $this->request->getPost('idpaciente'), $this->validator);
        }
    }

    public function eliminar($id, $idanamnesis, $idpaciente)
    {
        if ($this->signosVitales->update($id, ['activoSignosVitales' => 0])) {
            return redirect()->to(base_url() . $this->redireccionIndexSignosVitales . $idanamnesis . '/' . $idpaciente)->with('mensaje', 'Se ha eliminado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexSignosVitales . $idanamnesis . '/' . $idpaciente)->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }
}
