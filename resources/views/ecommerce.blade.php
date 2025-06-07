@extends('nav')

@section('content')

<h1 class="text-center my-3">Welcome {{$user->name}}, to your E-commerce Section</h1>

<div>
    <form action="/dashboard/ecommerce/{id}" class="container p-5 mt-4 card mx-auto d-flex justify-center w-50 gap-3" method="POST" enctype="multipart/form-data">
        <h3>Upload your Products Here</h3>
        @csrf
        <input type="text" placeholder="Product Name" name="productName" class="form-control">
        <textarea placeholder="Product Description" cols="30" rows="5" name="productDesc" class="form-control"></textarea>
        <input type="number" placeholder="Product Price" name="productPrice" class="form-control">
        <input type="file" name="productImage" class="form-control">
        <input type="hidden" value="{{$user->id}}" name="userId" class="form-control">
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

@endsection
