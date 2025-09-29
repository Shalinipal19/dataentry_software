<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            
            'company_name' => 'Data Entry Software',
            'company_email' => 'info@dataentry.com',
            'company_contact' => '1236547893',
            'company_whatsapp' => '1236547893',
            'company_address' => 'Lucknow , Uttar Pradesh , India',
            'facebook_link' => '',
            'instagram_link' => '',
            'linkedin_link' => '',
            'youtube_link' => '',
            'twitter_link' => '',
            'company_logo' => '',
            'company_favicon' => ''
            
            
        );
        
        $this->db->table('company_profiles')->insert($data);
    
    }
}
