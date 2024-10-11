<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Filters\CustomerService;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customerService = new CustomerService();
        $filters = $customerService->transform($request);
        $appended = Customer::where($filters);
        if ($request->query("include")) {
            $appended = $appended->with('invoices');
        }
        return new CustomerCollection($appended->paginate(10)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $request->except('postalCode');
        return new CustomerResource(Customer::create($customer));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        if (request()->query("include")) {
            return new CustomerResource($customer->loadMissing('invoices'));
        }
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if (!auth()->user()->tokenCan('delete')) {
            abort(403, 'You do not have permission to delete this resource.');
        }
        return $customer->delete();
    }
}
