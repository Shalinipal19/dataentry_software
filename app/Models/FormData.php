<?php

namespace App\Models;

use CodeIgniter\Model;

class FormData extends Model
{
    protected $table = 'form_data';
    protected $primaryKey  = 'id';
   
    protected $returnType = 'array';
    
    protected $allowedFields = ['category_id','field_id','field_label' ,'form_data','status', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // FormData Model
    public function getFormWithCategory($limit = null)
    {
        $builder = $this->db->table('form_data')
            ->select('form_data.*, categories.category_name, fields.field_name')
            ->join('categories', 'categories.id = form_data.category_id', 'left')
            ->join('fields', 'fields.id = form_data.field_id', 'left')
            ->orderBy('form_data.id','DESC');

        if ($limit) {
            $builder->limit($limit);
        }
        return $builder->get()->getResultArray();
    }

    public function getCategoryWiseCount()
    {
        return $this->db->table('form_data')
            ->select('categories.category_name, COUNT(form_data.id) as total_entries')
            ->join('categories', 'categories.id = form_data.category_id', 'left')
            ->where('form_data.status', 1)
            ->groupBy('form_data.category_id')
            ->get()
            ->getResultArray();
    }



}