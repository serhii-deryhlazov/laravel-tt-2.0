<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $token = '2|PQs9FaDmN0fLwsGO2jzvq3aEmbXHmBxOtCtgBrjy';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://localhost:8000/api/v1/customers');

        if ($response->successful()) {
            $customerData = $response->json()['data'];

            $customers = collect($customerData)->map(function ($customer) {
                return new Customer($customer);
            });

            return view('customers.index', compact('customers'));
        }
    }
}
