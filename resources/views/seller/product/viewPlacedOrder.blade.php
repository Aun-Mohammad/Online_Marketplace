{{-- {{ $orders }} --}}
@extends('partials.layouts.main')

<div class="container-fluid p-0 shadow">
    <div class="row">
        <div class="col-lg-16 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="row">

                        <div class="col-12 text-end">
                            <a href="{{ route('seller-dashboard') }}" class="btn btn-secondary">Back</a>
                        </div>

                        <div class="col-12 text-center">
                            <h2>Placed Orders Inventory</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($orders) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>User Name</th>
                                    <th>Phone Number</th>
                                    <th>Final Price</th>
                                    <th>Address</th>
                                    <th>Order Date and Time (local Time)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ $order->phone_no }}</td>
                                        <td>{{ $order->final_price }} $</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->created_at }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-danger m-0">You haven't recieved any orders yet!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
