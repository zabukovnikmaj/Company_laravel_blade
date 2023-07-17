<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Product;
use Illuminate\Http\Request;

class BranchOfficeController extends Controller
{
    /**
     * Get all employee data and display it
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        return view('branchOffice.list', [
            'branchOffices' => BranchOffice::all(),
        ]);
    }

    public function edit(Request $request, BranchOffice $branchOffice)
    {
        return view('branchOffice.edit', [
            'filteredData' => $branchOffice,
            'products' => Product::all(),
            'productsData' => $branchOffice->product()->pluck('products.uuid')->toArray(),
        ]);
    }
}
