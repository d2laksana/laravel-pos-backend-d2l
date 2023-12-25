<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // search products by name, category name
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.name', 'like', '%' . $request->search . '%')
            ->orWhere('categories.name', 'like', '%' . $request->search . '%')
            // ->orderBy('products.id', 'asc')
            ->paginate(10);

        // return to view with products
        return view('pages.product.index', compact('products'), ['type_menu' => 'products']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return to view
        return view('pages.product.create', ['type_menu' => 'products']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        // validate request
        $data = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric|min:1000',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|numeric|min:1',
            ]
        );
        // save image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAS('public/product', $imageName);
        // store data from request
        $data['image'] = $imageName;
        Products::create($data);
        // return to view
        return redirect()->route('products.index')->with('success', 'Product Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // find product by 
        $products = Products::findOrFail($id);
        // return to view
        return view('pages.product.edit', compact('products'), ['type_menu' => 'products']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // find product by id
        $products = Products::findOrFail($id);
        // validate request
        $data = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric|min:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|numeric|min:1',
            ]
        );
        // check if request has image
        if ($request->has('image')) {
            // delete old image
            Storage::delete('public/product/' . $products->image);
            // save new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAS('public/product', $imageName);
            // store data from request
            $data['image'] = $imageName;
        }
        // update product
        $products->update($data);
        // return to view
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // find product by id
        $product = Products::findOrFail($id);
        // delete image
        Storage::delete('public/product/' . $product->image);
        // delete product
        $product->delete();
        // return to view
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
