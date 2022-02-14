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
use App\Libraries\permisosMenu;

class Anamnesis extends BaseController
{
    protected $anamnesis, $signosVitales, $examenSistemaEstomatognaticos, $antecedentesPacientes, $odontogramas,  $odontogramaActual;
    protected $dentaduraActualMaxilarSuperiorDerecha;
    protected $reglas, $session;

    public function __construct(){
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
        $this->session = session();
        helper(['form']);
        $this->reglas =[
         'motivoConsulta'=>[
            'rules'=>'required',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.'
            ]
            ]
        ];
    }
    
    public function index($id, $activo = 1){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
            $permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'AnamnesisMostrar');
			if (!$permiso) {
				echo view('header');
				$this->permisosMenu->habilitarpermisos();
				$this->permisosMenu->mensajeNoPermisos();
				echo view('footer');
			} else {

        $anamnesis = $this->anamnesis->obtener(1, $id);
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
        
        $antecedentesPacientes = $this->antecedentesPacientes->where('activoAntecedentePaciente', $activo)->where('idPaciente', $id)->orderBy('idAntecedentePaciente DESC')->first();
        $contadordeantecedentes = $this->antecedentesPacientes->where('activoAntecedentePaciente', $activo)->where('idPaciente', $id)->orderBy('idAntecedentePaciente DESC')->countAllResults();

        $data = ['titulo'=> 'Historia clínica odontológica', 'datos'=> $anamnesis, 'idPaciente'=>$id, 'piezasDentales'=>$piezaDental, 'antecedentesPacientes'=>$antecedentesPacientes, 'contadordeantecedentes'=>$contadordeantecedentes, 'dentaduraActualMaxilarInferiorDerecho'=>$dentaduraActualMaxilarInferiorDerecho, 'dentaduraActualMaxilarInferiorIzquierda'=>$dentaduraActualMaxilarInferiorIzquierda, 'odontogramafiltrado'=>$odontogramafiltrado, 'dentaduraActualMaxilarSuperiorDerecha'=>$dentaduraActualMaxilarSuperiorDerecha, 'dentaduraActualMaxilarSuperiorIzquierda'=>$dentaduraActualMaxilarSuperiorIzquierda, 'dentaduraActualMaxilarSuperiorDerechaTemporales' => $dentaduraActualMaxilarSuperiorDerechaTemporales, 'dentaduraActualMaxilarSuperiorIzquierdaTemporales'=>$dentaduraActualMaxilarSuperiorIzquierdaTemporales, 'dentaduraActualMaxilarInferiorIzquierdaTemporales'=>$dentaduraActualMaxilarInferiorIzquierdaTemporales, 'dentaduraActualMaxilarInferiorDerechoTemporales'=>$dentaduraActualMaxilarInferiorDerechoTemporales, 'pacientes'=>$pacientes];

        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('anamnesis/anamnesis', $data);
        echo view('footer');
        }
    }
    }

    public function eliminados($activo = 0){
        $anamnesis = $this->anamnesis->where('activopaciente', $activo)->findAll();
        $data = ['titulo'=> 'Pacientes eliminados', 'datos'=> $anamnesis];

        echo view('header');
        echo view('anamnesis/eliminados', $data);
        echo view('footer');
    }

    public function nuevo($id){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $data = ['titulo'=> 'Agregar anamnesis', 'idPaciente'=>$id];
        echo view('header');
        echo view('anamnesis/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->anamnesis->save(['motivoConsultaAnamnesis'=>$this->request->getPost('motivoConsulta'),
        'descripcionProblemaAnamnesis'=>$this->request->getPost('problema'),
        'grupoEtarioAnamnesis'=>$this->request->getPost('grupoEtario'), 
        'idPaciente'=>$this->request->getPost('idPaciente'),
        'idMedico'=>$this->request->getPost('idMedico')
        ]);
        return redirect()->to(base_url().'/anamnesis/index/'.$this->request->getPost('idPaciente'));
    }else{
        $data = ['titulo'=> 'Agregar anamnesis', 'idPaciente'=>$this->request->getPost('idPaciente'), 'validation'=>$this->validator];
        echo view('header');
        echo view('anamnesis/nuevo', $data);
        echo view('footer');
    }
    }

    public function editar($id, $valid=null){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $paciente = $this->anamnesis->where('idanamnesis', $id)->first();
        if($valid !=null){            
            $data = ['titulo'=> 'Editar anamnesis', 'datos'=>$paciente, 'validation'=>$valid];
        }else{
            $data = ['titulo'=> 'Editar anamnesis', 'datos'=>$paciente];
        }
        
        echo view('header');
        echo view('anamnesis/editar', $data);
        echo view('footer');
    }
    }
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->anamnesis->update($this->request->getPost('id'), 
        ['motivoConsultaAnamnesis'=>$this->request->getPost('motivoConsulta'),
        'descripcionProblemaAnamnesis'=>$this->request->getPost('problema'),
        'grupoEtarioAnamnesis'=>$this->request->getPost('grupoEtario')        
        ]);
        //return redirect()->to(base_url().'/anamnesis');
        return redirect()->to(base_url().'/anamnesis/index/'.$this->request->getPost('idPaciente'));
     }else{
        return $this->editar($this->request->getPost('id'), $this->validator);
     }
    }

    public function eliminar($id){
        $this->anamnesis->update($id, ['activoPaciente'=>0]);
        return redirect()->to(base_url().'/anamnesis');
    }
    public function reingresar($id){
        $this->anamnesis->update($id, ['activoPaciente'=>1]);
        return redirect()->to(base_url().'/anamnesis');
    }

    public function buscarPorPiezaDental($codigo, $paciente){
        
        $datos1 = $this->odontogramaActual->obtenerpiezadental($codigo, $paciente);

        $res['existe'] = false;
        $res['datos'] = '';
        $res['error'] = '';
        if($datos1){
            $res['datos1'] = $datos1;
            $res['existe'] = true;
        }else{
            $res['error'] = 'No existe el producto';
            $res['existe'] = false;
        }

        echo json_encode($res);
    }
    
    public function insertarPorPiezaDental($codigo, $paciente, $carasdedientes, $movilidad, $recesion, $tratamientos, $dienteEstado){
        //if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
            $this->odontogramas->save(['idPiezaDental'=>$codigo,
            'idPaciente'=>$paciente,
            'caraOdontograma'=>$carasdedientes,//"d"+$derecha+"d"+$arriba+"d"+$abajo+"e"+$centro+"i"+$izquierda, //$derecha+","+$arriba+","+$abajo+","+$centro+","+$izquierda, 
            'tratamientoOdontograma'=>$tratamientos,
            'dienteEstadoOdontograma'=>$dienteEstado,
            'movilidadOdontograma'=>$movilidad,
            'recesionOdontograma'=>$recesion
            ]);
            
            $datos2 = $this->odontogramaActual->obtenerpiezadental($codigo, $paciente);

        if($datos2){
            $res['datos2'] = $datos2;
            $res['existe'] = true;
        }else{
            $res['error'] = 'No existe';
            $res['existe'] = false;
        }

        echo json_encode($res);
    }
  
    
    public function insertarAntecedentes(){
        //if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->antecedentesPacientes->save(['idPaciente'=>$this->request->getPost('idPaciente'),
        'alergiaAntibioticoAntecedentePaciente'=>$this->request->getPost('alergiaAntivioticos'),
        'alergiaAnestesiaAntecedentePaciente'=>$this->request->getPost('alergiaAnestesia'),
        'hemorragiasAntecedentePaciente'=>$this->request->getPost('hemorragias'), 
        'sidaAntecedentePaciente'=>$this->request->getPost('sida'),
        'tuberculosisAntecedentePaciente'=>$this->request->getPost('tuberculosis'),
        'asmaAntecedentePaciente'=>$this->request->getPost('asma'),
        'diabetesAntecedentePaciente'=>$this->request->getPost('diabetes'),
        'hipertensionAntecedentePaciente'=>$this->request->getPost('hipertension'),
        'enfermedadCardiacaAntecedentePaciente'=>$this->request->getPost('enfermedadCardiaca'),
        'otroAntecedentePaciente'=>$this->request->getPost('otros'),
        'comentarioAntecedentePaciente'=>$this->request->getPost('comentario'),
        ]);
        return redirect()->to(base_url().'/anamnesis/index/'.$this->request->getPost('idPaciente'));
    /*}else{
        $data = ['titulo'=> 'Historia clínica odontológica', 'idPaciente'=>$this->request->getPost('idPaciente'), 'validation'=>$this->validator];
        echo view('header');
        echo view('anamnesis/index', $data);
        echo view('footer');
    }*/
    }
    
}
?>