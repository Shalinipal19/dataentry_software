<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FormData;
use App\Models\Field;
use App\Models\Category;


class FormDataController extends BaseController
{
    public function index()
    {
        $userId = session()->get('loggedInAdminId');  
        $roleId = session()->get('role');  
        $db = \Config\Database::connect();

        $menu = $db->table('menus')->where('slug','formdata')->get()->getRow();

        if($roleId == 1){
            $permission = (object)[
                'can_add'=>1,
                'can_edit'=>1,
                'can_delete'=>1,
                'can_status'=>1
            ];
        } else {
            $permission = $db->table('permissions')->where('user_id',$userId)->where('menu_id',$menu->id)->get()->getRow();

            if(!$permission){
                $permission = (object)[
                    'can_add'=>0,
                    'can_edit'=>0,
                    'can_delete'=>0,
                    'can_status'=>0
                ];
            }
        }
        $formModel=new FormData();
        $data['getData'] = $formModel->getFormWithCategory();
        $data['permission'] = $permission;
        return view('admin/pages/formdata/index',$data);
    }

    public function addData()
    {
        $formModel     = new FormData();
        $categoryModel = new Category();
        $fieldModel    = new Field();

        $data['getCategories'] = $categoryModel->findAll();

        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();
            
            // Validate category
            if (!$this->validate(['category_id' => 'required|integer'])) {
                return redirect()->back()->withInput()->with('error', 'Please select a category!');
            }

            $category = $categoryModel->find($postData['category_id']);
            if (!$category) {
                return redirect()->back()->withInput()->with('error', 'Invalid Category Selected!');
            }

            $fields = $postData['fields'] ?? [];

            if (empty($fields)) {
                return redirect()->back()->withInput()->with('error', 'No field values submitted!');
            }

            foreach ($fields as $field_id => $value) {
                $field = $fieldModel->find($field_id);
                $field_label = $field ? $field['field_name'] : ''; 

                $dataArray = [
                    'category_id' => $postData['category_id'],
                    'field_id'    => $field_id,
                    'field_label' => $field_label,
                    'form_data'   => $value,
                    'status'      => 1,
                ];
          

                $formModel->insert($dataArray);
            }

            return redirect()->to('admin/formdata')->with('success', 'FormData added successfully!');
        }

        $data['getFields'] = $fieldModel->findAll();
        return view('admin/pages/formdata/add-data', $data);
    }

    public function editData($id)
    {
        $formModel     = new FormData();
        $categoryModel = new Category();
        $fieldModel    = new Field();

        $data['getCategories'] = $categoryModel->findAll();

        $data['getData'] = $formModel->find($id);
        if (!$data['getData']) {
            return redirect()->to('admin/formdata')->with('error', 'Record not found!');
        }
            $selectedCategoryId = $data['getData']['category_id'];
            $data['getFields'] = $fieldModel->where('category_id', $selectedCategoryId)->findAll();

        $data['getData'] = $formModel->find($id);
        if (!$data['getData']) {
            return redirect()->to('admin/formdata')->with('error', 'Record not found!');
        }

        $formFields = $formModel->where('category_id', $data['getData']['category_id'])->findAll();

        $formDataArray = [];
        foreach ($formFields as $fld) {
            $formDataArray[$fld['id']] = [
                'field_id' => $fld['field_id'],
                'form_data' => $fld['form_data']
            ];
        }

        $data['form'] = $data['getData'];
        $data['form']['fields'] = $formDataArray;

        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();

            $fields = $postData['fields'] ?? [];

            foreach ($fields as $row_id => $value) {
                $formModel->update($row_id, ['form_data' => $value]);
            }

            return redirect()->to('admin/formdata')->with('success', 'FormData updated successfully!');
        }

        return view('admin/pages/formdata/edit-data', $data);
    }

    public function getFieldsByCategory($category_id)
    {   
        $fieldModel = new Field();
        $fields = $fieldModel->where('category_id', $category_id)->findAll();
        return $this->response->setJSON($fields);
    }




}
