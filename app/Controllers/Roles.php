<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\PermisosModel;
use App\Models\DetalleRolesPermisosModel;
use App\Libraries\permisosMenu;

class Roles extends BaseController
{
    protected $roles, $permisos, $detalleRoles;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->roles = new RolesModel();        
        $this->permisos = new PermisosModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
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
        $roles = $this->roles->where('activoRoles', $activo)->findAll();
        $data = ['titulo'=> 'Roles', 'datos'=> $roles];

        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('roles/roles', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        $roles = $this->roles->where('activoRoles', $activo)->findAll();
        $data = ['titulo'=> 'Roles eliminadas', 'datos'=> $roles];

        echo view('header');
        echo view('roles/eliminados', $data);
        echo view('footer');
    }

    public function nuevo(){
        if(!isset($this->session->idUsuario)){            
			return redirect()->to(base_url());
		}else{        
        $data = ['titulo'=> 'Agregar rol'];
        echo view('header');
        echo view('roles/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->roles->save(['nombreRoles'=>$this->request->getPost('nombre')]);                
        return redirect()->to(base_url().'/roles')->with('mensaje', 'Rol guardado correctamente');
        }else{
            $data = ['titulo'=> 'Agregar rol', 'validation'=>$this->validator];
            echo view('header');
            echo view('roles/nuevo', $data);
            echo view('footer');     
        }        
    }

    public function editar($id, $valid=null){        
        if(!isset($this->session->idUsuario)){            
			return redirect()->to(base_url());
		}else{        
        $rol = $this->roles->where('idRoles', $id)->first();
        if($valid !=null){
            $data =['titulo'=>'Editar rol', 'datos'=>$rol, 'validation'=>$valid];
        }else{
            $data =['titulo'=>'Editar rol', 'datos'=>$rol];
        }
        
        echo view('header');
        echo view('roles/editar', $data);
        echo view('footer');
    }
    }
    
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->roles->update($this->request->getPost('id'), 
        ['nombreRoles'=>$this->request->getPost('nombre')
        ]);
        return redirect()->to(base_url().'/roles')->with('mensaje', 'Rol actualizado correctamente');
        }else{
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }

    public function eliminar($id){
        $this->roles->update($id, ['activoRoles'=>0]);
        return redirect()->to(base_url().'/roles')->with('mensaje', 'Rol eliminado correctamente');
    }
    public function reingresar($id){
        $this->roles->update($id, ['activoRoles'=>1]);
        return redirect()->to(base_url().'/roles');
    }
    public function detalles($idRol)
    {
        $permisos = $this->permisos->findAll();

        $permisosAsignados = $this->detalleRoles->where('idRolDetalleRolesPermisos', $idRol)->findAll();
        $datos = array();

        $this->detalleRoles->verificaPermisos($idRol, 'MenuProductos');



        foreach($permisosAsignados as $permisoAsignados){
            $datos[$permisoAsignados['idPermisoDetalleRolesPermisos']]=true;
        }

        $data = ['titulo'=>'Asignar Permisos', 'permisos'=>$permisos, 'id_rol'=>$idRol, 'asignado'=>$datos];        

        echo view('header');
        echo view('roles/detalles', $data);
        echo view('footer');
    }

    public function guardaPermisos(){
        if($this->request->getMethod()=="post"){
            $idRol = $this->request->getPost('id_rol');
            $permisos = $this->request->getPost('permisos');

            $this->detalleRoles->where('idRolDetalleRolesPermisos', $idRol)->delete();

            foreach($permisos as $permiso){
                $this->detalleRoles->save(['idRolDetalleRolesPermisos'=>$idRol, 'idPermisoDetalleRolesPermisos'=>$permiso]);
            }            
            return redirect()->to(base_url()."/roles");
        }
    }

}
