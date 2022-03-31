<?php
namespace App\Models;
use CodeIgniter\Model;

class DetalleRolesPermisosModel extends Model
{
    protected $table      = 'tbdetallerolespermisos';
    protected $primaryKey = 'idDetalleRolesPermisos';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idRolDetalleRolesPermisos', 'idPermisoDetalleRolesPermisos'];

    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function verificaPermisos($idRol, $permiso){
        $tieneAcceso = false;
        $this->select('*');
        $this->join('tbpermisos', 'tbdetallerolespermisos.idPermisoDetalleRolesPermisos = tbpermisos.idPermisos');
        $existe=$this->where(['idRolDetalleRolesPermisos'=>$idRol, 'tbpermisos.nombrePermisos'=>$permiso])->first();
        if($existe!=null){
            $tieneAcceso=true;
        }
        return $tieneAcceso;
    }

    public function verificaMenuPrincipal($idRol){
        $this->select('*');
        $this->join('tbpermisos', 'tbdetallerolespermisos.idPermisoDetalleRolesPermisos = tbpermisos.idPermisos');
        return $this->where(['idRolDetalleRolesPermisos'=>$idRol])->findAll();
    }
}

?>