<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'productFile' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->date = $validatedData['deliveryDate'];
        $product->fileType = $request->file('productFile')->getClientOriginalExtension();
        $product->save();

        if($request->hasFile('productFile')){
            $file = $request->file('productFile');
            Storage::put('public/productImages/' . $product->uuid, $file);

            return redirect('products/list/')->with('message', 'Product has been saved with picture!');
        }

        return redirect('products/list/')->with('message', 'Product has been saved!');
    }

    public function delete(Request $request, Product $product)
    {
        $product->delete();

        return redirect('products/list')->with('message', 'Product has been deleted!');
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:60'],
            'description' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'deliveryDate' => ['required', 'date'],
            'productFile' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $product->update($validatedData);

        if($request->hasFile('productFile')){
            $dir = 'public/productImages/' . $product->uuid;
            Storage::deleteDirectory($dir);
            $file = $request->file('productFile');
            Storage::put($dir, $file);

            return redirect('products/list/')->with('message', 'Product has been saved with picture!');
        }

        return redirect('products/list')->with('message', 'Product has been updated!');
    }
}
