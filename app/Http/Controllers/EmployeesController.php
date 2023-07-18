<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use \App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    /**
     * Get all employee data and display it
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list() {
        return view('employees.list', [
            'employees' => Employee::all(),
        ]);
    }
    public function edit(Request $request, Employee $employee)
    {
        return view('employees.edit', [
            'filteredData' => $employee,
            'branchOffices' => BranchOffice::all(),
            'existingBranchOffice' => null,
        ]);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'branchOffice' => ['required'],
            'name' => ['required', 'max:60'],
            'position' => ['required', 'max:60'],
            'age' => ['required', 'numeric', 'min:18', 'max:100'],
            'sex' => ['required', Rule::in(['m', 'f'])],
            'email' => ['required', 'email:rfc,dns'],
        ]);

        $employee = new Employee();
        $employee->branch_office = $validatedData['branchOffice'];
        $employee->name = $validatedData['name'];
        $employee->position = $validatedData['position'];
        $employee->age = $validatedData['age'];
        $employee->sex = $validatedData['sex'];
        $employee->email = $validatedData['email'];
        $employee->save();

        return redirect('employees/list/');
    }

    public function delete(Request $request, Employee $employee)
    {
        $employee->delete();

        return redirect('employees/list');
    }
}
