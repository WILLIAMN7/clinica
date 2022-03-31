<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\MedicosModel;
use App\Models\RolesModel;
use App\Models\LogsModel;
use App\Models\DetalleRolesPermisosModel;
use App\Libraries\permisosMenu;

class Usuarios extends BaseController
{
    protected $usuarios, $medicos, $roles, $session, $logs, $redireccionIndexUsuarios;
    protected $reglas, $reglaslogin, $reglascambia;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->usuarios = new UsuariosModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->medicos = new MedicosModel();
        $this->roles = new RolesModel();
        $this->logs = new LogsModel();
        $this->redireccionIndexUsuarios = '/usuarios';
        $this->session = session();
        helper(['form']);
        $this->reglas = [
            'usuario' => [
                'rules' => 'required|is_unique[tbusuario.usuarioUsuario]'
            ], 'password' => [
                'rules' => 'required|regex_match[^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,50}$]',
                'errors' => [
                    'regex_match' => 'La clave debe tener mínimo 8 caracteres de longitud. Mínimo debe tener 1 número, 1 letra en minúscula y 1 letra en mayúscula.'
                ]
            ], 'repassword' => [
                'rules' => 'required|matches[password]',
            ], 'nombre' => [
                'rules' => 'required'
            ], 'idMedico' => [
                'rules' => 'required'
            ], 'idRol' => [
                'rules' => 'required'
            ]
        ];

        $this->reglasIngresarUsuario = [
            'usuario' => [
                'rules' => 'required|is_unique[tbusuario.usuarioUsuario]'
            ]
        ];

        $this->reglasModificarUsuario = [
            'usuario' => [
                'rules' => 'required|is_unique[tbusuario.usuarioUsuario,tbusuario.idUsuario,{id}]'
            ], 'nombre' => [
                'rules' => 'required'
            ], 'idRol' => [
                'rules' => 'required'
            ]
        ];

        $this->reglasClave = [
            'password' => [
                'rules' => 'required|regex_match[^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,50}$]',
                'errors' => [
                    'regex_match' => 'La clave debe tener mínimo 8 caracteres de longitud. Mínimo debe tener 1 número, 1 letra en minúscula y 1 letra en mayúscula.'
                ]
            ], 'repassword' => [
                'rules' => 'required|matches[password]',
            ]
        ];


        $this->reglaslogin = [
            'usuario' => [
                'rules' => 'required'
            ], 'password' => [
                'rules' => 'required'
            ]
        ];

