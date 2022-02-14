<?php
namespace App\Models;
use CodeIgniter\Model;

class CodigosCieModel extends Model
{
    protected $table      = 'tbCodigosCie';
    protected $primaryKey = 'idCodigosCie';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['descripcionCodigosCie', 'codigoCodigosCie', 'tipoCodigosCie', 'activoCodigosCie'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaCodigosCie';
    protected $updatedField  = 'fechaEditCodigosCie';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}

?>