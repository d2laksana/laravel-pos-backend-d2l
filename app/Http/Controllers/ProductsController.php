<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all products from database and categori name
        $products = Products::with('category')->paginate(10);
        // get category name from category id in products table
        // $products = Products::with('category')->get();
        // $products = Products::with('category')->paginate(10);


        // return to view with products
        return view('pages.product.index', compact('products'), ['type_menu' => 'products']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return to view
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        // validate request
        $data = $request->validated(
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'image' => 'required',
                'category_id' => 'required',
                'stock' => 'required',
            ]
        );

        // store data from request
        // return to view
        return redirect()->route('products.index');
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
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
