<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiagnosticosModel;
use App\Models\CodigosCieModel;
use App\Models\AnamnesisModel;
use App\Models\DetalleRolesPermisosModel;
use App\Models\PacientesModel;
use App\Libraries\permisosMenu;

class Diagnosticos extends BaseController
{
    protected $diagnosticos, $anamnesis, $codigosCie, $redireccionIndexDiagnosticos;
    protected $reglas, $session;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->anamnesis = new AnamnesisModel();
        $this->diagnosticos = new DiagnosticosModel();
        $this->codigosCie = new CodigosCieModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->pacientes = new PacientesModel();
        $this->redireccionIndexDiagnosticos='/diagnosticos/index/';
        $this->session = session();

        helper(['form']);
        $this->reglas = [
            'diagnostico' => [
                'rules' => 'required'
            ],
            'tipoDiagnostico' => [
                'rules' => 'required'
            ]
        ];
    }

    public function index($id, $activo = 1)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'DiagnosticosMostrar');
            if (!$permiso) {
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                $this->permisosMenu->mensajeNoPermisos();
                echo view('footer');
            } else {
                $diagnostico = $this->diagnosticos->listarDiagnosticos($id);
                $pacientes = $this->pacientes->where('idPaciente', $id)->first();
                $permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'DiagnosticosInsertar');
                $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'DiagnosticosEditar');
                $permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'DiagnosticosEliminar');

                $data = ['titulo' => 'Diagnósticos', 'idPaciente' => $id, 'datos' => $diagnostico, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar, 'pacientes' => $pacientes];
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('diagnosticos/diagnosticos', $data);
                echo view('footer');
            }
        }
    }

    public function nuevo($idPaciente)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $codigoCie = $this->codigosCie->where('activoCodigosCie', 1)->where('tipoCodigosCie', 'DIA')->findAll();
            $data = ['titulo' => 'Agregar diagnósticos', 'codigosCie' => $codigoCie, 'idPaciente' => $idPaciente];
            echo view('header');
            echo view('diagnosticos/nuevo', $data);
            echo view('footer');
        }
    }

    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->diagnosticos->save([
                'idPaciente' => $this->request->getPost('idPaciente'),
                'idCodigosCie' => $this->request->getPost('diagnostico'),
                'descripcionDiagnostico' => $this->request->getPost('descripcionDiagnostico'),
                'tipoDiagnostico' => $this->request->getPost('tipoDiagnostico')
            ])) {
                return redirect()->to(base_url() . $this->redireccionIndexDiagnosticos . $this->request->getPost('idPaciente'))->with('mensaje', 'Se ha ingresado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexDiagnosticos . $this->request->getPost('idPaciente'))->with('mensajeError', 'No se ha ingresado correctamente.');
            }
        } else {
            $codigoCie = $this->codigosCie->where('activoCodigosCie', 1)->where('tipoCodigosCie', 'DIA')->findAll();
            $data = ['titulo' => 'Agregar diagnósticos', 'validation' => $this->validator, 'idPaciente' => $this->request->getPost('idPaciente'), 'codigosCie' => $codigoCie];
            echo view('header');
            echo view('diagnosticos/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $idPaciente, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $codigoCie = $this->codigosCie->where('activoCodigosCie', 1)->where('tipoCodigosCie', 'DIA')->findAll();
            $diagnostico = $this->diagnosticos->where('idDiagnostico', $id)->first();
            if ($valid != null) {
                $data = ['titulo' => 'Editar diagnósticos', 'diagnosticos' => $diagnostico, 'validation' => $valid, 'idPaciente' => $idPaciente, 'codigosCie' => $codigoCie];
            } else {
                $data = ['titulo' => 'Editar diagnósticos', 'diagnosticos' => $diagnostico, 'idPaciente' => $idPaciente, 'codigosCie' => $codigoCie];
            }
            echo view('header');
            echo view('diagnosticos/editar', $data);
            echo view('footer');
        }
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->diagnosticos->update(
                $this->request->getPost('id'),
                [
                    'idPaciente' => $this->request->getPost('idPaciente'),
                    'idCodigosCie' => $this->request->getPost('diagnostico'),
                    'descripcionDiagnostico' => $this->request->getPost('descripcionDiagnostico'),
                    'tipoDiagnostico' => $this->request->getPost('tipoDiagnostico')
                ]
            )) {
                return redirect()->to(base_url() . $this->redireccionIndexDiagnosticos . $this->request->getPost('idPaciente'))->with('mensaje', 'Se ha modificado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexDiagnosticos . $this->request->getPost('idPaciente'))->with('mensajeError', 'No se ha modificado correctamente.');
            }
        } else {
            return $this->editar($this->request->getPost('id'), $this->request->getPost('idPaciente'), $this->validator);
        }
    }

    public function eliminar($id, $idPaciente)
    {
        if ($this->diagnosticos->update($id, ['activoDiagnostico' => 0])) {
            return redirect()->to(base_url() . $this->redireccionIndexDiagnosticos . $idPaciente)->with('mensaje', 'Se ha eliminado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexDiagnosticos . $idPaciente)->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }
}
