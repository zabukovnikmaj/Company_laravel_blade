<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Get all employee data and display it
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $filename = Storage::files('public/productImages/' . $product->id);
            if (count($filename) !== 0) {
                $product->filename = Storage::url($filename[0]);
            }
        }

        return view('products.list', [
            'products' => $products,
            'title' => 'List products',
        ]);
    }

    /**
     * Displays existing data into form
     *
     * @param Request $request
     * @param Product $product
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Request $request, Product $product)
    {
        if (Storage::disk('local')->exists('public/productImages/' . $product->id)) {
            $filename = Storage::files('public/productImages/' . $product->id);
            if (count($filename) !== 0) {
                $product->filename = Storage::url($filename[0]);
            }
        }

        return view('products.edit', [
            'existingData' => $product,
            'title' => 'Edit product',
        ]);
    }

    /**
     * Saves and validates new product entry. Also handles file upload
     *
     * @param Request $request
     * @return Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
        $product->file_type = $request->file('productFile')->getClientOriginalExtension();
        $product->save();

        if ($request->hasFile('productFile')) {
            $file = $request->file('productFile');
            Storage::put('public/productImages/' . $product->id, $file);

            return redirect()->route('product.list')->with('message', 'Product has been saved with picture!');
        }

        return redirect()->route('product.list')->with('message', 'Product has been saved!');
    }

    /**
     * Deletes specific product and corresponding picture
     *
     * @param Request $request
     * @param Product $product
     * @return Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request, Product $product)
    {
        $product->delete();

        $dir = 'public/productImages/' . $product->id;
        Storage::deleteDirectory($dir);

        return redirect()->route('product.list')->with('message', 'Product has been deleted!');
    }

    /**
     * Updates and validates new product data. Also takes care of new image upload
     *
     * @param Request $request
     * @param Product $product
     * @return Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

        if ($request->hasFile('productFile')) {
            $dir = 'public/productImages/' . $product->id;
            Storage::deleteDirectory($dir);
            $file = $request->file('productFile');
            Storage::put($dir, $file);

            return redirect()->route('product.list')->with('message', 'Product has been saved with picture!');
        }

        return redirect()->route('product.list')->with('message', 'Product has been updated!');
    }
}
