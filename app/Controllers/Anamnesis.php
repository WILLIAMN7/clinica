<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnamnesisModel;
use App\Models\SignosVitalesModel;
use App\Models\PiezaDentalModel;
use App\Models\OdontogramasModel;
use App\Models\OdontogramaActualModel;
use App\Models\AntecedentesPacienteModel;
use App\Models\ExamenSistemaEstomatognaticoModel;
use App\Models\DetalleRolesPermisosModel;
use App\Models\PacientesModel;
use App\Models\DiagnosticosModel;

use App\Libraries\permisosMenu;

class Anamnesis extends BaseController
{
    protected $anamnesis, $diagnosticos, $signosVitales, $examenSistemaEstomatognaticos, $antecedentesPacientes, $odontogramas,  $odontogramaActual;
    protected $redireccionMostrarAnamnesis;
    protected $reglas, $session;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->anamnesis = new AnamnesisModel();
        $this->signosVitales = new SignosVitalesModel();
        $this->odontogramas = new OdontogramasModel();
        $this->odontogramaActual = new OdontogramaActualModel();
        $this->piezaDental = new PiezaDentalModel();
        $this->antecedentesPacientes = new AntecedentesPacienteModel();
        $this->examenSistemaEstomatognaticos = new ExamenSistemaEstomatognaticoModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->pacientes = new PacientesModel();
        $this->diagnosticos = new DiagnosticosModel();
        $this->session = session();
        $this->redireccionMostrarAnamnesis = '/anamnesis/mostrarAnamnesis/';
        helper(['form']);
        $this->reglas = [
            'motivoConsulta' => [
                'rules' => 'required'
            ], 'problema' => [
                'rules' => 'required'
            ], 'grupoEtario' => [
                'rules' => 'required'
            ]
        ];
    }

    public function index($id, $activo = 1)
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

                $anamnesi = $this->anamnesis->obtener(1, $id);
                $contadorAnamnesis= $this->anamnesis->where('activoAnamnesis', '1')->where('idPaciente', $id)->countAllResults();
                $contadorDiagnosticos = $this->diagnosticos->where('activoDiagnostico', '1')->where('idPaciente', $id)->countAllResults();
                $piezaDental = $this->piezaDental->where('activoPiezaDental', $activo)->orderBy('numeroPiezaDental', 'DESC')->findAll();

                $odontogramafiltrado = $this->odontogramas->obtenerDientesActuales($id);

                $pacientes = $this->pacientes->where('idPaciente', $id)->first();

                $dentaduraActualMaxilarSuperiorDerecha = $this->odontogramaActual->obtenerDentaduraActualMaxilarSuperiorDerecha($id);
                $dentaduraActualMaxilarSuperiorIzquierda = $this->odontogramaActual->obtenerDentaduraActualMaxilarSuperiorIzquierda($id);
                $dentaduraActualMaxilarInferiorIzquierda = $this->odontogramaActual->obtenerDentaduraActualMaxilarInferiorIzquierda($id);
                $dentaduraActualMaxilarInferiorDerecho = $this->odontogramaActual->obtenerDentaduraActualMaxilarInferiorDerecho($id);
                $dentaduraActualMaxilarSuperiorDerechaTemporales = $this->odontogramaActual->obtenerDentaduraActualMaxilarSuperiorDerechaTemporales($id);
                $dentaduraActualMaxilarSuperiorIzquierdaTemporales = $this->odontogramaActual->obtenerDentaduraActualMaxilarSuperiorIzquierdaTemporales($id);
                $dentaduraActualMaxilarInferiorIzquierdaTemporales = $this->odontogramaActual->obtenerDentaduraActualMaxilarInferiorIzquierdaTemporales($id);
                $dentaduraActualMaxilarInferiorDerechoTemporales = $this->odontogramaActual->obtenerDentaduraActualMaxilarInferiorDerechoTemporales($id);

                $antecedentePaciente = $this->antecedentesPacientes->where('activoAntecedentePaciente', $activo)->where('idPaciente', $id)->orderBy('idAntecedentePaciente DESC')->first();
                $contadordeantecedentes = $this->antecedentesPacientes->where('activoAntecedentePaciente', $activo)->where('idPaciente', $id)->orderBy('idAntecedentePaciente DESC')->countAllResults();

                $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisEditar');

                $data = ['titulo' => 'Historia clínica odontológica', 'contadorDiagnosticos'=>$contadorDiagnosticos, 'contadorAnamnesis'=>$contadorAnamnesis,'datos' => $anamnesi, 'idPaciente' => $id, 'piezasDentales' => $piezaDental, 'antecedentesPacientes' => $antecedentePaciente, 'contadordeantecedentes' => $contadordeantecedentes, 'dentaduraActualMaxilarInferiorDerecho' => $dentaduraActualMaxilarInferiorDerecho, 'dentaduraActualMaxilarInferiorIzquierda' => $dentaduraActualMaxilarInferiorIzquierda, 'odontogramafiltrado' => $odontogramafiltrado, 'dentaduraActualMaxilarSuperiorDerecha' => $dentaduraActualMaxilarSuperiorDerecha, 'dentaduraActualMaxilarSuperiorIzquierda' => $dentaduraActualMaxilarSuperiorIzquierda, 'dentaduraActualMaxilarSuperiorDerechaTemporales' => $dentaduraActualMaxilarSuperiorDerechaTemporales, 'dentaduraActualMaxilarSuperiorIzquierdaTemporales' => $dentaduraActualMaxilarSuperiorIzquierdaTemporales, 'dentaduraActualMaxilarInferiorIzquierdaTemporales' => $dentaduraActualMaxilarInferiorIzquierdaTemporales, 'dentaduraActualMaxilarInferiorDerechoTemporales' => $dentaduraActualMaxilarInferiorDerechoTemporales, 'pacientes' => $pacientes, 'permisoEditar' => $permisoEditar];

                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('anamnesis/anamnesis', $data);
                echo view('footer');
            }
        }
    }

    public function mostrarAnamnesis($idPaciente)
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
                $anamnesi = $this->anamnesis->obtener(1, $idPaciente);
                $pacientes = $this->pacientes->where('idPaciente', $idPaciente)->first();
                $permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisInsertar');
                $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisEditar');
                $permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisEliminar');
                $data = ['titulo' => 'Anamnesis', 'datos' => $anamnesi, 'idPaciente' => $idPaciente, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar, 'permisoMostrar' => $permiso, 'pacientes' => $pacientes];
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('anamnesis/anamnesisGeneral', $data);
                echo view('footer');
            }
        }
    }

    public function eliminados($activo = 0)
    {
        $anamnesi = $this->anamnesis->where('activopaciente', $activo)->findAll();
        $data = ['titulo' => 'Pacientes eliminados', 'datos' => $anamnesi];

        echo view('header');
        echo view('anamnesis/eliminados', $data);
        echo view('footer');
    }

    public function nuevo($id)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $data = ['titulo' => 'Agregar anamnesis', 'idPaciente' => $id];
            echo view('header');
            echo view('anamnesis/nuevo', $data);
            echo view('footer');
        }
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if ($this->anamnesis->save([
                'motivoConsultaAnamnesis' => $this->request->getPost('motivoConsulta'),
                'descripcionProblemaAnamnesis' => $this->request->getPost('problema'),
                'grupoEtarioAnamnesis' => $this->request->getPost('grupoEtario'),
                'idPaciente' => $this->request->getPost('idPaciente'),
                'idMedico' => $this->request->getPost('idMedico')
            ])) {
                return redirect()->to(base_url() . $this->redireccionMostrarAnamnesis . $this->request->getPost('idPaciente'))->with('mensaje', 'Se ha ingresado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionMostrarAnamnesis . $this->request->getPost('idPaciente'))->with('mensajeError', 'No se ha ingresado correctamente.');
            }
        } else {
            $data = ['titulo' => 'Agregar anamnesis', 'idPaciente' => $this->request->getPost('idPaciente'), 'validation' => $this->validator];
            echo view('header');
            echo view('anamnesis/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $paciente = $this->anamnesis->where('idanamnesis', $id)->first();
            if ($valid != null) {
                $data = ['titulo' => 'Editar anamnesis', 'datos' => $paciente, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Editar anamnesis', 'datos' => $paciente];
            }

            echo view('header');
            echo view('anamnesis/editar', $data);
            echo view('footer');
        }
    }
    public function actualizar()
    {
        if ($this->request->getMethod()=="post" && $this->validate($this->reglas)) {
            if ($this->anamnesis->update(
                $this->request->getPost('id'),
                [
                    'motivoConsultaAnamnesis' => $this->request->getPost('motivoConsulta'),
                    'descripcionProblemaAnamnesis' => $this->request->getPost('problema'),
                    'grupoEtarioAnamnesis' => $this->request->getPost('grupoEtario')
                ]
            )) {
                return redirect()->to(base_url() . $this->redireccionMostrarAnamnesis . $this->request->getPost('idPaciente'))->with('mensaje', 'Se ha modificado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionMostrarAnamnesis . $this->request->getPost('idPaciente'))->with('mensajeError', 'No se ha modificado correctamente.');
            }
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }

    public function eliminar($idAnamnesis, $idPaciente)
    {
        if($this->anamnesis->update($idAnamnesis, ['activoAnamnesis' => 0])){
            return redirect()->to(base_url() . $this->redireccionMostrarAnamnesis . $idPaciente)->with('mensaje', 'Se ha eliminado correctamente.');
        }else{
            return redirect()->to(base_url() . $this->redireccionMostrarAnamnesis . $idPaciente)->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }
    

    public function buscarPorPiezaDental($codigo, $paciente)
    {

        $datos1 = $this->odontogramaActual->obtenerpiezadental($codigo, $paciente);

        $res['existe'] = false;
        $res['datos'] = '';
        $res['error'] = '';
        if ($datos1) {
            $res['datos1'] = $datos1;
            $res['existe'] = true;
        } else {
            $res['error'] = 'No existe el producto';
            $res['existe'] = false;
        }

        echo json_encode($res);
    }

    public function insertarPorPiezaDental($codigo, $paciente, $carasdedientes, $movilidad, $recesion, $tratamientos, $dienteEstado)
    {
        $this->odontogramas->save([
            'idPiezaDental' => $codigo,
            'idPaciente' => $paciente,
            'caraOdontograma' => $carasdedientes, 
            'tratamientoOdontograma' => $tratamientos,
            'dienteEstadoOdontograma' => $dienteEstado,
            'movilidadOdontograma' => $movilidad,
            'recesionOdontograma' => $recesion
        ]);

        $datos2 = $this->odontogramaActual->obtenerpiezadental($codigo, $paciente);

        if ($datos2) {
            $res['datos2'] = $datos2;
            $res['existe'] = true;
        } else {
            $res['error'] = 'No existe';
            $res['existe'] = false;
        }

        echo json_encode($res);
    }


    public function insertarAntecedentes()
    {
        if ($this->antecedentesPacientes->save([
            'idPaciente' => $this->request->getPost('idPaciente'),
            'alergiaAntibioticoAntecedentePaciente' => $this->request->getPost('alergiaAntivioticos'),
            'alergiaAnestesiaAntecedentePaciente' => $this->request->getPost('alergiaAnestesia'),
            'hemorragiasAntecedentePaciente' => $this->request->getPost('hemorragias'),
            'sidaAntecedentePaciente' => $this->request->getPost('sida'),
            'tuberculosisAntecedentePaciente' => $this->request->getPost('tuberculosis'),
            'asmaAntecedentePaciente' => $this->request->getPost('asma'),
            'diabetesAntecedentePaciente' => $this->request->getPost('diabetes'),
            'hipertensionAntecedentePaciente' => $this->request->getPost('hipertension'),
            'enfermedadCardiacaAntecedentePaciente' => $this->request->getPost('enfermedadCardiaca'),
            'otroAntecedentePaciente' => $this->request->getPost('otros'),
            'comentarioAntecedentePaciente' => $this->request->getPost('comentario'),
        ])) {
            return redirect()->to(base_url() . '/anamnesis/index/' . $this->request->getPost('idPaciente'))->with('mensaje', 'Se ha ingresado correctamente.');
        } else {
            return redirect()->to(base_url() . '/anamnesis/index/' . $this->request->getPost('idPaciente'))->with('mensajeError', 'No se ha ingresado correctamente.');
        }
    }
}
