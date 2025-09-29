<?php

namespace App\Models;

use CodeIgniter\Model;

class Permission extends Model
{
    protected $table            = 'permissions';
    protected $primaryKey       = 'id';
    
    protected $returnType       = 'array';
   
    protected $allowedFields    = ['user_id',
        'menu_id',
        'can_add',
        'can_edit',
        'can_delete',
        'can_status'];

   
    // Dates
    protected $useTimestamps = true;
   
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUserMenus($userId)
    {
        return $this->select('menus.*')
                    ->join('menus', 'menus.id = permissions.menu_id')
                    ->where('permissions.user_id', $userId)
                    ->findAll();
    }
   
}
