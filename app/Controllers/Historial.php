<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PacientesModel;
use App\Libraries\permisosMenu;
use App\Models\AnamnesisModel;
use App\Models\SignosVitalesModel;
use App\Models\PiezaDentalModel;
use App\Models\OdontogramasModel;
use App\Models\PlanDiagnosticosModel;
use App\Models\DiagnosticosModel;
use App\Models\CodigosCieModel;
use App\Models\SaludBucalModel;
use App\Models\OdontogramaActualModel;
use App\Models\AntecedentesPacienteModel;
use App\Models\ExamenSistemaEstomatognaticoModel;
use App\Models\DetalleRolesPermisosModel;
use App\Models\ProcedimientosRealizadosModel;
use App\Models\ConfiguracionModel;
use App\Models\TratamientosModel;

class Historial extends BaseController
{
    protected $pacientes, $detalleRoles, $configuracion, $procedimientosRealizados, $redireccionIndexHistorial, $direccionImagenOdontograma, $direccionImagenBlanco;
    protected $reglas, $session;

    public function __construct()
    {
        $this->anamnesis = new AnamnesisModel();
        $this->permisosMenu = new permisosMenu();
        $this->pacientes = new PacientesModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->antecedentesPacientes = new AntecedentesPacienteModel();
        $this->signosVitales = new SignosVitalesModel();
        $this->examenSistemaEstomatognatico = new ExamenSistemaEstomatognaticoModel();
        $this->odontogramaActual = new OdontogramaActualModel();
        $this->saludBucal = new SaludBucalModel();
        $this->examenes = new PlanDiagnosticosModel();
        $this->diagnosticos = new DiagnosticosModel();
        $this->tratamientos = new TratamientosModel();
        $this->procedimientosRealizados = new ProcedimientosRealizadosModel();
        $this->configuracion = new ConfiguracionModel();
        $this->direccionImagenBlanco ='/images/odontograma/blanco.png';
        $this->direccionImagenOdontograma ='/images/odontograma/';
        $this->redireccionIndexHistorial = '/historial';
        $this->session = session();
        helper(['form']);
        $this->reglas = [
            'nombre' => [
                'rules' => 'required|min_length[2]|max_length[50]'
            ], 'apellido' => [
                'rules' => 'required|min_length[2]|max_length[50]'
            ], 'fechaNacimiento' => [
                'rules' => 'required'
            ], 'telefono' => [
                'rules' => 'required|min_length[7]|max_length[10]|numeric'
            ], 'correo' => [
                'rules' => 'required|min_length[10]|max_length[80]|valid_email'
            ], 'direccion' => [
                'rules' => 'required|min_length[5]|max_length[50]'
            ], 'genero' => [
                'rules' => 'required'
            ]
        ];
        $this->reglasInsertarIdentificacion = [
            'identificacion' => [
                'rules' => 'required|min_length[10]|max_length[13]|numeric|is_unique[tbpaciente.identificacionPaciente]'
            ]
        ];
        $this->reglasModificarIdentificacion = [
            'identificacion' => [
                'rules' => 'required|min_length[10]|max_length[13]|numeric|is_unique[tbpaciente.identificacionPaciente,tbpaciente.idPaciente,{id}]'
            ]
        ];
    }

