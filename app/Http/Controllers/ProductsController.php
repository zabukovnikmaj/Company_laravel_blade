<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Get all employee data and display it
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list() {
        return view('products.list', [
            'products' => Product::all(),
        ]);
    }

    public function edit(Request $request, Product $product)
    {
        return view('products.edit', [
            'filteredData' => $product,
        ]);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:60'],
            'description' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'deliveryDate' => ['required', 'date'],
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->date = $validatedData['deliveryDate'];
        $product->fileType = isset($_FILES["file"]["name"]) ? pathinfo($_FILES["file"]["name"])['extension'] : 'png';
        $product->save();

        return redirect('products/list/');
    }
}
