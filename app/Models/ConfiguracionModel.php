<?php
namespace App\Models;
use CodeIgniter\Model;

class ConfiguracionModel extends Model
{
    protected $table      = 'tbconfiguracion';
    protected $primaryKey = 'idConfiguracion';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombreConfiguracion', 'valorConfiguracion'];

    protected $useTimestamps = true;
    protected $createdField  = null;
    protected $updatedField  = null;
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>