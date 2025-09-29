<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    
    protected $allowedFields    = ['name', 'email', 'password', 'picture', 'role','status','created_at', 'updated_at'];

    

    // Validation
    protected $validationRules      = [];
    
}
