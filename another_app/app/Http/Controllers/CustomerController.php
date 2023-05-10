<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Customer;
use App\Models\BankData;
use Illuminate\Http\Client\RequestException;

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

                return view('customers.index', compact('customers'));
            } else {
                // Handle unsuccessful response
            }
        } catch (RequestException $e) {
            // Handle request exception
        }
    }
}

