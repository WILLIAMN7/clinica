<?php
namespace App\Models;
use CodeIgniter\Model;

class PermisosModel extends Model
{
    protected $table      = 'tbpermisos';
    protected $primaryKey = 'idPermisos';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombrePermisos', 'tipoPermisos'];

    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>