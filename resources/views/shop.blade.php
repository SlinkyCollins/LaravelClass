@extends('nav')

@section('landingpage')
    <div class="container py-5">
        <h1 class="text-center mb-4">Welcome to the E-commerce Shop 🛍️</h1>
        <p class="text-center text-muted mb-5">Browse all our fresh products</p>

        <h3 class="text-left mb-4 text-decoration-underline">All Products</h3>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($allproducts as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        <img src="/uploads/product_images/{{ $item->image }}" class="card-img-top" alt="{{ $item->name }}"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text text-muted text-truncate">{{ $item->description }}</p>
                            <p class="card-text fw-bold">₦{{ number_format($item->price, 2) }}</p>
                            <p class="card-text">📦 Qty: {{ $item->quantity }}</p>
                            <p class="card-text">🏷️ {{ ucfirst($item->category) }}</p>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                            <div>
                                @if ($item->user)
                                    <small class="text-muted">👤 {{ Str::title($item->user->name) }}</small>
                                @else
                                    <small class="text-danger">No seller info</small>
                                @endif
                                <br>
                                <small class="text-muted">🗓️ {{ $item->created_at->format('M d, Y') }}</small>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#" class="btn btn-sm btn-outline-primary mb-1">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="bi bi-cart-plus"></i> Buy
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