    public function index($activo = 1)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'PacientesMostrar');
            if (!$permiso) {
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                $this->permisosMenu->mensajeNoPermisos();
                echo view('footer');
            } else {
                $pacientes = $this->pacientes->where('activoPaciente', $activo)->findAll();
                $permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'PacientesInsertar');
                $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'PacientesEditar');
                $permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'PacientesEliminar');
                $permisoMostrar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisMostrar');
                $data = ['titulo' => 'Pacientes', 'datos' => $pacientes, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar, 'permisoMostrar' => $permisoMostrar];

                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('historial/historial', $data);
                echo view('footer');
            }
        }
    }

    public function eliminados($activo = 0)
    {
        $pacientes = $this->pacientes->where('activoPaciente', $activo)->findAll();
        $data = ['titulo' => 'Pacientes eliminados', 'datos' => $pacientes];

        echo view('header');
        echo view('historial/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $data = ['titulo' => 'Agregar pacientes'];
            echo view('header');
            echo view('historial/nuevo', $data);
            echo view('footer');
        }
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas) && $this->validate($this->reglasInsertarIdentificacion)) {
            if ($this->pacientes->save([
                'nombrePaciente' => $this->request->getPost('nombre'),
                'apellidoPaciente' => $this->request->getPost('apellido'),
                'fechaNacimientoPaciente' => $this->request->getPost('fechaNacimiento'),
                'telefonoPaciente' => $this->request->getPost('telefono'),
                'correoPaciente' => $this->request->getPost('correo'),
                'identificacionPaciente' => $this->request->getPost('identificacion'),
                'direccionPaciente' => $this->request->getPost('direccion'),
                'generoPaciente' => $this->request->getPost('genero')
            ])) {
                return redirect()->to(base_url() . $this->redireccionIndexHistorial)->with('mensaje', 'Se ha ingresado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexHistorial)->with('mensajeError', 'No se ha ingresado correctamente.');
            }
        } else {
            $data = ['titulo' => 'Agregar pacientes', 'validation' => $this->validator];
            echo view('header');
            echo view('historial/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $paciente = $this->pacientes->where('idPaciente', $id)->first();
            if ($valid != null) {
                $data = ['titulo' => 'Editar pacientes', 'datos' => $paciente, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Editar pacientes', 'datos' => $paciente];
            }

            echo view('header');
            echo view('historial/editar', $data);
            echo view('footer');
        }
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas) && $this->validate($this->reglasModificarIdentificacion)) {
            if ($this->pacientes->update(
                $this->request->getPost('id'),
                [
                    'nombrePaciente' => $this->request->getPost('nombre'),
                    'apellidoPaciente' => $this->request->getPost('apellido'),
                    'fechaNacimientoPaciente' => $this->request->getPost('fechaNacimiento'),
                    'telefonoPaciente' => $this->request->getPost('telefono'),
                    'correoPaciente' => $this->request->getPost('correo'),
                    'identificacionPaciente' => $this->request->getPost('identificacion'),
                    'direccionPaciente' => $this->request->getPost('direccion'),
                    'generoPaciente' => $this->request->getPost('genero')
                ]
            )) {
                return redirect()->to(base_url() . $this->redireccionIndexHistorial)->with('mensaje', 'Se ha modificado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexHistorial)->with('mensajeError', 'No se ha modificado correctamente.');
            }
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }

    public function eliminar($id)
    {
        if ($this->pacientes->update($id, ['activoPaciente' => 0])) {
            return redirect()->to(base_url() . $this->redireccionIndexHistorial)->with('mensaje', 'Se ha eliminado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexHistorial)->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }
    public function reingresar($id)
    {
        if ($this->pacientes->update($id, ['activoPaciente' => 1])) {
            return redirect()->to(base_url() . $this->redireccionIndexHistorial)->with('mensaje', 'Se ha reingresado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexHistorial)->with('mensajeError', 'No se ha reingresado correctamente.');
        }
    }

    function muestraHistorialPDF($idPaciente)
    {
        $data['idPaciente'] = $idPaciente;
        echo view('header');
        echo view('historial/verHistorialPdf', $data);
        echo view('footer');
    }

    public function mostrarDiente($dienteestado, $cara)
    {
        if ($dienteestado == "Rojo") {
            if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_total_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_blanco_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_izquierda_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_izquierda_centro_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_arriba_centro_izquierda_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_centro_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_arriba_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_abajo_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_centro_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_centro_arriba_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_arriba_abajo_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_arriba_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_abajo_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_abajo_centro_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_arriba_derecha_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_abajo_derecha_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_centro_abajo_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_arriba_abajo_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_centro_arriba_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_centro_arriba_abajo_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_arriba_abajo_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_centro_abajo_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_centro_arriba_abajo_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_centro_arriba_abajo_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_izquierda_arriba_abajo_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_izquierda_centro_abajo_por_tratar.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_centro_arriba_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_centro_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_arriba_por_tratar.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_abajo_por_tratar.png';
            }
        }
        if ($dienteestado = "Azul") {
            if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_total_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_blanco_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_izquierda_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_izquierda_centro_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_arriba_centro_izquierda_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_centro_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_arriba_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_abajo_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_centro_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_centro_arriba_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_arriba_abajo_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_arriba_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_abajo_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_abajo_centro_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_arriba_derecha_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_abajo_derecha_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_centro_abajo_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_arriba_abajo_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_centro_arriba_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_centro_arriba_abajo_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_arriba_abajo_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_centro_abajo_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_izquierda_centro_arriba_abajo_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_centro_arriba_abajo_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_izquierda_arriba_abajo_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 1 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_derecha_izquierda_centro_abajo_tratado.png';
            } else if ($cara[0] == 1 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_derecha_centro_arriba_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 1 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_izquierda_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 1 && $cara[6] == 0 && $cara[8] == 0) {
                return '/images/odontograma/diente_centro_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 1 && $cara[8] == 0) {
                return '/images/odontograma/diente_arriba_tratado.png';
            } else if ($cara[0] == 0 && $cara[2] == 0 && $cara[4] == 0 && $cara[6] == 0 && $cara[8] == 1) {
                return '/images/odontograma/diente_abajo_tratado.png';
            }
        }
    }

    public function generaHistorialPDF($idPaciente)
    {
        $antecedentesPacientes = $this->antecedentesPacientes->where('activoAntecedentePaciente', 1)->where('idPaciente', $idPaciente)->orderBy('idAntecedentePaciente', 'DESC')->first();
        if(isset($antecedentesPacientes)){
            $alergiaAntibioticoAntecedentePaciente=$antecedentesPacientes['alergiaAntibioticoAntecedentePaciente'];
            $alergiaAnestesiaAntecedentePaciente=$antecedentesPacientes['alergiaAnestesiaAntecedentePaciente'];
            $hemorragiasAntecedentePaciente=$antecedentesPacientes['hemorragiasAntecedentePaciente'];
            $sidaAntecedentePaciente=$antecedentesPacientes['sidaAntecedentePaciente'];
            $tuberculosisAntecedentePaciente=$antecedentesPacientes['tuberculosisAntecedentePaciente'];
            $asmaAntecedentePaciente=$antecedentesPacientes['asmaAntecedentePaciente'];
            $diabetesAntecedentePaciente=$antecedentesPacientes['diabetesAntecedentePaciente'];
            $hipertensionAntecedentePaciente=$antecedentesPacientes['hipertensionAntecedentePaciente'];
            $enfermedadCardiacaAntecedentePaciente=$antecedentesPacientes['enfermedadCardiacaAntecedentePaciente'];
            $otroAntecedentePaciente=$antecedentesPacientes['otroAntecedentePaciente'];
            $comentarioAntecedentePaciente=$antecedentesPacientes['comentarioAntecedentePaciente'];
        }else{
            $alergiaAntibioticoAntecedentePaciente="";
            $alergiaAnestesiaAntecedentePaciente="";
            $hemorragiasAntecedentePaciente="";
            $sidaAntecedentePaciente="";
            $tuberculosisAntecedentePaciente="";
            $asmaAntecedentePaciente="";
            $diabetesAntecedentePaciente="";
            $hipertensionAntecedentePaciente="";
            $enfermedadCardiacaAntecedentePaciente="";
            $otroAntecedentePaciente="";
            $comentarioAntecedentePaciente="";
        }
        $anamnesis = $this->anamnesis->select('*')->where('idPaciente', $idPaciente)->orderBy('idAnamnesis', 'DESC')->first();
        if(isset($anamnesis)){
            $idAnamnesis=$anamnesis['idAnamnesis'];
            $motivoConsultaAnamnesis=$anamnesis['motivoConsultaAnamnesis'];
            $descripcionProblemaAnamnesis=$anamnesis['descripcionProblemaAnamnesis'];
        }else{
            $idAnamnesis="";
            $motivoConsultaAnamnesis="";
            $descripcionProblemaAnamnesis="";
        }
        $pacientes = $this->pacientes->select('*')->where('idPaciente', $idPaciente)->findAll();
        $signosVitales = $this->signosVitales->where('activoSignosVitales', 1)->where('idAnamnesis', $idAnamnesis)->orderBy('idSignosVitales', 'DESC')->first();
        if(isset($signosVitales)){
            $presionArterial=$signosVitales['presionArterialSistolicaSignosVitales'].'/'.$signosVitales['presionArterialDiastolicaSignosVitales'];
            $frecuenciaCardiacaSignosVitales=$signosVitales['frecuenciaCardiacaSignosVitales'];
            $frecuenciaRespiratoriaSignosVitales=$signosVitales['frecuenciaRespiratoriaSignosVitales'];
            $temperaturaSignosVitales=$signosVitales['temperaturaSignosVitales'];
            $pesoSignosVitales=$signosVitales['pesoSignosVitales'];
            $tallaSignosVitales=$signosVitales['tallaSignosVitales'];
        }else{
            $presionArterial="";
            $frecuenciaCardiacaSignosVitales="";
            $frecuenciaRespiratoriaSignosVitales="";
            $temperaturaSignosVitales="";
            $pesoSignosVitales="";
            $tallaSignosVitales="";
        }
        $examenSistemaEstomatognatico = $this->examenSistemaEstomatognatico->where('activoExamenSistemaEstomatognatico', 1)->where('idAnamnesis', $idAnamnesis)->orderBy('idExamenSistemaEstomatognatico', 'DESC')->first();
        if(isset($examenSistemaEstomatognatico)){
            $labiosExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['labiosExamenSistemaEstomatognatico'];
            $mejillasExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['mejillasExamenSistemaEstomatognatico'];
            $maxilarSuperiorExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['maxilarSuperiorExamenSistemaEstomatognatico'];
            $maxilarInferiorExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['maxilarInferiorExamenSistemaEstomatognatico'];
            $lenguaExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['lenguaExamenSistemaEstomatognatico'];
            $paladarExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['paladarExamenSistemaEstomatognatico'];
            $pisoDeBocaExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['pisoDeBocaExamenSistemaEstomatognatico'];
            $carrillosExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['carrillosExamenSistemaEstomatognatico'];
            $glandulasSalivalesExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['glandulasSalivalesExamenSistemaEstomatognatico'];
            $faringeExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['faringeExamenSistemaEstomatognatico'];
            $atmExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['atmExamenSistemaEstomatognatico'];
            $gangliosExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['gangliosExamenSistemaEstomatognatico'];
            $comentarioExamenSistemaEstomatognatico=$examenSistemaEstomatognatico['comentarioExamenSistemaEstomatognatico'];
        }else{
            $labiosExamenSistemaEstomatognatico="";
            $mejillasExamenSistemaEstomatognatico="";
            $maxilarSuperiorExamenSistemaEstomatognatico="";
            $maxilarInferiorExamenSistemaEstomatognatico="";
            $lenguaExamenSistemaEstomatognatico="";
            $paladarExamenSistemaEstomatognatico="";
            $pisoDeBocaExamenSistemaEstomatognatico="";
            $carrillosExamenSistemaEstomatognatico="";
            $glandulasSalivalesExamenSistemaEstomatognatico="";
            $faringeExamenSistemaEstomatognatico="";
            $atmExamenSistemaEstomatognatico="";
            $gangliosExamenSistemaEstomatognatico="";
            $comentarioExamenSistemaEstomatognatico="";
        }
        $saludBucal = $this->saludBucal->where('activoSaludBucal', 1)->where('idAnamnesis', $idAnamnesis)->orderBy('idSaludBucal', 'DESC')->first();
        if(isset($saludBucal)){
            $higieneOral161755SaludBucal=$saludBucal['higieneOral161755SaludBucal'];
            $higieneOral112151SaludBucal=$saludBucal['higieneOral112151SaludBucal'];
            $higieneOral262765SaludBucal=$saludBucal['higieneOral262765SaludBucal'];
            $higieneOral363775SaludBucal=$saludBucal['higieneOral363775SaludBucal'];
            $higieneOral314171SaludBucal=$saludBucal['higieneOral314171SaludBucal'];
            $higieneOral464785SaludBucal=$saludBucal['higieneOral464785SaludBucal'];
            $enfermedadPeriodontalSaludBucal=$saludBucal['enfermedadPeriodontalSaludBucal'];
            $maloclusionSaludBucal=$saludBucal['maloclusionSaludBucal'];
            $fluorosisSaludBucal=$saludBucal['fluorosisSaludBucal'];
        }else{
            $higieneOral161755SaludBucal="";
            $higieneOral112151SaludBucal="";
            $higieneOral262765SaludBucal="";
            $higieneOral363775SaludBucal="";
            $higieneOral314171SaludBucal="";
            $higieneOral464785SaludBucal="";
            $enfermedadPeriodontalSaludBucal="";
            $maloclusionSaludBucal="";
            $fluorosisSaludBucal="";
        }
        $examenes = $this->examenes->where('activoPlanDiagnostico', 1)->where('idPaciente', $idPaciente)->orderBy('fechaEditPlanDiagnostico', 'DESC')->findAll();
        $diagnosticos = $this->diagnosticos->select('*')->join('tbcodigoscie AS c', 'tbdiagnostico.idCodigosCie = c.idCodigosCie')->where('tbdiagnostico.activoDiagnostico', 1)->where('tbdiagnostico.idPaciente', $idPaciente)->findAll();
        $tratamientos = $this->tratamientos->listarTratamientos($idPaciente);
        $procedimientosRealizados = $this->procedimientosRealizados->listarTodosLosProcedimientosRealizados($idPaciente);
        //Suma de odontograma
        $odontogramaActualP = $this->odontogramaActual->where('((tratamientoOdontogramaActual="Ausente" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Protesis_removible" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Protesis_fila" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Extraccion" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Protesis_total" and dienteEstadoOdontogramaActual="Azul"))  && (idPiezaDental<33) && idPaciente=' . $idPaciente)->countAllResults();
        $odontogramaActuale = $this->odontogramaActual->where('((tratamientoOdontogramaActual="Ausente" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Protesis_removible" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Protesis_fila" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Extraccion" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Protesis_total" and dienteEstadoOdontogramaActual="Azul"))  && (idPiezaDental>32) && idPaciente=' . $idPaciente)->countAllResults();
        $odontogramaActualO = $this->odontogramaActual->where('((tratamientoOdontogramaActual="Corona" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Endodoncia" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Restauracion" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Caries" and dienteEstadoOdontogramaActual="Azul")) && (idPiezaDental<33) && idPaciente=' . $idPaciente)->countAllResults();
        $odontogramaActualo = $this->odontogramaActual->where('((tratamientoOdontogramaActual="Corona" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Endodoncia" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Restauracion" and dienteEstadoOdontogramaActual="Azul") || (tratamientoOdontogramaActual="Caries" and dienteEstadoOdontogramaActual="Azul")) && (idPiezaDental>32) && idPaciente=' . $idPaciente)->countAllResults();
        $odontogramaActualC = $this->odontogramaActual->where('((tratamientoOdontogramaActual="Endodoncia" and dienteEstadoOdontogramaActual="Rojo") || (tratamientoOdontogramaActual="Restauracion" and dienteEstadoOdontogramaActual="Rojo") || (tratamientoOdontogramaActual="Caries" and dienteEstadoOdontogramaActual="Rojo")) && (idPiezaDental<33) && idPaciente=' . $idPaciente)->countAllResults();
        $odontogramaActualc = $this->odontogramaActual->where('((tratamientoOdontogramaActual="Endodoncia" and dienteEstadoOdontogramaActual="Rojo") || (tratamientoOdontogramaActual="Restauracion" and dienteEstadoOdontogramaActual="Rojo") || (tratamientoOdontogramaActual="Caries" and dienteEstadoOdontogramaActual="Rojo")) && (idPiezaDental>32) && idPaciente=' . $idPaciente)->countAllResults();
        //Odontograma
        $dentaduraActualMaxilarSuperiorDerecha = $this->odontogramaActual->obtenerDentaduraActualMaxilarSuperiorDerecha($idPaciente);
        $dentaduraActualMaxilarSuperiorIzquierda = $this->odontogramaActual->obtenerDentaduraActualMaxilarSuperiorIzquierda($idPaciente);
        $dentaduraActualMaxilarInferiorIzquierda = $this->odontogramaActual->obtenerDentaduraActualMaxilarInferiorIzquierda($idPaciente);
        $dentaduraActualMaxilarInferiorDerecho = $this->odontogramaActual->obtenerDentaduraActualMaxilarInferiorDerecho($idPaciente);
        $dentaduraActualMaxilarSuperiorDerechaTemporales = $this->odontogramaActual->obtenerDentaduraActualMaxilarSuperiorDerechaTemporales($idPaciente);
        $dentaduraActualMaxilarSuperiorIzquierdaTemporales = $this->odontogramaActual->obtenerDentaduraActualMaxilarSuperiorIzquierdaTemporales($idPaciente);
        $dentaduraActualMaxilarInferiorIzquierdaTemporales = $this->odontogramaActual->obtenerDentaduraActualMaxilarInferiorIzquierdaTemporales($idPaciente);
        $dentaduraActualMaxilarInferiorDerechoTemporales = $this->odontogramaActual->obtenerDentaduraActualMaxilarInferiorDerechoTemporales($idPaciente);

        $nombreTienda = $this->configuracion->select('valorConfiguracion')->where('nombreConfiguracion', "tienda_nombre")->get()->getRow()->valorConfiguracion;

        $pdf = new \FPDF('p', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->setTitle(utf8_decode('Historia clínica odontológica'));
        $pdf->SetFont('Arial', 'B', 16);
        //ancho, alto, titulo, 0 sin bordes, 1 salto de linea, C centrado
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, utf8_decode('ESTABLECIMIENTO'), 1, 0, 'L');
        $pdf->Cell(40, 5, utf8_decode('NOMBRE'), 1, 0, 'L');
        $pdf->Cell(40, 5, utf8_decode('APELLIDO'), 1, 0, 'L');
        $pdf->Cell(40, 5, utf8_decode('SEXO'), 1, 0, 'L');
        $pdf->Cell(40, 5, utf8_decode('HISTORIA CLINICA'), 1, 1, 'L');
        //X, Y, ANCHO, ALTO, FORMATO
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 5, utf8_decode($nombreTienda), 1, 0, 'L');
        foreach ($pacientes as $paciente) {
            $pdf->Cell(40, 5, utf8_decode($paciente['nombrePaciente']), 1, 0, 'L');
            $pdf->Cell(40, 5, utf8_decode($paciente['apellidoPaciente']), 1, 0, 'L');
            if ($paciente['generoPaciente'] == 'M') {
                $pdf->Cell(40, 5, 'MASCULINO', 1, 0, 'L');
            }
            if ($paciente['generoPaciente'] == 'F') {
                $pdf->Cell(40, 5, 'FEMENINO', 1, 0, 'L');
            }
            $pdf->Cell(40, 5, utf8_decode($paciente['identificacionPaciente']), 1, 0, 'L');
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(200, 5, utf8_decode('1. MOTIVO DE CONSULTA'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(200, 5, utf8_decode($motivoConsultaAnamnesis), 1, 'J');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln();

        $pdf->Cell(200, 5, utf8_decode('2. ENFERMEDAD O PROBLEMA ACTUAL'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(200, 5, utf8_decode($descripcionProblemaAnamnesis), 1, 'J');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln();

        $pdf->Cell(200, 5, utf8_decode('3. ANTECEDENTES PERSONALES Y FAMILIARES'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(35, 5, utf8_decode('ALERGIA ANTIBIÓTICO'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($alergiaAntibioticoAntecedentePaciente), 1, 0, 'L');
        $pdf->Cell(35, 5, utf8_decode('ALERGIA ANESTESIA'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($alergiaAnestesiaAntecedentePaciente), 1, 0, 'L');
        $pdf->Cell(35, 5, utf8_decode('HEMORRAGIAS'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($hemorragiasAntecedentePaciente), 1, 0, 'L');
        $pdf->Cell(35, 5, utf8_decode('SIDA'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($sidaAntecedentePaciente), 1, 1, 'L');
        $pdf->Cell(35, 5, utf8_decode('TUBERCULOSIS'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($tuberculosisAntecedentePaciente), 1, 0, 'L');
        $pdf->Cell(35, 5, utf8_decode('ASMA'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($asmaAntecedentePaciente), 1, 0, 'L');
        $pdf->Cell(35, 5, utf8_decode('DIABETES'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($diabetesAntecedentePaciente), 1, 0, 'L');
        $pdf->Cell(35, 5, utf8_decode('HIPERTENSIÓN'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($hipertensionAntecedentePaciente), 1, 1, 'L');
        $pdf->Cell(35, 5, utf8_decode('ENF. CARDÍACA'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($enfermedadCardiacaAntecedentePaciente), 1, 0, 'L');
        $pdf->Cell(35, 5, utf8_decode('OTRO'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($otroAntecedentePaciente), 1, 0, 'L');
        $pdf->Cell(35, 5, '', 1, 0, 'L');
        $pdf->Cell(15, 5, '', 1, 0, 'L');
        $pdf->Cell(35, 5, '', 1, 0, 'L');
        $pdf->Cell(15, 5, '', 1, 1, 'L');
        $pdf->Cell(200, 5, utf8_decode('COMENTARIO'), 1, 1, 'L');
        $pdf->MultiCell(200, 5, utf8_decode($comentarioAntecedentePaciente), 1, 'J');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln();
        $pdf->Cell(200, 5, utf8_decode('4. SIGNOS VITALES'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(50, 5, utf8_decode('PRESIÓN ARTERIAL'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($presionArterial), 1, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode('FRECUENCIA CARDIACA'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($frecuenciaCardiacaSignosVitales), 1, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode('FRECUENCIA RESPIRATORIA'), 1, 0, 'L');
        $pdf->Cell(20, 5, utf8_decode($frecuenciaRespiratoriaSignosVitales), 1, 1, 'L');
        $pdf->Cell(50, 5, utf8_decode('TEMPERATURA'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($temperaturaSignosVitales), 1, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode('PESO'), 1, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode($pesoSignosVitales), 1, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode('TALLA'), 1, 0, 'L');
        $pdf->Cell(20, 5, utf8_decode($tallaSignosVitales), 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln();
        $pdf->Cell(200, 5, utf8_decode('5. EXAMEN DEL SISTEMA ESTOMATOGNÁTICO'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(28, 5, utf8_decode('LABIOS'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($labiosExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('MEJILLAS'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($mejillasExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('MAX. SUPERIOR'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($maxilarSuperiorExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('MAX. INFERIOR'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($maxilarInferiorExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('LENGUA'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($lenguaExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(30, 5, utf8_decode('PALADAR'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($paladarExamenSistemaEstomatognatico), 1, 1, 'L');
        $pdf->Cell(28, 5, utf8_decode('PISO'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($pisoDeBocaExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('CARRILLOS'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($carrillosExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('GLÁN. SALIVALES'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($glandulasSalivalesExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('FARINGE'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($faringeExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('ATM'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($atmExamenSistemaEstomatognatico), 1, 0, 'L');
        $pdf->Cell(30, 5, utf8_decode('GANGLIOS'), 1, 0, 'L');
        $pdf->Cell(5, 5, utf8_decode($gangliosExamenSistemaEstomatognatico), 1, 1, 'L');

        $pdf->Cell(200, 5, utf8_decode('COMENTARIO'), 1, 1, 'L');
        $pdf->MultiCell(200, 5, utf8_decode($comentarioExamenSistemaEstomatognatico), 1, 'J');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln();
        $pdf->Cell(200, 5, utf8_decode('6. ODONTOGRAMA'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);

        $pdf->Ln();

        $pdf->Cell(16, 5, utf8_decode('Nro. Pieza'), 0, 0, 'L');
        foreach ($dentaduraActualMaxilarSuperiorDerecha  as $dienteActualMaxilarSuperiorDerecha) {
            $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorDerecha['numeroPiezaDental']), 0, 0, 'C');
        }

        $pdf->Cell(8, 5, utf8_decode(''), 0, 0, 'C');

        foreach ($dentaduraActualMaxilarSuperiorIzquierda  as $dienteActualMaxilarSuperiorIzquierda) {
            if ($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] == 28) {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental']), 0, 1, 'C');
            } else {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental']), 0, 0, 'C');
            }
        }

        $pdf->Cell(16, 5, utf8_decode('Recesión'), 1, 0, 'L');
        foreach ($dentaduraActualMaxilarSuperiorDerecha  as $dienteActualMaxilarSuperiorDerecha) {
            $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorDerecha['recesionOdontogramaActual']), 1, 0, 'C');
        }

        $pdf->Cell(8, 5, utf8_decode(''), 0, 0, 'C');

        foreach ($dentaduraActualMaxilarSuperiorIzquierda  as $dienteActualMaxilarSuperiorIzquierda) {
            if ($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] == 28) {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorIzquierda['recesionOdontogramaActual']), 1, 1, 'C');
            } else {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorIzquierda['recesionOdontogramaActual']), 1, 0, 'C');
            }
        }

        $pdf->Cell(16, 5, utf8_decode('Movilidad'), 1, 0, 'L');
        foreach ($dentaduraActualMaxilarSuperiorDerecha  as $dienteActualMaxilarSuperiorDerecha) {
            $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorDerecha['movilidadOdontogramaActual']), 1, 0, 'C');
        }

        $pdf->Cell(8, 5, utf8_decode(''), 0, 0, 'C');

        foreach ($dentaduraActualMaxilarSuperiorIzquierda  as $dienteActualMaxilarSuperiorIzquierda) {
            if ($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] == 28) {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorIzquierda['movilidadOdontogramaActual']), 1, 1, 'C');
            } else {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorIzquierda['movilidadOdontogramaActual']), 1, 0, 'C');
            }
        }

        $x = 26;
        $aumento = 11;
        $i = 0;

        foreach ($dentaduraActualMaxilarSuperiorDerecha  as $dienteActualMaxilarSuperiorDerecha) {
            $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarSuperiorDerecha['dienteEstadoOdontogramaActual'], $dienteActualMaxilarSuperiorDerecha['caraOdontogramaActual']) . '', $x + ($aumento * $i), 171, 12, 12, 'PNG');
            $i++;
        }

        $x2 = 122;
        $aumento2 = 11;
        $i2 = 0;
        foreach ($dentaduraActualMaxilarSuperiorIzquierda  as $dienteActualMaxilarSuperiorIzquierda) {
            if ($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] != 28) {
                $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'], $dienteActualMaxilarSuperiorIzquierda['caraOdontogramaActual']) . '', $x2 + ($aumento2 * $i2), 171, 12, 12, 'PNG');
                $i2++;
            } elseif ($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] == 28) {
                $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarSuperiorIzquierda['dienteEstadoOdontogramaActual'], $dienteActualMaxilarSuperiorIzquierda['caraOdontogramaActual']) . '', 199, 171, 12, 12, 'PNG');
            }
        }

        $x3 = 29;
        $aumento3 = 11;
        $i3 = 0;
        foreach ($dentaduraActualMaxilarSuperiorDerecha  as $dienteActualMaxilarSuperiorDerecha) {
            $diente = $dienteActualMaxilarSuperiorDerecha['tratamientoOdontogramaActual'];
            if ($diente == "") {
                $pdf->image(base_url() . $this->direccionImagenBlanco, $x3 + ($aumento3 * $i3), 183, 5, 5, 'PNG');
            } elseif ($diente != "") {
                $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarSuperiorDerecha['tratamientoOdontogramaActual'] . '.png', $x3 + ($aumento3 * $i3), 183, 5, 5, 'PNG');
            }
            $i3++;
        }

        $x4 = 125;
        $aumento4 = 11;
        $i4 = 0;
        foreach ($dentaduraActualMaxilarSuperiorIzquierda  as $dienteActualMaxilarSuperiorIzquierda) {
            if ($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] != 28) {
                $diente = $dienteActualMaxilarSuperiorIzquierda['tratamientoOdontogramaActual'];
                if ($diente == "") {
                    $pdf->image(base_url() . $this->direccionImagenBlanco, $x4 + ($aumento4 * $i4), 183, 5, 5, 'PNG');
                } elseif ($diente != "") {
                    $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarSuperiorIzquierda['tratamientoOdontogramaActual'] . '.png', $x4 + ($aumento4 * $i4), 183, 5, 5, 'PNG');
                }
                $i4++;
            } elseif ($dienteActualMaxilarSuperiorIzquierda['numeroPiezaDental'] == 28) {
                if ($diente == "") {
                    $pdf->image(base_url() . $this->direccionImagenBlanco, 202, 183, 5, 5, 'PNG');
                } elseif ($diente != "") {
                    $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarSuperiorIzquierda['tratamientoOdontogramaActual'] . '.png', 202, 183, 5, 5, 'PNG');
                }
            }
        }

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(49, 5, utf8_decode('Nro. Pieza'), 0, 0, 'L');
        foreach ($dentaduraActualMaxilarSuperiorDerechaTemporales  as $dienteActualMaxilarSuperiorDerechaTemporales) {
            $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorDerechaTemporales['numeroPiezaDental']), 0, 0, 'C');
        }

        $pdf->Cell(8, 5, utf8_decode(''), 0, 0, 'C');

        foreach ($dentaduraActualMaxilarSuperiorIzquierdaTemporales  as $dienteActualMaxilarSuperiorIzquierdaTemporales) {
            if ($dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] == 65) {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental']), 0, 1, 'C');
            } else {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental']), 0, 0, 'C');
            }
        }

        $x5 = 59;
        $aumento5 = 11;
        $i5 = 0;

        foreach ($dentaduraActualMaxilarSuperiorDerechaTemporales  as $dienteActualMaxilarSuperiorDerechaTemporales) {
            $pdf->image(base_url() . '' . $this->mostrardiente($dienteActualMaxilarSuperiorDerechaTemporales['dienteEstadoOdontogramaActual'], $dienteActualMaxilarSuperiorDerechaTemporales['caraOdontogramaActual']) . '', $x5 + ($aumento5 * $i5), 194, 12, 12, 'PNG');
            $i5++;
        }

        $x6 = 122;
        $aumento6 = 11;
        $i6 = 0;
        foreach ($dentaduraActualMaxilarSuperiorIzquierdaTemporales as $dienteActualMaxilarSuperiorIzquierdaTemporales) {
            if ($dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] != 65) {
                $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'], $dienteActualMaxilarSuperiorIzquierdaTemporales['caraOdontogramaActual']) . '', $x6 + ($aumento6 * $i6), 194, 12, 12, 'PNG');
                $i6++;
            } elseif ($dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] == 65) {
                $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarSuperiorIzquierdaTemporales['dienteEstadoOdontogramaActual'], $dienteActualMaxilarSuperiorIzquierdaTemporales['caraOdontogramaActual']) . '', 166, 194, 12, 12, 'PNG');
            }
        }


        $x7 = 62;
        $aumento7 = 11;
        $i7 = 0;
        foreach ($dentaduraActualMaxilarSuperiorDerechaTemporales  as $dienteActualMaxilarSuperiorDerechaTemporales) {
            $diente = $dienteActualMaxilarSuperiorDerechaTemporales['tratamientoOdontogramaActual'];
            if ($diente == "") {
                $pdf->image(base_url() . $this->direccionImagenBlanco, $x7 + ($aumento7 * $i7), 206, 5, 5, 'PNG');
            } elseif ($diente != "") {
                $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarSuperiorDerechaTemporales['tratamientoOdontogramaActual'] . '.png', $x7 + ($aumento7 * $i7), 206, 5, 5, 'PNG');
            }
            $i7++;
        }

        $x8 = 125;
        $aumento8 = 11;
        $i8 = 0;
        foreach ($dentaduraActualMaxilarSuperiorIzquierdaTemporales  as $dienteActualMaxilarSuperiorIzquierdaTemporales) {
            if ($dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] != 65) {
                $diente = $dienteActualMaxilarSuperiorIzquierdaTemporales['tratamientoOdontogramaActual'];
                if ($diente == "") {
                    $pdf->image(base_url() . $this->direccionImagenBlanco, $x8 + ($aumento8 * $i8), 206, 5, 5, 'PNG');
                } elseif ($diente != "") {
                    $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarSuperiorIzquierdaTemporales['tratamientoOdontogramaActual'] . '.png', $x8 + ($aumento8 * $i8), 206, 5, 5, 'PNG');
                }
                $i8++;
            } else if ($dienteActualMaxilarSuperiorIzquierdaTemporales['numeroPiezaDental'] == 65) {
                $diente = $dienteActualMaxilarSuperiorIzquierdaTemporales['tratamientoOdontogramaActual'];
                if ($diente == "") {
                    $pdf->image(base_url() . $this->direccionImagenBlanco, 169, 206, 5, 5, 'PNG');
                } elseif ($diente != "") {
                    $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarSuperiorIzquierdaTemporales['tratamientoOdontogramaActual'] . '.png', 169, 206, 5, 5, 'PNG');
                }
            }
        }

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(49, 5, utf8_decode('Nro. Pieza'), 0, 0, 'L');
        foreach ($dentaduraActualMaxilarInferiorDerechoTemporales   as $dienteActualMaxilarInferiorDerechoTemporales) {
            $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorDerechoTemporales['numeroPiezaDental']), 0, 0, 'C');
        }

        $pdf->Cell(8, 5, utf8_decode(''), 0, 0, 'C');

        foreach ($dentaduraActualMaxilarInferiorIzquierdaTemporales as $dienteActualMaxilarInferiorIzquierdaTemporales) {
            if ($dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] == 65) {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental']), 0, 1, 'C');
            } else {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental']), 0, 0, 'C');
            }
        }

        $x9 = 59;
        $aumento9 = 11;
        $i9 = 0;

        foreach ($dentaduraActualMaxilarInferiorDerechoTemporales  as $dienteActualMaxilarInferiorDerechoTemporales) {
            $pdf->image(base_url() . '' . $this->mostrardiente($dienteActualMaxilarInferiorDerechoTemporales['dienteEstadoOdontogramaActual'], $dienteActualMaxilarInferiorDerechoTemporales['caraOdontogramaActual']) . '', $x9 + ($aumento9 * $i9), 214, 12, 12, 'PNG');
            $i9++;
        }

        $x10 = 122;
        $aumento10 = 11;
        $i10 = 0;
        foreach ($dentaduraActualMaxilarInferiorIzquierdaTemporales as $dienteActualMaxilarInferiorIzquierdaTemporales) {
            if ($dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] != 75) {
                $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'], $dienteActualMaxilarInferiorIzquierdaTemporales['caraOdontogramaActual']) . '', $x10 + ($aumento10 * $i10), 214, 12, 12, 'PNG');
                $i10++;
            } elseif ($dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] == 75) {
                $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarInferiorIzquierdaTemporales['dienteEstadoOdontogramaActual'], $dienteActualMaxilarInferiorIzquierdaTemporales['caraOdontogramaActual']) . '', 166, 214, 12, 12, 'PNG');
            }
        }


        $x11 = 62;
        $aumento11 = 11;
        $i11 = 0;
        foreach ($dentaduraActualMaxilarInferiorDerechoTemporales  as $dienteActualMaxilarInferiorDerechoTemporales) {
            $diente = $dienteActualMaxilarInferiorDerechoTemporales['tratamientoOdontogramaActual'];
            if ($diente == "") {
                $pdf->image(base_url() . $this->direccionImagenBlanco, $x11 + ($aumento11 * $i11), 226, 5, 5, 'PNG');
            } elseif ($diente != "") {
                $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarInferiorDerechoTemporales['tratamientoOdontogramaActual'] . '.png', $x11 + ($aumento11 * $i11), 226, 5, 5, 'PNG');
            }
            $i11++;
        }

        $x12 = 125;
        $aumento12 = 11;
        $i12 = 0;
        foreach ($dentaduraActualMaxilarInferiorIzquierdaTemporales  as $dienteActualMaxilarInferiorIzquierdaTemporales) {
            if ($dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] != 75) {
                $diente = $dienteActualMaxilarInferiorIzquierdaTemporales['tratamientoOdontogramaActual'];
                if ($diente == "") {
                    $pdf->image(base_url() . $this->direccionImagenBlanco, $x12 + ($aumento12 * $i12), 226, 5, 5, 'PNG');
                } elseif ($diente != "") {
                    $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarInferiorIzquierdaTemporales['tratamientoOdontogramaActual'] . '.png', $x12 + ($aumento12 * $i12), 226, 5, 5, 'PNG');
                }
                $i12++;
            } else if ($dienteActualMaxilarInferiorIzquierdaTemporales['numeroPiezaDental'] == 75) {
                $diente = $dienteActualMaxilarInferiorIzquierdaTemporales['tratamientoOdontogramaActual'];
                if ($diente == "") {
                    $pdf->image(base_url() . $this->direccionImagenBlanco, 169, 226, 5, 5, 'PNG');
                } elseif ($diente != "") {
                    $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarInferiorIzquierdaTemporales['tratamientoOdontogramaActual'] . '.png', 169, 226, 5, 5, 'PNG');
                }
            }
        }

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(16, 5, utf8_decode('Nro. Pieza'), 0, 0, 'L');
        foreach ($dentaduraActualMaxilarInferiorDerecho   as $dienteActualMaxilarInferiorDerecho) {
            $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorDerecho['numeroPiezaDental']), 0, 0, 'C');
        }

        $pdf->Cell(8, 5, utf8_decode(''), 0, 0, 'C');

        foreach ($dentaduraActualMaxilarInferiorIzquierda   as $ActualMaxilarInferiorIzquierda) {
            if ($ActualMaxilarInferiorIzquierda['numeroPiezaDental'] == 38) {
                $pdf->Cell(11, 5, utf8_decode($ActualMaxilarInferiorIzquierda['numeroPiezaDental']), 0, 1, 'C');
            } else {
                $pdf->Cell(11, 5, utf8_decode($ActualMaxilarInferiorIzquierda['numeroPiezaDental']), 0, 0, 'C');
            }
        }

        $pdf->Cell(16, 5, utf8_decode('Recesión'), 1, 0, 'L');
        foreach ($dentaduraActualMaxilarInferiorDerecho  as $dienteActualMaxilarInferiorDerecho) {
            $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorDerecho['recesionOdontogramaActual']), 1, 0, 'C');
        }

        $pdf->Cell(8, 5, utf8_decode(''), 0, 0, 'C');

        foreach ($dentaduraActualMaxilarInferiorIzquierda  as $dienteActualMaxilarInferiorIzquierda) {
            if ($dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] == 38) {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorIzquierda['recesionOdontogramaActual']), 1, 1, 'C');
            } else {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorIzquierda['recesionOdontogramaActual']), 1, 0, 'C');
            }
        }

        $pdf->Cell(16, 5, utf8_decode('Movilidad'), 1, 0, 'L');
        foreach ($dentaduraActualMaxilarInferiorDerecho  as $dienteActualMaxilarInferiorDerecho) {
            $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorDerecho['movilidadOdontogramaActual']), 1, 0, 'C');
        }

        $pdf->Cell(8, 5, utf8_decode(''), 0, 0, 'C');

        foreach ($dentaduraActualMaxilarInferiorIzquierda  as $dienteActualMaxilarInferiorIzquierda) {
            if ($dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] == 38) {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorIzquierda['movilidadOdontogramaActual']), 1, 1, 'C');
            } else {
                $pdf->Cell(11, 5, utf8_decode($dienteActualMaxilarInferiorIzquierda['movilidadOdontogramaActual']), 1, 0, 'C');
            }
        }


        $x13 = 26;
        $aumento13 = 11;
        $i13 = 0;

        foreach ($dentaduraActualMaxilarInferiorDerecho  as $dienteActualMaxilarInferiorDerecho) {
            $pdf->image(base_url() . '' . $this->mostrardiente($dienteActualMaxilarInferiorDerecho['dienteEstadoOdontogramaActual'], $dienteActualMaxilarInferiorDerecho['caraOdontogramaActual']) . '', $x13 + ($aumento13 * $i13), 249, 12, 12, 'PNG');
            $i13++;
        }

        $x14 = 122;
        $aumento14 = 11;
        $i14 = 0;
        foreach ($dentaduraActualMaxilarInferiorIzquierda as $dienteActualMaxilarInferiorIzquierda) {
            if ($dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] != 38) {
                $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'], $dienteActualMaxilarInferiorIzquierda['caraOdontogramaActual']) . '', $x14 + ($aumento14 * $i14), 249, 12, 12, 'PNG');
                $i14++;
            } elseif ($dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] == 38) {
                $pdf->image(base_url() . '' . $this->mostrarDiente($dienteActualMaxilarInferiorIzquierda['dienteEstadoOdontogramaActual'], $dienteActualMaxilarInferiorIzquierda['caraOdontogramaActual']) . '', 166, 249, 12, 12, 'PNG');
            }
        }


        $x15 = 29;
        $aumento15 = 11;
        $i15 = 0;
        foreach ($dentaduraActualMaxilarInferiorDerecho  as $dienteActualMaxilarInferiorDerecho) {
            $diente = $dienteActualMaxilarInferiorDerecho['tratamientoOdontogramaActual'];
            if ($diente == "") {
                $pdf->image(base_url() . $this->direccionImagenBlanco, $x15 + ($aumento15 * $i15), 261, 5, 5, 'PNG');
            } elseif ($diente != "") {
                $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarInferiorDerecho['tratamientoOdontogramaActual'] . '.png', $x15 + ($aumento15 * $i15), 261, 5, 5, 'PNG');
            }
            $i15++;
        }

        $x16 = 125;
        $aumento16 = 11;
        $i16 = 0;
        foreach ($dentaduraActualMaxilarInferiorIzquierda  as $dienteActualMaxilarInferiorIzquierda) {
            if ($dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] != 38) {
                $diente = $dienteActualMaxilarInferiorIzquierda['tratamientoOdontogramaActual'];
                if ($diente == "") {
                    $pdf->image(base_url() . $this->direccionImagenBlanco, $x16 + ($aumento16 * $i16), 261, 5, 5, 'PNG');
                } elseif ($diente != "") {
                    $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarInferiorIzquierda['tratamientoOdontogramaActual'] . '.png', $x16 + ($aumento16 * $i16), 261, 5, 5, 'PNG');
                }
                $i16++;
            } else if ($dienteActualMaxilarInferiorIzquierda['numeroPiezaDental'] == 38) {
                $diente = $dienteActualMaxilarInferiorIzquierda['tratamientoOdontogramaActual'];
                if ($diente == "") {
                    $pdf->image(base_url() . $this->direccionImagenBlanco, 169, 270, 5, 5, 'PNG');
                } elseif ($diente != "") {
                    $pdf->image(base_url() . $this->direccionImagenOdontograma . $dienteActualMaxilarInferiorIzquierda['tratamientoOdontogramaActual'] . '.png', 169, 270, 5, 5, 'PNG');
                }
            }
        }



        


        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(200, 5, '', 0, 1, 'L');
        $pdf->image(base_url().$this->direccionImagenOdontograma.'Simbologia.png', 10, 15, 200, 30, 'PNG');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(200, 5, utf8_decode('7. INDICADORES DE SALUD BUCAL'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(172, 5, utf8_decode('HIGIENE ORAL SIMPLIFICADA'), 1, 0, 'C');
        $pdf->Cell(28, 5, utf8_decode('CARIES'), 1, 1, 'C');
        $pdf->Cell(20, 5, utf8_decode('PIEZA'), 1, 0, 'C');
        $datospieza161755 = explode(",", $higieneOral161755SaludBucal);
        $datospieza112151 = explode(",", $higieneOral112151SaludBucal);
        $datospieza262765 = explode(",", $higieneOral262765SaludBucal);
        $datospieza363775 = explode(",", $higieneOral363775SaludBucal);
        $datospieza314171 = explode(",", $higieneOral314171SaludBucal);
        $datospieza464785 = explode(",", $higieneOral464785SaludBucal);

        if (count($datospieza161755) == 1 && count($datospieza112151) == 1 && count($datospieza262765) == 1 && count($datospieza363775) == 1 && count($datospieza314171) == 1 && count($datospieza464785) == 1) {
            $datospieza161755 = "    ";
            $datospieza112151 = "    ";
            $datospieza262765 = "    ";
            $datospieza363775 = "    ";
            $datospieza314171 = "    ";
            $datospieza464785 = "    ";
            $sumaPlaca = 0;
            $sumaCalculo = 0;
            $sumaGingivitis = 0;
        } else {
            $sumaPlaca = $datospieza161755[1] + $datospieza112151[1] + $datospieza262765[1] + $datospieza363775[1] + $datospieza314171[1] + $datospieza464785[1];
            $sumaCalculo = $datospieza161755[2] + $datospieza112151[2] + $datospieza262765[2] + $datospieza363775[2] + $datospieza314171[2] + $datospieza464785[2];
            $sumaGingivitis = $datospieza161755[3] + $datospieza112151[3] + $datospieza262765[3] + $datospieza363775[3] + $datospieza314171[3] + $datospieza464785[3];
        }

        $pdf->Cell(10, 5, utf8_decode($datospieza161755[0]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza112151[0]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza262765[0]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza363775[0]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza314171[0]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza464785[0]), 1, 0, 'C');
        $pdf->Cell(15, 5, utf8_decode('TOTALES'), 1, 0, 'C');
        $pdf->Cell(27, 5, utf8_decode('ENF.PERIODONTAL'), 1, 0, 'C');
        $pdf->Cell(25, 5, utf8_decode('MALOCLUSIÓN'), 1, 0, 'C');
        $pdf->Cell(25, 5, utf8_decode('FLUOROSIS'), 1, 0, 'C');
        $pdf->Cell(14, 5, utf8_decode('D'), 1, 0, 'C');
        $pdf->Cell(14, 5, utf8_decode('d'), 1, 1, 'C');
        $pdf->Cell(20, 5, utf8_decode('PLACA'), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza161755[1]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza112151[1]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza262765[1]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza363775[1]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza314171[1]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza464785[1]), 1, 0, 'C');
        $pdf->Cell(15, 5, utf8_decode(round((($sumaPlaca) / 6), 2)), 1, 0, 'C');
        $pdf->Cell(22, 5, utf8_decode('LEVE'), 1, 0, 'C');
        if ($enfermedadPeriodontalSaludBucal == "Leve") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(20, 5, utf8_decode('ANGLE I'), 1, 0, 'C');
        if ($maloclusionSaludBucal == "Angle I") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(20, 5, utf8_decode('LEVE'), 1, 0, 'C');
        if ($fluorosisSaludBucal == "Leve") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(7, 5, utf8_decode('C'), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode($odontogramaActualC), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode('c'), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode($odontogramaActualc), 1, 1, 'C');

        $pdf->Cell(20, 5, utf8_decode('CALCULO'), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza161755[2]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza112151[2]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza262765[2]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza363775[2]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza314171[2]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza464785[2]), 1, 0, 'C');
        $pdf->Cell(15, 5, utf8_decode(round((($sumaCalculo) / 6), 2)), 1, 0, 'C');
        $pdf->Cell(22, 5, utf8_decode('MODERADA'), 1, 0, 'C');
        if ($enfermedadPeriodontalSaludBucal == "Moderado") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(20, 5, utf8_decode('ANGLE II'), 1, 0, 'C');
        if ($maloclusionSaludBucal == "Angle II") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(20, 5, utf8_decode('MODERADA'), 1, 0, 'C');
        if ($fluorosisSaludBucal == "Moderado") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(7, 5, utf8_decode('P'), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode($odontogramaActualP), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode('e'), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode($odontogramaActuale), 1, 1, 'C');

        $pdf->Cell(20, 5, utf8_decode('GINGIVITIS'), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza161755[3]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza112151[3]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza262765[3]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza363775[3]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza314171[3]), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode($datospieza464785[3]), 1, 0, 'C');
        $pdf->Cell(15, 5, utf8_decode(round((($sumaGingivitis) / 6), 2)), 1, 0, 'C');
        $pdf->Cell(22, 5, utf8_decode('SEVERA'), 1, 0, 'C');
        if ($enfermedadPeriodontalSaludBucal == "Severa") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(20, 5, utf8_decode('ANGLE III'), 1, 0, 'C');
        if ($maloclusionSaludBucal == "Angle III") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(20, 5, utf8_decode('SEVERA'), 1, 0, 'C');
        if ($fluorosisSaludBucal == "Severa") {
            $pdf->Cell(5, 5, utf8_decode('X'), 1, 0, 'C');
        } else {
            $pdf->Cell(5, 5, utf8_decode(''), 1, 0, 'C');
        }
        $pdf->Cell(7, 5, utf8_decode('O'), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode($odontogramaActualO), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode('o'), 1, 0, 'C');
        $pdf->Cell(7, 5, utf8_decode($odontogramaActualo), 1, 1, 'C');



        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(200, 5, '', 0, 1, 'L');
        $pdf->Cell(200, 5, utf8_decode('8. EXAMENES'), 1, 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(50, 5, utf8_decode('Examen enviado'), 1, 0, 'C');
        $pdf->Cell(30, 5, utf8_decode('Fecha'), 1, 0, 'C');
        $pdf->Cell(120, 5, utf8_decode('Documentos'), 1, 1, 'C');
        $pdf->SetFont('Arial', '', 8);
        foreach ($examenes  as $examen) {
            $pdf->Cell(50, 5, utf8_decode($examen['examenEnviadoPlanDiagnostico']), 1, 0, 'l');
            $pdf->Cell(30, 5, utf8_decode($examen['fechaEditPlanDiagnostico']), 1, 0, 'C');
            $directory = getcwd() . "/images/examenes/" . $examen['idPlanDiagnostico'] . "/";
            if (file_exists($directory)) {
                // Returns array of files
                $files1 = scandir($directory);
                // Count number of files and store them to variable
                $num_files = count($files1) - 2;
                if ($num_files == 0) {
                    $pdf->Cell(120, 5, 'No hay archivos', 1, 1, 'C');
                } else {
                    if ($num_files < 4) {
                        for ($i = 1; $i < $num_files + 1; $i++) {
                            if ($num_files == 1) {
                                $cantidad = 120;
                            } else if ($num_files == 2) {
                                $cantidad = 60;
                            } else if ($num_files == 3) {
                                $cantidad = 40;
                            }
                            if ($i < $num_files && $num_files < 4) {
                                $pdf->Cell($cantidad, 5, 'Ver archivo_' . $i, 1, 0, 'C', false, base_url() . '/images/examenes/' . $examen['idPaciente'] . '/archivo_' . $i . '.pdf');
                            } else {
                                $pdf->Cell($cantidad, 5, 'Ver archivo_' . $i, 1, 1, 'C', false, base_url() . '/images/examenes/' . $examen['idPaciente'] . '/archivo_' . $i . '.pdf');
                            }
                        }
                    } else if ($num_files >= 4) {
                        for ($i = 1; $i < 4 + 1; $i++) {
                            if ($i < 4) {
                                $pdf->Cell(30, 5, 'Ver archivo_' . $i, 1, 0, 'C', false, base_url() . '/images/examenes/' . $examen['idPaciente'] . '/archivo_' . $i . '.pdf');
                            } else {
                                $pdf->Cell(30, 5, 'Ver archivo_' . $i, 1, 1, 'C', false, base_url() . '/images/examenes/' . $examen['idPaciente'] . '/archivo_' . $i . '.pdf');
                            }
                        }
                    }
                }
            } else {
                $pdf->Cell(120, 5, utf8_decode("No hay archivos"), 1, 1, 'C');
            }
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(200, 5, '', 0, 1, 'L');
        $pdf->Cell(200, 5, utf8_decode('9. DIAGNÓSTICOS'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);

        foreach ($diagnosticos  as $diagnostico) {
            $pdf->Cell(30, 5, utf8_decode('DIAGNOSTICO'), 1, 0, 'C');
            $pdf->Cell(70, 5, utf8_decode($diagnostico['descripcionCodigosCie']), 1, 0, 'l');
            $pdf->Cell(20, 5, utf8_decode('CIE'), 1, 0, 'C');
            $pdf->Cell(30, 5, utf8_decode($diagnostico['codigoCodigosCie']), 1, 0, 'l');
            $pdf->Cell(20, 5, utf8_decode('TIPO'), 1, 0, 'C');
            $pdf->Cell(30, 5, utf8_decode($diagnostico['tipoDiagnostico']), 1, 1, 'l');
            $pdf->MultiCell(200, 5, utf8_decode('OBSERVACIONES: ' . $diagnostico['descripcionDiagnostico']), 1, 'J', FALSE);
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(200, 5, '', 0, 1, 'L');
        $pdf->Cell(200, 5, utf8_decode('10. PLAN DE TRATAMIENTO'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        foreach ($tratamientos  as $tratamiento) {
            $pdf->Cell(25, 5, utf8_decode('DOCTOR'), 1, 0, 'C');
            $pdf->Cell(95, 5, utf8_decode($tratamiento['apellidoMedico'] . ' ' . $tratamiento['nombreMedico']), 1, 0, 'l');
            $pdf->Cell(40, 5, utf8_decode('FECHA DE REGISTRO'), 1, 0, 'C');
            $pdf->Cell(40, 5, utf8_decode($tratamiento['fechaAltaTratamiento']), 1, 1, 'l');
            $pdf->Cell(25, 5, utf8_decode('TRATAMIENTO'), 1, 0, 'C');
            $pdf->Cell(95, 5, utf8_decode($tratamiento['descripcionCodigosCie']), 1, 0, 'l');
            $pdf->Cell(40, 5, utf8_decode('ESTADO'), 1, 0, 'C');
            $pdf->Cell(40, 5, utf8_decode($tratamiento['procedimientoTratamiento']), 1, 1, 'l');
            $pdf->MultiCell(200, 5, utf8_decode('COMENTARIO: ' . $tratamiento['prescripcionTratamiento']), 1, 'J', FALSE);
        }


        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(200, 5, '', 0, 1, 'L');
        $pdf->Cell(200, 5, utf8_decode('11. NOTAS DE EVOLUCIÓN'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        foreach ($procedimientosRealizados  as $procedimientoRealizado) {
            $pdf->Cell(25, 5, utf8_decode('DOCTOR'), 1, 0, 'C');
            $pdf->Cell(95, 5, utf8_decode($procedimientoRealizado['apellidoMedico'] . ' ' . $procedimientoRealizado['nombreMedico']), 1, 0, 'l');
            $pdf->Cell(40, 5, utf8_decode('FECHA DE REGISTRO'), 1, 0, 'C');
            $pdf->Cell(40, 5, utf8_decode($procedimientoRealizado['fechaAltaProcedimientosRealizados']), 1, 1, 'l');
            $pdf->MultiCell(200, 5, utf8_decode('PROCEDIMIENTO REALIZADO: ' . $procedimientoRealizado['procedimientoProcedimientosRealizados']), 1, 'J', FALSE);
            $pdf->MultiCell(200, 5, utf8_decode('PRESCRIPCIÓN: ' . $procedimientoRealizado['prescripcionProcedimientosRealizados']), 1, 'J', FALSE);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');

        $pdf->Output("historialPdf.pdf", "I");
    }
}
