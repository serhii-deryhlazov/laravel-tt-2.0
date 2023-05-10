@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Customers</h1>

        <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Create Customer</a>

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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paginatedCustomers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->birthday }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->bankData->bank_name }}</td>
                        <td>{{ $customer->bankData->account_number }}</td>
                        <td>{{ $customer->bankData->account_age }}</td>
                        <td>
                            <a href="{{ route('customers.show', ['customer' => $customer->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('customers.destroy', ['customer' => $customer]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $paginatedCustomers->links() }}
        </div>
    </div>
@endsection
