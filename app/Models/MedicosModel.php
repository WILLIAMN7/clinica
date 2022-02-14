<?php
namespace App\Models;
use CodeIgniter\Model;

class MedicosModel extends Model
{
    protected $table      = 'tbmedico';
    protected $primaryKey = 'idMedico';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombreMedico', 'apellidoMedico', 'fechaNacimientoMedico', 'telefonoMedico', 'correoMedico', 'identificacionMedico', 'direccionMedico', 'generoMedico', 'activoMedico'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaMedico';
    protected $updatedField  = 'fechaEditMedico';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>