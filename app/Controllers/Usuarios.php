<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\MedicosModel;
use App\Models\RolesModel;
use App\Models\LogsModel;
use App\Libraries\permisosMenu;

class Usuarios extends BaseController
{
    protected $usuarios, $medicos, $roles, $session, $logs;
    protected $reglas, $reglaslogin, $reglascambia;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->usuarios = new UsuariosModel();
        $this->medicos = new MedicosModel();
        $this->roles = new RolesModel();
        $this->logs = new LogsModel();
        $this->session = session();
        helper(['form']);
        $this->reglas =[
        'usuario'=>[
            'rules'=>'required|is_unique[tbusuario.usuarioUsuario]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'is_unique' => 'El campo {field} debe ser unico.',
            ]
        ], 'password'=>[
            'rules'=>'required',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.'
            ]
            ], 'repassword'=>[
                'rules'=>'required|matches[password]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden, por favor revisa.',
                ]
            ], 'nombre'=>[
                'rules'=>'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
                ], 'id_medico'=>[
                    'rules'=>'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                    ], 'id_rol'=>[
                        'rules'=>'required',
                        'errors' => [
                            'required' => 'El campo {field} es obligatorio.'
                        ]
                        ]
        ];

        $this->reglasmodificarusuario =[
            'usuario'=>[
                'rules'=>'required|is_unique[tbusuario.usuarioUsuario]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} debe ser unico.',
                ]
            ], 'nombre'=>[
                    'rules'=>'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                    ], 'id_medico'=>[
                        'rules'=>'required',
                        'errors' => [
                            'required' => 'El campo {field} es obligatorio.'
                        ]
                        ], 'id_rol'=>[
                            'rules'=>'required',
                            'errors' => [
                                'required' => 'El campo {field} es obligatorio.'
                            ]
                            ]
            ];

            
        $this->reglaslogin =[
            'usuario'=>[
                'rules'=>'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'                
                ]
            ], 'password'=>[
                'rules'=>'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
                ]
                ];

                $this->reglascambia =[
                    'password'=>[
                        'rules'=>'required',
                        'errors' => [
                            'required' => 'El campo {field} es obligatorio.'                
                        ]
                    ], 'repassword'=>[
                        'rules'=>'required|matches[password]',
                        'errors' => [
                            'required' => 'El campo {field} es obligatorio.',
                            'matches' => 'Las contraseñas no coinciden, por favor revisa.',
                        ]
                    ]
                        ];
    }
    
    public function index($activo = 1){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $usuarios = $this->usuarios->where('activoUsuario', $activo)->findAll();
        $data = ['titulo'=> 'Usuarios', 'datos'=> $usuarios];

        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('usuarios/usuarios', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        $usuarios = $this->usuarios->where('activoUsuario', $activo)->findAll();
        $data = ['titulo'=> 'Usuarios eliminadas', 'datos'=> $usuarios];

        echo view('header');
        echo view('usuarios/eliminados', $data);
        echo view('footer');
    }

    public function nuevo(){
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $roles = $this->roles->where('activoRoles', 1)->findAll();
        $medicos = $this->medicos->where('activomedico', 1)->findAll();

        $data = ['titulo'=> 'Agregar usuario', 'roles'=> $roles, 'medicos'=> $medicos];
        echo view('header');
        echo view('usuarios/nuevo', $data);
        echo view('footer');
        }
    }

    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        
        $this->usuarios->save(['usuarioUsuario'=>$this->request->getPost('usuario'),
        'passwordUsuario'=>$hash,
        'nombreUsuario'=>$this->request->getPost('nombre'),
        'idMedicoUsuario'=>$this->request->getPost('id_medico'),
        'idRolUsuario'=>$this->request->getPost('id_rol')
        ]);
        return redirect()->to(base_url().'/usuarios');
        }else{
        $roles = $this->roles->where('activoRoles', 1)->findAll();
        $medicos = $this->medicos->where('activomedico', 1)->findAll();
        
            $data = ['titulo'=> 'Agregar usuario', 'roles'=> $roles, 'medicos'=> $medicos, 'validation'=>$this->validator];
            echo view('header');
            echo view('usuarios/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $valid=null){        
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $usuario = $this->usuarios->where('idUsuario', $id)->first();
        $roles = $this->roles->where('activoRoles', 1)->findAll();    

        if($valid !=null){
            $data =['titulo'=>'Editar usuario', 'datos'=>$usuario, 'roles'=> $roles, 'validation'=>$valid];
        }else{
            $data =['titulo'=>'Editar usuario', 'datos'=>$usuario, 'roles'=> $roles];
        }
        
        echo view('header');
        echo view('usuarios/editar', $data);
        echo view('footer');
    }
    }
    
    public function actualizar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglasmodificarusuario)){
        $this->usuarios->update($this->request->getPost('id'), 
        ['usuarioUsuario'=>$this->request->getPost('usuario'),
        'nombreUsuario'=>$this->request->getPost('nombre'),
        //'idUsuario_caja'=>$this->request->getPost('id_caja'),
        'idRolUsuario'=>$this->request->getPost('id_rol')
         ]);
        return redirect()->to(base_url().'/usuarios');
        }else{
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }

    public function eliminar($id){
        $this->usuarios->update($id, ['activoUsuario'=>0]);
        return redirect()->to(base_url().'/usuarios');
    }
    public function reingresar($id){
        $this->usuarios->update($id, ['activoUsuario'=>1]);
        return redirect()->to(base_url().'/usuarios');
    }

    public function login(){
        echo view('login');
    }
    
    public function valida(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglaslogin))
        {
            $usuario =$this->request->getPost('usuario');
            $password =$this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('usuarioUsuario', $usuario)->first();
            if($datosUsuario != null) {
                if(password_verify($password, $datosUsuario['passwordUsuario'])){
                    $datosSesion = [
                        'idUsuario' => $datosUsuario['idUsuario'],
                        'nombre' => $datosUsuario['nombreUsuario'],                        
                        'idMedico' => $datosUsuario['idMedicoUsuario'],
                        'idRol' => $datosUsuario['idRolUsuario']
                    ];

                    $ip = $_SERVER['REMOTE_ADDR'];
                    $detalles = $_SERVER['HTTP_USER_AGENT'];

                    $this->logs->save([
                        'idUsuarioLogs'=>$datosUsuario['idUsuario'],
                        'eventoLogs'=>'Inicio de sesion',
                        //'wn7_log_fecha'=>NOW(),
                        'ipLogs'=>$ip,
                        'detallesLogs'=>$detalles,
                    ]);


                    $session= session();
                    $session->set($datosSesion);
                    return redirect()->to(base_url().'/inicio');
                }else{
                    $data['error'] = "Las contraseñas no coinsiden";
                    echo view('login', $data);
                }
            }else{
                $data['error'] = "El usuario no existe";
                echo view('login', $data);
            }
        }else{
                $data = ['validation' => $this->validator];
                echo view('login', $data);
            }
    }

    public function logout(){
        $session = session();
        $ip = $_SERVER['REMOTE_ADDR'];
        $detalles = $_SERVER['HTTP_USER_AGENT'];
        
                    $this->logs->save([
                        'idUsuarioLogs'=>$session->idUsuario,
                        'eventoLogs'=>'Cierre de sesion',                        
                        'ipLogs'=>$ip,
                        'detallesLogs'=>$detalles,
                    ]);


        $session->destroy(); 
        //echo view('login');
        return redirect()->to(base_url());
    }

    public function cambia_password(){
        $session = session();
        $usuario = $this->usuarios->where('idUsuario', $session->idUsuario)->first();

        $data = ['titulo'=> 'Cambiar contraseña', 'usuario'=> $usuario];
        echo view('header');
        echo view('usuarios/cambia_password', $data);
        echo view('footer');
    }

    public function actualizar_password(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglascambia)){
            $session=session();
            $idUsuario = $session->idusuario;
            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            
            $this->usuarios->update($idUsuario, ['passwordUsuario'=>$hash]);

            $usuario = $this->usuarios->where('idUsuario', $session->idUsuario)->first();

        $data = ['titulo'=> 'Cambiar contraseña', 'usuario'=> $usuario, 'mensaje'=>'contraseña actualizada'];
        echo view('header');
        echo view('usuarios/cambia_password', $data);
        echo view('footer');

            }else{
                $session = session();
                $usuario = $this->usuarios->where('idUsuario', $session->idUsuario)->first();
        
                $data = ['titulo'=> 'Cambiar contraseña', 'usuario'=> $usuario, 'validation' => $this->validator];
                echo view('header');
                echo view('usuarios/cambia_password', $data);
                echo view('footer');
            }
    }



}
