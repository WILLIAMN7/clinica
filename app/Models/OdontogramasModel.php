<?php
namespace App\Models;
use CodeIgniter\Model;

class OdontogramasModel extends Model
{
    protected $table      = 'tbodontograma';
    protected $primaryKey = 'idOdontograma';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPiezaDental', 'idPaciente', 'caraOdontograma', 'tratamientoOdontograma', 'dienteEstadoOdontograma', 'movilidadOdontograma', 'recesionOdontograma', 'activoOdontograma'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaOdontograma';
    protected $updatedField  = 'fechaEditOdontograma';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function obtenerpiezadental($codigo){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontograma.idPiezaDental = p.idPiezaDental');
        $this->where('p.idPiezaDental', $codigo);
        $this->orderBy('fechaAltaOdontograma', 'DESC');
        return $this->get()->getRow();
    }

    public function obtenerpiezadental2($codigo, $paciente){
        $this->select('*');
        $this->join('tbpiezadental as p', 'tbodontograma.idPiezaDental = p.idPiezaDental');
        $this->where('p.idPiezaDental', $codigo);
        $this->orderBy('fechaAltaOdontograma', 'DESC');
        return $this->get()->getRow();
    }

    public function obtenerDientesActuales($id){
        return $this->findAll();
    }

}

?>