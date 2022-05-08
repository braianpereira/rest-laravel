<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request): ProductCollection
    {
        $products = $this->product;

        if($request->has('fields'))
            $products = $products->selectRaw($request->fields);



//        return response()->json($products);
        return new ProductCollection($products->paginate(10));
    }

    public function show($id): ProductResource
    {
        $product = $this->product->find($id);

//        return response()->json($product);
        return new ProductResource($product);
    }

    public function save(Request $request): \Illuminate\Http\JsonResponse
    {
        $product = $this->product->fill($request->all());

        $product->save();

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = $this->product->find($id);
        $product->fill($request->all())->save();

        return response()->json($product);
    }

    public function remove($id)
    {
        $product = $this->product->find($id);

        if($product) {
            $product->delete();
        }

        return response()->json(['data' => ['msg' => 'Produto removido com sucesso!']]);
    }
}
