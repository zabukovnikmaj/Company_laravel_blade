<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\BranchOfficeProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'branchOffices' => BranchOffice::with('products')->get(),
            'title' => 'List branch offices',
        ]);
    }

    /**
     * Display existing data into form
     *
     * @param Request $request
     * @param BranchOffice $branchOffice
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Request $request, BranchOffice $branchOffice)
    {
        return view('branchOffice.edit', [
            'existingData' => $branchOffice,
            'products' => Product::all(),
            'productsData' => $branchOffice->products->pluck('id')->toArray(),
            'title' => 'Edit branch office',
        ]);
    }

    /**
     * Creates new entry into database and validates data
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:60'],
            'address' => ['required', 'max:60'],
            'products' => ['required'],
        ]);

        $branchOffice = new BranchOffice();
        $branchOffice->name = $validatedData['name'];
        $branchOffice->address = $validatedData['address'];
        $branchOffice->save();

        foreach ($validatedData['products'] as $product) {
            $branchOfficeProduct = new BranchOfficeProduct();
            $branchOfficeProduct->branch_office_id = $branchOffice->id;
            $branchOfficeProduct->product_id = $product;
            $branchOfficeProduct->save();
        }

        return redirect('branchOffice/list/')->with('message', 'Branch office has been saved!');
    }

    /**
     * Deletes specific entry
     *
     * @param Request $request
     * @param BranchOffice $branchOffice
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request, BranchOffice $branchOffice)
    {
        $branchOffice->delete();

        return redirect('branchOffice/list')->with('message', 'Branch office has been deleted!');
    }

    /**
     * Updates changed data of branch office and products of branch office
     *
     * @param Request $request
     * @param BranchOffice $branchOffice
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, BranchOffice $branchOffice)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:60'],
            'address' => ['required', 'max:60'],
            'products' => ['required'],
        ]);

        $branchOffice->update($validatedData);

        BranchOfficeProduct::where('branch_office_uuid', $branchOffice->uuid)->delete();
        foreach ($validatedData['products'] as $product) {
            $branchOfficeProduct = new BranchOfficeProduct();
            $branchOfficeProduct->branch_office_uuid = $branchOffice->uuid;
            $branchOfficeProduct->product_uuid = $product;
            $branchOfficeProduct->save();
        }

        return redirect('branchOffice/list')->with('message', 'Branch office has been updated!');
    }
}
