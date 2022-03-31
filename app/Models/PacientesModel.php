<?php
namespace App\Models;
use CodeIgniter\Model;

class PacientesModel extends Model
{
    protected $table      = 'tbpaciente';
    protected $primaryKey = 'idPaciente';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombrePaciente', 'apellidoPaciente', 'fechaNacimientoPaciente', 'telefonoPaciente', 'correoPaciente', 'identificacionPaciente', 'direccionPaciente', 'generoPaciente', 'activoPaciente'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaPaciente';
    protected $updatedField  = 'fechaEditPaciente';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function listarFiltrosAnamnesisRealizadas($idTratamiento, $fechaInicio, $fechaFin){
        $this->select('distinct(a.idPaciente), nombrePaciente, apellidoPaciente');
        $this->join('tbanamnesis as a', 'a.idPaciente = tbPaciente.idPaciente');
        $this->where('a.fechaAltaAnamnesis>"'.$fechaInicio.'"');
        $this->where('a.fechaAltaAnamnesis<"'.$fechaFin.'"');
        return $this->findAll();
    }

    public function listarFiltrosDiagnosticosRealizadas($idTratamiento, $fechaInicio, $fechaFin){
        $this->select('distinct(d.idPaciente), nombrePaciente, apellidoPaciente');
        $this->join('tbdiagnostico as d', 'd.idPaciente = tbPaciente.idPaciente');
        $this->where('d.fechaAltaDiagnostico>"'.$fechaInicio.'"');
        $this->where('d.fechaAltaDiagnostico<"'.$fechaFin.'"');
        return $this->findAll();
    }

    public function listarFiltrosTratamientosRealizadas($idTratamiento, $fechaInicio, $fechaFin){
        $this->select('distinct(t.idPaciente), nombrePaciente, apellidoPaciente');
        $this->join('tbtratamiento as t', 't.idPaciente = tbPaciente.idPaciente');
        $this->where('t.fechaAltaTratamiento>"'.$fechaInicio.'"');
        $this->where('t.fechaAltaTratamiento<"'.$fechaFin.'"');
        return $this->findAll();
    }

    public function listarFiltrosProcedimientossRealizadas($fechaInicio, $fechaFin){
        $this->select('distinct(t.idPaciente), nombrePaciente, apellidoPaciente');
        $this->join('tbtratamiento as t', 't.idPaciente = tbPaciente.idPaciente');
        $this->join('tbprocedimientosrealizados as p', 't.idTratamiento = p.idTratamiento');
        $this->where('p.fechaAltaProcedimientosRealizados>"'.$fechaInicio.'"');
        $this->where('p.fechaAltaProcedimientosRealizados<"'.$fechaFin.'"');
        return $this->findAll();
    }
    
}

?>