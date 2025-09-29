<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Field;
use App\Models\Category;

class FieldController extends BaseController
{
    public function index()
    {
        $userId = session()->get('loggedInAdminId');  
        $roleId = session()->get('role');  
        $db = \Config\Database::connect();

        $menu = $db->table('menus')->where('slug','field')->get()->getRow();

        if($roleId == 1){
            $permission = (object)[
                'can_add'=>1,
                'can_edit'=>1,
                'can_delete'=>1,
                'can_status'=>1
            ];
        } else {
            $permission = $db->table('permissions')
                            ->where('user_id',$userId)
                         ->where('menu_id',$menu->id)
                         ->get()
                         ->getRow();

        if(!$permission){
            $permission = (object)[
                'can_add'=>0,
                'can_edit'=>0,
                'can_delete'=>0,
                'can_status'=>0
            ];
        }
        }
            $fieldModel=new Field();
            $data['getData'] = $fieldModel->getFieldWithCategory();
            $data['permission'] = $permission;
        return view('admin/pages/field/index',$data);
    }

    public function addData()
    {
        $fieldModel = new Field();
        $categoryModel = new Category();

        $data['getCategories'] = $categoryModel->findAll();

        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();

             $rules = [
                'field_name' => 'required',
                'field_type'        => 'required',
                'category_id'  => 'required|integer',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Please fill all required fields!');
            }

            $category = $categoryModel->find($postData['category_id']);
            if (!$category) {
                return redirect()->back()->withInput()->with('error', 'Invalid Category Selected!');
            }

            $dataArray = [
                'field_name'  => $postData['field_name'],
                'category_id'   => $postData['category_id'],
                'category'      => $category['category_name'],
                'field_type'    => $postData['field_type'],
                'status'        => 1,
            ];

           $fieldModel->save($dataArray);

            return redirect()->to('admin/field')->with('success', 'Field added successfully!');
        }
        return view('admin/pages/field/add-data' , $data);
    }

    public function editData($id)
    {
        $categoryModel = new Category();
        $fieldModel  = new Field();

        $data['getCategories'] = $categoryModel->findAll();
        $data['getData'] = $fieldModel->find($id);

        if (!$data['getData']) {
            return redirect()->to('admin/field')->with('error', 'Product not found!');
        }

        $data['field'] = $data['getData'];

        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();

            $rules = [
                'field_name' => 'required',
                'field_type' => 'required',
            ];
            
            $category = $categoryModel->find($postData['category_id']);
            if (!$category) {
                return redirect()->back()->withInput()->with('error', 'Invalid Category Selected!');
            }

            $dataArray = [
                'field_name'  => $postData['field_name'],
                'category_id'   => $postData['category_id'],
                'category'      => $category['category_name'],
                'field_type'    => $postData['field_type'],
            ];

            
            $fieldModel->update($id, $dataArray);

            return redirect()->to('admin/field')->with('success', 'Field updated successfully!');
        }

        return view('admin/pages/field/edit-data', $data);
    }
}
