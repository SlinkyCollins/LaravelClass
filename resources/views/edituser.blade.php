

    @extends('nav')

    @section('edit-content')
        <form method="POST" action="/dashboard/{{$user->id}}" class="container mt-5 p-4 card mx-auto d-flex justify-center w-50">
            @csrf
            @method('PUT')
            <input type="hidden" name="userId" value="{{$user->id}}">
            <h4 class="text-center">Edit Form</h4>

             <div class="form-group mb-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="editName" value="{{$user->name}}">
            </div>
            <div class="form-group mb-2">
                <label for="">Email</label>
                <input type="email" class="form-control" name="editEmail" value="{{$user->email}}">
            </div>
            <div class="form-group mb-2">
                <label for="">Password</label>
                <input type="password" class="form-control" name="editPassword" value="{{$user->password}}">
            </div>

            <button type="submit" class="btn btn-outline-success">Update</button>
        </form>
    @endsection
