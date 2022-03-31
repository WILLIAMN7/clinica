<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TratamientosModel;
use App\Models\CodigosCieModel;
use App\Models\ProcedimientosRealizadosModel;
use App\Libraries\permisosMenu;
use App\Models\DetalleRolesPermisosModel;
use App\Models\PacientesModel;

class ProcedimientosRealizados extends BaseController
{
    protected $tratamientos, $procedimientosRealizados, $medicos, $pacientes, $redireccionIndexProcedimientos;
    protected $reglas, $session;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->tratamientos = new TratamientosModel();
        $this->procedimientosRealizados = new ProcedimientosRealizadosModel();
        $this->codigosCie = new CodigosCieModel();
        $this->pacientes = new PacientesModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->redireccionIndexProcedimientos = '/procedimientosRealizados/index/';
        $this->session = session();

        helper(['form']);
        $this->reglas = [
            'procedimiento' => [
                'rules' => 'required|min_length[2]'
            ]
        ];
    }

    public function index($id, $idTratamiento, $activo = 1)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'TratamientosMostrar');
            if (!$permiso) {
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                $this->permisosMenu->mensajeNoPermisos();
                echo view('footer');
            } else {
                $procedimientosRealizados = $this->procedimientosRealizados->listarProcedimientosRealizados($idTratamiento);
                $permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'TratamientosInsertar');
                $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'TratamientosEditar');
                $permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'TratamientosEliminar');
                $data = ['titulo' => 'Procedimientos realizados', 'idPaciente' => $id, 'idTratamiento' => $idTratamiento,  'datos' => $procedimientosRealizados, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar];

                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('procedimientosRealizados/procedimientosRealizados', $data);
                echo view('footer');
            }
        }
    }

    public function eliminados($activo = 0)
    {
        $tratamientos = $this->tratamientos->where('activoTratamiento', $activo)->findAll();
        $data = ['titulo' => 'Tratamientos eliminadas', 'datos' => $tratamientos];

        echo view('header');
        echo view('procedimientosRealizados/eliminados', $data);
        echo view('footer');
    }

    public function nuevo($idPaciente, $idTratamiento)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $tratamientos = $this->tratamientos->listarTratamiento($idTratamiento);
            $pacientes = $this->pacientes->where('idPaciente', $idPaciente)->first();
            $data = ['titulo' => 'Agregar procedimiento realizado', 'tratamientos' => $tratamientos, 'pacientes' => $pacientes, 'idPaciente' => $idPaciente, 'idTratamiento' => $idTratamiento];
            echo view('header');
            echo view('procedimientosRealizados/nuevo', $data);
            echo view('footer');
        }
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->procedimientosRealizados->save([
                'idMedico' => $this->request->getPost('idMedicos'),
                'idTratamiento' => $this->request->getPost('idTratamientos'),
                'procedimientoProcedimientosRealizados' => $this->request->getPost('procedimiento'),
                'prescripcionProcedimientosRealizados' => $this->request->getPost('prescripcion')
            ])) {
                return redirect()->to(base_url() . $this->redireccionIndexProcedimientos . $this->request->getPost('idPaciente') . '/' . $this->request->getPost('idTratamientos'))->with('mensaje', 'Se ha ingresado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexProcedimientos . $this->request->getPost('idPaciente') . '/' . $this->request->getPost('idTratamientos'))->with('mensajeError', 'No se ha ingresado correctamente.');
            }
        } else {
            $tratamientos = $this->tratamientos->listarTratamiento($this->request->getPost('idTratamientos'));
            $pacientes = $this->pacientes->where('idPaciente', $this->request->getPost('idPaciente'))->first();
            $data = ['titulo' => 'Agregar procedimiento realizado', 'tratamientos' => $tratamientos, 'pacientes' => $pacientes, 'idPaciente' => $this->request->getPost('idPaciente'), 'idTratamiento' => $this->request->getPost('idTratamientos'), 'validation' => $this->validator];
            echo view('header');
            echo view('procedimientosRealizados/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $idPaciente, $idTratamiento, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $tratamientos = $this->tratamientos->listarTratamiento($idTratamiento);
            $pacientes = $this->pacientes->where('idPaciente', $idPaciente)->first();
            $procedimientosRealizados = $this->procedimientosRealizados->where('idProcedimientosRealizados', $id)->first();
            if ($valid != null) {
                $data = ['titulo' => 'Editar procedimientos realizados', 'procedimientosRealizados' => $procedimientosRealizados, 'pacientes' => $pacientes, 'tratamientos' => $tratamientos, 'idPaciente' => $idPaciente, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Editar procedimientos realizados', 'procedimientosRealizados' => $procedimientosRealizados, 'pacientes' => $pacientes, 'tratamientos' => $tratamientos, 'idPaciente' => $idPaciente];
            }
            echo view('header');
            echo view('procedimientosRealizados/editar', $data);
            echo view('footer');
        }
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->procedimientosRealizados->update(
                $this->request->getPost('id'),
                [
                    'procedimientoProcedimientosRealizados' => $this->request->getPost('procedimiento'),
                    'prescripcionProcedimientosRealizados' => $this->request->getPost('prescripcion')
                ]
            )) {
                return redirect()->to(base_url() . $this->redireccionIndexProcedimientos . $this->request->getPost('idPaciente') . '/' . $this->request->getPost('idTratamientos'))->with('mensaje', 'Se ha modificado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexProcedimientos . $this->request->getPost('idPaciente') . '/' . $this->request->getPost('idTratamientos'))->with('mensajeError', 'No se ha modificado correctamente.');
            }
        } else {
            return $this->editar($this->request->getPost('id'), $this->request->getPost('idPaciente'), $this->request->getPost('idTratamientos'), $this->validator);
        }
    }

    public function eliminar($id, $idPaciente, $idTratamiento)
    {
        if ($this->procedimientosRealizados->update($id, ['activoProcedimientosRealizados' => 0])) {
            return redirect()->to(base_url() . $this->redireccionIndexProcedimientos . $idPaciente . '/' . $idTratamiento)->with('mensaje', 'Se ha eliminado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexProcedimientos . $idPaciente . '/' . $idTratamiento)->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }

    public function finalizado($idPaciente, $idTratamiento)
    {
        $this->tratamientos->update(
            $idTratamiento,
            [
                'procedimientoTratamiento' => "FINALIZADO",
            ]
        );
        return redirect()->to(base_url() . '/Tratamientos/index/' . $idPaciente)->with('mensaje', 'Se ha finalizado el tratamiento correctamente. Revisar y actualizar el odontograma de ser necesario.');
    }
}
