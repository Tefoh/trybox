<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\ProductRequest;
use App\Models\Store;
use Core\Services\Product\ProductService;
use Core\ValueObjects\Store\AddProductToStoreObject;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    )
    { }

    public function index(Request $request)
    {
        return $this->productService->getProducts($request->user());
    }

    public function store(ProductRequest $request, Store $store)
    {
        $productObject = new AddProductToStoreObject($request->validated());

        return $this->productService->save(
            $productObject, $request->user(), $store->id
        );
    }
}