        $this->reglascambia = [
            'password' => [
                'rules' => 'required'
            ], 'repassword' => [
                'rules' => 'required|matches[password]'
            ]
        ];
    }

    public function index($activo = 1)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'UsuariosMostrar');
            if (!$permiso) {
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                $this->permisosMenu->mensajeNoPermisos();
                echo view('footer');
            } else {
                $usuarios = $this->usuarios->listarUsuarios();
                $permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'UsuariosInsertar');
                $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'UsuariosEditar');
                $permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'UsuariosEliminar');
                $data = ['titulo' => 'Usuarios', 'datos' => $usuarios, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar];

                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('usuarios/usuarios', $data);
                echo view('footer');
            }
        }
    }

    public function eliminados($activo = 0)
    {
        $usuarios = $this->usuarios->where('activoUsuario', $activo)->findAll();
        $data = ['titulo' => 'Usuarios eliminadas', 'datos' => $usuarios];

        echo view('header');
        echo view('usuarios/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $roles = $this->roles->where('activoRoles', 1)->findAll();
            $medicos = $this->medicos->where(' idMedico NOT IN( SELECT idMedicoUsuario FROM tbusuario)')->where('activomedico', 1)->findAll();

            $data = ['titulo' => 'Agregar usuario', 'roles' => $roles, 'medicos' => $medicos];
            echo view('header');
            echo view('usuarios/nuevo', $data);
            echo view('footer');
        }
    }

    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas) && $this->validate($this->reglasIngresarUsuario)) {
            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            if ($this->usuarios->save([
                'usuarioUsuario' => $this->request->getPost('usuario'),
                'passwordUsuario' => $hash,
                'nombreUsuario' => $this->request->getPost('nombre'),
                'idMedicoUsuario' => $this->request->getPost('idMedico'),
                'idRolUsuario' => $this->request->getPost('idRol')
            ])) {
                return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensaje', 'Se ha ingresado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensajeError', 'No se ha ingresado correctamente.');
            }
        } else {
            $roles = $this->roles->where('activoRoles', 1)->findAll();
            $medicos = $this->medicos->where('activomedico', 1)->findAll();

            $data = ['titulo' => 'Agregar usuario', 'roles' => $roles, 'medicos' => $medicos, 'validation' => $this->validator];
            echo view('header');
            echo view('usuarios/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $usuario = $this->usuarios->where('idUsuario', $id)->first();
            $roles = $this->roles->where('activoRoles', 1)->findAll();

            if ($valid != null) {
                $data = ['titulo' => 'Editar usuario', 'datos' => $usuario, 'roles' => $roles, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Editar usuario', 'datos' => $usuario, 'roles' => $roles];
            }

            echo view('header');
            echo view('usuarios/editar', $data);
            echo view('footer');
        }
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasModificarUsuario)) {
            if ($this->usuarios->update(
                $this->request->getPost('id'),
                [
                    'usuarioUsuario' => $this->request->getPost('usuario'),
                    'nombreUsuario' => $this->request->getPost('nombre'),
                    'idRolUsuario' => $this->request->getPost('idRol')
                ]
            )) {
                return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensaje', 'Se ha modificado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensajeError', 'No se ha modificado correctamente.');
            }
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }

    public function eliminar($id)
    {
        if ($this->usuarios->update($id, ['activoUsuario' => 0])) {
            return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensaje', 'Se ha eliminado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }
    public function reingresar($id)
    {
        if ($this->usuarios->update($id, ['activoUsuario' => 1])) {
            return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensaje', 'Se ha reingresado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensajeError', 'No se ha reingresado correctamente.');
        }
    }

    public function login()
    {
        echo view('login');
    }

    public function valida()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglaslogin)) {
            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('usuarioUsuario', $usuario)->first();
            if ($datosUsuario != null) {
                if (password_verify($password, $datosUsuario['passwordUsuario'])) {
                    $datosSesion = [
                        'idUsuario' => $datosUsuario['idUsuario'],
                        'nombre' => $datosUsuario['nombreUsuario'],
                        'idMedico' => $datosUsuario['idMedicoUsuario'],
                        'idRol' => $datosUsuario['idRolUsuario']
                    ];

                    $ip = $_SERVER['REMOTE_ADDR'];
                    $detalles = $_SERVER['HTTP_USER_AGENT'];

                    $this->logs->save([
                        'idUsuarioLogs' => $datosUsuario['idUsuario'],
                        'eventoLogs' => 'Inicio de sesion',
                        'ipLogs' => $ip,
                        'detallesLogs' => $detalles,
                    ]);


                    $session = session();
                    $session->set($datosSesion);
                    return redirect()->to(base_url() . '/inicio');
                } else {
                    $data['error'] = "Las contraseñas no coinsiden";
                    echo view('login', $data);
                }
            } else {
                $data['error'] = "El usuario no existe";
                echo view('login', $data);
            }
        } else {
            $data = ['validation' => $this->validator];
            echo view('login', $data);
        }
    }

    public function logout()
    {
        $session = session();
        $ip = $_SERVER['REMOTE_ADDR'];
        $detalles = $_SERVER['HTTP_USER_AGENT'];

        $this->logs->save([
            'idUsuarioLogs' => $session->idUsuario,
            'eventoLogs' => 'Cierre de sesion',
            'ipLogs' => $ip,
            'detallesLogs' => $detalles,
        ]);


        $session->destroy();
        return redirect()->to(base_url());
    }

    public function cambiarClave()
    {
        $session = session();
        $usuario = $this->usuarios->where('idUsuario', $session->idUsuario)->first();

        $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario];
        echo view('header');
        echo view('usuarios/cambiarClave', $data);
        echo view('footer');
    }

    public function actualizarClave()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasClave)) {
            $session = session();
            $idUsuario = $session->idUsuario;
            echo $idUsuario;

            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $this->usuarios->update($idUsuario, ['passwordUsuario' => $hash]);
            $usuario = $this->usuarios->where('idUsuario', $session->idUsuario)->first();

            return redirect()->to(base_url() . '/usuarios/cambiarClave')->with('mensaje', 'Se ha modificado correctamente.');

        } else {
            $session = session();
            $usuario = $this->usuarios->where('idUsuario', $session->idUsuario)->first();

            $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario, 'validation' => $this->validator];
            echo view('header');
            echo view('usuarios/cambiarClave', $data);
            echo view('footer');
        }
    }

    public function resetearClave($id, $valid = null){
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $usuario = $this->usuarios->where('idUsuario', $id)->first();
            $roles = $this->roles->where('activoRoles', 1)->findAll();
            if ($valid != null) {
                $data = ['titulo' => 'Resetear Clave', 'usuario' => $usuario, 'roles' => $roles, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Resetear clave', 'usuario' => $usuario, 'roles' => $roles];
            }
            echo view('header');
            echo view('usuarios/resetearClave', $data);
            echo view('footer');
        }
    }

    public function reseteoClave()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasClave)) {
            $session = session();
            $idUsuario = $this->request->getPost('id');
            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $this->usuarios->update($idUsuario, ['passwordUsuario' => $hash]);
            return redirect()->to(base_url() . $this->redireccionIndexUsuarios)->with('mensaje', 'Se ha modificado correctamente.');
        } else {
            $session = session();
            $usuario = $this->usuarios->where('idUsuario', $this->request->getPost('id'))->first();

            $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario, 'validation' => $this->validator];
            echo view('header');
            echo view('usuarios/resetearClave', $data);
            echo view('footer');
        }
    }
}
