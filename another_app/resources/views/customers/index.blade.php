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
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->birthday }}</td>
                        <td>{{ $customer->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
