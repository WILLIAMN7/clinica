<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PlanDiagnosticosModel;
use App\Libraries\permisosMenu;

class Examenes extends BaseController
{
    protected $examenes;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->examenes = new PlanDiagnosticosModel();
        $this->session = session();
        helper(['form']);
        $this->reglas =[
         'examenes'=>[
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
        $examenes = $this->examenes->where('activoPlanDiagnostico', $activo)->where('idPaciente', $id)->findAll();

        $data = ['titulo'=> 'Examenes realizados', 'idPaciente'=>$id, 'datos'=> $examenes];

        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('examenes/examenes', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        /*$codigos_cie = $this->codigos_cie->where('activoCodigosCie', $activo)->findAll();
        $data = ['titulo'=> 'Códigos CIE eliminados', 'datos'=> $codigos_cie];

        echo view('header');
        echo view('codigosCie/eliminados', $data);
        echo view('footer');*/
    }

    public function nuevo($idPaciente){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $data = ['titulo'=> 'Agregar examenes realizados', 'idPaciente'=>$idPaciente];
        echo view('header');
        echo view('examenes/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->examenes->save([
        'idPaciente'=>$this->request->getPost('idPaciente'),
        'examenEnviadoPlanDiagnostico'=>$this->request->getPost('examenes'),
        'comentarioPlanDiagnostico'=>$this->request->getPost('comentario'),
        ]);
        $id = $this->examenes->insertID();


        if ($imagefile = $this->request->getFiles()) {
            $contador=1;
            foreach($imagefile['imgExamenes'] as $img) {
                $ruta="images/examenes/".$id;
                if(!file_exists($ruta)){
                    mkdir($ruta, 0777, true);
                }
                if ($img->isValid() && ! $img->hasMoved()) {
                    //$newName = $img->getRandomName();
                    $img->move('./images/examenes/',$id.'/archivo_'.$contador.'.pdf');
                    $contador ++;
                }
            }
        }

/*
        $validacion = $this->validate([
            'imgExamenes'=>[
                'uploaded[imgExamenes]',
                'mime_in[imgExamenes,image/jpg,image/jpeg]',
                'max_size[imgExamenes, 4096]'
            ]
            ]);
        if($validacion){
            $ruta_logo="images/examenes/" .$id.".jpg";
            if(file_exists($ruta_logo)){
                unlink($ruta_logo);
            }

            $img = $this->request->getFile('imgExamenes');
            $img->move('./images/examenes', $id.'.jpg');            
        }else{
            echo 'error';  
        }
        */
        return redirect()->to(base_url().'/Examenes/index/'.$this->request->getPost('idPaciente'));
    }else{
        $data = ['titulo'=> 'Agregar examenes', 'validation'=>$this->validator];
        echo view('header');
        echo view('Examenes/nuevo', $data);
        echo view('footer');
    }
    }

    public function editar($id, $idPaciente, $valid=null){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $examenes = $this->examenes->where('idPlanDiagnostico', $id)->first();
        if($valid !=null){
            $data = ['titulo'=> 'Editar examenes', 'idPaciente'=>$idPaciente, 'datos'=>$examenes, 'validation'=>$valid];
        }else{
            $data = ['titulo'=> 'Editar examenes', 'idPaciente'=>$idPaciente, 'datos'=>$examenes];
        }
        echo view('header');
        echo view('Examenes/editar', $data);
        echo view('footer');
    }
    }
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->examenes->update($this->request->getPost('id'), 
        [
            'idPaciente'=>$this->request->getPost('idPaciente'),
            'examenEnviadoPlanDiagnostico'=>$this->request->getPost('examenes'),
            'comentarioPlanDiagnostico'=>$this->request->getPost('comentario'),
        ]);
        $id=$this->request->getPost('id');

        if ($imagefile = $this->request->getFiles()) {
            $contador=1;
            /*Se elimina los ficheros antiguos para colocar los nuevos*/ 
            $files = glob('./images/examenes/'.$id.'/*'); //obtenemos todos los nombres de los ficheros
            foreach($files as $file){
            if(is_file($file))
            unlink($file); //elimino el fichero
            }
            
            foreach($imagefile['imgExamenes'] as $img) {                
                $ruta="images/examenes/".$id;
                if(!file_exists($ruta)){
                    mkdir($ruta, 0777, true);
                }
                if ($img->isValid() && ! $img->hasMoved()) {
                    //$newName = $img->getRandomName();
                    $img->move('./images/examenes/',$id.'/archivo_'.$contador.'.pdf');
                    $contador ++;
                }
            }
        }

        return redirect()->to(base_url().'/Examenes/index/'.$this->request->getPost('idPaciente'));
     }else{
        return $this->editar($this->request->getPost('id'), $this->request->getPost('idPaciente'), $this->validator);
     }
    }

    public function eliminar($id, $idPaciente){
        $this->examenes->update($id, ['activoPlanDiagnostico'=>0]);        
        return redirect()->to(base_url().'/Examenes/index/'.$idPaciente);
    }
    public function reingresar($id){
        $this->codigos_cie->update($id, ['activoCodigosCie'=>1]);
        return redirect()->to(base_url().'/CodigosCie');
    }


    
}
