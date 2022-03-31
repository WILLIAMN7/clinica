<?php
namespace App\Models;
use CodeIgniter\Model;

class SignosVitalesModel extends Model
{
    protected $table      = 'tbsignosvitales';
    protected $primaryKey = 'idSignosVitales';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idAnamnesis', 'presionArterialSistolicaSignosVitales', 'presionArterialDiastolicaSignosVitales', 'frecuenciaCardiacaSignosVitales', 'frecuenciaRespiratoriaSignosVitales', 'temperaturaSignosVitales', 'pesoSignosVitales', 'tallaSignosVitales', 'activoSignosVitales'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaSignosVitales';
    protected $updatedField  = 'fechaEditSignosVitales';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>