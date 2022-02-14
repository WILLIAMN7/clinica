<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SignosVitalesModel;
use App\Libraries\permisosMenu;

class SignosVitales extends BaseController
{
    protected $signosVitales;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->signosVitales = new SignosVitalesModel();
        $this->session = session();
        helper(['form']);
        $this->reglas =[
         'presionArterial'=>[
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
        $signosVitales = $this->signosVitales->where('activoSignosVitales', $activo)->where('idanamnesis', $idanamnesis)->findAll();        
        $data = ['titulo'=> 'Signos Vitales', 'datos'=> $signosVitales, 'idanamnesis'=> $idanamnesis, 'idpaciente'=> $idpaciente];
        
        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('signosVitales/signosVitales', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        $signosVitales = $this->signosVitales->where('activoSignosVitales', $activo)->findAll();
        $data = ['titulo'=> 'Códigos CIE eliminados', 'datos'=> $signosVitales];

        echo view('header');
        echo view('codigosCie/eliminados', $data);
        echo view('footer');
    }

    public function nuevo($id, $idpaciente){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $data = ['titulo'=> 'Agregar signos vitales', 'idanamnesis'=>$id, 'idpaciente'=>$idpaciente];
        echo view('header');
        echo view('SignosVitales/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->signosVitales->save([
        'idAnamnesis'=>$this->request->getPost('id'),
        'presionArterialSignosVitales'=>$this->request->getPost('presionArterial'),
        'frecuenciaCardiacaSignosVitales'=>$this->request->getPost('frecuenciaCardiaca'),
        'frecuenciaRespiratoriaSignosVitales'=>$this->request->getPost('frecuenciaRespiratoria'),
        'temperaturaSignosVitales'=>$this->request->getPost('temperatura'),
        'pesoSignosVitales'=>$this->request->getPost('peso'),
        'tallaSignosVitales'=>$this->request->getPost('talla'),
        ]);
        return redirect()->to(base_url().'/SignosVitales/index/'.$this->request->getPost('id').'/'.$this->request->getPost('idpaciente'));
    }else{
        $data = ['titulo'=> 'Agregar signos vitales', 'validation'=>$this->validator, 'idanamnesis'=>$this->request->getPost('id'), 'idpaciente'=>$this->request->getPost('idpaciente')];
        echo view('header');
        echo view('SignosVitales/nuevo', $data);
        echo view('footer');
    }
    }

    public function editar($id, $idanamnesis, $idpaciente, $valid=null){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $signosVitales = $this->signosVitales->where('idSignosVitales', $id)->first();
        if($valid !=null){            
            $data = ['titulo'=> 'Editar signos vitales', 'datos'=>$signosVitales, 'validation'=>$valid];
        }else{
            $data = ['titulo'=> 'Editar signos vitales', 'datos'=>$signosVitales, 'idanamnesis'=>$idanamnesis, 'idpaciente'=>$idpaciente];
        }        
        echo view('header');
        echo view('SignosVitales/editar', $data);
        echo view('footer');
    }
    }
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->signosVitales->update($this->request->getPost('id'), 
        [
        'idAnamnesis'=>$this->request->getPost('idanamnesis'),
        'presionArterialSignosVitales'=>$this->request->getPost('presionArterial'),
        'frecuenciaCardiacaSignosVitales'=>$this->request->getPost('frecuenciaCardiaca'),
        'frecuenciaRespiratoriaSignosVitales'=>$this->request->getPost('frecuenciaRespiratoria'),
        'temperaturaSignosVitales'=>$this->request->getPost('temperatura'),
        'pesoSignosVitales'=>$this->request->getPost('peso'),
        'tallaSignosVitales'=>$this->request->getPost('talla'),
        ]);
        return redirect()->to(base_url().'/SignosVitales/index/'.$this->request->getPost('idanamnesis').'/'.$this->request->getPost('idpaciente'));
     }else{
        return $this->editar($this->request->getPost('id'), $this->request->getPost('idanamnesis'), $this->request->getPost('idpaciente'), $this->validator);
     }
    }

    public function eliminar($id, $idanamnesis, $idpaciente){
        $this->signosVitales->update($id, ['activoSignosVitales'=>0]);
        return redirect()->to(base_url().'/SignosVitales/index/'.$idanamnesis.'/'.$idpaciente);        
    }
  
}
?>