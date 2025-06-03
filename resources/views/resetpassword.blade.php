@extends('nav')

@section('content')
<div class="col-6 mx-auto shadow p-4 mt-4">
    <h3 class="text-center text-primary">Reset Password</h3>
    <form action="/resetpassword" method="post">
        @csrf
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <input type="password" name="newPassword" placeholder="Enter New Password" class="form-control my-2">
        @if ($errors->get('newPassword'))
            <div class="text-sm text-danger">{{ $errors->first('newPassword') }}</div>
        @endif
        <input type="password" name="confirmPassword" placeholder="Confirm New Password" class="form-control my-2">
        @if ($errors->get('confirmPassword'))
            <div class="text-sm text-danger">{{ $errors->first('confirmPassword') }}</div>
        @endif
        <div class="text-center">
            <input type="submit" name="submit" value="Save Password" class="btn btn-outline-primary">
        </div>
    </form>
</div>
@endsection
