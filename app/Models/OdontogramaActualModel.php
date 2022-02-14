<?php
namespace App\Models;
use CodeIgniter\Model;

class OdontogramaActualModel extends Model
{
    protected $table      = 'tbodontogramaactual';
    protected $primaryKey = 'idOdontogramaActual';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPiezaDental', 'idPaciente', 'caraOdontogramaActual', 'tratamientoOdontogramaActual', 'dienteEstadoOdontogramaActual',  'movilidadOdontogramaActual', 'recesionOdontogramaActual', 'activoOdontogramaActual'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaOdontogramaActual';
    protected $updatedField  = 'fechaEditOdontogramaActual';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function obtenerpiezadental($codigo, $paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('p.idPiezaDental', $codigo);
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $datos=$this->get()->getRow();
        return $datos;
    }
    
    public function obtenerDentaduraActualMaxilarSuperiorDerecha($paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $this->where('p.numeroPiezaDental<19');
        $this->orderBy('p.numeroPiezaDental', 'DESC');
        $datos3=$this->findAll();
        //print_r($this->getLastQuery());
        return $datos3;
    }

    public function obtenerDentaduraActualMaxilarSuperiorIzquierda($paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $this->where('numeroPiezaDental>20 && numeroPiezaDental<29');
        $this->orderBy('numeroPiezaDental', 'ASC');
        $datos3=$this->findAll();
        return $datos3;
    }

    public function obtenerDentaduraActualMaxilarInferiorIzquierda($paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $this->where('numeroPiezaDental>30 && numeroPiezaDental<39');
        $this->orderBy('numeroPiezaDental', 'ASC');
        $datos3=$this->findAll();
        return $datos3;
    }

    public function obtenerDentaduraActualMaxilarInferiorDerecho($paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $this->where('numeroPiezaDental>40 && numeroPiezaDental<49');
        $this->orderBy('numeroPiezaDental', 'DESC');
        $datos3=$this->findAll();
        return $datos3;
    }

    public function obtenerDentaduraActualMaxilarSuperiorDerechaTemporales($paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $this->where('numeroPiezaDental>50 && numeroPiezaDental<56');
        $this->orderBy('numeroPiezaDental', 'DESC');
        $datos3=$this->findAll();
        return $datos3;
    }

    public function obtenerDentaduraActualMaxilarSuperiorIzquierdaTemporales($paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $this->where('numeroPiezaDental>60 && numeroPiezaDental<66');
        $this->orderBy('numeroPiezaDental', 'ASC');
        $datos3=$this->findAll();
        return $datos3;
    }

    public function obtenerDentaduraActualMaxilarInferiorIzquierdaTemporales($paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $this->where('numeroPiezaDental>70 && numeroPiezaDental<76');
        $this->orderBy('numeroPiezaDental', 'ASC');
        $datos3=$this->findAll();
        return $datos3;
    }

    public function obtenerDentaduraActualMaxilarInferiorDerechoTemporales($paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontogramaactual.idPiezaDental = p.idPiezaDental');
        $this->where('tbodontogramaactual.idPaciente', $paciente);
        $this->where('numeroPiezaDental>80 && numeroPiezaDental<86');
        $this->orderBy('numeroPiezaDental', 'DESC');
        $datos3=$this->findAll();
        return $datos3;
    }

}
?>