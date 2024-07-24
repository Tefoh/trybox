<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\BuyProductRequest;
use App\Http\Requests\API\V1\ProductRequest;
use App\Jobs\ProcessOrderJob;
use App\Models\Product;
use App\Models\Store;
use Core\Services\Product\ProductService;
use Core\ValueObjects\Products\BuyProductObject;
use Core\ValueObjects\Store\AddProductToStoreObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function buy(BuyProductRequest $request, Product $product)
    {
        $buyProductObject = new BuyProductObject($request->validated());

        $transaction = $this->productService->buyProduct(
            $buyProductObject, $request->user(), $product->id
        );

        Http::fake([
            '*' => Http::response(['transaction_num' => uniqid()], 200),
        ]);

        $response = Http::post('http://random.com/anywhere');
        $transactionNumber = $response->json()['transaction_num'];
        ProcessOrderJob::dispatch($transaction, $transactionNumber);

        return $this->productService->updateTheTransactionNumber(
            $transaction, $transactionNumber
        );
    }
}
