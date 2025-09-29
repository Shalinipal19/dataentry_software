<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    
    protected $returnType       = 'array';
    
    protected $allowedFields    = ['category_name','status','created_at','updated_at'];

    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}