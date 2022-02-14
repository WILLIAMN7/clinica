<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PiezaDentalModel;
use App\Libraries\permisosMenu;

class Medicos extends BaseController
{
    protected $piezaDental;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->piezaDental = new PiezaDentalModel();
        $this->session = session();
        helper(['form']);
        $this->reglas =[
         'nombre'=>[
            'rules'=>'required',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.'
            ]
            ]
        ];
    }
    
    public function index($activo = 1){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $piezaDental = $this->piezaDental->where('activoPiezaDental', $activo)->findAll();
        $data = ['titulo'=> 'Médicos', 'datos'=> $piezaDental];

        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('piezaDental/piezaDental', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        $piezaDental = $this->piezaDental->where('activoPiezaDental', $activo)->findAll();
        $data = ['titulo'=> 'Médicos eliminados', 'datos'=> $piezaDental];

        echo view('header');
        echo view('piezaDental/eliminados', $data);
        echo view('footer');
    }

    public function nuevo(){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $data = ['titulo'=> 'Agregar médicos'];
        echo view('header');
        echo view('piezaDental/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->piezaDental->save(['nombremedico'=>$this->request->getPost('nombre'),
        'apellidomedico'=>$this->request->getPost('apellido'),
        'fechanacimientomedico'=>$this->request->getPost('fechaNacimiento'),        
        'telefonomedico'=>$this->request->getPost('telefono'),
        'correomedico'=>$this->request->getPost('correo'),
        'identificacionmedico'=>$this->request->getPost('identificacion'),
        'direccionmedico'=>$this->request->getPost('direccion'),
        'generomedico'=>$this->request->getPost('genero')
        ]);
        return redirect()->to(base_url().'/piezaDental');
    }else{
        $data = ['titulo'=> 'Agregar médicos', 'validation'=>$this->validator];
        echo view('header');
        echo view('piezaDental/nuevo', $data);
        echo view('footer');
    }
    }

    public function editar($id, $valid=null){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $medico = $this->piezaDental->where('idmedico', $id)->first();
        if($valid !=null){            
            $data = ['titulo'=> 'Editar médicos', 'datos'=>$medico, 'validation'=>$valid];
        }else{
            $data = ['titulo'=> 'Editar médicos', 'datos'=>$medico];
        }
        
        echo view('header');
        echo view('piezaDental/editar', $data);
        echo view('footer');
    }
    }
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->piezaDental->update($this->request->getPost('id'), 
        ['nombremedico'=>$this->request->getPost('nombre'),
        'apellidomedico'=>$this->request->getPost('apellido'),
        'fechanacimientomedico'=>$this->request->getPost('fechaNacimiento'),        
        'telefonomedico'=>$this->request->getPost('telefono'),
        'correomedico'=>$this->request->getPost('correo'),
        'identificacionmedico'=>$this->request->getPost('identificacion'),
        'direccionmedico'=>$this->request->getPost('direccion'),
        'generomedico'=>$this->request->getPost('genero')
        ]);
        return redirect()->to(base_url().'/piezaDental');
     }else{
        return $this->editar($this->request->getPost('id'), $this->validator);
     }
    }

    public function eliminar($id){
        $this->piezaDental->update($id, ['activoPiezaDental'=>0]);
        return redirect()->to(base_url().'/piezaDental');
    }
    public function reingresar($id){
        $this->piezaDental->update($id, ['activoPiezaDental'=>1]);
        return redirect()->to(base_url().'/piezaDental');
    }
}
?>