<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class CreateNewProduct
{
    public function handle(Request $request): Product
    {
        if($request->photo) {
            $path_url = $request->photo->storePublicly(
                'product-photos', ['disk' => 'public']
            );
        }

        return Product::create([
            'team_id' => auth()->user()->currentTeam->id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'sku' => $request->sku,
            'description' => $request->description,
            'specification' => $request->specification,
            'photo_path' => $path_url ?? '',
        ]);
    }
}
