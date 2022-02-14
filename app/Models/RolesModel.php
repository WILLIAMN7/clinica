<?php
namespace App\Models;
use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $table      = 'tbroles';
    protected $primaryKey = 'idRoles';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombreRoles', 'activoRoles'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaRoles';
    protected $updatedField  = 'fechaEditRoles';
    //protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>