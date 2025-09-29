<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::loginForm', ['as' => 'admin.login.form']);

// Redirect /admin to /admin/login
$routes->get('admin', function () {
    return redirect()->to('admin/login');
});

$routes->group('admin',static function($routes)
{

    $routes->group('',['filter'=>'cifilter:guest'], static function($routes){
        // $routes->view('example-auth','example-auth');
        $routes->get('/','AuthController::loginForm',['as'=>'admin.login.form']);
        $routes->get('login','AuthController::loginForm');
        $routes->post('login','AuthController::loginHandler',['as'=>'admin.login.handler']);
    });
    
    $routes->group('',['filter'=>'cifilter:auth'], static function($routes){
        // $routes->view('example-page','example-page');
        $routes->get('home','AdminController::dashboard',['as'=>'admin.home']);
        $routes->match(['get', 'post'],'change-password','AuthController::changePassword',['as'=>'admin.change.form']);
        $routes->get('company-profile','AdminController::companyProfile',['as'=>'admin.company.profile']);
        $routes->match(['get','post'],'edit-company-profile','AdminController::editCompanyProfile',['as'=>'admin.edit.company.profile']);

        $routes->get('subadmin','AdminController::index',);
        $routes->match(['get','post'],'add-subadmin','AdminController::addData');
        $routes->match(['get','post'],'subadmin/edit-data/(:num)','AdminController::editData/$1');
        // $routes->match(['get','post'],'subadmin/edit-data/(:num)','AdminController::editData');
        
        $routes->get('category','CategoryController::index',['as'=>'admin.category']);
        $routes->match(['get','post'],'category/add-data','CategoryController::addData');
        $routes->match(['get','post'],'category/edit-data/(:num)','CategoryController::editData/$1');

        $routes->get('field','FieldController::index',['as'=>'admin.field']);
        $routes->match(['get','post'],'field/add-data','FieldController::addData');
        $routes->match(['get','post'],'field/edit-data/(:num)','FieldController::editData/$1');

        $routes->get('formdata','FormDataController::index',['as'=>'admin.form.data']);
        $routes->match(['get','post'],'formdata/add-data','FormDataController::addData');
        $routes->match(['get','post'],'formdata/edit-data/(:num)','FormDataController::editData/$1');
        $routes->get('get-fields/(:num)', 'FormDataController::getFieldsByCategory/$1');

        $routes->get('report','ReportController::index',['as'=>'admin.report']);
        $routes->post('reports/search','ReportController::search');

        $routes->post('reports/exportExcel', 'ReportController::exportExcel');
        $routes->post('reports/exportPdf', 'ReportController::exportPdf');

        $routes->get('product','ProductController::index',['as'=>'admin.product']);
        $routes->match(['get','post'],'product/add-data','ProductController::addData');
        $routes->match(['get','post'],'product/edit-data/(:num)','productController::editData/$1');

        $routes->get('logout','AdminController::logoutHandler',['as'=>'admin.logout']);

        $routes->get('change-status','CommonAjaxController::toggleStatus');
        $routes->get('delete-data','CommonAjaxController::deleteData');
    });

    
});