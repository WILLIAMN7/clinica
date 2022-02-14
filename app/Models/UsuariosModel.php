<?php
namespace App\Models;
use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'tbusuario';
    protected $primaryKey = 'idUsuario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['usuarioUsuario', 'passwordUsuario', 'nombreUsuario', 'idMedicoUsuario', 'idRolUsuario', 'activoUsuario'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaUsuario';
    protected $updatedField  = 'fechaEditUsuario';
    //protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>