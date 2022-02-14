<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiagnosticosModel;
use App\Models\CodigosCieModel;
use App\Models\AnamnesisModel;
use App\Libraries\permisosMenu;

class Diagnosticos extends BaseController
{
    protected $diagnosticos, $anamnesis, $codigos_cie;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->anamnesis = new AnamnesisModel();
        $this->diagnosticos = new DiagnosticosModel();
        $this->codigos_cie = new CodigosCieModel();
        $this->session = session();

        helper(['form']);
        $this->reglas =[
         'diagnostico'=>[
            'rules'=>'required',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.'
             ]
            ],
        'tipoDiagnostico'=>[
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
        $diagnosticos = $this->diagnosticos->listarDiagnosticos($id);

        $data = ['titulo'=> 'Diagnósticos', 'idPaciente'=>$id, 'datos'=> $diagnosticos];
        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('diagnosticos/diagnosticos', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        $diagnosticos = $this->diagnosticos->where('activoDiagnostico', $activo)->findAll();
        $data = ['titulo'=> 'Diagnósticos eliminadas', 'datos'=> $diagnosticos];

        echo view('header');
        echo view('diagnosticos/eliminados', $data);
        echo view('footer');
    }

    public function nuevo($idPaciente){
        if(!isset($this->session->idUsuario)){            
			return redirect()->to(base_url());
		}else{
        $codigos_cie = $this->codigos_cie->where('activoCodigosCie', 1)->where('tipoCodigosCie','DIA')->findAll();
        $data = ['titulo'=> 'Agregar diagnósticos', 'codigos_cie'=>$codigos_cie, 'idPaciente'=>$idPaciente];
        echo view('header');
        echo view('diagnosticos/nuevo', $data);
        echo view('footer');
        }
    }

    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->diagnosticos->save(['idPaciente'=>$this->request->getPost('idPaciente'),
        'idCodigosCie'=>$this->request->getPost('diagnostico'),
        'descripcionDiagnostico'=>$this->request->getPost('descripcionDiagnostico'),
        'tipoDiagnostico'=>$this->request->getPost('tipoDiagnostico')
        ]);
        return redirect()->to(base_url().'/diagnosticos/index/'.$this->request->getPost('idPaciente'));
        }else{        
        $codigos_cie = $this->codigos_cie->where('activoCodigosCie', 1)->where('tipoCodigosCie','DIA')->findAll();
        $data = ['titulo'=> 'Agregar diagnósticos', 'validation'=>$this->validator, 'idPaciente'=>$this->request->getPost('idPaciente'), 'codigos_cie'=>$codigos_cie];
            echo view('header');
            echo view('diagnosticos/nuevo', $data);
            echo view('footer');
        }
    }
    
    public function editar($id, $idPaciente, $valid=null){
    if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $codigos_cie = $this->codigos_cie->where('activoCodigosCie', 1)->where('tipoCodigosCie','DIA')->findAll();
        $diagnosticos = $this->diagnosticos->where('idDiagnostico', $id)->first();
        if($valid !=null){
            $data =['titulo'=>'Editar diagnósticos', 'diagnosticos'=>$diagnosticos, 'validation'=>$valid, 'idPaciente'=>$idPaciente, 'codigos_cie'=>$codigos_cie];
        }else{
            $data =['titulo'=>'Editar diagnósticos', 'diagnosticos'=>$diagnosticos, 'idPaciente'=>$idPaciente, 'codigos_cie'=>$codigos_cie];
        }
        echo view('header');
        echo view('diagnosticos/editar', $data);
        echo view('footer');
    }
    }

    public function actualizar(){        
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
            $this->diagnosticos->update($this->request->getPost('id'), 
            ['idPaciente'=>$this->request->getPost('idPaciente'),
            'idCodigosCie'=>$this->request->getPost('diagnostico'),
            'descripcionDiagnostico'=>$this->request->getPost('descripcionDiagnostico'),
            'tipoDiagnostico'=>$this->request->getPost('tipoDiagnostico')
            ]);
            return redirect()->to(base_url().'/diagnosticos/index/'.$this->request->getPost('idPaciente'));
            }else{
            return $this->editar($this->request->getPost('id'), $this->request->getPost('idPaciente'), $this->validator);
            }
    }

    public function eliminar($id, $idPaciente){
        $this->diagnosticos->update($id, ['activoDiagnostico'=>0]);
        return redirect()->to(base_url().'/diagnosticos/index/'.$idPaciente);
    }

    public function reingresar($id){
        $this->diagnosticos->update($id, ['activoDiagnostico'=>1]);
        return redirect()->to(base_url().'/diagnosticos');
    }
  
}
?>