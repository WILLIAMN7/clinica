<?php
namespace App\Models;
use CodeIgniter\Model;

class ProcedimientosRealizadosModel extends Model
{
    protected $table      = 'tbprocedimientosrealizados';
    protected $primaryKey = 'idProcedimientosRealizados';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idMedico', 'idTratamiento', 'procedimientoProcedimientosRealizados', 'prescripcionProcedimientosRealizados', 'activoProcedimientosRealizados'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaProcedimientosRealizados';
    protected $updatedField  = 'fechaEditProcedimientosRealizados';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function listarProcedimientosRealizados($idTratamiento){
        $this->select('*');
        $this->join('tbtratamiento as t', 'tbprocedimientosrealizados.idTratamiento = t.idTratamiento');
        $this->join('tbmedico AS m', 'tbprocedimientosrealizados.idMedico = m.idMedico');
        $this->join('tbcodigoscie AS c', 't.idCodigoCie = c.idCodigosCie');
        $this->where('tbprocedimientosrealizados.activoProcedimientosRealizados', 1);
        $this->where('tbprocedimientosrealizados.idTratamiento', $idTratamiento);
        return $this->findAll();
    }

    public function listarTodosLosProcedimientosRealizados($idPaciente){
        $this->select('*');
        $this->join('tbtratamiento as t', 'tbprocedimientosrealizados.idTratamiento = t.idTratamiento');
        $this->join('tbmedico AS m', 'tbprocedimientosrealizados.idMedico = m.idMedico');
        $this->join('tbcodigoscie AS c', 't.idCodigoCie = c.idCodigosCie');
        $this->where('tbprocedimientosrealizados.activoProcedimientosRealizados', 1);
        $this->where('t.idpaciente', $idPaciente);
        return $this->findAll();
    }
}

?>