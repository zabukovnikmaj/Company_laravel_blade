<?php

namespace App\Http\Controllers;

use \App\Models\Employees;

class EmployeesController extends Controller
{
    /**
     * Get all employee data and display it
     *
     * @return string
     */
    public function list() {
        return view('employees.list', [
            'employees' => Employees::all(),
        ]);
    }
}
