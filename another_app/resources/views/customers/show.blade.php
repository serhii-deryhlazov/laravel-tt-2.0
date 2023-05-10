@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Customer Details</h1>

        <table class="table">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $customer->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $customer->email }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">Edit</a>
    </div>
@endsection
