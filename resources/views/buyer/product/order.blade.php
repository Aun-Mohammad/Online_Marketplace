{{-- {{dd(Auth::user()->user_id)}} --}}
{{-- {{dd(Auth::user()->product_id)}} --}}


@extends('partials.layouts.main')

<body class="bg-light">
    <div class="col-12">
        <div class="card shadow mx-auto">
            <div class="card-header">
                <div class="col-12 text-end">
                    <a href="{{ route('buyer-dashboard') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                {{-- <p>Product ID: {{ $product->product_id }}</p> --}}
                @include('partials.alerts')
                <form action="{{ route('buyer.product.place_order') }}" method="POST">
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    {{-- <input type="hidden" name="user_id" value="{{ $user_id }}"> --}}

                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                            name="quantity" id="quantity" placeholder="Enter the quantity"
                            value="{{ old('quantity') }}">
                        @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                            placeholder="Enter address!">{{ old('address') }}</textarea>

                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="phone_no" class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone_no') is-invalid @enderror"
                            name="phone_no" id="phone_no" placeholder="Enter phone no!" value="{{ old('phone_no') }}">
                        @error('phone_no')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-5 mb-3 text-center">
                        <input type="submit" value="Place Order" class="btn btn-success btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
