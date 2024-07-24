<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CustomerAddressRequest;
use Core\Services\Address\CustomerAddressService;
use Core\ValueObjects\CustomerObject;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    public function __construct(
        private readonly CustomerAddressService $customerAddressService
    )
    { }

    public function store(CustomerAddressRequest $request)
    {
        $customerAddressObject = new CustomerObject(
            $request->validated(),
        );

        return $this->customerAddressService->save(
            $customerAddressObject,
            $request->user()
        );
    }
}
