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

        return view('employee.employee', compact('data'));
    }

    public function detailEmployee($id)
    {
        $data = Employee::find($id);

        return view('employee.detailEmployee', compact('data'));
    }

    public function addEmployee()
    {
        return view("employee.addEmployee");
    }

    public function editEmployee()
    {
        return view('editEmployee');
    }

    public function createEmployee(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'gender' => 'required|in:man,woman',
                'email' => 'required|email',
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you only want image files (adjust as needed)
            ]);

            // Create a new employee record
            $data = Employee::create($validatedData);

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $uploadedFile = $request->file('photo');
                $fileName = $uploadedFile->getClientOriginalName();

                // Move the uploaded file to the desired location
                $uploadedFile->move('media/employees/', $fileName);

                // Save the file name to the employee record
                $data->photo = $fileName;
                $data->save();
            }

            return redirect()->route('Employee')->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return redirect()->route('Employee')->with('error', 'Error creating employee: ' . $e->getMessage());
        }
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
        $dateGenerated = now()->format('Y-m-d');
        $employeeName = $data->name;

        // Check if the user has a photo
        $photoPath = public_path('media/employees/') . $data->photo;
        $photoExists = file_exists($photoPath);

        // SVG for placeholder background
        $placeholderSvg = '<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="2048" height="2048" style="shape-rendering:geometricPrecision;text-rendering:geometricPrecision;image-rendering:optimizeQuality;fill-rule:evenodd;clip-rule:evenodd"><defs><style>.fil0,.fil1{fill:#424242}.fil1{fill-rule:nonzero}</style></defs><g id="Layer_x0020_1"><path class="fil0" d="M1270.3 1007.71v171.985c0 20.054 7.416 37.502 24.385 48.806 11.381 7.579 25.355 11.163 38.952 11.163 35.953.001 63.341-22.554 63.341-59.969v-169.429c0-47.031-9.718-93.223-28.48-136.339-34.317-78.865-83.8-130.05-161.767-166.188-29.623-13.73-60.972-23.719-92.956-30.215-5.758-1.17-11.195-.96-16.738 1.04-16.673 6.016-33.22 28.652-43.78 42.271-4.894 6.313-9.787 12.627-14.688 18.937-5.725 7.367-10.975 16.262-22.378 16.35-11.818.094-16.82-8.531-22.622-16.294-4.448-5.95-8.908-11.889-13.506-17.724-10.357-13.146-26.65-35.077-42.867-40.831-5.786-2.053-11.405-2.09-17.35-.673-29.29 6.982-57.855 17.058-84.95 30.208-74.849 36.326-122.192 86.821-155.392 163.12-18.762 43.116-28.48 89.307-28.48 136.339v169.429c0 20.054 7.416 37.503 24.386 48.805 11.38 7.58 25.355 11.164 38.953 11.164 35.952 0 63.34-22.556 63.34-59.97v-169.428c0-37.636 10.99-59.558 27.048-93.591 59.157-125.38 45.407 56.737 45.407 87.961v177.04h347.685v-237.04c0-144.819 64.54 32.604 72.457 63.074zm-420.142 205.967v527.917c0 10.804 3.313 20.56 10.122 28.964 9.743 12.021 25.023 19.338 40.017 22.121 16.147 2.998 34.793 1.225 48.7-8.105 14.787-9.919 20.114-25.729 20.114-42.98v-303.83c0-146.322 109.78-148.33 109.78 3.124v300.705c0 13.225 4.204 24.957 13.905 34.128 11.814 11.169 29.168 16.144 45.137 16.28 31.148.267 59.91-16.386 59.91-50.408v-527.917H850.158z"/></g><path style="fill:none" d="M0 0h2048v2048H0z"/></svg>';

        // Encode the user image as base64
        $photoBase64 = null;
        if ($photoExists) {
            $photoContent = file_get_contents($photoPath);
            $photoBase64 = 'data:image/png;base64,' . base64_encode($photoContent);
        }

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
                .employee-photo {
                    width: 150px;
                    height: 150px;
                    margin: 0 auto;
                    border-radius: 50%;
                    overflow: hidden;
                    background-color: #f2f2f2; /* Gray background */
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Employee Data Report</h1>
            </div>
            <div class="employee-photo">';

        // Check if the user has a photo
        if ($photoExists) {
            $html .= '<img src="' . $photoBase64 . '" alt="Employee Photo" style="width: 100%; height: 100%;">';
        } else {
            $html .= $placeholderSvg; // Render placeholder SVG
        }

        $html .= '</div>
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
