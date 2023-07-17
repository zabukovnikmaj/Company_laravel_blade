<?php

namespace App\Http\Controllers;

use \App\Models\Employee;

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
}
