<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TratamientosModel;
use App\Models\CodigosCieModel;
use App\Libraries\permisosMenu;

class Tratamientos extends BaseController
{
    protected $tratamientos;
    protected $reglas, $session;

    public function __construct(){
        $this->permisosMenu = new permisosMenu();
        $this->tratamientos = new TratamientosModel();
        $this->codigos_cie = new CodigosCieModel();
        $this->session = session();

        helper(['form']);
        $this->reglas =[
         'tratamiento'=>[
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
        $tratamientos = $this->tratamientos->listarTratamientos($id);
        $data = ['titulo'=> 'Tratamientos', 'idPaciente'=>$id, 'datos'=> $tratamientos];

        echo view('header');
        $this->permisosMenu->habilitarpermisos();
        echo view('tratamientos/tratamientos', $data);
        echo view('footer');
        }
    }

    public function eliminados($activo = 0){
        $tratamientos = $this->tratamientos->where('activoTratamiento', $activo)->findAll();
        $data = ['titulo'=> 'Tratamientos eliminadas', 'datos'=> $tratamientos];

        echo view('header');
        echo view('tratamientos/eliminados', $data);
        echo view('footer');
    }

    public function nuevo($idPaciente){        
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $codigos_cie = $this->codigos_cie->where('activoCodigosCie', 1)->where('tipoCodigosCie','TRA')->findAll();
        $data = ['titulo'=> 'Agregar tratamiento', 'codigos_cie'=>$codigos_cie, 'idPaciente'=>$idPaciente];
        echo view('header');
        echo view('tratamientos/nuevo', $data);
        echo view('footer');
        }
    }
    public function insertar(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
        $this->tratamientos->save(['idCodigoCie'=>$this->request->getPost('tratamiento'),
        'idMedico'=>$this->request->getPost('idMedicos'),
        'idPaciente'=>$this->request->getPost('idPaciente'),
        'procedimientoTratamiento'=>'PENDIENTE',
        'prescripcionTratamiento'=>$this->request->getPost('comentario')
        ]);
        return redirect()->to(base_url().'/tratamientos/index/'.$this->request->getPost('idPaciente'));
        }else{        
        $codigos_cie = $this->codigos_cie->where('activoCodigosCie', 1)->where('tipoCodigosCie','TRA')->findAll();
        $data = ['titulo'=> 'Agregar tratamientos', 'codigos_cie'=>$codigos_cie, 'idPaciente'=>$this->request->getPost('idPaciente'), 'validation'=>$this->validator];
            echo view('header');
            echo view('tratamientos/nuevo', $data);
            echo view('footer');
        }
    }
    
    public function editar($id, $idPaciente, $valid=null){        
        if(!isset($this->session->idUsuario)){
			return redirect()->to(base_url());
		}else{
        $codigos_cie = $this->codigos_cie->where('activoCodigosCie', 1)->where('tipoCodigosCie','TRA')->findAll();
        $tratamientos = $this->tratamientos->where('idTratamiento', $id)->first();
        if($valid !=null){
            $data =['titulo'=>'Editar tratamientos', 'codigos_cie'=>$codigos_cie, 'tratamientos'=>$tratamientos, 'idPaciente'=>$idPaciente, 'validation'=>$valid];
        }else{
            $data =['titulo'=>'Editar tratamientos', 'codigos_cie'=>$codigos_cie, 'tratamientos'=>$tratamientos, 'idPaciente'=>$idPaciente];
        }
        echo view('header');
        echo view('tratamientos/editar', $data);
        echo view('footer');
    }
    }

    public function actualizar(){        
        if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
            $this->tratamientos->update($this->request->getPost('id'), 
            ['idCodigoCie'=>$this->request->getPost('tratamiento'),
            'idMedico'=>$this->request->getPost('idMedicos'),
            'idPaciente'=>$this->request->getPost('idPaciente'),
            'procedimientoTratamiento'=>$this->request->getPost('estado'),
            'prescripcionTratamiento'=>$this->request->getPost('comentario')
        ]);
            return redirect()->to(base_url().'/tratamientos/index/'.$this->request->getPost('idPaciente'));
            }else{
                return $this->editar($this->request->getPost('id'), $this->request->getPost('idPaciente'), $this->validator);
            }
    }

    public function eliminar($id, $idPaciente){
        $this->tratamientos->update($id, ['activoTratamiento'=>0]);
        return redirect()->to(base_url().'/tratamientos/index/'.$idPaciente);
    }

    public function muestraTratamientosPDF(){
        echo view('header');
        echo view('tratamientos/verTratamientosPdf');
        echo view('footer');
    }

    public function generaHistorialPDF($idPaciente, $fechaInicio, $fechaFin)
    {
        $tratamientos = $this->tratamientos->listarFiltrosTratamiento($idPaciente, $fechaInicio, $fechaFin);

        $pdf = new \FPDF('p', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->setTitle('Compra');
        $pdf->SetFont('Arial', 'B', 16);
        //ancho, alto, titulo, 0 sin bordes, 1 salto de linea, C centrado
        $pdf->SetFont('Arial', 'B', 9);

        foreach ($tratamientos  as $tratamiento) {
            $pdf->SetFillColor(230,230,230);
            $pdf->Cell(200, 5, utf8_decode('PACIENTE'), 1, 1, 'C', 1);
            $pdf->Cell(200, 5, utf8_decode($tratamiento['apellidoPaciente'].' '.$tratamiento['nombrePaciente']), 1, 1, 'C'); 
            $pdf->Cell(25, 5, utf8_decode('DOCTOR'), 1, 0, 'C');
            $pdf->Cell(95, 5, utf8_decode($tratamiento['apellidoMedico'].' '.$tratamiento['nombreMedico']), 1, 0, 'l'); 
            $pdf->Cell(40, 5, utf8_decode('FECHA DE REGISTRO'), 1, 0, 'C');
            $pdf->Cell(40, 5, utf8_decode($tratamiento['fechaAltaTratamiento']), 1, 1, 'l'); 
            $pdf->Cell(25, 5, utf8_decode('TRATAMIENTO'), 1, 0, 'C');
            $pdf->Cell(95, 5, utf8_decode($tratamiento['descripcionCodigosCie']), 1, 0, 'l');
            $pdf->Cell(40, 5, utf8_decode('ESTADO'), 1, 0, 'C');
            $pdf->Cell(40, 5, utf8_decode($tratamiento['procedimientoTratamiento']), 1, 1, 'l');
            $pdf->MultiCell(200,5,utf8_decode('COMENTARIO: '.$tratamiento['prescripcionTratamiento']),1,'J', FALSE);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');

        $pdf->Output("tratamientosPdf.pdf", "I");

    }

    /*public function reingresar($id){
        $this->tratamientos->update($id, ['activotratamiento'=>1]);
        return redirect()->to(base_url().'/tratamientos');
    }*/
    
}
