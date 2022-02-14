<?php
namespace App\Models;
use CodeIgniter\Model;

class PiezaDentalModel extends Model
{
    protected $table      = 'tbPiezaDental';
    protected $primaryKey = 'idPiezaDental';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombrePiezaDental', 'numeroPiezaDental', 'aplicaMovilidadRecesionPiezaDental', 'activoPiezaDental'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaPiezaDental';
    protected $updatedField  = 'fechaEditPiezaDental';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>