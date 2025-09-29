<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyProfile extends Model
{
    protected $table            = 'company_profiles';
    protected $primaryKey       = 'id';
    
    protected $returnType       = 'array';
    
    protected $allowedFields    = ['company_name','company_email','company_contact','company_whatsapp','company_address',
    'facebook_link', 'instagram_link', 'linkedin_link', 'youtube_link', 'twitter_link','company_logo','company_favicon' ];


    // Dates
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    

    
}
