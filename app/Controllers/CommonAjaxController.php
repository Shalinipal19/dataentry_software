<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Field;
use App\Models\FormData;

class CommonAjaxController extends BaseController
{
    public function toggleStatus()
    {
       $mode=service('request')->getVar('mode');
		$action=service('request')->getVar('action');
        $rowId = service('request')->getVar('rowid');

        $userId = session()->get('loggedInAdminId'); 
        $roleId = session()->get('role'); 
        $db = \Config\Database::connect(); 

        if($roleId != 1){ 
        $menuSlug = $mode; 
        $menu = $db->table('menus')->where('slug', $menuSlug)->get()->getRow();

        $permission = $db->table('permissions')->where('user_id', $userId)
                     ->where('menu_id', $menu->id)->get()->getRow();
        if(!$permission || $permission->can_status != 1){
            return $this->response->setJSON(['error'=>'Permission denied']);
        }
        }
       
        switch($mode){
        case 'subadmin':
            switch($action){
                case"activate":
                        $rowid=service('request')->getVar('rowid');
						$updateArray=array('id' => $rowid,'status' => 1);
						$model=new Admin();
			            $model->save($updateArray);
                    break;
                case"deactivate":
                        $rowid=service('request')->getVar('rowid');
						$updateArray=array('id' => $rowid,'status' => 2);
						$model=new Admin();
			            $model->save($updateArray);
                    break;

                }
            break;

        case 'category':
            switch($action){
                case"activate":
                        $rowid=service('request')->getVar('rowid');
						$updateArray=array('id' => $rowid,'status' => 1);
						$model=new Category();
			            $model->save($updateArray);
                    break;
                case"deactivate":
                        $rowid=service('request')->getVar('rowid');
						$updateArray=array('id' => $rowid,'status' => 2);
						$model=new Category();
			            $model->save($updateArray);
                    break;

                }
            break;
        case 'field':
            switch($action){
                case"activate":
                        $rowid=service('request')->getVar('rowid');
						$updateArray=array('id' => $rowid,'status' => 1);
						$model=new Field();
			            $model->save($updateArray);
                    break;
                case"deactivate":
                        $rowid=service('request')->getVar('rowid');
						$updateArray=array('id' => $rowid,'status' => 2);
						$model=new Field();
			            $model->save($updateArray);
                    break;
            }
            break;
        case 'formdata':
            switch($action){
                case"activate":
                        $rowid=service('request')->getVar('rowid');
						$updateArray=array('id' => $rowid,'status' => 1);
						$model=new FormData();
			            $model->save($updateArray);
                    break;
                case"deactivate":
                        $rowid=service('request')->getVar('rowid');
						$updateArray=array('id' => $rowid,'status' => 2);
						$model=new FormData();
			            $model->save($updateArray);
                    break;
            }
            break;
        }
        $data['action']=$action;
		$data['mode']=$mode;
		$data['rowid'] = $rowId; 
       return view('admin/pages/ajax',$data);
    }

    public function deleteData()
	{
		$mode=service('request')->getVar('mode');
        $rowId = service('request')->getVar('rowid');
        $userId = session()->get('loggedInAdminId'); 
        $roleId = session()->get('role'); 
        $db = \Config\Database::connect();  

        $menuSlug = [
            'subadmin' => 'subadmin', 
            'category' => 'category',
            'field' => 'field',
            'formdata' => 'formdata',
        ];

        if(!isset($menuSlug[$mode])){
            return $this->response->setJSON(['error'=>'Invalid request']);
        }

        if($roleId != 1){
            $menu = $db->table('menus')->where('slug',$menuSlug[$mode])->get()->getRow();
            $permission = $db->table('permissions')->where('user_id',$userId)->where('menu_id',$menu->id)->get()->getRow();

            if(!$permission || $permission->can_delete != 1){
                return $this->response->setJSON(['error'=>'Permission denied']);
            }
        }

		 switch($mode)
		 {

            case "subadmin":
               $rowId=service('request')->getVar('rowid');
	           $model=new Admin();
	           $model->delete($rowId);
		 	break;

		 	case "category":
               $rowId=service('request')->getVar('rowid');
	           $model=new Category();
	           $model->delete($rowId);
		 	break;

            case "field":
               $rowId=service('request')->getVar('rowid');
	           $model=new Field();
	           $model->delete($rowId);
		 	break;

            case "formdata":
               $rowId=service('request')->getVar('rowid');
	           $model=new FormData();
	           $model->delete($rowId);
		 	break;
         }
	}
}

