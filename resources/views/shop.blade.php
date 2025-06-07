@extends('nav')

@section('landingpage')
    <h1>Welcome to the E-commerce Shop</h1>

    <p>Landing Page</p>

    <div>
        <h3 class="text-left my-5 ms-5 text-decoration-underline">All Products</h3>
        @foreach ($allproducts as $item)
            <ul>
                <li>{{ $item->id }}</li>
                <li style="list-style-type: none"><strong>Product Name:</strong> {{ $item->name }}</li>
                <li style="list-style-type: none"><strong>Description:</strong> {{ $item->description }}</li>
                <li style="list-style-type: none"><strong>Price:</strong> ₦{{ number_format($item->price, 2) }}</li>
                <li style="list-style-type: none"><strong>Created At:</strong> {{ $item->created_at }}</li>
                <li style="list-style-type: none"><strong>Updated At:</strong> {{ $item->updated_at }}</li>
                <img src="/uploads/product_images/{{ $item->image }}" alt="Product Image" width="50" height="50">
            </ul>
            <div class="mb-2 p-3">
                @if ($item->user)
                    <ul>
                        <li><strong>Seller Name:</strong> {{ $item->user->name }}</li>
                    </ul>
                @else
                    <p>No user associated with this note.</p>
                @endif

            </div>
        @endforeach
    </div>
@endsection
