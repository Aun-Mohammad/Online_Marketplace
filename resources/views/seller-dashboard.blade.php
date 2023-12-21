@extends('partials.layouts.main')

<body class="bg-light">
    <div class="container-fluid p-0 shadow">
        <div class="row">
            <div class="col-lg-16 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 text-end">
                                <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <h5>Welcome {{ Auth::user()->name }} to your {{ Auth::user()->role }} account!</h5>
                        </div>

                        <div class="row p-0">
                            <div class="col-16 text-end">
                                <a href="{{ route('seller.product.create') }}" class="btn btn-outline-primary">Add
                                    Products</a>
                            </div>
                            <div class="col-16 text-start">
                                <a href="{{ route('seller.product.view_placed_order') }}"
                                    class="btn btn-outline-success">View
                                    Orders</a>
                            </div>
                        </div>
                        <hr>
                        @include('partials.alerts')
                        @if (count($products) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered m-0">
                                    <thead>
                                        <tr>
                                            <th>Sr. No</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            @if (Auth::user()->id == $product->owner_id)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->price }} $</td>

                                                    <td>
                                                        <img src="{{ asset('template/img/products/' . $product->image) }}"
                                                            alt="No Image Available" width="100">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('seller.product.view', $product->product_id) }}"
                                                            class="btn btn-info">View</a>
                                                        <form
                                                            action="{{ route('seller.product.edit', $product->product_id) }}"
                                                            class="d-inline">
                                                            @csrf

                                                            <button type="submit"
                                                                class="btn btn-secondary">Edit</button>
                                                        </form>
                                                        <form
                                                            action="{{ route('seller.product.destroy', $product->product_id) }}"
                                                            method="POST" fo class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" value="Delete"
                                                                class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-danger m-0">No Record Found!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
