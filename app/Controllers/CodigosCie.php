<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CodigosCieModel;
use App\Libraries\permisosMenu;

class CodigosCie extends BaseController
{
    protected $codigosCie;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->codigosCie = new CodigosCieModel();
        $this->session = session();
        helper(['form']);
        $this->reglas =[
         'descripcion'=>[
            'rules'=>'required',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.'
            ]
            ]
        ];
    }
    
    public function index($activo = 1, $mensajeOk=""){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $codigosCie = $this->codigosCie->where('activoCodigosCie', $activo)->findAll();
        $data = ['titulo'=> 'Código CIE', 'datos'=> $codigosCie, 'mensajeOK'=>$mensajeOk];

        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('codigosCie/codigosCie', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        $codigosCie = $this->codigosCie->where('activoCodigosCie', $activo)->findAll();
        $data = ['titulo'=> 'Códigos CIE eliminados', 'datos'=> $codigosCie];

        echo view('header');
        echo view('codigosCie/eliminados', $data);
        echo view('footer');
    }

    public function nuevo(){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $data = ['titulo'=> 'Agregar códigos CIE'];
        echo view('header');
        echo view('codigosCie/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        if($this->codigosCie->save([
        'codigoCodigosCie'=>$this->request->getPost('codigo_cie'),
        'descripcionCodigosCie'=>$this->request->getPost('descripcion'),
        'tipoCodigosCie'=>$this->request->getPost('tipo')
        ])){
            return redirect()->to(base_url().'/CodigosCie')->with('mensaje', 'Se ha ingresado correctamente.');
        }else{
            return redirect()->to(base_url().'/CodigosCie')->with('mensajeError', 'No se ha ingresado correctamente.');
        }
    }else{
        $data = ['titulo'=> 'Agregar códigos CIE', 'validation'=>$this->validator];
        echo view('header');
        echo view('codigosCie/nuevo', $data);
        echo view('footer');
    }
    }

    public function editar($id, $valid=null){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $medico = $this->codigosCie->where('idCodigosCie', $id)->first();
        if($valid !=null){            
            $data = ['titulo'=> 'Editar códigos CIE', 'datos'=>$medico, 'validation'=>$valid];
        }else{
            $data = ['titulo'=> 'Editar códigos CIE', 'datos'=>$medico];
        }
        echo view('header');
        echo view('codigosCie/editar', $data);
        echo view('footer');
    }
    }
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        if($this->codigosCie->update($this->request->getPost('id'), 
        [
        'codigoCodigosCie'=>$this->request->getPost('codigo_cie'),
        'descripcionCodigosCie'=>$this->request->getPost('descripcion'),
        'tipoCodigosCie'=>$this->request->getPost('tipo')
        ])){
            return redirect()->to(base_url().'/CodigosCie')->with('mensaje', 'Se ha modificado correctamente.');
        }else{
            return redirect()->to(base_url().'/CodigosCie')->with('mensajeError', 'No se ha modificado correctamente.');
        }
     }else{
        return $this->editar($this->request->getPost('id'), $this->validator);
     }
    }

    public function eliminar($id){
        if($this->codigosCie->update($id, ['activoCodigosCie'=>0])){
            return redirect()->to(base_url().'/CodigosCie')->with('mensaje', 'Se ha eliminado correctamente.');
        }else{
            return redirect()->to(base_url().'/CodigosCie')->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }
    public function reingresar($id){
        if($this->codigosCie->update($id, ['activoCodigosCie'=>1])){
        return redirect()->to(base_url().'/CodigosCie')->with('mensaje', 'Se ha reingresado correctamente.');
        }else{
        return redirect()->to(base_url().'/CodigosCie')->with('mensajeError', 'No se ha reingresado correctamente.');
       }
    }
}
