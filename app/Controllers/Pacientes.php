<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PacientesModel;
use App\Libraries\permisosMenu;

class Pacientes extends BaseController
{
    protected $pacientes, $redireccionIndexPacientes;
    protected $reglas, $session;

    public function __construct()
    {
        $this->permisosMenu = new permisosMenu();
        $this->pacientes = new PacientesModel();
        $this->redireccionIndexPacientes = '/pacientes';
        $this->session = session();
    }

    public function index($activo = 1)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $paciente = $this->pacientes->where('activoPaciente', $activo)->findAll();
            $data = ['titulo' => 'Pacientes', 'datos' => $paciente];

            echo view('header');
            $this->permisosMenu->habilitarpermisos();
            echo view('pacientes/pacientes', $data);
            echo view('footer');
        }
    }

    public function eliminados($activo = 0)
    {
        $paciente = $this->pacientes->where('activoPaciente', $activo)->findAll();
        $data = ['titulo' => 'Pacientes eliminados', 'datos' => $paciente];

        echo view('header');
        echo view('pacientes/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $data = ['titulo' => 'Agregar pacientes'];
            echo view('header');
            echo view('pacientes/nuevo', $data);
            echo view('footer');
        }
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas) && $this->validate($this->reglasModificarIdentificacion)) {
            if ($this->pacientes->save([
                'nombrePaciente' => $this->request->getPost('nombre'),
                'apellidoPaciente' => $this->request->getPost('apellido'),
                'fechanacimientoPaciente' => $this->request->getPost('fechaNacimiento'),
                'telefonoPaciente' => $this->request->getPost('telefono'),
                'correoPaciente' => $this->request->getPost('correo'),
                'identificacionPaciente' => $this->request->getPost('identificacion'),
                'direccionPaciente' => $this->request->getPost('direccion'),
                'generoPaciente' => $this->request->getPost('genero')
            ])) {
                return redirect()->to(base_url() . $this->redireccionIndexPacientes)->with('mensaje', 'Se ha ingresado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexPacientes)->with('mensajeError', 'No se ha ingresado correctamente.');
            }
        } else {
            $data = ['titulo' => 'Agregar pacientes', 'validation' => $this->validator];
            echo view('header');
            echo view('pacientes/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $valid = null)
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            $paciente = $this->pacientes->where('idPaciente', $id)->first();
            if ($valid != null) {
                $data = ['titulo' => 'Editar pacientes', 'datos' => $paciente, 'validation' => $valid];
            } else {
                $data = ['titulo' => 'Editar pacientes', 'datos' => $paciente];
            }
            echo view('header');
            echo view('pacientes/editar', $data);
            echo view('footer');
        }
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas) && $this->validate($this->reglasInsertarIdentificacion)) {
            if ($this->pacientes->update(
                $this->request->getPost('id'),
                [
                    'nombrePaciente' => $this->request->getPost('nombre'),
                    'apellidoPaciente' => $this->request->getPost('apellido'),
                    'fechanacimientoPaciente' => $this->request->getPost('fechaNacimiento'),
                    'telefonoPaciente' => $this->request->getPost('telefono'),
                    'correoPaciente' => $this->request->getPost('correo'),
                    'identificacionPaciente' => $this->request->getPost('identificacion'),
                    'direccionPaciente' => $this->request->getPost('direccion'),
                    'generoPaciente' => $this->request->getPost('genero')
                ]
            )) {
                return redirect()->to(base_url() . $this->redireccionIndexPacientes)->with('mensaje', 'Se ha modificado correctamente.');
            } else {
                return redirect()->to(base_url() . $this->redireccionIndexPacientes)->with('mensajeError', 'No se ha modificado correctamente.');
            }
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }

    public function eliminar($id)
    {
        $this->pacientes->update($id, ['activoPaciente' => 0]);
        return redirect()->to(base_url() . $this->redireccionIndexPacientes);
    }
    public function reingresar($id)
    {
        $this->pacientes->update($id, ['activoPaciente' => 1]);
        return redirect()->to(base_url() . $this->redireccionIndexPacientes);
    }

    public function muestraPacientesPDF()
    {
        echo view('header');
        echo view('pacientes/verPacientesPdf');
        echo view('footer');
    }

    public function generaPacientesPDF($fechaInicio, $fechaFin)
    {
        $procedimientos = $this->pacientes->listarFiltrosProcedimientossRealizadas($fechaInicio, $fechaFin);

        $pdf = new \FPDF('p', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->setTitle('Pacientes');
        $pdf->SetFont('Arial', 'B', 16);
        //ancho, alto, titulo, 0 sin bordes, 1 salto de linea, C centrado
        $pdf->SetFont('Arial', 'B', 9);


        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(200, 5, utf8_decode('TOTAL DE PACIENTES ATENDIDOS'), 1, 1, 'C', 1);
        $items4 = array();
        foreach ($procedimientos  as $procedimiento) {
            $items4[] = $procedimiento['idPaciente'];
        }
        $pdf->Cell(200, 5, utf8_decode(count($items4)), 1, 1, 'C');
        $pdf->ln();


        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(200, 5, utf8_decode('PACIENTE'), 1, 1, 'C', 1);

        foreach ($procedimientos  as $procedimiento) {
            $pdf->Cell(200, 5, utf8_decode($procedimiento['apellidoPaciente'] . ' ' . $procedimiento['nombrePaciente']), 1, 1, 'C');
        }



        $this->response->setHeader('Content-Type', 'application/pdf');

        $pdf->Output("tratamientosPdf.pdf", "I");
    }
}
