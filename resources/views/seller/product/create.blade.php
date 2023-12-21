@extends('partials.layouts.main')
{{-- {{dd(Auth::user()->owner_id)}} --}}

<body class="bg-dark">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-12 text-end">
                    <a href="{{ route('seller-dashboard') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                @include('partials.alerts')
                <form action="{{ route('seller.product.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Enter the name!" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Price $</span>
                        <input type="text" aria-label="Amount (to the nearest dollar)"
                            class="form-control @error('price') is-invalid @enderror" name="price" id="price"
                            placeholder="Enter the Price per Piece (Numbers Only)" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                            rows="3" placeholder="Enter the description!">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-control">Product Image</label>
                        <input type="file" id="image"
                            class="form-control @error('image') is-invalid
                            @enderror"
                            name="image" placeholder="Enter the product image!" value="{{ old('image') }}">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="submit" value="Create Product" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
