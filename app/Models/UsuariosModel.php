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
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function listarUsuarios(){
        $this->select('*');
        $this->join('tbroles AS r', 'tbusuario.idRolUsuario = r.idRoles');
        $this->where('tbusuario.activoUsuario', 1);
        return $this->findAll();
    }
}

?>