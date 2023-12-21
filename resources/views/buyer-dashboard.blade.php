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
                        <div class="card-body">
                            <div>
                                <h5>Welcome {{ Auth::user()->name }} to your {{ Auth::user()->role }} account!</h5>
                            </div>

                            @include('partials.alerts')
                            @if (count($products) > 0)
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    @foreach ($products as $product)
                                        <div class="col">
                                            <div class="card mx-auto" style="width: 25rem">
                                                <img src="{{ asset('template/img/products/' . $product->image) }}"
                                                    class="card-img-top" alt="No Image Available" height="400">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $product->name }} {{ $product->price }} $
                                                    </h5>
                                                    <a href="{{ route('buyer.product.order', $product->product_id) }}"
                                                        class="btn btn-success btn-sm">Order Now</a>
                                                    <a href="{{ route('buyer.product.view', $product) }}"
                                                        class="btn btn-dark btn-sm">See Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-danger m-0">No Product Found!</div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</body>
