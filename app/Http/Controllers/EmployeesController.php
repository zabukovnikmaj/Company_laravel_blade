<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use \App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    /**
     * Get all employee data and display it
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $employees = DB::table('employees')
            ->join('branchOffice', 'employees.branch_office', '=', 'branchOffice.uuid')
            ->select('employees.*', 'branchOffice.name AS branchOffice')
            ->get()
            ->toArray();

        return view('employees.list', [
            'employees' => $employees,
        ]);
    }

    /**
     * Displays existing data into form
     *
     * @param Request $request
     * @param Employee $employee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Request $request, Employee $employee)
    {
        return view('employees.edit', [
            'filteredData' => $employee,
            'branchOffices' => BranchOffice::all(),
        ]);
    }

    /**
     * Saves new employee and validates data
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'branch_office' => ['required'],
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

        return redirect('employees/list/')->with('message', 'Employee has been saved!');
    }

    /**
     * Deletes specific employee
     *
     * @param Request $request
     * @param Employee $employee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request, Employee $employee)
    {
        $employee->delete();

        return redirect('employees/list')->with('message', 'Employee has been deleted!');
    }

    /**
     * Updates data about existing employee
     *
     * @param Request $request
     * @param Employee $employee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'branch_office' => ['required'],
            'name' => ['required', 'max:60'],
            'position' => ['required', 'max:60'],
            'age' => ['required', 'numeric', 'min:18', 'max:100'],
            'sex' => ['required', Rule::in(['m', 'f'])],
            'email' => ['required', 'email:rfc,dns'],
        ]);

        $employee->update($validatedData);

        return redirect('employees/list')->with('message', 'Employee has been updated!');
    }
}
