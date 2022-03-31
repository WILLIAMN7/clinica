<?php
namespace App\Models;
use CodeIgniter\Model;

class AnamnesisModel extends Model
{
    protected $table      = 'tbanamnesis';
    protected $primaryKey = 'idAnamnesis';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPaciente', 'idMedico', 'motivoConsultaAnamnesis', 'descripcionProblemaAnamnesis', 'grupoEtarioAnamnesis', 'activoAnamnesis'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaAnamnesis';
    protected $updatedField  = 'fechaEditAnamnesis';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function obtener($activo=1, $idPaciente){
        $this->select('*');
        $this->join('tbpaciente AS p', 'tbanamnesis.idPaciente = p.idPaciente');
        $this->join('tbmedico AS m', 'tbanamnesis.idMedico = m.idMedico');
        $this->where('tbanamnesis.activoAnamnesis', $activo);
        $this->where('tbanamnesis.idPaciente', $idPaciente);
        return $this->findAll();
    }

    

}

?>