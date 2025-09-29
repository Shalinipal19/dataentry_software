<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    
    protected $allowedFields    = ['product_name','category_id','price','discount','discount_type','offer_price','size','weight','image','description','status',];


    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProductsWithCategory()
    {
        return $this->select('products.*, categories.category_name')
                    ->join('categories', 'categories.id = products.category_id', 'left')
                    ->findAll();
    }
    
}
