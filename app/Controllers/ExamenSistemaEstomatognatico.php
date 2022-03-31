<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExamenSistemaEstomatognaticoModel;
use App\Models\DetalleRolesPermisosModel;
use App\Libraries\permisosMenu;

class ExamenSistemaEstomatognatico extends BaseController
{
    protected $examenSistemaEstomatognatico, $redireccionIndexExamenSistemaEstomatognatico;
    protected $reglas, $session;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->examenSistemaEstomatognatico = new ExamenSistemaEstomatognaticoModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->session = session();
        $this->redireccionIndexExamenSistemaEstomatognatico='/examenSistemaEstomatognatico/index/';
        helper(['form']);
        $this->reglas = [
            'comentario' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
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
                $examenSistemaEstomatognaticos = $this->examenSistemaEstomatognatico->where('activoExamenSistemaEstomatognatico', $activo)->where('idanamnesis', $idanamnesis)->findAll();
                $permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisInsertar');
                $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisEditar');
                $permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisEliminar');
                $data = ['titulo' => 'Examen del Sistema Estomatognático', 'datos' => $examenSistemaEstomatognaticos, 'idanamnesis' => $idanamnesis, 'idpaciente' => $idpaciente, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar];

                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('examenSistemaEstomatognatico/examenSistemaEstomatognatico', $data);
                echo view('footer');
            }
        }
    }

    public function nuevo($id, $idpaciente)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $data = ['titulo' => 'Agregar examen del sistema estomatognático', 'idanamnesis' => $id, 'idpaciente' => $idpaciente];
            echo view('header');
            echo view('examenSistemaEstomatognatico/nuevo', $data);
            echo view('footer');
        }
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->examenSistemaEstomatognatico->save([
                'idAnamnesis' => $this->request->getPost('id'),
                'labiosExamenSistemaEstomatognatico' => $this->request->getPost('labios'),
                'mejillasExamenSistemaEstomatognatico' => $this->request->getPost('mejillas'),
                'maxilarSuperiorExamenSistemaEstomatognatico' => $this->request->getPost('maxilarSuperior'),
                'maxilarInferiorExamenSistemaEstomatognatico' => $this->request->getPost('maxilarInferior'),
                'lenguaExamenSistemaEstomatognatico' => $this->request->getPost('lengua'),
                'paladarExamenSistemaEstomatognatico' => $this->request->getPost('paladar'),
                'pisoDeBocaExamenSistemaEstomatognatico' => $this->request->getPost('pisoBoca'),
                'carrillosExamenSistemaEstomatognatico' => $this->request->getPost('carrillos'),
                'glandulasSalivalesExamenSistemaEstomatognatico' => $this->request->getPost('glandulasSalivales'),
                'faringeExamenSistemaEstomatognatico' => $this->request->getPost('faringe'),
                'atmExamenSistemaEstomatognatico' => $this->request->getPost('atm'),
                'gangliosExamenSistemaEstomatognatico' => $this->request->getPost('ganglios'),
                'comentarioExamenSistemaEstomatognatico' => $this->request->getPost('comentario'),
            ])) {
                return redirect()->to(base_url() . $this->redireccionIndexExamenSistemaEstomatognatico . $this->request->getPost('id') . '/' . $this->request->getPost('idpaciente'))->with('mensaje', 'Se ha ingresado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexExamenSistemaEstomatognatico . $this->request->getPost('id') . '/' . $this->request->getPost('idpaciente'))->with('mensajeError', 'No se ha ingresado correctamente.');
            }
        } else {
            $data = ['titulo' => 'Agregar examen del sistema estomatognático', 'validation' => $this->validator, 'idanamnesis' => $this->request->getPost('id'), 'idpaciente' => $this->request->getPost('idpaciente')];
            echo view('header');
            echo view('examenSistemaEstomatognatico/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $idanamnesis, $idpaciente, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $examenSistemaEstomatognaticos = $this->examenSistemaEstomatognatico->where('idExamenSistemaEstomatognatico', $id)->first();
            if ($valid != null) {
                $data = ['titulo' => 'Editar examen de sistema estomatognático', 'datos' => $examenSistemaEstomatognaticos, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Editar examen de sistema estomatognático', 'datos' => $examenSistemaEstomatognaticos, 'idanamnesis' => $idanamnesis, 'idpaciente' => $idpaciente];
            }
            echo view('header');
            echo view('examenSistemaEstomatognatico/editar', $data);
            echo view('footer');
        }
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->examenSistemaEstomatognatico->update(
                $this->request->getPost('id'),
                [
                    'idanamnesis' => $this->request->getPost('idanamnesis'),
                    'labiosExamenSistemaEstomatognatico' => $this->request->getPost('labios'),
                    'mejillasExamenSistemaEstomatognatico' => $this->request->getPost('mejillas'),
                    'maxilarSuperiorExamenSistemaEstomatognatico' => $this->request->getPost('maxilarSuperior'),
                    'maxilarInferiorExamenSistemaEstomatognatico' => $this->request->getPost('maxilarInferior'),
                    'lenguaExamenSistemaEstomatognatico' => $this->request->getPost('lengua'),
                    'paladarExamenSistemaEstomatognatico' => $this->request->getPost('paladar'),
                    'pisoDeBocaExamenSistemaEstomatognatico' => $this->request->getPost('pisoBoca'),
                    'carrillosExamenSistemaEstomatognatico' => $this->request->getPost('carrillos'),
                    'glandulasSalivalesExamenSistemaEstomatognatico' => $this->request->getPost('glandulasSalivales'),
                    'faringeExamenSistemaEstomatognatico' => $this->request->getPost('faringe'),
                    'atmExamenSistemaEstomatognatico' => $this->request->getPost('atm'),
                    'gangliosExamenSistemaEstomatognatico' => $this->request->getPost('ganglios'),
                    'comentarioExamenSistemaEstomatognatico' => $this->request->getPost('comentario'),
                ]
            )) {
                return redirect()->to(base_url() . $this->redireccionIndexExamenSistemaEstomatognatico . $this->request->getPost('idanamnesis') . '/' . $this->request->getPost('idpaciente'))->with('mensaje', 'Se ha modificado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexExamenSistemaEstomatognatico . $this->request->getPost('idanamnesis') . '/' . $this->request->getPost('idpaciente'))->with('mensajeError', 'No se ha modificado correctamente.');
            }
        } else {
            return $this->editar($this->request->getPost('id'), $this->request->getPost('idanamnesis'), $this->request->getPost('idpaciente'), $this->validator);
        }
    }

    public function eliminar($id, $idanamnesis, $idpaciente)
    {
        if ($this->examenSistemaEstomatognatico->update($id, ['activoExamenSistemaEstomatognatico' => 0])) {
            return redirect()->to(base_url() . $this->redireccionIndexExamenSistemaEstomatognatico . $idanamnesis . '/' . $idpaciente)->with('mensaje', 'Se ha eliminado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexExamenSistemaEstomatognatico . $idanamnesis . '/' . $idpaciente)->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }
}
