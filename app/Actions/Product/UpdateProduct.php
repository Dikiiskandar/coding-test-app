<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class UpdateProduct
{
    public function handle(Request $request, Product $product): Product
    {
        if($request->photo) {
            $product->photo_path = $request->photo->storePublicly(
                'product-photos', ['disk' => 'public']
            );
        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->save();

        return $product;
    }
}
