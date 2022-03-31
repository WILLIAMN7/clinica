<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PlanDiagnosticosModel;
use App\Models\DetalleRolesPermisosModel;
use App\Models\PacientesModel;
use App\Libraries\permisosMenu;

class Examenes extends BaseController
{
    protected $examenes, $redireccionIndexExamenes, $direccionImagenes;
    protected $reglas, $session;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->examenes = new PlanDiagnosticosModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->pacientes = new PacientesModel();
        $this->session = session();
        $this->redireccionIndexExamenes = '/Examenes/index/';
        $this->direccionImagenes = 'images/examenes/';
        helper(['form']);
        $this->reglas = [
            'examenes' => [
                'rules' => 'required'
            ]
        ];
    }

    public function index($id, $activo = 1)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $permiso = $this->detalleRoles->verificaPermisos($this->session->idRol, 'DiagnosticosMostrar');
            if (!$permiso) {
                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                $this->permisosMenu->mensajeNoPermisos();
                echo view('footer');
            } else {

                $examen = $this->examenes->where('activoPlanDiagnostico', $activo)->where('idPaciente', $id)->findAll();
                $pacientes = $this->pacientes->where('idPaciente', $id)->first();
                $permisoInsertar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'DiagnosticosInsertar');
                $permisoEditar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'DiagnosticosEditar');
                $permisoEliminar = $this->detalleRoles->verificaPermisos($this->session->idRol, 'DiagnosticosEliminar');

                $data = ['titulo' => 'Examenes realizados', 'idPaciente' => $id, 'datos' => $examen, 'permisoInsertar' => $permisoInsertar, 'permisoEditar' => $permisoEditar, 'permisoEliminar' => $permisoEliminar, 'pacientes' => $pacientes];

                echo view('header');
                $this->permisosMenu->habilitarpermisos();
                echo view('examenes/examenes', $data);
                echo view('footer');
            }
        }
    }

    public function nuevo($idPaciente)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $data = ['titulo' => 'Agregar examenes realizados', 'idPaciente' => $idPaciente];
            echo view('header');
            echo view('examenes/nuevo', $data);
            echo view('footer');
        }
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if($this->examenes->save([
                'idPaciente' => $this->request->getPost('idPaciente'),
                'examenEnviadoPlanDiagnostico' => $this->request->getPost('examenes'),
                'comentarioPlanDiagnostico' => $this->request->getPost('comentario'),
            ])) {
            $id = $this->examenes->insertID();
            if ($imagefile = $this->request->getFiles()) {
                $contador = 1;
                foreach ($imagefile['imgExamenes'] as $img) {
                    $ruta = $this->direccionImagenes . $id;
                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }
                    if ($img->isValid() && !$img->hasMoved()) {
                        $img->move('./'.$this->direccionImagenes, $id . '/archivo_' . $contador . '.pdf');
                        $contador++;
                    }
                }
            }
            return redirect()->to(base_url() . $this->redireccionIndexExamenes . $this->request->getPost('idPaciente'))->with('mensaje', 'Se ha ingresado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexExamenes . $this->request->getPost('idPaciente'))->with('mensajeError', 'No se ha ingresado correctamente.');
        }
        } else {
            $data = ['titulo' => 'Agregar examenes', 'validation' => $this->validator];
            echo view('header');
            echo view('Examenes/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $idPaciente, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $examen = $this->examenes->where('idPlanDiagnostico', $id)->first();
            if ($valid != null) {
                $data = ['titulo' => 'Editar examenes', 'idPaciente' => $idPaciente, 'datos' => $examen, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Editar examenes', 'idPaciente' => $idPaciente, 'datos' => $examen];
            }
            echo view('header');
            echo view('Examenes/editar', $data);
            echo view('footer');
        }
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            if($this->examenes->update(
                $this->request->getPost('id'),
                [
                    'idPaciente' => $this->request->getPost('idPaciente'),
                    'examenEnviadoPlanDiagnostico' => $this->request->getPost('examenes'),
                    'comentarioPlanDiagnostico' => $this->request->getPost('comentario'),
                ]
            )) {
                
            $id = $this->request->getPost('id');

            if ($imagefile = $this->request->getFiles()) {
                $contador = 1;
                /*Se elimina los ficheros antiguos para colocar los nuevos*/
                $files = glob('./'. $this->direccionImagenes . $id . '/*'); //obtenemos todos los nombres de los ficheros
                foreach ($files as $file) {
                    if (is_file($file))
                        unlink($file); //elimino el fichero
                }

                foreach ($imagefile['imgExamenes'] as $img) {
                    $ruta = $this->direccionImagenes . $id;
                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }
                    if ($img->isValid() && !$img->hasMoved()) {
                        $img->move('./'.$this->direccionImagenes, $id . '/archivo_' . $contador . '.pdf');
                        $contador++;
                    }
                }
            }
            return redirect()->to(base_url() . $this->redireccionIndexExamenes . $this->request->getPost('idPaciente'))->with('mensaje', 'Se ha modificado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexExamenes . $this->request->getPost('idPaciente'))->with('mensajeError', 'No se ha modificado correctamente.');
        }
        } else {
            return $this->editar($this->request->getPost('id'), $this->request->getPost('idPaciente'), $this->validator);
        }
    }

    public function eliminar($id, $idPaciente)
    {
        if($this->examenes->update($id, ['activoPlanDiagnostico' => 0])) {
            return redirect()->to(base_url() . $this->redireccionIndexExamenes . $idPaciente)->with('mensaje', 'Se ha eliminado correctamente.');
        } else {
            return redirect()->to(base_url() . $this->redireccionIndexExamenes . $idPaciente)->with('mensajeError', 'No se ha eliminado correctamente.');
        }
    }
}
