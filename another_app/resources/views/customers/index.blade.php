@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Customers</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>Account Age (Months)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->birthday }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->bankData->bank_name }}</td>
                        <td>{{ $customer->bankData->account_number }}</td>
                        <td>{{ $customer->bankData->account_age }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
