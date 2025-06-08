@extends('nav')

@section('content')
    <div>
        <h3 class="text-left my-5 ms-5 text-decoration-underline">My Products</h3>
        @if ($myproducts->isEmpty())
            <div>No products uploaded yet. Upload one <a href="/dashboard/ecommerce/{{ $id }}">here</a></div>
        @else
            @foreach ($myproducts as $item)
                <ul>
                    <li>{{ $item->id }}</li>
                    <div style="list-style-type: none">
                        <li><strong>Product Name:</strong> {{ $item->name }}</li>
                        <li><strong>Description:</strong> {{ $item->description }}</li>
                        <li><strong>Price:</strong> ₦{{ number_format($item->price, 2) }}</li>
                        <li><strong>Quantity:</strong> {{ $item->quantity }}</li>
                        <li><strong>Category:</strong> {{ $item->category }}</li>
                        <li><strong>Created At:</strong> {{ $item->created_at }}</li>
                        <li><strong>Updated At:</strong> {{ $item->updated_at }}</li>
                    </div>
                    <img src="/uploads/product_images/{{ $item->image }}" alt="Product Image" width="50" height="50">
                </ul>
            @endforeach
        @endif
    </div>
@endsection
