<?php
namespace App\Models;
use CodeIgniter\Model;

class LogsModel extends Model
{
    protected $table      = 'tblogs';
    protected $primaryKey = 'idLogs';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idUsuarioLogs', 'eventoLogs', 'ipLogs', 'detallesLogs'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaLogs';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>