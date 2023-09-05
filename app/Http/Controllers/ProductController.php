<?php

namespace App\Http\Controllers;

use App\Actions\Product\CreateNewProduct;
use App\Http\Requests\Products\StoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return inertia('Products/Index', [
            'products' => $products->load('team'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, CreateNewProduct $createNewProduct)
    {
        $product = $createNewProduct->handle($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $recomendedProducts = Product::where('team_id', $product->team->id)->inRandomOrder()->limit(3)->get();

        return inertia('Products/Show', [
            'product' => $product->load('team'),
            'recomendedProducts' => $recomendedProducts->load('team'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
