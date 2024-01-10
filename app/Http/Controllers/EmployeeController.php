<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class EmployeeController extends Controller
{
    public function index()
    {
        $data = Employee::all();

        return view('Employee', compact('data'));
    }

    public function detailEmployee($id)
    {
        $data = Employee::find($id);

        return view('detailEmployee', compact('data'));
    }

    public function addEmployee()
    {

        return view("addEmployee");
    }

    public function editEmployee()
    {
        return view('editEmployee');
    }

    public function createEmployee(Request $request)
    {
        Employee::create($request->all());

        return redirect()->route('Employee')->with('success', 'Date created successfully');
    }

    public function deleteEmployee($id)
    {
        $data = Employee::find($id);

        $data->delete();

        return redirect()->route('Employee')->with('success', 'Date deleted successfully');
    }

    public function updateEmployee(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());
        return redirect()->route('Employee')->with('success', 'Data Successfully Updated');
    }

    public function pdfEmployee($id)
    {
        $data = Employee::find($id);
        $dateGenerated = Carbon::now()->format('Y-m-d');
        $employeeName = $data->name;

        $html = '<html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                h1 {
                    color: #333;
                    font-size: 24px;
                    text-align: center;
                    margin-bottom: 30px;
                }
                .employee-info {
                    border-collapse: collapse;
                    width: 100%;
                }
                .employee-info th, .employee-info td {
                    border: 1px solid #ccc;
                    padding: 8px;
                }
                .employee-info th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Employee Data Report</h1>
            </div>
            <table class="employee-info">
                <tr>
                    <th>ID</th>
                    <td>' . $data->id . '</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>' . $data->name . '</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>' . $data->gender . '</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>' . $data->created_at . '</td>
                </tr>
            </table>
        </body>
    </html>';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        $fileName = "employee_report_$employeeName-$dateGenerated.pdf";

        return $pdf->download($fileName);
    }
}
