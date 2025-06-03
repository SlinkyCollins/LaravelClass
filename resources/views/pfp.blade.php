@extends('nav')

@section('edit-content')
    <div class="p-4">
        <h2>Update profile picture</h2>
        @if (session('profilemessage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('profilemessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="/dashboard/updatepfp/{{ $id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="profilepic">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
