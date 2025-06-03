@extends('nav')

@section('usersandnotes')
<h1 class="my-2">Admin Page</h1>

@foreach ($users as $user)
    <div class="shadow-sm mb-2 p-4">
        <strong>User:</strong>
        <ul>
            <li><strong>User ID:</strong> {{ $user->id }}</li>
            <li><strong>Name:</strong> {{ $user->name }}</li>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Created At:</strong> {{ $user->created_at }}</li>
            <li><strong>Updated At:</strong> {{ $user->updated_at }}</li>
        </ul>

        <div class="mb-2 p-3">
            <strong>Notes:</strong>
            @if($user->note)
                <ul>
                    @foreach ($user->note as $note)
                        <li class="mt-3"><strong>Note ID:</strong> {{ $note->id }}</li>
                        <li><strong>Title:</strong> {{ $note->title }}</li>
                        <li><strong>Description:</strong> {{ $note->description }}</li>
                        <li><strong>User ID:</strong> {{ $note->user_id }}</li>
                        <li><strong>Created At:</strong> {{ $note->created_at }}</li>
                        <li><strong>Updated At:</strong> {{ $note->updated_at }}</li>
                    @endforeach
                </ul>
            @else
                <p>No notes created yet.</p>
            @endif
        </div>
    </div>
@endforeach

@endsection

