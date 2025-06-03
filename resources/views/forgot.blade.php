@extends('nav')

@section('content')
    <div class="col-5 mx-auto shadow p-4 mt-4">
        <h3 class="text-center text-primary">Confirm Email</h3>
        <form action="/forgot" method="POST">
            @csrf
            @if ($errors->get('email'))
                <div class="text-sm text-danger">{{ $errors->first('email') }}</div>
            @endif
            @if (isset($message))
                <span class="text-center text-primary fw-bold">{{ $message }}</span>
            @endif
            @if (session('error'))
                <div class="text-danger">{{session('error')}}</div>
            @endif
            <input type="text" size="20" name="email" placeholder="Enter a valid email address" class="form-control my-3">
            <div class="text-center">
                <input type="submit" name="submit" value="Verify Email" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
@endsection
