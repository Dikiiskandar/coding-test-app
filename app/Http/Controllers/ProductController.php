<?php

namespace App\Http\Controllers;

use App\Actions\Product\CreateProduct;
use App\Actions\Product\UpdateProduct;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Jetstream\HasTeams;

class ProductController extends Controller
{
    use HasTeams;
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
        ])->except(['show']); 
    }

    public function index()
    {
        $product = Product::where('team_id', auth()->user()->currentTeam->id)
            ->with('team')
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

        return inertia('Products/Index', [
            'product' => $product
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
    public function store(StoreRequest $request, CreateProduct $createProduct)
    {
        if(!auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'create')){
            abort(401);
        }

        $product = $createProduct->handle($request);
        
        return to_route('products.show', $product)->with('success', 'the product is stored!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $user = auth()->user();

        if($user) {
            $currentTeam = $user->currentTeam;
            $ownedPermissions = $user->teamPermissions($user->currentTeam);
        }

        $recomendedProducts = Product::where('team_id', $product->team->id)->inRandomOrder()->limit(3)->get();

        return inertia('Products/Show', [
            'product' => $product->load('team'),
            'recomendedProducts' => $recomendedProducts->load('team'),
            'currentTeam' => $currentTeam ?? null,
            'ownedPermissions' => $ownedPermissions ?? [],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if(!auth()->user()->hasTeamPermission($product->team, 'update')){
            abort(401);
        }

        return inertia('Products/Edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        if(!auth()->user()->hasTeamPermission($product->team, 'update')){
            abort(401);
        }
        
        $actionUpdateProduct = new UpdateProduct();
        $product = $actionUpdateProduct->handle($request, $product);

        return to_route('products.index')->with('success', 'the product is updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if(!auth()->user()->hasTeamPermission($product->team, 'delete')){
            abort(401);
        }

        $product->delete();

        return to_route('products.index')->with('success', 'the product is deleted!');
    }
}
