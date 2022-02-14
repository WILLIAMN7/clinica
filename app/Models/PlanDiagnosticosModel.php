<?php
namespace App\Models;
use CodeIgniter\Model;

class PlanDiagnosticosModel extends Model
{
    protected $table      = 'tbplandiagnostico';
    protected $primaryKey = 'idPlanDiagnostico';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPaciente', 'examenEnviadoPlanDiagnostico', 'comentarioPlanDiagnostico', 'activoPlanDiagnostico'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaPlanDiagnostico';
    protected $updatedField  = 'fechaEditPlanDiagnostico';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>