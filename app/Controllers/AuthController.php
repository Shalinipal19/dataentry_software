<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CIAuth;
use App\Libraries\Hash;
use App\Models\Admin;

class AuthController extends BaseController
{
    protected $helper = ['url','form'];
    public function loginForm()
    {
        $data =[
            'pageTitle' => 'Login',
            'validation' => null
        ];
        return view('admin/pages/auth/login', $data);
    }

    public function loginHandler()
    {
        // echo 'login handler process---';
        $fieldType = filter_var($this->request->getVar('email'),FILTER_VALIDATE_EMAIL) ? 'email' : 'invalid';
        if($fieldType == 'email'){
            $isValid = $this->validate([
                'email' =>[
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Please check email field It does not appear to be valid.'
                    ]
                ],
                'password' =>[
                    'rules' => 'required|min_length[4]|max_length[45]',
                    'errors' =>[
                        'required' => 'Password is required',
                        'min_length' => 'Password must have atleast 4 character in length.',
                        'max_length' => 'Password must not have character more than 45 in length.'
                    ]
                ]
            ]);
        }else{
            return redirect()->to('admin/pages/auth/login')->with('success','Login Sucessfully');
        }
        if( ! $isValid){
        return view('admin/pages/auth/login',[
            'pageTitle'=>'Login',
            'validation'=>$this->validator
        ]);
        } else{
            $admin = new Admin();
            $adminInfo = $admin->where($fieldType,$this->request->getVar('email'))->first();
            if (!$adminInfo) {
                return redirect()->route('admin.login.form')->with('fail', 'Account not found')->withInput();
            }
            $check_password = password_verify($this->request->getVar('password'), $adminInfo['password']);

            if( !$check_password ){
                return redirect()->route('admin.login.form')->with('fail', 'Wrong Password')->withInput();
            }else{
                CIAuth::setCIAuth($adminInfo);
                $session = session();
                $session->set([
                    'loggedInAdminId' => $adminInfo['id'],  
                    'role' => $adminInfo['role'],          
                    'name' => $adminInfo['name'],   
                    'isLoggedIn' => true
                ]);
                if ($adminInfo['role'] == 1) {
                        return redirect()->route('admin.home');
                    } elseif ($adminInfo['role'] == 2) {
                        return redirect()->route('admin.home'); 
                    }
                return redirect()->route('admin.home');
            }
        }
        
    }

    public function changePassword()
    {
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'new_password'     => 'required',
                'confirm_password' => 'required|matches[new_password]'
            ];

            if (!$this->validate($rules)) {
                return view('admin/pages/auth/change-password', [
                    'validation' => $this->validator
                ]);
            }

            $adminId = CIAuth::id(); 
            
            if (!$adminId) {
                return redirect()->back()->with('fail', 'Admin ID not found in session!');
            }

            $new_password = $this->request->getVar('new_password');
            $password_h   = password_hash($new_password, PASSWORD_DEFAULT);

            $adminModel = new Admin();
            $adminModel->update($adminId, ['password' => $password_h]);

            session()->setFlashdata('success', 'Password changed successfully');
            return redirect()->to('admin/change-password');
        }

        return view('admin/pages/auth/change-password');
    }


}
