<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;

class BranchOfficeController extends Controller
{
    /**
     * Get all employee data and display it
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list() {
        return view('branchOffice.list', [
            'branchOffices' => BranchOffice::all(),
        ]);
    }
}
