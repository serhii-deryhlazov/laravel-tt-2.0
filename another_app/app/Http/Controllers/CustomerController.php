<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Customer;
use App\Models\BankData;
use Illuminate\Http\Client\RequestException;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerController extends Controller
{
    public function index()
    {
        $token = '1|gm6RPKvodjnMvjVYFDyYFaz61AdLF9Nz24Fk4A53';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:8000/api/v1/customers');

            if ($response->successful()) {
                $customerData = $response->json()['data'];

                $customers = collect($customerData)->map(function ($customer) {
                    $customerModel = new Customer($customer);

                    // Retrieve bank data for each customer
                    $bankData = $customer['bank_data'];

                    if ($bankData) {
                        $bankDataModel = new BankData($bankData);
                        $customerModel->setRelation('bankData', $bankDataModel);
                    }

                    return $customerModel;
                });

                $perPage = 2; 
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $pagedData = $customers->slice(($currentPage - 1) * $perPage, $perPage)->all();
                $paginatedCustomers = new LengthAwarePaginator($pagedData, $customers->count(), $perPage, $currentPage);

                return view('customers.index', compact('paginatedCustomers'));
            } else {
                // Handle unsuccessful response
            }
        } catch (RequestException $e) {
            // Handle request exception
        }
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(CustomerStoreRequest $request)
    {
        // Process and save the customer data

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        // Process and update the customer data

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        // Delete the customer

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
