<?php
namespace App\Models;
use CodeIgniter\Model;

class SaludBucalModel extends Model
{
    protected $table      = 'tbsaludbucal';
    protected $primaryKey = 'idSaludBucal';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idAnamnesis', 'enfermedadPeriodontalSaludBucal', 'maloclusionSaludBucal', 'fluorosisSaludBucal', 'higieneOral161755SaludBucal', 'higieneOral112151SaludBucal', 'higieneOral262765SaludBucal', 'higieneOral363775SaludBucal', 'higieneOral314171SaludBucal', 'higieneOral464785SaludBucal', 'activoSaludBucal'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaaltaSaludBucal';
    protected $updatedField  = 'fechaeditSaludBucal	';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}

?>