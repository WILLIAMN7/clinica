<?php
namespace App\Models;
use CodeIgniter\Model;

class DiagnosticosModel extends Model
{
    protected $table      = 'tbdiagnostico';
    protected $primaryKey = 'idDiagnostico';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPaciente', 'idCodigosCie', 'descripcionDiagnostico', 'tipoDiagnostico', 'activoDiagnostico'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaDiagnostico';
    protected $updatedField  = 'fechaEditDiagnostico';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function listarDiagnosticos($id){
        $this->select('*');
        $this->join('tbcodigoscie AS c', 'tbdiagnostico.idCodigosCie = c.idCodigosCie');
        $this->where('tbdiagnostico.activoDiagnostico', 1);
        $this->where('c.tipoCodigosCie', 'DIA');
        $this->where('tbdiagnostico.idPaciente', $id);
        return $this->findAll();
    }
}



?>