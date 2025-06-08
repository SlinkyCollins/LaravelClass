@extends('nav')

@section('content')
    <h1 class="text-center my-3">Welcome to your E-commerce Section</h1>

    <div>
        <form action="/dashboard/ecommerce/{id}" class="container p-5 mt-4 card mx-auto d-flex justify-center w-50 gap-3"
            method="POST" enctype="multipart/form-data">
            <h3>Upload your Products Here</h3>
            @csrf
            <input type="hidden" value="{{ $id }}" name="userId" class="form-control">
            <input type="text" placeholder="Product Name" name="productName" class="form-control">
            <textarea placeholder="Product Description" cols="30" rows="5" name="productDesc" class="form-control"></textarea>
            <input type="number" placeholder="Product Price" name="productPrice" class="form-control">
            <input type="number" placeholder="Product Quantity" name="productQty" class="form-control">
            <select name="productCategory" class="form-control">
                <option value="" disabled selected>Select Category</option>
                <option value="electronics">Electronics</option>
                <option value="clothing">Fashion</option>
                <option value="books">Books</option>
                <option value="home">Home</option>
                <option value="beauty">Beauty</option>
                <option value="food">Food & Groceries</option>
                <option value="toys">Toys & Games</option>
                <option value="fitness">Fitness & Sports</option>
                <option value="automobile">Automobile Accessories</option>
                <option value="other">Others</option>
            </select>
            <input type="file" name="productImage" class="form-control">
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>


    <div>
        <a href="/dashboard/ecommerce/{{ $id }}/products">View my products</a>
    </div>
@endsection
