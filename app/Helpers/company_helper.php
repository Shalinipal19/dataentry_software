<?php 

use App\Models\FormData;
use App\Models\Permission;

function getCompanyData($col)
{
    $db = \Config\Database::connect();
    $getData = $db->table('company_profiles')->select($col)->get()->getRowArray();
    return $getData[$col] ?? 'N/A';
}

function getFilteredQuery()
    {
        $model = new FormData();
        $builder = $model->builder();
        $request = \Config\Services::request();

        $selectedYear  = $request->getPost('selected_year'); 
        $selectedMonth = $request->getPost('selected_month');
        $start_date    = $request->getPost('start_date');
        $end_date      = $request->getPost('end_date');
        $yearType      = $request->getPost('year');
        $category_id   = $request->getPost('category_id');
        $field_value   = $request->getPost('field_value');

        $builder->select('form_data.*, categories.category_name, fields.field_name')
                ->join('categories', 'categories.id = form_data.category_id', 'left')
                ->join('fields', 'fields.id = form_data.field_id', 'left');

        if ($yearType == "0" && !empty($selectedYear)) {
            $builder->where("YEAR(form_data.created_at)", $selectedYear);
        } elseif ($yearType == "1" && !empty($selectedYear) && !empty($selectedMonth)) {
            $builder->where("YEAR(form_data.created_at)", $selectedYear);
            $builder->where("MONTH(form_data.created_at)", $selectedMonth);
        } elseif ($yearType == "2" && !empty($start_date) && !empty($end_date)) {
            $builder->where("DATE(form_data.created_at) >=", $start_date);
            $builder->where("DATE(form_data.created_at) <=", $end_date);
        }

        if (!empty($category_id)) {
            $builder->where("form_data.category_id", $category_id);
        }

        if (!empty($field_value)) {
            $builder->groupStart()
                ->like("form_data.form_data", $field_value)
                ->orLike("fields.field_name", $field_value)
                ->orLike("categories.category_name", $field_value)
                ->groupEnd();
        }

        return $builder;
    }

    function getSidebarMenus()
    {
        $session = session();

        if ($session->get('role') == 1) {
            return [
                ['name' => 'Dashboard', 'slug' => 'home'],
                ['name' => 'Sub Admin', 'slug' => 'subadmin'],
                ['name' => 'Category', 'slug' => 'category'],
                ['name' => 'Field List', 'slug' => 'field'],
                ['name' => 'Data Entry List', 'slug' => 'formdata'],
                ['name' => 'Report and Search', 'slug' => 'report'],
            ];
        } elseif ($session->get('role') == 2) {
            $permModel = new Permission();
            $userMenus = $permModel->getUserMenus($session->get('loggedInAdminId'));
            array_unshift($userMenus, ['name' => 'Dashboard', 'slug' => 'home']);
            $userMenus[] =  ['name' => 'Report and Search', 'slug' => 'report'];
            return $userMenus;
        }

        return [];
    }