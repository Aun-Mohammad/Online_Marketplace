@extends('partials.layouts.main')

<body class="bg-light">
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">

        <div class="card mb-3 shadow" style="max-width: max-content;">
            <div class="row g-0">
                <div class="col-12 col-md-4">
                    <img src="{{ asset('template/img/products/' . $product->image) }}" class="img-fluid rounded-start"
                        alt="Image not available!">
                </div>
                <div class="col-12 col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="col-12 text-end">
                        <a href="{{ route('seller-dashboard') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
</body>
