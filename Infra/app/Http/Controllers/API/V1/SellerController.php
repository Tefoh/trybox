<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\SellerRequest;
use Core\Services\User\SellerService;
use Core\ValueObjects\SellerObject;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function __construct(
        private readonly SellerService $sellerService
    )
    { }

    public function store(SellerRequest $request)
    {
        $sellerObject = new SellerObject($request->validated());

        return $this->sellerService->save($sellerObject, $request->user());
    }
}
