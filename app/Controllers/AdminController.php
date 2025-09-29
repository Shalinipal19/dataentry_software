<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CIAuth;
use App\Models\Admin;
use App\Models\CompanyProfile;
use App\Models\FormData;
use App\Models\Category;
use App\Models\Permission;

helper('form');

class AdminController extends BaseController
{
    protected $helpers = ['url','form'];
    
    public function dashboard()
    {
        $formDataModel = new FormData();
        $entries = $formDataModel->getFormWithCategory(5);

        $categoryModel = new Category();
        $categoryCount = $categoryModel->select('COUNT(*) as total')->where('status', 1)
            ->get()
            ->getRowArray()['total'];
                
        $categoryWise = $formDataModel->getCategoryWiseCount();
        return view('admin/pages/home', ['entries' => $entries,'categoryCount' => $categoryCount
            ,'categoryWise' => $categoryWise]);
    }

    public function companyProfile()
    {
        $data=[
            'pageTitle' => 'Company Profile',
        ];

        $companyModel=new CompanyProfile();
        $getData=$companyModel->findAll();
        return view('admin/pages/company-profile', compact('getData', 'data'));
    }

    public function editCompanyProfile()
    {
        $companyModal = new CompanyProfile();
        $getData = $companyModal->find(1); 

        if($this->request->getMethod() == 'POST'){
            $data = [
                'company_name' => $this->request->getVar('company_name'),
                'company_email' => $this->request->getVar('company_email'),
                'company_contact' => $this->request->getVar('company_contact'),
                'company_whatsapp' => $this->request->getVar('company_whatsapp'), 
                'company_address' => $this->request->getVar('company_address'),
                'facebook_link' => $this->request->getVar('facebook_link'),
                'instagram_link' => $this->request->getVar('instagram_link'),
                'twitter_link' => $this->request->getVar('twitter_link'),
                'youtube_link' => $this->request->getVar('youtube_link'),
                'linkedin_link' => $this->request->getVar('linkedin_link')
            ];

            $logoFile = $this->request->getFile('company_logo');
            if ($logoFile && $logoFile->isValid() && ! $logoFile->hasMoved()) {
                $logoName = $logoFile->getRandomName();
                $logoFile->move('public/assets/uploads/logo/', $logoName);
                $data['company_logo'] = $logoName;
                
            }

            $faviconFile = $this->request->getFile('company_favicon');
            if ($faviconFile && $faviconFile->isValid() && ! $faviconFile->hasMoved()) {
                $faviconName = $faviconFile->getRandomName();
                $faviconFile->move('public/assets/uploads/logo/', $faviconName);
                $data['company_favicon'] = $faviconName;
            }
            
            if($getData){
                $companyModal->update(1, $data);
                session()->setFlashdata('success', 'Company details updated successfully!');
            } else { 
                $companyModal->insert($data);
                session()->setFlashdata('success', 'Company details added successfully!');
            }

            return redirect()->to('admin/edit-company-profile');
        }
        return view('admin/pages/edit-company-profile', ['getData' => $getData]);
    }

    public function index()
    {
        $adminModel = new Admin();
        $data['getData'] = $adminModel->where('role', 2)->orderBy('id','DESC')->findAll();
        
        return view('admin/pages/subadmin/index', $data);
    }

    public function addData()
    {
        $adminModel = new Admin();

        if ($this->request->getMethod() == 'POST') {
            $postData = $this->request->getPost();
       
            $rules = [
                'name' => 'required',
                'email'  => 'required|valid_email|is_unique[admins.email]',
                'password' => 'required', 
            ];
            
            // if (!$this->validate($rules)) {
            //      return redirect()->back()->withInput()->with('error', 'Please check the form and try again.');
            // }
            $dataArray = [
                'name' => $postData['name'],
                'email' => $postData['email'],
                'password' => password_hash($postData['password'], PASSWORD_DEFAULT),
                'role' => 2
            ];

            $adminModel->save($dataArray);
            
            $userId = $adminModel->getInsertID();
            $permissions = $postData['permissions'] ?? [];
            // echo '<pre>';
            //     print_r($permissions);
            // echo '</pre>';
            //     die;
            $permModel = new Permission();
            $session = session();
            $loggedInId = $session->get('loggedInAdminId');
            $userMenus  = $permModel->getUserMenus($loggedInId);

                $menuIds = [
                'category' => 1,
                'field' => 2,
                'formdata'   => 3,
                // 'report' => 4,
            ];
            foreach($permissions as $slug => $actions) {
                $menuId = $menuIds[$slug] ?? 0;
                if($menuId == 0) continue;

                $permModel->insert([
                    'user_id'    => $userId,
                    'menu_id'    => $menuId,
                    'can_add'    => isset($actions['add']) ? 1 : 0,
                    'can_edit'   => isset($actions['edit']) ? 1 : 0,
                    'can_delete' => isset($actions['delete']) ? 1 : 0,
                    'can_status' => isset($actions['status']) ? 1 : 0,
                ]);
            }
            return redirect()->to('admin/subadmin')->with('success', 'Sub Admin details Added Successfully');
        }
            $menus = [
            ['name'=>'Category', 'slug'=>'category'],
            ['name'=>'Field', 'slug'=>'field'],
            ['name'=>'Form Data', 'slug'=>'formdata'],
            // ['name'=>'Report and Search', 'slug'=>'report'],
        ];
        return view('admin/pages/subadmin/add-data', compact('menus'));
    }

    public function editData($id = null)
    {
        $adminModel = new Admin();
        if ($id === null || !$adminModel->find($id)) {
            return redirect()->to('admin/subadmin')->with('error', 'Invalid Category ID!');
        }
        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();
            $rules = [
                'name'  => 'required',
                'email' => 'required|valid_email',
                ];
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Please check the form fields.');
            }

            $dataArray = [
                'name' => $postData['name'],
                'email' => $postData['email'],
                'role' => 2
            ];
            if (!empty($postData['password'])) {
                $dataArray['password'] = password_hash($postData['password'], PASSWORD_DEFAULT);
            }

            $adminModel->update($id, $dataArray);
                return redirect()->to('admin/subadmin')->with('success', 'Sub Admin updated successfully!');
            }
            $getData = $adminModel->find($id);
        return view('admin/pages/subadmin/edit-data', compact('getData'));
    }

    public function logoutHandler()
    {
        CIAuth::forget();
        return redirect()->route('admin.login.form')->with('fail','You are logged out!');
    }
}
