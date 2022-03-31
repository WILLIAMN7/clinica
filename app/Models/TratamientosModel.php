<?php
namespace App\Models;
use CodeIgniter\Model;

class TratamientosModel extends Model
{
    protected $table      = 'tbtratamiento';
    protected $primaryKey = 'idTratamiento';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idMedico', 'idPaciente', 'idCodigoCie','procedimientoTratamiento', 'prescripcionTratamiento', 'activoTratamiento'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaTratamiento';
    protected $updatedField  = 'fechaEditTratamiento';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function listarTratamientos($id){
        $this->select('*');
        $this->join('tbcodigoscie AS c', 'tbtratamiento.idCodigoCie = c.idCodigosCie');
        $this->join('tbmedico AS m', 'tbtratamiento.idMedico = m.idMedico');
        $this->where('tbtratamiento.activoTratamiento', 1);
        $this->where('c.tipoCodigosCie', 'TRA');
        $this->where('tbtratamiento.idPaciente', $id);
        return $this->findAll();
    }

    public function listarTratamiento($idTratamiento){
        $this->select('*');
        $this->join('tbcodigoscie AS c', 'tbtratamiento.idCodigoCie = c.idCodigosCie');
        $this->join('tbmedico AS m', 'tbtratamiento.idMedico = m.idMedico');
        $this->where('tbtratamiento.activoTratamiento', 1);
        $this->where('c.tipoCodigosCie', 'TRA');
        $this->where('tbtratamiento.idTratamiento', $idTratamiento);
        return $this->first();
    }

    public function listarFiltrosTratamiento($estado, $fechaInicio, $fechaFin){
        $this->select('*');
        $this->join('tbcodigoscie AS c', 'tbtratamiento.idCodigoCie = c.idCodigosCie');
        $this->join('tbmedico AS m', 'tbtratamiento.idMedico = m.idMedico');
        $this->join('tbpaciente AS p', 'tbtratamiento.idPaciente = p.idPaciente');
        $this->where('tbtratamiento.activoTratamiento', 1);
        $this->where('c.tipoCodigosCie', 'TRA');
        $this->where('tbtratamiento.fechaAltaTratamiento>"'.$fechaInicio.'"');
        $this->where('tbtratamiento.fechaAltaTratamiento<"'.$fechaFin.'"');
        if($estado!="TODOS"){
        $this->where('tbtratamiento.procedimientoTratamiento', $estado);        
        }
        $this->orderBy('tbtratamiento.fechaAltaTratamiento', 'DESC');
        return $this->findAll();
    }



}

?>