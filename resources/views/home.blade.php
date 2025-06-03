@extends('nav')

@section('search-bar')
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
@endsection

@section('content')
    <div>
        <form action="/register" method="post" class="container mt-5 p-4 card mx-auto d-flex justify-center w-50">
            @csrf
            <h4 class="text-center">Registration Form</h4>

            @if (isset($message))
                <span class="text-center text-{{ $status ? 'success' : 'danger' }} fw-bold">{{ $message }}</span>
            @endif

            <div class="form-group mb-2">
                <label for="">Full Name</label>
                <input type="text" class="form-control" name="full_name">
            </div>
            @if ($errors->get('full_name'))
                <div class="text-sm text-danger">{{ $errors->first('full_name') }}</div>
            @endif

            <div class="form-group mb-2">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email">
            </div>

            @if ($errors->get('email'))
                <div class="text-sm text-danger">{{ $errors->first('email') }}</div>
            @endif

            <div class="form-group mb-2">
                <label for="">Phone Number</label>
                <input type="tel" class="form-control" name="phone_number">
            </div>

            <div class="form-group mb-2">
                <label for="">Password</label>
                <input type="text" class="form-control" name="password">
            </div>

            @if ($errors->get('password'))
                <div class="text-sm text-danger">{{ $errors->first('password') }}</div>
            @endif

            <button class="btn btn-outline-success">Submit</button>
        </form>


        {{-- <p class="text-success">Welcome to Laravel 12, {{$name. $school}}</p>
    {{$username}} --}}
    </div>
@endsection
