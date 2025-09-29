<?php

namespace App\Models;

use CodeIgniter\Model;

class Field extends Model
{
    protected $table            = 'fields';
    protected $primaryKey       = 'id';
    
    protected $returnType       = 'array';
    
    protected $allowedFields    = ['field_name','category_id','field_type','status','created_at','updated_at'];

    

    // Dates
    protected $useTimestamps = true;
   
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getFieldWithCategory()
    {
        return $this->select('fields.*, categories.category_name')
            ->join('categories', 'categories.id = fields.category_id', 'left')->orderBy('fields.id','DESC')
                    ->findAll();
    }
}