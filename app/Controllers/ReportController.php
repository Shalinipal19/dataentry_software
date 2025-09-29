<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\FormData;
use App\Models\Category;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

helper('form');

class ReportController extends BaseController
{
     protected $helpers = ['url','form','company_helper'];

    public function index()
    {
        $categoryModel = new Category();
        $data['categories'] = $categoryModel->findAll();
        $data['reports'] = [];
        return view('admin/pages/report/index', $data);
    }

    public function search()
    {
        $model = new FormData();
        $categoryModel = new Category();
        $data['categories'] = $categoryModel->findAll();

        $selectedYear  = $this->request->getPost('selected_year'); 
        $selectedMonth = $this->request->getPost('selected_month');
        $start_date    = $this->request->getPost('start_date');
        $end_date      = $this->request->getPost('end_date');
        $yearType      = $this->request->getPost('year');
        $category_id   = $this->request->getPost('category_id');
        $field_value   = $this->request->getPost('field_value');

        $data['reports'] = [];

        if (!empty($selectedYear) || !empty($selectedMonth) || !empty($start_date) || 
            !empty($end_date) || !empty($yearType) || !empty($category_id) || !empty($field_value)) {

            $builder = $model->builder();
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

            $data['reports'] = $builder->orderBy('form_data.id', 'DESC')->limit(1000)->get()->getResultArray();
        }

        $data['yearType']      = $yearType;
        $data['selected_year'] = $selectedYear;
        $data['selected_month']= $selectedMonth;
        $data['start_date']    = $start_date;
        $data['end_date']      = $end_date;
        $data['category_id']   = $category_id;
        $data['field_value']   = $field_value;

        return view('admin/pages/report/index', $data);
    }

    public function exportExcel()
    {
        $filters = $this->request->getVar();
        $model = new FormData();
        $builder = $model->builder();

        $builder->select('form_data.*, categories.category_name, fields.field_name')
                ->join('categories', 'categories.id = form_data.category_id', 'left')
                ->join('fields', 'fields.id = form_data.field_id', 'left');

        if (!empty($filters['year'])) {
            if ($filters['year'] == "0" && !empty($filters['selected_year'])) {
                $builder->where("YEAR(form_data.created_at)", $filters['selected_year']);
            } elseif ($filters['year'] == "1" && !empty($filters['selected_year']) && !empty($filters['selected_month'])) {
                $builder->where("YEAR(form_data.created_at)", $filters['selected_year']);
                $builder->where("MONTH(form_data.created_at)", $filters['selected_month']);
            } elseif ($filters['year'] == "2" && !empty($filters['start_date']) && !empty($filters['end_date'])) {
                $builder->where("DATE(form_data.created_at) >=", $filters['start_date']);
                $builder->where("DATE(form_data.created_at) <=", $filters['end_date']);
            }
        }

        if (!empty($filters['category_id'])) {
            $builder->where("form_data.category_id", $filters['category_id']);
        }

        if (!empty($filters['field_value'])) {
            $builder->groupStart()
                    ->like("form_data.form_data", $filters['field_value'])
                    ->orLike("fields.field_name", $filters['field_value'])
                    ->orLike("categories.category_name", $filters['field_value'])
                    ->groupEnd();
        }

        $reports = $builder->orderBy('form_data.id', 'DESC')->get()->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'Category');
        $sheet->setCellValue('C1', 'Field');
        $sheet->setCellValue('D1', 'Data');

        $row = 2;
        foreach ($reports as $key => $report) {
            $sheet->setCellValue('A'.$row, $key + 1);
            $sheet->setCellValue('B'.$row, $report['category_name'] ?? '');
            $sheet->setCellValue('C'.$row, $report['field_name'] ?? '');
            $sheet->setCellValue('D'.$row, $report['form_data'] ?? '');
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        if (ob_get_length()) ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reports.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function exportPdf()
    {
        $builder = getFilteredQuery();
        $reports = $builder->orderBy('form_data.id', 'DESC')->get()->getResultArray();

        $html = '<h2>Reports</h2>
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                <tr><th>#</th><th>Category</th><th>Field</th><th>Data</th></tr>';

        foreach ($reports as $key => $row) {
            $html .= '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$row['category_name'].'</td>
                        <td>'.$row['field_name'].'</td>
                        <td>'.$row['form_data'].'</td>
                    </tr>';
        }
        $html .= '</table>';
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('reports.pdf', 'D');
    }



}
