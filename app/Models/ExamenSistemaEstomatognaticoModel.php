<?php
namespace App\Models;
use CodeIgniter\Model;

class ExamenSistemaEstomatognaticoModel extends Model
{
    protected $table      = 'tbexamensistemaestomatognatico';
    protected $primaryKey = 'idExamenSistemaEstomatognatico';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idAnamnesis', 'labiosExamenSistemaEstomatognatico', 'mejillasExamenSistemaEstomatognatico', 'maxilarSuperiorExamenSistemaEstomatognatico', 'maxilarInferiorExamenSistemaEstomatognatico', 'lenguaExamenSistemaEstomatognatico', 'paladarExamenSistemaEstomatognatico', 'pisoDeBocaExamenSistemaEstomatognatico', 'carrillosExamenSistemaEstomatognatico', 'glandulasSalivalesExamenSistemaEstomatognatico', 'faringeExamenSistemaEstomatognatico', 'atmExamenSistemaEstomatognatico', 'gangliosExamenSistemaEstomatognatico', 'comentarioExamenSistemaEstomatognatico','activoExamenSistemaEstomatognatico'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaExamenSistemaEstomatognatico';
    protected $updatedField  = 'fechaEditExamenSistemaEstomatognatico';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>