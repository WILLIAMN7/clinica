<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SaludBucalModel;
use App\Libraries\permisosMenu;

class SaludBucal extends BaseController
{
    protected $saludBucal;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->saludBucal = new SaludBucalModel();
        $this->session = session();
        helper(['form']);
        $this->reglas =[
         'periodontal'=>[
            'rules'=>'required',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.'
            ]
            ]
        ];
    }
    
    public function index($idanamnesis, $idpaciente, $activo = 1){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $saludBucal = $this->saludBucal->where('activoSaludBucal', $activo)->where('idAnamnesis', $idanamnesis)->findAll();
        $data = ['titulo'=> 'Salud Bucal', 'datos'=> $saludBucal, 'idanamnesis'=> $idanamnesis, 'idpaciente'=> $idpaciente];
        
        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('saludBucal/saludBucal', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        /*$saludBucal = $this->saludBucal->where('activosignosvitales', $activo)->findAll();
        $data = ['titulo'=> 'Códigos CIE eliminados', 'datos'=> $saludBucal];

        echo view('header');
        echo view('codigosCie/eliminados', $data);
        echo view('footer');*/
    }

    public function nuevo($id, $idpaciente){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $data = ['titulo'=> 'Agregar examen de salud bucal', 'idanamnesis'=>$id, 'idpaciente'=>$idpaciente];
        echo view('header');
        echo view('saludBucal/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
            
        $this->saludBucal->save([
        'idAnamnesis'=>$this->request->getPost('id'),
        'enfermedadPeriodontalSaludBucal'=>$this->request->getPost('periodontal'),
        'maloclusionSaludBucal'=>$this->request->getPost('maloclucion'),
        'fluorosisSaludBucal'=>$this->request->getPost('fluorosis'),
        'higieneOral161755SaludBucal'=>$this->request->getPost('pieza161755').",".$this->request->getPost('placa161755').",".$this->request->getPost('calculo161755').",".$this->request->getPost('gingivitis161755'),
        'higieneOral112151SaludBucal'=>$this->request->getPost('pieza112151').",".$this->request->getPost('placa112151').",".$this->request->getPost('calculo112151').",".$this->request->getPost('gingivitis112151'),
        'higieneOral262765SaludBucal'=>$this->request->getPost('pieza262765').",".$this->request->getPost('placa262765').",".$this->request->getPost('calculo262765').",".$this->request->getPost('gingivitis262765'),
        'higieneOral363775SaludBucal'=>$this->request->getPost('pieza363775').",".$this->request->getPost('placa363775').",".$this->request->getPost('calculo363775').",".$this->request->getPost('gingivitis363775'),
        'higieneOral314171SaludBucal'=>$this->request->getPost('pieza314171').",".$this->request->getPost('placa314171').",".$this->request->getPost('calculo314171').",".$this->request->getPost('gingivitis314171'),
        'higieneOral464785SaludBucal'=>$this->request->getPost('pieza464785').",".$this->request->getPost('placa464785').",".$this->request->getPost('calculo464785').",".$this->request->getPost('gingivitis464785')
        ]);
        return redirect()->to(base_url().'/saludBucal/index/'.$this->request->getPost('id').'/'.$this->request->getPost('idpaciente'));
    }else{
        $data = ['titulo'=> 'Agregar examen de salud bucal', 'validation'=>$this->validator, 'idanamnesis'=>$this->request->getPost('id'), 'idpaciente'=>$this->request->getPost('idpaciente')];
        echo view('header');
        echo view('saludBucal/nuevo', $data);
        echo view('footer');
    }
    }

    public function editar($id, $idanamnesis, $idpaciente, $valid=null){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $saludBucal = $this->saludBucal->where('idSaludBucal', $id)->first();
        if($valid !=null){            
            $data = ['titulo'=> 'Editar exámen de salud bucal', 'datos'=>$saludBucal, 'validation'=>$valid];
        }else{
            $data = ['titulo'=> 'Editar exámen de salud bucal', 'datos'=>$saludBucal, 'idanamnesis'=>$idanamnesis, 'idpaciente'=>$idpaciente];
        }        
        echo view('header');
        echo view('saludBucal/editar', $data);
        echo view('footer');
    }
    }
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->saludBucal->update($this->request->getPost('id'), 
        [
        'idAnamnesis'=>$this->request->getPost('idanamnesis'),        
        'enfermedadPeriodontalSaludBucal'=>$this->request->getPost('periodontal'),
        'maloclusionSaludBucal'=>$this->request->getPost('maloclucion'),
        'fluorosisSaludBucal'=>$this->request->getPost('fluorosis'),
        'higieneOral161755SaludBucal'=>$this->request->getPost('pieza161755').",".$this->request->getPost('placa161755').",".$this->request->getPost('calculo161755').",".$this->request->getPost('gingivitis161755'),
        'higieneOral112151SaludBucal'=>$this->request->getPost('pieza112151').",".$this->request->getPost('placa112151').",".$this->request->getPost('calculo112151').",".$this->request->getPost('gingivitis112151'),
        'higieneOral262765SaludBucal'=>$this->request->getPost('pieza262765').",".$this->request->getPost('placa262765').",".$this->request->getPost('calculo262765').",".$this->request->getPost('gingivitis262765'),
        'higieneOral363775SaludBucal'=>$this->request->getPost('pieza363775').",".$this->request->getPost('placa363775').",".$this->request->getPost('calculo363775').",".$this->request->getPost('gingivitis363775'),
        'higieneOral314171SaludBucal'=>$this->request->getPost('pieza314171').",".$this->request->getPost('placa314171').",".$this->request->getPost('calculo314171').",".$this->request->getPost('gingivitis314171'),
        'higieneOral464785SaludBucal'=>$this->request->getPost('pieza464785').",".$this->request->getPost('placa464785').",".$this->request->getPost('calculo464785').",".$this->request->getPost('gingivitis464785')
        ]);
        return redirect()->to(base_url().'/saludBucal/index/'.$this->request->getPost('idanamnesis').'/'.$this->request->getPost('idpaciente'));
     }else{
        return $this->editar($this->request->getPost('id'), $this->request->getPost('idanamnesis'), $this->request->getPost('idpaciente'), $this->validator);
     }
    }

    public function eliminar($id, $idanamnesis, $idpaciente){
        $this->saludBucal->update($id, ['activoSaludBucal'=>0]);
        return redirect()->to(base_url().'/saludBucal/index/'.$idanamnesis.'/'.$idpaciente);
    }
  
}
