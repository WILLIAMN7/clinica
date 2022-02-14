<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExamenSistemaEstomatognaticoModel;
use App\Libraries\permisosMenu;

class ExamenSistemaEstomatognatico extends BaseController
{
    protected $examenSistemaEstomatognatico;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->examenSistemaEstomatognatico = new ExamenSistemaEstomatognaticoModel();
        $this->session = session();
        helper(['form']);
        $this->reglas =[
         'comentario'=>[
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
        $examenSistemaEstomatognatico = $this->examenSistemaEstomatognatico->where('activoExamenSistemaEstomatognatico', $activo)->where('idanamnesis', $idanamnesis)->findAll();
        $data = ['titulo'=> 'Examen Sistema Estomatognatico', 'datos'=> $examenSistemaEstomatognatico, 'idanamnesis'=> $idanamnesis, 'idpaciente'=> $idpaciente];
        
        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('examenSistemaEstomatognatico/examenSistemaEstomatognatico', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        /*$examenSistemaEstomatognatico = $this->examenSistemaEstomatognatico->where('activosignosvitales', $activo)->findAll();
        $data = ['titulo'=> 'Códigos CIE eliminados', 'datos'=> $examenSistemaEstomatognatico];

        echo view('header');
        echo view('codigosCie/eliminados', $data);
        echo view('footer');*/
    }

    public function nuevo($id, $idpaciente){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $data = ['titulo'=> 'Agregar examen sistema estomatognatico', 'idanamnesis'=>$id, 'idpaciente'=>$idpaciente];
        echo view('header');
        echo view('examenSistemaEstomatognatico/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->examenSistemaEstomatognatico->save([
        'idAnamnesis'=>$this->request->getPost('id'),
        'labiosExamenSistemaEstomatognatico'=>$this->request->getPost('labios'),
        'mejillasExamenSistemaEstomatognatico'=>$this->request->getPost('mejillas'),
        'maxilarSuperiorExamenSistemaEstomatognatico'=>$this->request->getPost('maxilarSuperior'),
        'maxilarInferiorExamenSistemaEstomatognatico'=>$this->request->getPost('maxilarInferior'),
        'lenguaExamenSistemaEstomatognatico'=>$this->request->getPost('lengua'),
        'paladarExamenSistemaEstomatognatico'=>$this->request->getPost('paladar'),
        'pisoDeBocaExamenSistemaEstomatognatico'=>$this->request->getPost('pisoBoca'),
        'carrillosExamenSistemaEstomatognatico'=>$this->request->getPost('carrillos'),
        'glandulasSalivalesExamenSistemaEstomatognatico'=>$this->request->getPost('glandulasSalivales'),
        'faringeExamenSistemaEstomatognatico'=>$this->request->getPost('faringe'),
        'atmExamenSistemaEstomatognatico'=>$this->request->getPost('atm'),
        'gangliosExamenSistemaEstomatognatico'=>$this->request->getPost('ganglios'),
        'comentarioExamenSistemaEstomatognatico'=>$this->request->getPost('comentario'),
        ]);
        return redirect()->to(base_url().'/examenSistemaEstomatognatico/index/'.$this->request->getPost('id').'/'.$this->request->getPost('idpaciente'));
    }else{
        $data = ['titulo'=> 'Agregar examen sistema estomatognatico', 'validation'=>$this->validator, 'idanamnesis'=>$this->request->getPost('id'), 'idpaciente'=>$this->request->getPost('idpaciente')];
        echo view('header');
        echo view('examenSistemaEstomatognatico/nuevo', $data);
        echo view('footer');
    }
    }

    public function editar($id, $idanamnesis, $idpaciente, $valid=null){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $examenSistemaEstomatognatico = $this->examenSistemaEstomatognatico->where('idExamenSistemaEstomatognatico', $id)->first();
        if($valid !=null){            
            $data = ['titulo'=> 'Editar examen sistema estomatognatico', 'datos'=>$examenSistemaEstomatognatico, 'validation'=>$valid];
        }else{
            $data = ['titulo'=> 'Editar examen sistema estomatognatico', 'datos'=>$examenSistemaEstomatognatico, 'idanamnesis'=>$idanamnesis, 'idpaciente'=>$idpaciente];
        }        
        echo view('header');
        echo view('examenSistemaEstomatognatico/editar', $data);
        echo view('footer');
    }
    }
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->examenSistemaEstomatognatico->update($this->request->getPost('id'), 
        [
            'idanamnesis'=>$this->request->getPost('idanamnesis'),
            'labiosExamenSistemaEstomatognatico'=>$this->request->getPost('labios'),
            'mejillasExamenSistemaEstomatognatico'=>$this->request->getPost('mejillas'),
            'maxilarSuperiorExamenSistemaEstomatognatico'=>$this->request->getPost('maxilarSuperior'),
            'maxilarInferiorExamenSistemaEstomatognatico'=>$this->request->getPost('maxilarInferior'),
            'lenguaExamenSistemaEstomatognatico'=>$this->request->getPost('lengua'),
            'paladarExamenSistemaEstomatognatico'=>$this->request->getPost('paladar'),
            'pisoDeBocaExamenSistemaEstomatognatico'=>$this->request->getPost('pisoBoca'),
            'carrillosExamenSistemaEstomatognatico'=>$this->request->getPost('carrillos'),
            'glandulasSalivalesExamenSistemaEstomatognatico'=>$this->request->getPost('glandulasSalivales'),
            'faringeExamenSistemaEstomatognatico'=>$this->request->getPost('faringe'),
            'atmExamenSistemaEstomatognatico'=>$this->request->getPost('atm'),
            'gangliosExamenSistemaEstomatognatico'=>$this->request->getPost('ganglios'),
            'comentarioExamenSistemaEstomatognatico'=>$this->request->getPost('comentario'),
        ]);
        return redirect()->to(base_url().'/examenSistemaEstomatognatico/index/'.$this->request->getPost('idanamnesis').'/'.$this->request->getPost('idpaciente'));
     }else{
        return $this->editar($this->request->getPost('id'), $this->request->getPost('idanamnesis'), $this->request->getPost('idpaciente'), $this->validator);
     }
    }

    public function eliminar($id, $idanamnesis, $idpaciente){
        $this->examenSistemaEstomatognatico->update($id, ['activoExamenSistemaEstomatognatico'=>0]);
        return redirect()->to(base_url().'/examenSistemaEstomatognatico/index/'.$idanamnesis.'/'.$idpaciente);
    }
  
}
?>