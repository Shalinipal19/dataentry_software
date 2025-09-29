<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function index()
    {
        $userId = session()->get('loggedInAdminId');  
        $roleId = session()->get('role');  
        $db = \Config\Database::connect();

        $menu = $db->table('menus')->where('slug','category')->get()->getRow();

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

        $categoryModel = new Category();
        $data['getData'] = $categoryModel->orderBy('id', 'DESC')->findAll();
        $data['permission'] = $permission;

        return view('admin/pages/category/index',$data);
    }




    public function addData()
    {
        $categoryModel = new Category();

        if ($this->request->getMethod() == 'POST') {
            $postData = $this->request->getPost();

            $rules = [
            'category_name' => 'required',
            ];
            
            if (!$this->validate($rules)) {
                return redirect()->back()->with('error', 'Category field is required');
            }
            $dataArray = [
                'category_name' => $postData['category_name'],
                'status'        => 1
            ];
            
            $categoryModel->save($dataArray);
            return redirect()->to('admin/category')->with('success', 'Category Added Successfuly');
        }
        $getData = $categoryModel->find(1);
        return view('admin/pages/category/add-data', compact('getData'));
    }

    public function editData($id = null)
    {
        $categoryModel = new Category();
        
        if ($id === null || !$categoryModel->find($id)) {
            return redirect()->to('admin/category')->with('error', 'Invalid Category ID!');
        }
        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();
            $rules = [
                'category_name'=> 'required',
            ];
            if (!$this->validate($rules)) {
                return redirect()->back()->with('error', 'Category field is required');
            }
            $dataArray = [
                'category_name'    => $postData['category_name'],
            ];
            $categoryModel->update($id, $dataArray);
            return redirect()->to('admin/category')->with('success', 'Category updated successfully!');
        }
        $getData = $categoryModel->find($id);
        return view('admin/pages/category/edit-data', compact('getData'));
    }
}
