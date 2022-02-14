<?php
namespace App\Models;
use CodeIgniter\Model;

class AntecedentesPacienteModel extends Model
{
    protected $table      = 'tbAntecedentePaciente';
    protected $primaryKey = 'idAntecedentePaciente';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPaciente', 'alergiaAntibioticoAntecedentePaciente', 'alergiaAnestesiaAntecedentePaciente', 'hemorragiasAntecedentePaciente', 'sidaAntecedentePaciente', 'tuberculosisAntecedentePaciente', 'asmaAntecedentePaciente', 'diabetesAntecedentePaciente', 'hipertensionAntecedentePaciente', 'enfermedadCardiacaAntecedentePaciente', 'otroAntecedentePaciente', 'comentarioAntecedentePaciente', 'activoAntecedentePaciente'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaAntecedentePaciente';
    protected $updatedField  = 'fechaEditAntecedentePaciente';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>